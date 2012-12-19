<div>Welcome

	<!-- For users who are logged in -->
	<? if($user): ?>
		
		<span> <?=$user->first_name?></span>
	
		<br><br>
		
		<!-- Get them to say something -->
		<div class="words">What's new?</div>
		<? include("v_posts_add.php")?>
		<hr>	
	<!-- For users who are not logged in -->	
	<? else: ?>
		
		stranger
		
	<? endif; ?>
	
</div>

<!-- eventually REMOVE CODE BELOW THIS COMMENT temp to show about page till something gets built -->
<? include("v_index_about.php")?>
<!-- eventually REMOVE CODE ABOVE THIS COMMENT temp to show about page till something gets built -->