<!DOCTYPE html>
<html>
<head>
	<title><?=@$title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
	<!-- JS -->
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
	<!-- load from local if google jquery not loaded -->
	<script>window.jQuery || document.write('<script type="text/javascript" src="js/jquery-1.8.3.min.js"><\/script> <script type="text/javascript" src="js/jquery-ui-1.9.1.min.js"><\/script>')</script>
				
	<!-- Controller Specific JS/CSS -->
	<?php echo @$client_files; ?>
	
</head>

<body>	

	<?=$content;?> 

</body>
</html>