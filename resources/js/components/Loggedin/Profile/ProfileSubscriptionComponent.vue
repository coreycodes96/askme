<template>
	<div>
		<div class="card">
			<!-- If the user doesn't have any subscriptions -->
			<div v-if="fetchSubscriptions == ''" class="card-body">
				<p>There are no subscriptions here</p>
			</div>
			<!-- Display subscriptions -->
			<div v-for="subscription in fetchSubscriptions" :key="subscription.id">
				<a :href="'/profile/'+subscription.receiver">
					<div class="card-body">
						<p>{{ subscription.receiver }}</p>
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
			...mapGetters('profile', ['fetchSubscriptions']) //fetch the users subscriptions
		}
	}
</script>

<style scoped>
/* Subscriptions Start */
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
/* Subscriptions End */
</style>