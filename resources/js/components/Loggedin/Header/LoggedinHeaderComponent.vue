<template>
	<div>
		<!-- Display Notification Start -->
		<!-- checking if there are any notifications -->
		<div v-if="notifications != null">
			<div class="alert alert-primary" role="alert">
				<!-- Delete Notification Button -->
				<button class="btn" @click="closeNotification">X</button>
				<!-- Display Subscribers Notification -->
			  	<div v-if="notifications.type == 'App\\Notifications\\SubscribersNotification'">
			  		<p><b>{{ notifications.subscriber }}</b> has subscribed to you!</p>
			  	</div>
				<!-- Display Answer Notification -->
				<div v-if="notifications.type == 'App\\Notifications\\AnswerNotification'">
					<p><b>{{ notifications.answer.username }}</b> has answered <b>"{{ notifications.answer.answer }}"</b> on your debate <b>"{{ notifications.answer.question }}"</b>!</p>
				</div>
				<!-- Display Favourite Notification -->
				<div v-if="notifications.type == 'App\\Notifications\\FavouriteNotification'">
					<p><b>{{ notifications.favourite.username }}</b> favourited your debate <b>"{{ notifications.favourite.question.question }}"</b>!</p>
				</div>
				<p>Go to your notifications to see again!</p>
			</div>
		</div>
		<!-- Display Notification End -->

		<!-- Header Start -->
		<header>
			<div class="container">
				<!-- Title -->
				<h1>Ask Me.</h1>

				<div class="float-right">
					<!-- Show Menu -->
					<span class="show"><i class="fas fa-ellipsis-h sidebar-open"></i></span>
					<!-- Hide Menu -->
					<span class="hide"><i class="fas fa-ellipsis-v sidebar-open"></i></span>
				</div>
			</div>
		</header>
		<!-- Header End -->
		
		<!-- Sidebar Start -->
		<section class="sidebar">
			<!-- Close Sidebar -->
			<i class="fas fa-times sidebar-close"></i>
			<!-- Display Users Username -->
			<div class="sidebar-header">
				<h1>Welcome {{ loggedInUser.username }}!</h1>
			</div>
			<!-- Display Links -->
			<div class="sidebar-body">
				<li><a href="/news">News</a></li>
				<li><a href="/createadebate">Create A Debate</a></li>
				<li><a href="/search">Search</a></li>
				<li><a :href="'/profile/'+loggedInUser.username">My Profile</a></li>
				<li><a href="/notifications">Notifications({{ notificationCount }})</a></li>
				<div></div>
			</div>
			<!-- Logout Button -->
			<div class="sidebar-logout">
				<button class="btn btn-danger" @click="logUserOut">Logout</button>
			</div>
		</section>
		<!-- Sidebar End -->
	</div>
</template>

<script>
	export default{
		props:{
			user: String, //getting the users information
			userNotificationCount: String //getting the notification count
		},
		data(){
			return{
				loggedInUser: JSON.parse(this.user), //loggedin users data
				notificationCount: JSON.parse(this.userNotificationCount), //loggedin users notification count
				notifications: null, //getting the notification websockets (Default is null)

			}
		},
		mounted(){
			//slide down side bar
			$('.sidebar-open').on('click', function(){
				$('.show').hide();
				$('.hide').show();
				$('.sidebar').slideDown();
			})

			//slide up side bar
			$('.sidebar-close').on('click', function(){
				$('.hide').hide();
				$('.show').show();
				$('.sidebar').slideUp();
			})
		},
		methods:{
			//closing the notification when X button is clicked
			closeNotification(){
				this.notifications = null;
			},
			//log the user out
			logUserOut(){
				axios.post('/logout', {
					headers:{
						'Content-Type': 'application/json'
					}
				})
				.then(response =>{
					window.location = '/';
				})
				.catch(errors => {
					console.log(errors.response);
				})
			}
		},
		created(){
			//Echoing the notification object for the user
			Echo.private(`App.User.${this.loggedInUser.id}`)
			    .notification((notification) => {
			        //console.log(notification);
			        this.notifications = notification;
			        let number  = 1;
			        this.notificationCount++;
			    });
		}
	}
</script>

<style scoped>
/* Display Notifications Start */
	.alert{
		position: fixed;
		top: 0;
		left: 0;
		z-index: 2;
		-webkit-border-radius: 0;
		-moz-border-radius: 0;
		-o-border-radius: 0;
		border-radius: 0;
		width: 100%;
		margin: 0;
		padding: 0;
		background-color: #3C3E54;
		text-align: center;
		color: #FFF;
		border: none;
	}

	.alert button{
		float: right;
		margin: 5px 0 0 0;
		color: #FFF;
	}

	.alert .btn:focus{
		box-shadow: none;
	}

	.alert p{
		margin: 0;
		padding: 10px 0 10px 0;
		font-size: 15px;
	}
/* Dislpay Notifications End */

/* Header Start */
	header{
		padding: 20px 0;
		background-color: #1B1D34;
		color: #FFF;
	}

	header .container{
		z-index: 0;
	}

	header .container h1{
		margin-top: 5px;
		display: inline-block;
	}

	header .container .float-right i{
		margin-top: 17px;
		font-size: 26px;
		cursor: pointer;
	}
/* Header End */

/* Sidebar Start */
	.sidebar{
		z-index: 1;
		position: absolute;
		top: 0;
		left: 0;
		width: 300px;
		height: 657px;
		background-color: #1B1D34;
		color: #FFF;
		display: none;
	}

	.sidebar i{
		margin: 10px 10px 0 0;
		padding: 5px;
		float: right;
		font-size: 18px;
		color: #FFF;
	}

	.sidebar-header{
		display: inline-block;
		margin-top: 20px;
		padding: 5px 20px;
		width: 100%;
		text-align: center;
	}

	.sidebar-header h1{
		display: inline-block;
		font-size: 30px;
		border-bottom: 3px solid #FFF;
	}

	.sidebar .sidebar-close{
		cursor: pointer;
	}

	.hide{
		display: none;
	}

	.sidebar-body{
		margin-top: 50px;
		padding: 0 50px;
	}

	.sidebar-body li{
		margin: 20px 0 20px 10px;
		list-style: none;
		font-size: 22px;
	}

	.sidebar-body li a{
		text-decoration: none;
		color: #FFF;
	}

	.sidebar-body li a:hover{
		padding-left: 5px;
		height: 5px;
		border-left: 4px solid #FFF;
	}

	.sidebar-body div{
		width: 200px;
		height: 5px;
		background-color: #FFF;
	}

	.sidebar-logout{
		margin: 40px auto 0 auto;
		text-align: center;
	}

	.sidebar-logout .btn{
		width: 150px;
		height: 45px;
		font-size: 18px;
	}
/* Sidebar End */
</style>