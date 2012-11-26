<!DOCTYPE html>
<html>
<head>
	<title><?=@$title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
	<!-- Global JS -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>

	<!-- load from local if google jquery not loaded -->
	<script>window.jQuery || document.write(
		'<script type="text/javascript" src="/js/jquery-1.8.3.min.js"><\/script> <script type="text/javascript" src="/js/jquery-ui-1.9.1.min.js"><\/script>'
		);
	</script>
				
	<!-- Global CSS -->
	<link rel="stylesheet" href="/css/damage.css" type="text/css">
	
	<!-- Controller Specific JS/CSS -->
	<?php echo @$client_files; ?>
	
</head>

<body>
	<!-- Menu for users that are logged in -->
	<? if($user): ?>

		<div id="nav_main">
			
			<div id="nav_top_left"> 
				<a href="/">p3.fenjiot</a>		
			</div>
		
		<div id="menu">
			<span>
				Signed in as <a href="/users/profile"><?=$user->first_name?></a> | 
				<a href="/users/logout">Logout | </a>
				<a href="/users/delete">Erase <?=$user->first_name?> </a>
			</span>
		</div>
</div>

		
	<!-- Menu for those not logged in -->
	<? else: ?>
		<div class="words">
			<a href="/users/signup">Sign Up</a> <span class="strong"> | </span>
			<a href="/users/login">Login</a>
		</div>
	<? endif; ?>
	
	</div>
	
	<br>
	
	<div id="content">
		<?=$content;?> 
	</div>
	
</body>
</html>