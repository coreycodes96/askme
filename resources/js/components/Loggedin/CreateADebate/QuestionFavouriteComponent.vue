<template>
	<div>
		<!-- Checking if there are any favourites -->
		<span v-if="favourites">
			<!-- Checking if the user has liked the debate -->
			<span v-if="favourites.find(s => s.sender === getUsername())">
				<!-- If the user has already liked the debate -->
				<button @click="createFavourite" type="button" class="btn">
				  	{{ this.unfavourite }}
				</button>	
			</span>
			<span v-else>
				<!-- If user hasn't liked the debate -->
				<button @click="createFavourite" type="button" class="btn">
				  	{{ this.favourite }}
				</button>	
			</span>
		</span>
	</div>
</template>

<script>
	//Import Vuex
	import {mapState, mapActions} from 'vuex';
	
	export default{
		props:{
			questionId: Number, //getting the question id
			questionUsername: String, //getting the question username
			questionFavourite: Array //getting all the favourites related to the question
		},
		data(){
			return{
				favourites: this.questionFavourite, //putting the favourites prop in a data object
				favourite: 'Favourite', //favourite string
				unfavourite: 'Unfavourite' //unfavourite string
			}
			
		},
		methods:{
			...mapState('questions', ['user']), //getting the users state from vuex
			...mapActions('questions', ['getQuestions', 'addFavourite']), //getting the questions and getting the add favourite action
			getUsername(){
				//getting the users username
				let json_data = JSON.parse(this.user());

				return json_data.username;
			},
			createFavourite(){
				//putting the data in a data object
				let data = {
					'sender': this.getUsername(),
					'receiver': this.questionUsername,
					'question_id': this.questionId
				};

				//if the user hasn't favourited the question
				if(this.favourite === 'Favourite'){
					this.favourite = 'Unfavourite';
				}else{
					this.favourite = 'Favourite';
				}

				//if the user has favourited the question
				if(this.unfavourite === 'Unfavourite'){
					this.unfavourite = 'Favourite';
				}else{
					this.unfavourite = 'Unfavourite';
				}

				//putting the data into the add favourite vuex action
				this.addFavourite(data);

				//fetching the questions
				this.getQuestions();
			}
		}
	}
</script>

<style scoped>
/* Favourite Button Start */
	button{
		margin: 0 5px;
		float: right;
		background-color: #FFF;
		color: #1B1D34;
	}

	button:hover{
		color: #1B1D34;
	}

	button:focus{
		box-shadow: none;
	}
/* Favourite Button End */

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