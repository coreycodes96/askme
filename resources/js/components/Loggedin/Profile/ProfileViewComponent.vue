<template>
	<div>
		<div class="container">
			<!-- Profile Header Start -->
			<div class="profile-header">
				<!-- Your profile or the profile username of the user you are visiting -->
				<h2>{{ JSON.parse(loggedinUser).username === JSON.parse(guestUser).username ? "Your Profile" : JSON.parse(guestUser).username+"'s Profile" }}</h2>
				
				<!-- Subscribe Button -->
				<div class="float-right subscribe-container" v-if="JSON.parse(loggedinUser).username != JSON.parse(guestUser).username">
					<subscribe-button :sender="JSON.parse(loggedinUser).username" :receiver="JSON.parse(guestUser).username" :subscribers="JSON.parse(subscribers)"></subscribe-button>
				</div>
				
				<!-- Question, Subscribers & Subscriptions -->
				<div class="profile-buttons-container">
					<button @click="getQuestions" class="btn">Questions</button>
					<button @click="getSubcribers" class="btn">Subscribers({{ fetchSubscribers.length }})</button>
					<button @click="getSubscriptions" class="btn">Subscriptions({{ fetchSubscriptions.length }})</button>
				</div>
			</div>
			<!-- Profile Header End -->

			<!-- Profile Content -->
			<div class="profile-content">
				<!-- Questions Container -->
				<div class="questions-container">
					<!-- Question Component -->
					<questions-profile :questions="questions"></questions-profile>
				</div>

				<!-- Subscribers Container -->
				<div class="subscribers-container">
					<!-- Subscribers Component -->
					<subscribers-profile></subscribers-profile>
				</div>	

				<!-- Subscriptions Container -->
				<div class="subscriptions-container">
					<!-- Subscriptions Component -->
					<subscriptions-profile></subscriptions-profile>
				</div>		
			</div>
		</div>
	</div>
</template>

<script>
	//Import Vuex
	import {mapState, mapGetters, mapActions} from 'vuex';

	//Import Components
	import SubscribeButton from './SubscribeButton.vue';
	import ProfileQuestion from './ProfileQuestionComponent.vue';
	import ProfileSubscriber from './ProfileSubscriberComponent.vue';
	import ProfileSubscription from './ProfileSubscriptionComponent.vue';
	export default{
		props:{
			loggedinUser: String, //logged in user info
			guestUser: String, //other users info
			questions: String, //questions related to user
			subscribers: String, //people that have subscribed to the user
			subscriptions: String //people that the user has subscribed to
		},
		components:{
			'subscribe-button': SubscribeButton, //Subscribe Button Component
			'questions-profile': ProfileQuestion, //Profile Question Component
			'subscribers-profile': ProfileSubscriber, //Subscribers Component
			'subscriptions-profile': ProfileSubscription //Subscription Component
		},
		methods:{
			//open and close question box
			getQuestions(){
				$('.questions-container').show();
				$('.subscribers-container').hide();
				$('.subscriptions-container').hide();
			},
			//open and close subscribers
			getSubcribers(){
				$('.subscribers-container').show();
				$('.questions-container').hide();
				$('.subscriptions-container').hide();
			},
			//open and close subscriptions
			getSubscriptions(){
				$('.subscriptions-container').show();
				$('.questions-container').hide();
				$('.subscribers-container').hide();
			},
			...mapActions('profile', ['sendSubscribers', 'sendSubscriptions']), //send the subscribers and subscriptions to the vuex actions
			storeSubscribers(){
				//store the subscribers to vuex action
				this.sendSubscribers(JSON.parse(this.subscribers));
			},
			storeSubscriptions(){
				//store the subscriptions to vuex action
				this.sendSubscriptions(JSON.parse(this.subscriptions));
			},
			...mapState('profile', ['displaySubscribers']) //get the users subscribers
		},
		computed:{
			...mapGetters('profile', ['fetchSubscribers', 'fetchSubscriptions']) //fetch the users subscribers and subscriptions
		},
		created(){
			//activate functions
			this.displaySubscribers(),
			this.storeSubscribers(),
			this.storeSubscriptions()
		}
	}
</script>

<style scoped>
/* Profile Header Start */
	.profile-header{
		position: relative;
		margin: 20px 0 0 0;
		padding: 15px 10px 15px 20px;
		background-color: #1B1D34;
		color: #FFF;
	}

	.profile-header h2{
		margin: 20px auto;
		padding: 0 0 10px 0;
		text-align: center;
		width: 60%;
		border-bottom: 4px solid #FFF;
	}

	.profile-buttons-container{
		margin-top: 50px;
		text-align: center;
	}

	.profile-buttons-container button{
		margin: 0 25px;
		color: #1B1D34;
		background-color: #FFF;
	}

	.profile-buttons-container button:focus{
		box-shadow: none;
	}

	.subscribe-container{
		position: absolute;
		top: 0;
		right: 0;
		margin: 5px;
	}

	.subscribe-container button{
		width: 150px;
		height: 40px;
	}
/* Profile Header End */

/* Profile Content Start */
	.questions-container{
		display: none;	
	}

	.subscribers-container{
		display: none;
	}

	.subscriptions-container{
		display: none;
	}
/* Profile Content End */

/* Repsonsive Start */
@media screen and (max-width: 850px){
	.profile-buttons-container{
		display: block;
	}

	.profile-buttons-container button{
		margin: 10px auto;
		padding: 0;
		display: block;
		width: 100%;
		-webkit-border-radius: 0;
		-moz-border-radius: 0;
		-o-border-radius: 0;
		border-radius: 0;
	}
}
/* Responsive End */
</style>