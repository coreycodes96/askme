const questions = {
	namespaced: true,
	state:{
		user: {}, //logged in user will be stored here
		questions: [] //users questions will be stored here
	},
	getters:{
		fetchQuestions: state => state.questions //putting the questions state to a getter
	},
	actions:{
		//send the logged in user information
		getUser({commit}, data){
			commit('PASS_USER', data);
		},
		//send the users questions
		getQuestions({commit}){
			axios.get('getquestions')
			.then(response => {
				commit('SHOW_QUESTIONS', response.data);
			})
			.catch(errors => {
				console.log(errors.response);
			})
		},
		//add a new question
		newQuestion({commit}, data){
			axios.post('createdebatequestion', {
				'username': data.username,
				'question': data.question
			},{
				headers:{
					'Content-Type': 'application/json'
				}
			})
			.then(response => {
				commit('STORE_QUESTION', response.data);
			})
			.catch(errors => {
				console.log(errors.response);
			})
		},
		//add a new answer
		newAnswer({commit}, data){
			axios.post('createdebateanswer', {
				'username': data.username,
				'answer': data.answer,
				'question_id': data.question_id
			},{
				headers:{
					'Content-Type': 'application/json'
				}
			})
			.then(response => {
				console.log(response);
				commit('STORE_ANSWER', response.data)
			})
			.catch(errors => {
				console.log(errors.response);
			})
		},
		//delete the question
		deleteQuestion({commit}, data){
			axios(`deletequestion/${data.question_id}`, {
				method: 'delete'
			})
			.then(response => {
				console.log(response.data);
				commit('DESTROY_QUESTION', data.question_index);
			})
			.catch(errors => {
				console.log(errors.response);
			})
		},
		//delete the answer
		deleteAnswer({commit}, id){
			axios(`deleteanswer/${id}`, {
				method: 'delete'
			})
			.then(response => {
				commit('DESTROY_ANSWER');
			})
			.catch(errors => {
				console.log(errors.response);
			})
		},
		//add a favourite
		addFavourite({commit}, data){
			axios.post('favouritequestion', {
				'sender': data.sender,
				'receiver': data.receiver,
				'question_id': data.question_id
			}, {
				headers:{
					'Content-Type': 'application/json'
				}
			})
			.then(response => {
				console.log(response);

				commit('FAVOURITE_OR_UNFAVOURITE');
			})
		}
	},
	mutations:{
		//putting the users info into the user state
		PASS_USER(state, user){
			state.user = user;
		},
		//putting the questions in the questions state
		SHOW_QUESTIONS(state, questions){
			state.questions = questions;
		},
		//putting a new question in the questions state
		STORE_QUESTION(state, question){
			state.questions.unshift(question);
		},
		//putting the answer in the answer state
		STORE_ANSWER(state, answer){
			state.questions.question.unshift(answer);
		},
		//deleting the users question
		DESTROY_QUESTION(state, index){
			state.questions.splice(index, 1);
		},
		//deleting the users answer
		DESTROY_ANSWER(state){
			state.questions;
		},
		//add or remove the users favourite
		FAVOURITE_OR_UNFAVOURITE(state){
			state.questions;
		}
	}
}

export default questions