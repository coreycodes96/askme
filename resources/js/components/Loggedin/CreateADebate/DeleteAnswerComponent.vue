<template>
	<div>
		<!-- Delete Answer Button Start -->
		<button @click="removeAnswer" type="button" class="btn">
		  	Delete
		</button>
		<!-- Delete Answer Button End -->
	</div>
</template>

<script>
	//Import Vuex
	import {mapActions} from 'vuex';
	
	export default{
		props: {
			answerId: Number //answer id
		},
		methods:{
			...mapActions('questions', ['getQuestions', 'deleteAnswer']), //getting the questions and delete answer action
			removeAnswer(){
				//passing the answer id to the delete answer action
				this.deleteAnswer(this.answerId);

				//fetching the questions
				this.getQuestions();
			}
		}
	}
</script>

<style scoped>
/* Delete Answer Start */
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
/* Delete Answer End */

/* Responsive Start */
	@media screen and (max-width: 900px){
		button{
			margin: 10px 0 30px 0;
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