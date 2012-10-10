<!DOCTYPE html>
<head>

</head>
	
	<?
	$boxes = "";
	
	for($i = 1; $i <= 10; $i++) {
		$var1 = rand(0,500);
		$var2 = rand(0,500);
		$boxes .= "<div style='width:{$var1}px; height:{$var2}px; float:left; margin:4px; background-color:red'></div>";
	};
	
	?>	
		
<body>

	<?=$boxes?>

</body>
</html>