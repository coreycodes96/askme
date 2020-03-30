<template>
	<div>
		<!-- Add Question Component -->
		<AddQuestion></AddQuestion>
		
		<!-- Show Questions Component -->
		<ShowQuestions></ShowQuestions>
	</div>
</template>

<script>
	//Import Vuex
	import {mapActions} from 'vuex';
	import AddQuestion from './AddQuestionComponent.vue';
	import ShowQuestions from './ShowQuestionsComponent.vue';
	export default{
		components:{
			'AddQuestion': AddQuestion, //register add question component
			'ShowQuestions': ShowQuestions //register show questions component
		},
		props:{
			theUser: String
		},
		methods:{
			...mapActions('questions', ['getUser']), //getting the user action
			fetchUser(){
				//sending the users information to the vuex action
				this.getUser(this.theUser);
			}
		},
		created(){
			//activate the function
			this.fetchUser()
		}
	}
</script>