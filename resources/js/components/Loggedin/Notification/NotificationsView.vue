<template>
	<div>
		<div class="container">
			<!-- If the notification object is empty -->
			<span v-if="allNotifications == ''">
				<p>No Notifications</p>
			</span>
			<!-- Displaying all the notifications -->
			<span v-else v-for="(notification, index) in allNotifications" :key="notification.id">
				<!-- Subscriber Notifications Start -->
				<div v-if="notification.type == 'App\\Notifications\\SubscribersNotification'">
					<div class="card">
						<div class="card-body">
							<button type="submit" @click="deleteNotification(notification.id, index)" class="btn float-right">X</button>
							<p><b>{{ notification.data.subscriber }}</b> has subscribed to you!</p>
						</div>
					</div>
				</div>
				<!-- Subscriber Notifications End -->

				<!-- Answer Notifications  Start-->
				<div v-if="notification.type == 'App\\Notifications\\AnswerNotification'">
					<div class="card">
						<div class="card-body">
							<button type="submit" @click="deleteNotification(notification.id, index)" class="btn float-right">X</button>
							<p><b>{{ notification.data.answer.username }}</b> has answered <b>"{{ notification.data.answer.answer }}"</b> on your debate <b>"{{ notification.data.answer.question }}"</b>!</p>
						</div>
					</div>
				</div>
				<!-- Answer Notifications End -->
				
				<!-- Follow Notifications Start -->
				<div v-if="notification.type == 'App\\Notifications\\FavouriteNotification'">
					<div class="card">
						<div class="card-body">
							<button type="submit" @click="deleteNotification(notification.id, index)" class="btn float-right">X</button>
							<p><b>{{ notification.data.favourite.username }}</b> favourited your debate <b>"{{ notification.data.favourite.question.question }}"</b>!</p>
						</div>
					</div>
				</div>
				<!-- Follow Notifications End -->
			</span>
		</div>
	</div>
</template>

<script>
	export default{
		props: {
			userId: String, //getting the users id
			userNotifications: String //getting the users notifications
		},
		data(){
			return{
				allNotifications: JSON.parse(this.userNotifications) //putting all the notifications in a data object
			}
		},
		methods:{
			//marking all the notifications as read
			// markAsRead(){
			// 	axios('/markasread')
			// 	.then(response => {
			// 		console.log(response.data);
			// 	})
			// 	.catch(errors => {
			// 		console.log(errors.response);
			// 	})
			// },

			//sending a request to delete a notification based on the id
			deleteNotification(id, index){
				axios(`/deletenotification/${id}`, {
					method: 'delete'
				})
				.then(response => {
					console.log(response.data);
					this.allNotifications.splice(index, 1);
				})
				.catch(errors => {
					console.log(errors.response);
				})
			}
		}
	}
</script>

<style scoped>
/* Notifications Start */
	.container{
		margin: 60px auto 0 auto;
	}

	span p{
		margin: 20px auto;
		padding: 5px 5px 5px 20px;
		width: 100%;
		-webkit-border-radius: 0;
		-moz-border-radius: 0;
		-o-border-radius: 0;
		border-radius: 0;
		font-size: 18px;
		color: #1B1D34;
	}

	.card{
		margin: 20px 0;
	}

	.btn:focus{
		box-shadow: none;
	}
/* Notifications End */

/* Responsive Start */
@media screen and (max-width: 800px){
	span p{
		font-size: 16px;
	}
}
/* Responsive End */
</style>