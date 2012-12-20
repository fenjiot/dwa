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
	<link rel="stylesheet" href="/css/font-face.css" type="text/css">
	<link rel="stylesheet" href="/css/raerden.css" type="text/css">
	
	<!-- Global JS -->
	<script src="/js/raerden.js"></script>
	
	<!-- Controller Specific JS/CSS -->
	<?php echo @$client_files; ?>
	
</head>

<body>
	<header class="main" role="banner">
		<div class="head_logo hide">
			<a href="/">p4.fenjiot</a>
		</div>	
	</div> 
	</header>
	
	<br>
	
	<div id="container">
		<div class="col-mask"> 
			<div class="col-mid">
				<div class="col-left">
					
					<div class="col-1">
						<div class="col-wrapper">
							<div id="main_nav">
								<ul>
									<li><a href="/" id="top_logo" title="Raerden" alt="Raerden"><img src="/images/raerden/RaerdenLogo_626w_202l.png"></a></li>
									<? if($user): ?>
									<!-- Menu for users that are logged in -->
										<? if(isset($manage_nav)): ?>
											<? foreach($manage_nav as $key => $value): ?>
												<li><a href='<?=$value?>'><?=$key?></a></li>
											<? endforeach; ?>
										<? endif; ?>
											<li>---------</li>
											<li><a href="/users/profile">Signed in as <?=$user->first_name?></a></li>
											<li><a href="/users/delete">Erase <?=$user->first_name?></a></li>
											<li class="highlight"><a href="/users/logout">Logout</a></li>
									<? else: ?>
									<!-- Menu for those not logged in -->
										<? if(isset($navigation)): ?>
											<? foreach($navigation as $key => $value): ?>
												<li><a href='<?=$value?>'><?=$key?></a></li>
											<? endforeach; ?>
										<? endif; ?>
										<li class="highlight"><a href="/users/signup">Sign Up</a> -or- <a href="/users/login">Login</a></li>
									<? endif; ?>
								</ul>
							</div><!-- end main-nav div -->
						</div><!-- end col-wrapper -->
					</div><!-- end col-1 div -->
					
					<div class="col-2">
						<div class="col-spacer"> </div>
						<div id="content">
							<?=$content;?> 
						</div>
					</div> <!-- end col-2 div -->
					<div class="clear"></div> <!-- clear! -->
				</div><!-- end col-left -->
				<div class="clear"></div> <!-- clear! -->
			</div><!-- end col-mid -->
			<div class="clear"></div> <!-- clear! -->
		</div><!-- end col-mask -->
		<div class="clear"></div> <!-- clear! -->
	</div><!-- end container -->

	<footer id="foot">
		<div class="hide" id="footer_box">
		something something something<br>
		somethingeaoifn wai wa<br>
		ouwbfouabcoauba<br>
		ouwfoauwbfoawubo<br>
		okay
		
		</div>
	</footer>	

</body>
</html>