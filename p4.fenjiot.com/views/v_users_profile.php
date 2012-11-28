<h1 class="words"><?=$user->first_name?> </h1>

<div class="mediumwords">Did something change? Update your information:</div>
<br><br>

<form method='POST' action='/users/p_profile'>

	<?=$user->first_name?> <br>
	<input type='text' name='first_name' placeholder="First Name" required="required">
	<br><br>

	<?=$user->last_name?><br >
	<input type='text' name='last_name' placeholder="Last Name" required="required">
	<br><br>

	Please verify your: <br><br>
	
	Email <br>
	<input type='text' name='email' required="required">
	<br><br>
	
	Password <br>
	<input type='password' name='password' required="required">
	<br><br>
	
<!--  NOT WORKING YET
	<? if($_POST = 1): ?>
		<div class="success">
			 Your information has been changed!
		</div>
		<br>
		
	<? else: ?>		
		<div class="error">
			 Sorry, please check your email and password!
		</div>
		<br>
		
	<? endif; ?> 
-->

	<input type='submit'>

</form>



