<!DOCTYPE html>
<html>
<head>
	<title><?=@$title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
	<!-- Global JS -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
				
	<!-- Global CSS -->
	<link rel="stylesheet" href="/css/master.css" type="text/css">
	
	<!-- Controller Specific JS/CSS -->
	<?php echo @$client_files; ?>
	
</head>

<body>	
	
	<div id='menu'>
	
		<!-- Menu for users that are logged in -->
		<? if($user): ?>
		
			<span>
				Signed in as <a href="/users/profile"><?=$user->first_name?></a> | 
				<a href="/users/logout">Logout</a>
				<a href="/posts/users">Change who you're following</a>
				<a href="/posts">View posts</a>
				<a href="/posts/add">Add a new post</a>
				<a href="/users/delete">Delete user</a>
			</span>
			
		<!-- Menu for those not logged in -->
		<? else: ?>
		
			<a href="/users/signup">Sign Up</a>
			<a href="/users/login">Login</a>
			
		<? endif; ?>
	
	</div>
	
	<br>

	<?=$content;?> 

</body>
</html>