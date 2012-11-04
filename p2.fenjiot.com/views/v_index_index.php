<div>Welcome

	<!-- For users who are logged in -->
	<? if($user): ?>
		
		<span> <?=$user->first_name?></span>
	
		<br><br>
		
		<!-- Get them to say something -->
		<div class="words">What's new?</div>
		<form method='POST' action='/posts/p_add'>
			<div class="strong">Add a new post:</div><br>
			<textarea rows="10" cols="50" name='content' placeholder="text area is expandible"></textarea>
	
			<br><br>
	
	<input type='submit'>
	
</form>
	
	<!-- For users who are not logged in -->	
	<? else: ?>
		
		stranger
		
	<? endif; ?>
	
</div>