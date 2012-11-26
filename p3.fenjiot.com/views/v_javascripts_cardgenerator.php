<div id='wrapper'>

	<!-- HEADING -->
	<h1>Card Generator</h1>

	<!-- CARD SETTINGS ON THE LEFT -->
	<div id='left-side'>
		<h2>Pick a color</h2>
			<div class='color-choice' id='red'> </div>
			<div class='color-choice' id='orange'> </div>
			<div class='color-choice' id='yellow'> </div>
			<div class='color-choice' id='green'> </div>
			<div class='color-choice' id='blue'> </div>
			<div class='color-choice' id='indigo'> </div>
			<div class='color-choice' id='violet'> </div>
			<div class='color-choice' id='pink'> </div>
			<div class='color-choice' id='white'> </div>
			<br>
			
		<h2>Pick a texture</h2>
			<div class='texture-choice' id='texture_1'> </div>
			<div class='texture-choice' id='texture_2'> </div>
			<div class='texture-choice' id='texture_3'> </div>
			<div class='texture-choice' id='texture_4'> </div>
			<br>

		<h2>Pick a message</h2>
			<input type='radio' name='message' value='Happy Birthday'>&nbsp;Happy Birthday<br>
			<input type='radio' name='message' value='Thank you'>&nbsp;Thank you<br>
			<input type='radio' name='message' value='I miss you'>&nbsp;I miss you<br>
			<input type='radio' name='message' value='Congratulations'>&nbsp;Congratulations<br>

		<h2>Enter your recipient</h2>
			<div>Characters left: <span id='characters_left'>15</span></div> 
			<input type='text' id='recipient' maxlength='15'><br>		

		<h2>Add some graphics</h2>
			<img class='graphic_choice' src="/images/cardgenerator/graphic_burst.png">
			<img class='graphic_choice' src="/images/cardgenerator/graphic_gift.png">
			<img class='graphic_choice' src="/images/cardgenerator/graphic_gift_2.png">
			<img class='graphic_choice' src="/images/cardgenerator/graphic_gift_3.png">
			<img class='graphic_choice' src="/images/cardgenerator/graphic_heart.png">
			<img class='graphic_choice' src="/images/cardgenerator/graphic_star.png">
			<br>
			
		<h2>Finalize</h2>
			<br>
			<input type='button' id='reset_card_button' value='Clear Card'>
			<input type='button' id='print_button' value='Print'>
			<br><br>
		<div class='footer'></div>
		
	</div>

	<!-- CARD SETTINGS ON THE RIGHT -->
	<div id='right-side'>
		<div id='card'>
        	<div id='canvas'>
        		<div id='message_in_canvas'></div>
	        	<div id='recipient_output_in_canvas'></div>
        	</div>
        </div>
	</div>

	<!-- FOOTER -->
	<div id='footer'></div>


</div>