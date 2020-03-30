<template>
	<div>
		<!-- If the user hasn't got any questions -->
		<div v-if="questionObject == ''" class="card no-questions-container">
			<div class="card-body">
				<p>There are no questions here</p>
			</div>
		</div>
		<!-- Displaying the questions -->
		<div v-else class="questions-container">
			<div v-for="question in questionObject" :key="question.id">
				<div class="card">
					<div class="card-body">
						<!-- Displaying the questions -->
						<h3>{{ question.question }}</h3>
						<!-- Displaying the username -->
						<p><b>By {{ question.username }}</b></p>

						<div class="answer-count-container">
							<!-- Number of answers -->
							<span @click="toggleAnswers(question.id)" v-if="question.answer">Answer({{ question.answer.length }})</span>
							<!-- If there are no answers -->
							<span @click="toggleAnswers(question.id)" v-else>Answer(0)</span>
						</div>
					</div>
					<!-- Displaying the answers -->
					<div class="answers-container" :id="'answerbox'+question.id">
						<div v-for="answer in question.answer" :key="answer.id">
							<div class="card">
								<div class="card-body">
									<!-- Displaying the answers -->
									<h5>{{ answer.answer }}</h5>
									<!-- Displaying the username -->
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
	export default{
		props:{
			questions: String //getting the users questions
		},
		data(){
			return{
				questionObject: JSON.parse(this.questions) //putting the question prop into a data object
			}
		},
		methods:{
			//hide and show answer box
			toggleAnswers(id){
				$('#answerbox'+id).toggle();
			}
		}
	}
</script>

<style scoped>
/* Button Start */
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
/* Button End */

/* Questions Start */
	.no-questions-container{
		margin: 20px auto;
		width: 100%;
		-webkit-border-radius: 0;
		-moz-border-radius: 0;
		-o-border-radius: 0;
		border-radius: 0;
	}

	.no-questions-container p{
		margin: 0;
		padding: 0;
		font-size: 18px;
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
		width: 70%;
		margin: 0 20px 20px 0;
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
</style>