<div>Welcome

	<!-- For users who are logged in -->
	<? if($user): ?>
		
		<?=$user->first_name?>
	
	<!-- For users who are not logged in -->	
	<? else: ?>
		
		stranger
		
	<? endif; ?>
	
</div>