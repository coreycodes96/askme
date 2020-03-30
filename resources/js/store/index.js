import Vue from 'vue';
import Vuex from 'vuex';
import questions from './modules/questions';
import profile from './modules/profile';

Vue.use(Vuex);

export default new Vuex.Store({
	modules:{
		questions,
		profile
	}
})