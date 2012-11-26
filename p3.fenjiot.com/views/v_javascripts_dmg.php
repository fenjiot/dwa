<div id="wrapper">

	<!-- HEADING -->
	<h1>Drink Mix Generator</h1>

	<!-- ON THE LEFT -->
	<div id="left_side">
		<div class="largewords">INPUT INFORMATION</div>
		
		<!-- ON THE LEFT TOP -->
		<div id="left_side_top">
			<h2>How many people drinking</h2>
				<div class="select_number_of_people"> 
					<img class="select_people" id="one_person" alt="1" title="1" src="/images/dmg/one_person.png">1 
					<img class="select_people" id="two_people" alt="2" title="2" src="/images/dmg/two_people.png">2 
					<img class="select_people" id="three_people" alt="3" title="3" src="/images/dmg/three_people.png">3 
					<img class="select_people" id="four_or_more_people" alt="4" title="4" src="/images/dmg/four_or_more_people.png">or more
				</div>
				<br>
				
				<input type="text" class="number_field" id="number_of_people" size="3">
				<span class="words"> <span id="person_people">people drinking</span>
				<br>
				
			<h2>Drinks expected to be consumed</h2>
				<div class="select_number_of_drinks">
				
					<input type="text" id="select_total_cocktails" size="3"> 
					<img class="drink_icons" src="/images/dmg/cocktail_glass.png">
					<span class="words">cocktails total</span>
				
					<br>
				
					<input type="text" id="select_total_shots" size="3"> 
					<img class="drink_icons" src="/images/dmg/shot_glass.png">
					<span class="words">shots total</span>
				
				</div>
				<br>
				
			<h2>What's the damage?</h2>
				<br>
				<input type="button" id="submit" value="Generate">
				<br><br>
		
		</div>
			
		<span class="clear"></span>
	
		<!-- ON THE LEFT BOTTOM -->
		<div id="left_side_bottom">
			<div id='board'></div>
				
			<br><br>
		
			<div class="clear"></div>
			
			<br><br>
		</div>
		
		<div class="footer"></div>
		
	</div>

	<!-- ON THE RIGHT -->
	<div id="right-side">
		<div class="largewords">DMG SAYS</div>
		
		<!-- ON THE RIGHT TOP -->
		<div id="right_side_top">
		
    		<div class="totals" id="total_people"></div><br>
        	<div class="totals" id="total_cocktails"></div><br>
        	<div class="totals" id="total_shots"></div><br>
        	<div class="totals" id="total_drinks"></div><br>
        </div>
        
        <span class="clear"></span>
        
        <!-- ON THE RIGHT BOTTOM -->
        <div id="right_side_bottom">
        	
        	
        	
        </div>
	</div>

	<!-- FOOTER -->
	<div class="footer"></div>


</div>