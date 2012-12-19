<form method='POST' action='/users/p_signup'>
	<div class="module">
		<div class="header">
			Signup
			<p>Already a member? <a href="/users/login">Log In</a></p>
		</div>
	</div> <!-- end .module -->
	
	<br> 
	
	<div class="clear"></div>
	
	<div class="module">
		<div class="header" id="header-dynamic">Or complete the following...</div>
		
		<div class="field-wrapper">
			<label for="signup-name-first">First Name</label>
			<div class="input"><input id="signup-name-first" type="text" name="first_name" required="required"></div>
		</div>  <!-- end .field-wrapper -->
		<div class="field-wrapper">
			<label for="signup-name-last">Last Name</label>
			<div class="input"><input id="signup-name-last" type="text" name="last_name" required="required"></div>
		</div>  <!-- end .field-wrapper -->
		
		<div class="clear"></div>
		
		<div class="field-wrapper">
		<label for="signup-email">Email</label>
		<div class="input"><input id="signup-email" type="text" name="email" required="required"></div>
		</div>  <!-- end .field-wrapper -->
		
		<div class="field-wrapper">
			<label for="signup-username">Username</label>
			<div class="input"><input id="signup-username" type="text" name="username" required="required"></div>
		</div>  <!-- end .field-wrapper -->
		
		<div class="clear"></div>
					
		<div class="field-wrapper">
			<label for="signup-password">Password</label>
			<div class="input"><input id="signup-password" type="password" name="password" required="required"></div>
		</div>  <!-- end .field-wrapper -->

<!-- TAKING OUT FOR NOW	to TEST
		<div class="field-wrapper">
			<label for="signup-password">Confirm Password</label>
			<div class="input"><input id="signup-password-confirm" type="password" name="password_confirm" required="required"></div>
		</div>  <!-- end .field-wrapper -->
		
		<div class="clear"></div>	
		
		<? if($error): ?>
			<div class="error">
				 So sorry, that email address has already been registered.
			</div>
			<br>
		<? endif; ?>
	
		<br><br>
	
		<div class="clear"></div>
			
	</div> <!-- end .module -->
	
	<div class="module">
		<input id="button" type="submit" name="submit" value="signup">
	</div> <!-- end .module -->

</form>