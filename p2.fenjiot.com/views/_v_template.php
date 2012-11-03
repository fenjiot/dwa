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
	<!-- Menu for users that are logged in -->
	<? if($user): ?>
		<div id="nav_main">
			<div id="nav_top_left"> 
				<a href="/">p2.fenjiot</a>		
			</div>
			<div id="nav_title"> 
				<span class="words">on </span><span class="bigwords"><?=@$title;?></span> <!-- Going to have to troubleshoot this later. Isn't showing what I want -->
			</div>
			<div id="subnav_main">
				<ul> 
					<li><a id="Feed" href="/users">Feed</a></li>
					<li><a id="Posts" href="/posts">Posts</a></li>
					<li><a id="Follow" href="/posts/users">Follow</a></li>
					<li><a id="Account" href="/users/profile">Account</a></li>
					<li><a id="Logout" href="/users/logout">Logout</a></li>
				</ul>
			</div>
			
			<div id="subnav_second"> 
				<a id="" href=""></a>
			</div>
			
		</div>
	
		<div id="menu">
		
			<span>
				Signed in as <a href="/users/profile"><?=$user->first_name?></a> | 
				<a href="/users/logout">Logout | </a>
				<a href="/posts/users"> Follow People | </a>
				<a href="/posts">Read Posts | </a>
				<a href="/posts/myposts">Your Posts | </a>
				<a href="/posts/add">Add A New Post | </a>
				<a href="/users/delete">Erase <?=$user->first_name?> | </a>
			</span>
			
	<!-- Menu for those not logged in -->
	<? else: ?>
	
		<a href="/users/signup">Sign Up</a>
		<a href="/users/login">Login</a>
		
	<? endif; ?>
	
	</div>
	
	<br>
	
	<div id="content">
		<?=$content;?> 
	</div>
	
</body>
</html>