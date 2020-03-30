<template>
	<div>
		<!-- Checking if there are any subscribers -->
		<span v-if="subscribers">
			<span v-if="subscribers.find(s => s.sender === sender)">
				<!-- If the user has already subscribed -->
				<button @click="subscribeToUser" class="btn">{{ unsubscribeBtn }}</button>
			</span>
			<span v-else>
				<!-- If the user hasn't subscribed -->
				<button @click="subscribeToUser" class="btn">{{ subscribeBtn }}</button>
			</span>
		</span>
	</div>
</template>

<script>
	//Import Vuex
	import {mapActions} from 'vuex';
	export default{
		props:{
			sender: String, //getting the sender
			receiver: String, //getting the reciever
			subscribers: Array //getting array of subscribers
		},
		data(){
			return{
				subscribeBtn: 'Subscribe To '+this.receiver, //setting the subscribe button text
				unsubscribeBtn: 'Unsubscribe To '+this.receiver //setting the unsubscribe button text
			}
		},
		methods:{
			...mapActions('profile', ['addSubscriber']), //get the add subscriber action
			subscribeToUser(){
				//putting the subscibe info in a data object
				let data = {
					'sender': this.sender,
					'receiver': this.receiver
				};

				//add the data to the vuex add subscribe action
				this.addSubscriber(data);

				//if the user hasn't subscribed
				if(this.subscribeBtn === 'Subscribe To '+this.receiver){
					this.subscribeBtn = 'Unsubscribe To '+this.receiver; 
				}else{
					this.subscribeBtn = 'Subscribe To '+this.receiver; 
				}

				//if the user has subscribed
				if(this.unsubscribeBtn === 'Unsubscribe To '+this.receiver){
					this.unsubscribeBtn = 'Subscribe To '+this.receiver;
				}else{
					this.unsubscribeBtn = 'Unsubscribe To '+this.receiver; 
				}
			}
		}
	}
</script>

<style scoped>
/* Subscribe Button Start */
	.subscribe-container button{
		width: 200px;
		height: 40px;
		background-color: #FFF;
		color: #1B1D34;
	}
/* Subscribe Button End */

/* Responsive Start */
	@media screen and (max-width: 900px){
		.subscribe-container button{
			width: 100px;
			height: 55px;
		}
	}
/* Responsive End */
</style>