<template>
	<div>
		<div class="container">
			<!-- Start Form Start -->
			<form @submit.prevent="getSearch" class="col-8">
				<div class="row form-group">
					<input type="text" name="search" v-model="search">
					<button type="submit" class="btn"><i class="fas fa-search"></i></button>
				</div>
				<div class="catch_error">{{ catch_error }}</div>
			</form>
			<!-- Search Form End -->
			
			<!-- Show Searches Start -->
			<div v-for="user in showSearch" :key="user.id">
				<a :href="'/profile/'+user.username">
					<div class="card">
						<div class="card-body">
							<p>{{ user.username }}</p>
						</div>
					</div>
				</a>
			</div>		
			<!-- Show Searches End -->
		</div>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				search: '', //form data
				catch_error: '', //catch errors
				showSearch: [] //show searches
			}
		},
		methods:{
			getSearch(){
				if(this.search === ''){
					//checking if the search input empty
					this.catch_error = 'Please enter a username to search';
				}else{
					//clearing the errors
					this.catch_error = '';

					//making a request to the search route
					axios.post('/search', {
						'username': this.search
					}, {
						headers:{
							'Content-Type': 'application/json'
						}
					})
					.then(response => {
						console.log(response.data);
						if(response.data != ''){
							this.catch_error = '';
							this.showSearch = response.data;
						}else{
							this.catch_error = 'Sorry there is no user called "'+this.search+'"';
							this.showSearch = '';
						}
						
					})
					.catch(errors => {
						console.log(errors.response);
					})
				}
			}
		}
	}
</script>

<style scoped>
/* Form Start */
	.container form{
		margin: 30px auto 0 auto;
		padding: 20px 10px 10px 10px;
		width: 80%;
		background-color: #1B1D34;
	}

	.form-group{
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.form-group input{
		padding-left: 10px;
		width: 80%;
		height: 40px;
	}

	.form-group input:focus{
		outline: 2px solid #FFF;
	}

	.form-group .btn{
		margin-left: 10px;
		width: 100px;
		height: 40px;
		background-color: #FFF;
		border-radius: 0;
		-webkit-border-radius: 0;
		-moz-border-radius: 0;
		-o-border-radius: 0;
	}

	.form-group .btn:focus{
		box-shadow: none;
	}

	.form-group .btn i{
		color: #1B1D34;
	}

	.catch_error{
		font-size: 16px;
		color: #FFF;
	}

	.card{
		margin: 20px 0;
		background-color: #1B1D34;
		color: #FFF;
	}

	.card-body{
		width: 70%;
		margin: 0;
	}
/* Form End */

/* Search Display Start */
	a{
		color: #FFF;
		text-decoration: none;
	}

	.card-body p{
		margin: 0;
		padding: 0;
		font-size: 18px;
	}
/* Search Display End */

/* Responsive Start */
	@media screen and (max-width: 1100px){
		.form-group .btn{
			margin: 10px auto;
			width: 80%;
			display: block;
		}

		.catch_error{
			text-align: center;
		}
	}
/* Responsive End */
</style>