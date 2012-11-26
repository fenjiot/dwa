<!DOCTYPE html>
<html>
<head>
	<title><?=@$title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
	<!-- JS -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
	<script type='text/javascript'> 
	// <![CDATA[
		if(typeof jQuery === 'undefined') {
		        document.write(unescape('%3Cscript type="text/javascript" src="/js/jquery-1.8.3.min.js" %3E%3C/script%3E'))
		}; // Loads the fallback version if the CDN version cannot be loaded, like on my computer...
				
			alert('Hello');		
		$(document).ready(function() { // start doc ready; do not delete this!

					
		}); // end doc ready; do not delete this!
		
	// ]]> end of CDATA; do not delete this! 
	</script>
				
	<!-- Controller Specific JS/CSS -->
	<?=@$client_files; ?>
	
</head>

<body>	

	<div id="nav">
		<h1 id="titlenav">
			<a href="http://fenjiot.com/dwa">dwa.fenjiot</a>
		</h1>
		<div>
			<ul>
				<li><a href="http://fenjiot.com/dwa/">INTRODUCTION</a></li> <!-- Create intro coming soon -->
				<li><a href="http://fenjiot.com/dwa/p1" title="project i - about">PROJECT I</a></li>
				<li><a href="http://p2.fenjiot.com" title="project ii">PROJECT II</a></li> <!-- Create p2 coming soon -->
				<li class="cur"><a href="p3.fenjiot.com" title="project iii">PROJECT III</a></li> <!-- Create p3 coming soon -->
				<li><a href="http://fenjiot.com/dwa/p4" title="project iv">PROJECT IV</a></li> <!-- Create p4 coming soon -->
			</ul>
		</div>
	</div>

	<?=$content;?> 

</body>
</html>