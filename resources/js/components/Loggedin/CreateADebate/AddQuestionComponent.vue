<template>
	<div>
		<!-- Create A Debate Button Start -->
		<div class="container">
			<div class="create-debate-button-box">
				<button class="btn" data-toggle="modal" data-target="#createQuestionModal">Create A Debate <i class="fas fa-plus"></i></button>
			</div>
		</div>
		<!-- Create A Debate Button End -->

		<!-- Create A Debate Modal Start -->
		<div class="modal fade" id="createQuestionModal" tabindex="-1" role="dialog" aria-labelledby="createQuestionLabel" aria-hidden="true">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="createQuestionLabel">Create A Debate</h5>
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          			<span aria-hidden="true">&times;</span>
		        		</button>
		      		</div>
				    <div class="modal-body">
				    	<div class="col-8 container">
				    		<!-- Create A Debate Form Start -->
			        		<form @submit.prevent="createDebate">
			        			<!-- Debate Textarea -->
			        			<div class="row form-group">
			        				<label>Question:</label>
			        				<textarea type="text" name="question" v-model="question" class="form-control"></textarea>
			        			</div>
								
								<!-- Debate Button -->
			        			<div class="row form-group">
			        				<button type="submit" class="btn form-control">Create A Debate <i class="fas fa-plus"></i></button>

			        				<div class="catch-error">{{ catch_error }}</div>
			        			</div>
			        		</form>
			        		<!-- Create A Debate Form End -->
				    	</div>
				    </div>
				    <!-- Close Modal -->
		      		<div class="modal-footer">
		        		<button type="button" class="btn" data-dismiss="modal">Close</button>
		      		</div>
		    	</div>
		  	</div>
		</div>
		<!-- Create A Debate Modal End -->
	</div>
</template>

<script>
	//Import Vuex
	import {mapState, mapActions} from 'vuex';
	export default{
		data(){//form data
			return{
				question: '',
				catch_error: ''
			}
		},
		methods:{
			...mapState('questions', ['user']), //get the users state from vuex
			...mapActions('questions', ['getQuestions', 'newQuestion']), //getting the questions and add question 
			createDebate(){
				if(this.question === ""){
					//checking if the question textarea is empty
					this.catch_error = 'Please enter your question';
				}else{
					//clearing the errors
					this.catch_error = '';

					//parse the data in json format
					const json_data_user = JSON.parse(this.user());

					//putting the json data in an object
					const data = {
						'username': json_data_user.username,
						'question': this.question
					};

					console.log(data);

					//sending the data to vuex to an action to create a debate
					this.newQuestion(data);

					//fetching the questions
					this.getQuestions();

					//closing the create a debate modal
					setTimeout(function(){
				    	$('.modal').modal('hide');
				  	}, 1500);

					//empty the question textarea
				  	this.question = '';
				}
			}
		}
	}
</script>

<style scoped>
/* Form Start */
	.create-debate-button-box{
		margin: 40px 0 0 0;
		display: inline-block;
		width: 100%;
	}

	.create-debate-button-box .btn{
		float: right;
		background-color: #1B1D34;
		color: #FFF;
	}

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
</style>