<form method='POST' action='/posts/p_follow'>

	<? foreach($users as $user): ?>
		
		<!-- If there exists a connection with this user, show unfollow link -->
		<? if(isset($connections[$user['user_id']])): ?>
			<a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow </a>
			<? $color = "following" ?>
		<!-- Otherwise, show follow link -->
		<? else: ?>
			<a href='/posts/follow/<?=$user['user_id']?>'>Follow </a>
			<? $color = "notfollowing" ?>
		<? endif; ?>
		
		<!-- Print this user's name -->
		<span class="<?=@$color?>"> &nbsp;<?=$user['first_name']?> <?=$user['last_name']?> </span>
				
		<br><br>
	
	<? endforeach; ?>

</form>