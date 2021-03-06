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
<!--	<link rel="stylesheet" href="/css/master1.css" type="text/css"> -->
	
	<!-- Controller Specific JS/CSS -->
	<?php echo @$client_files; ?>
	
</head>

<body>
	<!-- Menu for users -->
		<div id="nav_main">
			
			<div id="nav_top_left"> 
				<a href="/">p3.fenjiot</a>		
			</div>
		
		<div id="menu">
			<? if($user): ?>
			<!-- Menu for users that are logged in -->
				Signed in as <a href="/users/profile"><?=$user->first_name?></a> | 
				<a href="/users/logout">Logout</a> | 
				<a href="/users/delete">Erase <?=$user->first_name?> </a> | 
			<? else: ?>
			<!-- Menu for those not logged in -->
				<span class="words">
					<a href="/users/signup">Sign Up</a> | 
					<a href="/users/login">Login</a> |
				</span> 
			<? endif; ?>				
			<a href="/javascripts/damage"><span id="damage">DMG</span></a>  |  
			<a href="/index/about"><span id="about">About</span></a>
			<div class="other"> -- Other Javascript apps: --<br>
				<a href="/javascripts/cardgenerator"><span id="cardgenerator">Card Generator</span></a>  | 
				<a href="/javascripts/memorygame"><span id="memorygame">Memory Game</span></a>
			</div>
		</div>
	
	</div>



	
	<br>
	
	<div id="content">
		<?=$content;?> 
	</div>
	
</body>
</html>