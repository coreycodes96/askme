const profile = {
	namespaced: true,
	state:{
		displaySubscribers: [], //put the subscribers in this array
		displaySubscriptions: [] //put the subscriptions in this array
	},
	getters:{
		fetchSubscribers: (state) => state.displaySubscribers, //put the subscribers state in a getter
		fetchSubscriptions: (state) => state.displaySubscriptions //put the subscriptions state in a getter
	},
	actions:{
		//send subscribers
		sendSubscribers({commit}, data){
			commit('SAVE_SUBSCRIBERS', data);
		},
		//send subscriptions
		sendSubscriptions({commit}, data){
			commit('SAVE_SUBSCRIPTIONS', data);
		},
		//subscribe to a user
		addSubscriber({commit}, data){
			axios.post('/subscribeuser', {
				'sender': data.sender,
				'receiver': data.receiver
			}, {
				headers:{
					'Content-Type': 'application/json'
				}
			})
			.then(response => {
				console.log(response.data);
				if(response.data.message === 'Subscribed'){
					commit('ADD_SUBSCRIBE', response.data.data);
				}

				if(response.data.message === 'Unsubscribed'){
					commit('REMOVE_SUBSCRIBE', response.data.data);
				}
			})
			.catch(errors => {
				//console.log(errors.response);
			})
		}
	},
	mutations:{
		//put the subscribers in the state
		SAVE_SUBSCRIBERS(state, data){
			state.displaySubscribers = data;
		},
		//put the subscriptions in the state
		SAVE_SUBSCRIPTIONS(state, data){
			state.displaySubscriptions = data;
		},
		//add the subscriber to the state
		ADD_SUBSCRIBE(state, data){
			state.displaySubscribers.unshift(data);
		},
		//remove the subscriber from the state
		REMOVE_SUBSCRIBE(state, data){
			state.displaySubscribers.pop(data);
		}
	}
}

export default profile