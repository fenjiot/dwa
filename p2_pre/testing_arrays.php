<!DOCTYPE html>
<head>

</head>
	
	<?
	$contestants["Sam"]		= "";
	$contestants["Eliot"]	= "";
	$contestants["Liz"]		= "";
	$contestants["Max"]		= "";
	
	$howmany = count($contestants);
	$winning_number = rand(1,$howmany);
	
	foreach($contestants as $index => $this_contestant){
		$rand_number = rand(1,$howmany);
		echo $rand_number; // testing line of code
		if($rand_number == $winning_number){
			$contestants[$index]="Winner!";
		}
		else {
			$contestants[$index]="Losser :( ";
		}
	}
	
	
	
	?>	
		
<body>

	<h1>Contestants</h1>

	The winning number is: <?=$winning_number?>! <br \><br \>
	
	<? foreach($contestants as $index => $winner_or_loser) { ?>
	        <?=$index?> picked <?=$rand_number?> and is a <?=$winner_or_loser?> <br \>
 
	<? } ?>

</body>
</html>