<template>
	<div>
        <section class="form-container">
            <div class="col-8 container">
            	<!-- Login Form Start -->
                <form @submit.prevent="loginUser">
                	<!-- Email Input -->
                    <div class="row form-group">
                        <label>Email:</label>
                       <input type="text" name="email" v-model="email" class="form-control"> 
                    </div>
                    <!-- Password Input -->
                    <div class="row form-group">
                        <label>Password:</label>
                       <input type="password" name="password" v-model="password" class="form-control"> 
                    </div>  
                    <!-- Button -->
                    <div class="row form-group">
                        <button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i>  Login</button>
						
						<!-- Catch Errors -->
                        <div class="catch-error">{{ catch_error }}</div>
                    </div>                     
                </form>
                <!-- Login Form End -->
            </div>
        </section>
	</div>
</template>

<script>
	export default{
		data(){
			return{//form data
				email: '',
				password: '',
				catch_error: ''
			}
		},
		methods:{
			loginUser(){
				//validation
				if(this.email === "" && this.password === ""){
					//checking if the form is empty
					this.catch_error = 'Please enter the required information';
				}else if(this.email === ""){
					//checking if the email input is empty
					this.catch_error = 'Please enter your email';
				}else if(this.password === ""){
					//checking if the password input is empty
					this.catch_error = 'Please enter your password';
				}else{
					//clearing the errors
					this.catch_error = '';

					//making a request to the login route
					axios.post('/login', {
						'email': this.email,
						'password': this.password
					},{
						headers:{
							'Content-Type': 'application/json'
						}
					})
					.then(response => {
						console.log(response.data);

						//if the response is equal to okay, direct the user to the news page
						if(response.data === 'Okay'){
							window.location = '/news';
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