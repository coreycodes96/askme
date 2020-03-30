<template>
	<div>
		<!-- Delete Question Button Start -->
		<button @click="removeQuestion" type="button" class="btn">
		  	Delete
		</button>
		<!-- Delete Question Button End -->
	</div>
</template>

<script>
	//Import vuex
	import {mapActions} from 'vuex';
	export default{
		props:{
			questionIndex: Number, //getting the question index
			questionId: Number //getting the question id
		},
		methods:{
			...mapActions('questions', ['deleteQuestion']), //getting the delete question action

			removeQuestion(){
				//create a data object
				let data = {
					'question_index': this.questionIndex,
					'question_id': this.questionId
				};

				//sending the object to the vuex action
				this.deleteQuestion(data);
			}
		}
	}
</script>

<style scoped>
/* Delete Button Start */
	button{
		margin: 0 5px;
		float: right;
		background-color: #BD1111;
		color: #FFF;
	}

	button:hover{
		color: #FFF;
	}

	button:focus{
		box-shadow: none;
	}
/* Delete Button End */

/* Responsive Start */
	@media screen and (max-width: 900px){
		button{
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