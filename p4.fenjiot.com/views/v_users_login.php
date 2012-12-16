<form method='POST' action='/users/p_login'>
	<div class="module">
		<div class="header">
			Login
			<p>Not a member? <a href="/users/signup">Sign Up</a></p>
		</div>
	</div> <!-- end .module -->
	
	<br>
	
	<div class="clear"></div>
		
	<div class="module">
		<div class="header" id="header-dynamic">Sign In</div>
		
		<br>
		
		<div class="field-wrapper">
			<label for="signup-email">Email</label>
			<div class="input"><input id="signup-email" type="text" name="email" required="required"></div>
		</div>  <!-- end .field-wrapper -->
		
		<div class="clear"></div>
		<br>
			
		<div class="field-wrapper">
			<label for="signup-username">Username</label>
			<div class="input"><input id="signup-username" type="text" name="username" required="required"></div>
		</div>  <!-- end .field-wrapper -->
		
		<div class="clear"></div>
		<br>
		
		<div class="field-wrapper">
			<label for="signup-password">Password</label>
			<div class="input"><input id="signup-password" type="password" name="password" required="required"></div>
		</div>  <!-- end .field-wrapper -->
		
		<div class="clear"></div>
		
		<? if($error): ?>
			<div class='error'>
				Login failed. Please check your email and password.
			</div>
			<br>
		<? endif; ?> 
		
		<div class="clear"></div>

		<br>
	
		<div class="field-wrapper">
			<input id="button" type="submit" name="submit" value="login">
		</div>  <!-- end .field-wrapper -->
		
		<br>
		<br>
		
		<div class="field-wrapper">
			<a href="/forgot-password">Forgot your username or password?</a>
		</div>  <!-- end .field-wrapper -->
		
		<div class="clear"></div>
		
	</div> <!-- end .module -->
	
</form>
	