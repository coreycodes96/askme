<template>
	<div>
		<div class="card">
			<!-- If the user hasn't got any subscribers -->
			<div v-if="fetchSubscribers == ''" class="card-body">
				<p>There are no subscribers here</p>
			</div>
			<!-- Display subscribers -->
			<div v-else v-for="subscriber in fetchSubscribers" :key="subscriber.id">
				<!-- Link to the users profile -->
				<a :href="'/profile/'+subscriber.sender">
					<div class="card-body">
						<!-- Users Username -->
						<p>{{ subscriber.sender }}</p>
					</div>
				</a>
			</div>
		</div>
	</div>
</template>

<script>
	//Import Vuex
	import {mapGetters} from 'vuex';
	export default{
		computed:{
			...mapGetters('profile', ['fetchSubscribers']) //fetching the users subscribers
		}
	}
</script>

<style scoped>
/* Subscribers Start */
	.card{
		margin: 20px auto;
		color: #FFF;
		background-color: transparent;
		border: none;
	}

	.card-body{
		margin: 10px 0;
		width: 100%;
		background-color: #1B1D34;
	}

	a{
		color: #FFF;
		text-decoration: none;
	}

	.card-body p{
		margin: 0;
		padding: 0;
		font-size: 18px;
	}
/* Subscribers End */
</style>