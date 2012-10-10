<!DOCTYPE hmtml>
<head>

</head>
	<?
	if($_POST){
		
		$howmany = count($_POST);
		$winning_number = rand(1,$howmany);
		
		foreach($contestants as $index => $this_contestant){
			$rand_number = rand(1,$howmany);
			echo $rand_number; // testing line of code
			if($rand_number == $winning_number){
				$contestants[$index]="Winner!";
			} // END if
			else {
				$contestants[$index]="Losser :( ";
			} // END else
		} // END foreach
		
	} // END if
	
	?>

<body>

	<form method='POST' action='testing_drawing2.php'> <!-- action destination must be the same as your file -->
		Enter up to 5 contestants: <br>
		<input type='text' name='contestant1'> <br>
		<input type='text' name='contestant2'> <br>
		<input type='text' name='contestant3'> <br>
		<input type='text' name='contestant4'> <br>
		<input type='text' name='contestant5'> <br>
		<input type='submit' value='Pick a winner!'> <br>
	</form>

	<pre>
	<?
	print_r($_POST);
	?>
	</pre>
	
	<h1>Contestants</h1>

	The winning number is: <?=$winning_number?>! <br \><br \>
	
	<? foreach($_POST as $index => $winner_or_loser) { ?>
	        <?=$index?> picked <?=$rand_number?> and is a <?=$winner_or_loser?> <br \>
 
	<? } ?>


</body>
</html>