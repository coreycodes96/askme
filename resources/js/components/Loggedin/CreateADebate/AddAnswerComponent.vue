<template>
	<div>
		<!-- Create An Answer Button Start -->
		<span>
			<button type="button" class="btn" data-toggle="modal" :data-target="'#answerModal'+questionId">
		  		Answer
			</button>
		</span>
		<!-- Create An Answer Button End -->

		<!-- Create An Answer Modal Start -->
		<div class="modal fade" :id="'answerModal'+questionId" tabindex="-1" role="dialog" aria-labelledby="answerModalLabel" aria-hidden="true">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title text-dark" id="answerModalLabel">Answer A Question</h5>
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          			<span aria-hidden="true">&times;</span>
		        		</button>
		      		</div>
			      	<div class="modal-body text-dark">
			      		<div class="answer-form-container col-8 container">
			      			<!-- Add Answer Form Start -->
			      			<form @submit.prevent="addAnswer">
			      				<!-- Answer Textarea -->
			      				<div class="row form-group">
			      					<label>Answer:</label>
			      					<textarea type="text" v-model="answer" class="form-control"></textarea>
			      				</div>
			      				<!-- Answer Button -->
								<div class="row form-group">
									<button type="submit" class="form-control">Add Answer</button>
									
									<!-- Catch Errors -->
									<div class="catch-error">{{ catch_error }}</div>
								</div>
			      			</form>
			      			<!-- Add Answer Form End -->
			      		</div>
			      	</div>
			      	<!-- Close Modal Start -->
			      	<div class="modal-footer">
			        	<button type="button" class="btn" data-dismiss="modal">Close</button>
			      	</div>
			      	<!-- Close Modal End -->
		    	</div>
		  	</div>
		</div>
		<!-- Create An Answer Modal End -->
	</div>
</template>

<script>
	//Import Vuex
	import {mapState, mapActions} from 'vuex';
	export default{
		props:{
			questionId: Number //getting the question id
		},
		data(){
			return{//form data
				answer: '',
				catch_error: ''
			}
		},
		methods:{
			...mapState('questions', ['user']), //getting the users state from vuex
			...mapActions('questions', ['getQuestions', 'newAnswer']), //getting the questions and add answer
			addAnswer(){
				//validation
				if(this.answer === ""){
					//checking the answer textarea is empty
					this.catch_error = 'Please enter an answer';
				}else{
					//parse the data in json format
					let json_data = JSON.parse(this.user());

					//putting the json data in an object
					let data = {
						'username': json_data.username,
						'answer': this.answer,
						'question_id': this.questionId
					};

					//sending the data to vuex to an action to create a debate
					this.newAnswer(data);

					//fetching the questions
					this.getQuestions();

					//display a success message
					this.catch_error = 'Your answer has been submitted!';

					//hiding the modal
					setTimeout(function(){
				    	$('.modal').modal('hide');
				  	}, 1500);

				  	//empty the answer textarea
				  	this.answer = '';
				}
			}
		}
	}
</script>

<style scoped>
/* Answer Button Start */
	span button{
		margin: 0 5px;
		float: right;
		background-color: #FFF;
		color: #1B1D34;
	}

	span button:hover{
		color: #1B1D34;
	}

	span button:focus{
		box-shadow: none;
	}
/* Answer Button End */

/* Form Start */
	.form-group label{
		font-size: 16px;
		color: #1B1D34;
	}

	.form-group textarea{
		font-family: 'PT Sans';
		height: 200px;
		resize: none;
	}

	.form-group textarea:focus{
		outline: none;
		box-shadow: none;
		border: 2px solid #1B1D34;
	}

	.form-group button{
		background-color: #1B1D34;
		color: #FFF;
	}

	.modal-footer button{
		background-color: #1B1D34;
		color: #FFF;		
	}

	.catch-error{
		margin: 20px 0 0 0;
		font-size: 16px;
	}
/* Form End */

/* Responsive Start */
	@media screen and (max-width: 900px){
		span button{
			margin: 10px 0;
			float: none;
			width: 100%;
			display: inline-block;
			-webkit-border-radius: 0;
			-moz-border-radius: 0;
			-o-border-radius: 0;
			border-radius: 0;	
		}
	}
/* Responsive End */
</style>