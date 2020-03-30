<template>
	<div>
		<div class="questions-container">
			<!-- Checking if there are any questions -->
			<span v-if="fetchQuestions == ''" class="no-questions-container">
				<p>Sorry there isn't any questions!</p>
			</span>
			<!-- Displaying the questions -->
			<div v-else v-for="(question, index) in fetchQuestions" :key="question.id">
				<div class="card">
					<div class="card-body">
						<div class="question-button-container">
							<!-- Delete the question if the question belongs to the user -->
							<span v-if="question.username == getUsername()">
								<delete-button :question-index="index" :question-id="question.id"></delete-button>
							</span>
							<!-- Number of favourites on a question -->
							<span v-if="question.favourite">
								<button class="btn">{{ question.favourite.length }}</button>
							</span>
							<!-- If the question has no favourites -->
							<span v-else>
								<button class="btn">0</button>
							</span>
							<!-- Favourite the question as long as the question isn't the users -->
							<span v-if="question.username != getUsername()">
								<favourite-button :question-id="question.id" :question-username="question.username" :question-favourite="question.favourite"></favourite-button>
							</span>
							<!-- Answer a question -->
							<answer-button :question-id="question.id"></answer-button>
						</div>
						<!-- Display the question -->
						<h3>{{ question.question }}</h3>
						<!-- Display the username -->
						<p><b>By {{ question.username }}</b></p>

						<div class="answer-count-container">
							<!-- Number of answers -->
							<span @click="toggleAnswers(question.id)" v-if="question.answer">Answer({{ question.answer.length }})</span>
							<!-- if the question hasn't got any answers -->
							<span @click="toggleAnswers(question.id)" v-else>Answer(0)</span>
						</div>
					</div>
					<!-- Displaying the answers -->
					<div class="answers-container" :id="'answerbox'+question.id">
						<div v-for="answer in question.answer" :key="answer.id">
							<div class="card">
								<div class="card-body">
								<!-- Delete the answer if it belongs to the user -->
								<span v-if="answer.username == getUsername()">
									<delete-answer-button :answer-id="answer.id"></delete-answer-button>
								</span>
								 	<!-- Display the answer -->
									<h5>{{ answer.answer }}</h5>
									<!-- Display the username -->
									<p><b>By {{ answer.username }}</b></p>
								</div>
							</div>
						</div>						
					</div>
				</div>
			</div>					
		</div>
	</div>
</template>

<script>
	//Import Vuex
	import QuestionFavouriteButton from './QuestionFavouriteComponent.vue';
	import AddAnswerButton from './AddAnswerComponent.vue';
	import DeleteQuestionButton from './DeleteQuestionButtonComponent.vue';
	import DeleteAnswerButton from './DeleteAnswerComponent.vue';
	import {mapState, mapActions, mapGetters} from 'vuex';
	export default{
		components:{
			'favourite-button': QuestionFavouriteButton, //registering the favourite component
			'answer-button': AddAnswerButton, //registering the answer component
			'delete-button': DeleteQuestionButton, //registering the delete question component
			'delete-answer-button': DeleteAnswerButton //registering the delete answer component
		},
		methods:{
			//get the user object
			...mapState('questions', ['user']), //getting the user state
			//get all the questions
			...mapActions('questions', ['getQuestions']), //getting the questions
			getUsername(){
				//returning the users username
				let user = JSON.parse(this.user());

				return user.username;
			},
			toggleAnswers(id){
				//open and close the answers to the questions
				$('#answerbox'+id).toggle();
			}
		},
		computed:{
			//fetch all the questions for the v-for loop
			...mapGetters('questions', ['fetchQuestions'])
		},
		created(){
			//execute all the questions
			this.getQuestions()
		}
	}
</script>

<style scoped>
/* Buttons Start */
	button{
		background-color: #FFF;
		color: #1B1D34;
		cursor: text;
	}

	button:hover{
		color: #1B1D34;
	}

	button:focus{
		box-shadow: none;
	}
/* Buttons End */

/* Questions Start */
	.no-questions-container{
		margin: 30px auto 0 auto;
		width: 80%;
	}

	.no-questions-container p{
		padding: 15px;
		background-color: #1B1D34;
		font-size: 40px;
		color: #FFF;
		text-align: center;
	}

	.questions-container{
		margin: 40px auto 20px auto;
		width: 90%;
		display: block;
	}

	.card{
		margin: 30px 0;
		background-color: #1B1D34;
		color: #FFF;
	}

	.card-body h3{
		margin: 0 20px 20px 0;
		width: 70%;
	}

	.question-button-container button{
		margin: 0px 10px;
		float: right;
	}
/* Questions End */

/* Answers Start */
	.answer-count-container span{
		cursor: pointer;
	}
	.answers-container{
		background-color: #0D0E19;
		display: none;
	}

	.answers-container .card{
		margin-right: 20px;
		float: right;
		width: 80%;
	}
/* Answers End */

/* Responsive Start */
	@media screen and (max-width: 900px){
		.card-body h3{
			margin: 10px 0;
			width: 100%;
			font-size: 20px;
		}

		.question-button-container{
			margin-bottom: 30px;
			padding: 5px;
			display: block;
			width: 100%;
		}

		.question-button-container button{
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