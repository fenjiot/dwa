<form method='POST' action='/users/p_signup'>
	<div class="words">Signup</div>
	<br>
	
	First Name <br>
	<input type='text' name='first_name' required="required">
	<br><br>

	Last Name <br>
	<input type='text' name='last_name' required="required">
	<br><br>
	
	Email <br>
	<input type='text' name='email' required="required">
	<br><br>
	
	Password <br>
	<input type='password' name='password' required="required">
	<br><br>
	
	<? if($error): ?>
		<div class="error">
			 So sorry, that email address has already been registered.
		</div>
		<br>
	<? endif; ?> 
	
	<input type='submit'>

</form>