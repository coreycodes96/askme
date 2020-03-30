<template>
	<div>
		<section class="form-container">
	       	<div class="col-8 container">
	       		<!-- Create An Account Form Start -->
	            <form @submit.prevent="createAccount">
	            	<!-- Firstname Input -->
	                <div class="row form-group">
	                    <label>Firstname:</label>
	                    <input type="text" name="firstname" v-model="firstname" class="form-control">
	                </div>
	                <!-- Surname Input -->
	                <div class="row form-group">
	                    <label>Surname:</label>
	                    <input type="text" name="surname" v-model="surname" class="form-control">
	                </div>
	                <!-- Username Input -->
	                <div class="row form-group">
	                    <label>Username:</label>
	                    <input type="text" name="username" v-model="username" class="form-control">
	                </div>
	                <!-- Email Input -->
	                <div class="row form-group">
	                    <label>Email:</label>
	                    <input type="text" name="email" v-model="email" class="form-control">
	                </div>
	                <!-- Gender Select -->
					<div class="row form-group">
						<label>Gender:</label>
					  	<select v-model="gender" class="form-control">
					    	<option>Male</option>
					    	<option>Female</option>
					    	<option>Other</option>
					  	</select>
					</div>
					<!-- Date Of Birth -->
					<div class="row form-group">
						<label>Date Of Birth:</label>
						<div class="date-container">
							<!-- Year Input -->
							<div class="date-field">
								<input type="text" name="year" v-model="year" placeholder="Y-Y-Y-Y">
							</div>
							<!-- Month Input -->
							<div class="date-field">
								<input type="text" name="month" v-model="month" placeholder="M-M">
							</div>
							<!-- Day Input -->
							<div class="date-field">
								<input type="text" name="day" v-model="day" placeholder="D-D">
							</div>
						</div>	
					</div>
					<!-- Password Input -->
	                <div class="row form-group">
	                    <label>Password:</label>
	                    <input type="password" name="password" v-model="password" class="form-control">
	                </div>
	                <!-- Password Confirm Input -->
	                <div class="row form-group">
	                    <label>Password Confirm:</label>
	                    <input type="password" name="password_confirm" v-model="password_confirm" class="form-control">
	                </div>
	                <!-- Create An Account Button -->
	                <div class="row form-group">
	                    <button type="submit" class="btn"><i class="fas fa-user-plus"></i> Create An Account</button>
						<!-- Catch Errors -->
	                    <div class="catch-error">{{ catch_error }}</div>
	                </div>
	            </form>
	            <!-- Create An Account Form End -->
	            <div class="row form-group">
	            	<!-- Checkbox Input -->
	                <input class="form-group checkbox" v-model="checkbox" type="checkbox">
	                <label class="form-check-label">
	                	<!-- Terms & Conditions -->
	                    <span data-toggle="modal" data-target="#checkboxModal">Agree to terms &amp; conditions</span>
	                </label>
	            </div>

	            <!-- Checkbox Modal -->
	            <div class="modal fade" id="checkboxModal" tabindex="-1" role="dialog" aria-labelledby="checkboxModalLabel" aria-hidden="true">
	                <div class="modal-dialog" role="document">
	                    <div class="modal-content">
	                        <div class="modal-header">
	                            <h5 class="modal-title" id="checkboxModalLabel">Terms &amp; Conditions</h5>
	                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                                <span aria-hidden="true">&times;</span>
	                            </button>
	                        </div>
	                        <div class="modal-body">
	                            <p>
	                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus illum error sequi ipsum doloribus amet labore accusamus quasi fuga modi, ullam officiis, veniam deleniti quam voluptates maiores, suscipit nemo odit.
	                            </p>

	                            <p>
	                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio error nihil fugiat, ipsum, fuga magni aut nemo repellendus perspiciatis quisquam distinctio? Cumque velit accusantium aliquam et modi hic praesentium, consectetur.
	                            </p>

	                            <p>
	                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium numquam saepe distinctio corporis asperiores, explicabo atque aut dolore cum eos similique, ipsa maxime dignissimos voluptate expedita magnam nesciunt sequi animi.
	                            </p>
	                        </div>
	                        <div class="modal-footer">
	                            <button class="btn" data-dismiss="modal">Close</button>
	                        </div>
	                    </div>
	                </div>
	            </div>
	       </div>
       </section>
	</div>
</template>

<script>
	export default{
		data(){
			return{//form data
				firstname: '',
				surname: '',
				username: '',
				email: '',
				gender: '',
				year: '',
				month: '',
				day: '',
				password: '',
				password_confirm: '',
				catch_error: '',
				checkbox: false
			}
		},
		methods:{
			createAccount(){
				//vars
		        let fieldLettersNum      = /^[a-zA-Z0-9-_]+$/i; //letters and numbers
		        let fieldLetters         = /^[a-zA-Z']+$/i; //letters only
		        let fieldNum             = /^[0-9]+$/i; //number only
				let emailCheck 			 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; //check email is valid

				//validation
				if(this.firstname === "" && this.surname === "" && this.username === "" && this.email === "" && this.gender === "" && this.date === "" && this.password === "" && this.password_confirm === ""){
					//checking if the form inputs are empty
					this.catch_error = 'Please enter the required information!';
				}else if(this.firstname === ""){
					//checking if the firstname input is empty
					this.catch_error = 'Please enter your firstname';
				}else if(this.firstname.length > 20){
					//checking if the firstname input length has more than 20 characters
					this.catch_error = 'Your firstname can\'t be more than 20 characters';
				}else if(!this.firstname.match(fieldLetters)){
					//checking if the firstname input only has letters
					this.catch_error = 'Your first name can\'t contain any numbers or symbols';
				}else if(this.surname === ""){
					//checking if the surname input is empty 
					this.catch_error = 'Please enter your surname';
				}else if(this.surname.length > 25){
					//checking if the surname input length has more than 25 characters
					this.catch_error = 'Your surname can\'t be more than 25 characters';
				}else if(!this.surname.match(fieldLetters)){
					//checking if the surname input has letters only
					this.catch_error = 'Your surname can\'t contain any numbers or symbols';
				}else if(this.username === ""){
					//checking if the username input is empty
					this.catch_error = 'Please enter a username';
				}else if(this.username.length > 15){
					//checking if the username input length has more than 15 characters 
					this.catch_error = 'Your username can\'t be more than 15 characters';
				}else if(!isNaN(this.username.charAt(0))){
					//checking if the username input has a number first
					this.catch_error = 'Your username can\'t have a number first';
				}else if(this.email === ""){
					//checking if the email input is empty
					this.catch_error = 'Please enter your email!';
				}else if(!this.email.match(emailCheck)){
					//checking if the email input is valid
					this.catch_error = 'Sorry your email isn\'t valid';
				}else if(this.email.length > 255){
					//checking if the email input has more than 255 characters
					this.catch_error = 'Your email can only has 255 characters';
				}else if(this.gender === ""){
					//checking if the gender input is empty
					this.catch_error = 'Please select your gender';
				}else if(this.year === ""){
					//checking if the year input is empty
					this.catch_error = 'Please enter the year of your birth';
				}else if(!this.year.match(fieldNum)){
					//checking if the year input has numbers only
					this.catch_error = 'You can only use numbers for your year of birth';
				}else if(this.year.length != 4){
					//checking if the year input has 4 numbers only
					this.catch_error = 'Please enter 4 numbers for the year of your birth';
				}else if(this.year < 1900){
					//checking if the year input hasn't got numbers lower than 1900
					this.catch_error = 'If you were born before 1900 please contact us';
				}else if(this.year > 2005){
					//check if the year hasn't got numbers higher than 2005
					this.catch_error = 'You are too young to create an account';
				}else if(this.month === ""){
					//checking if the month input is empty
					this.catch_error = 'Please enter the month of your birth';
				}else if(!this.month.match(fieldNum)){
					//checking if the month input has numbers only
					this.catch_error = 'You can only use numbers for your month of birth';
				}else if(this.month == '00' || this.month > 12){
					//checking if the month input hasn't got numbers lower than 00 or higher than 12
					this.catch_error = 'Please enter the numbers between 01-12';
				}else if(this.month.length != 2){
					//checking if the month input has 2 numbers only
					this.catch_error = 'Please enter 2 numbers for the month of your birth';
				}else if(this.day === ""){
					//checking if the day input is empty
					this.catch_error = 'Please enter your day of birth';
				}else if(!this.day.match(fieldNum)){
					//checking if the day input has numbers only
					this.catch_error = 'You can only use numbers for your day of birth';
				}else if(this.day.length != 2){
					//checking if the day input has 2 numbers only
					this.catch_error = 'Please enter 2 numbers for the day of your birth';
				}else if(this.day == '00' || this.day > 31){
					//checking if the day input has numbers lower than 00 and higher than 31
					this.catch_error = 'Please enter a numbers between 01-31';
				}else if(this.month == '02' && this.day > '29'){
					//checking if the user has typed in the second month and a day higher than 29
					this.catch_error = 'Please don\'t be silly. Type your right date of birth';
				}else if(this.password === ""){
					//checking if the password input is empty
					this.catch_error = 'Please enter a password';
				}else if(this.password.length < 8){
					//checking if the password has less than 8 characters
					this.catch_error = 'Your password can\'t be less than 8 characters';
				}else if(this.password.length > 255){
					//checking if the password has more than 255 characters
					this.catch_error = 'Your password can\'t be more than 255 characters';
				}else if(this.password.toLowerCase().indexOf(this.firstname.toLowerCase()) > -1 || this.password.toLowerCase().indexOf(this.surname.toLowerCase()) > -1 || this.password.toLowerCase().indexOf(this.username.toLowerCase()) > -1){
					//checking if the password input contains the firstname, surname or the username
					this.catch_error = 'You can\'t use your firstname or surname or username in your password';
				}else if(this.password_confirm === ""){
					//checking if the password confirm input is empty
					this.catch_error = 'Please confirm your password';
				}else if(this.password_confirm != this.password){
					//checking if the password input matches the password confirm input
					this.catch_error = 'Sorry your passwords do not match';
				}else if(this.checkbox != true){
					//checking if the checkbox input is ticked
					this.catch_error = 'Please agree to the terms and conditions';
				}else{
					//clearing the errors
					this.catch_error = '';

					//making a request to the register route
					axios.post('/register', {
						'firstname': this.firstname,
						'surname': this.surname,
						'username': this.username,
						'email': this.email,
						'gender': this.gender,
						'year': this.year,
						'month': this.month,
						'day': this.day,
						'password': this.password,
						'password_confirmation': this.password_confirm
					}, {
						headers:{
							'Content-Type': 'application/json'
						}
					})
					.then(response => {
						//console.log(response);

						//password the response to the data object
						this.catch_error = response.data;

						//letting the user know their account has been created
						this.catch_error = 'You\'ve created an account! You can now login '+this.username;
					})
					.catch(errors => {
						//checking for any errors
						console.log(errors.response);

						//if the username has already been taken
						if(errors.status == 422){
							this.catch_error = errors.response.data.errors.username[0];
						}

						//if the email has already been taken
						if(errors.status == 422){
							this.catch_error = errors.response.data.errors.email[0];
						}
					})
				}
			}
		}
	}
</script>