<!-- REMEMBER all of this is wrapped in a <div id="content"> --> 
<h1>DMG</h1>
<div id="left_side">
	<div class="one_of_four_boxes" id="left_side_top">
		<div class="one_of_four_title" id="left_side_top_title">
		1 LST -- Let's begin
		</div>
		<br>
		<div class="one_of_four_content" id="left_side_top_content">
			<div id="lst_content">
				<input id="number_of_people" type="text" placeholder="#" size="3" maxlength="5">
				<span class="words_by_inputs">
					<span id="person_vs_people"> people drinking</span>
				</span> 
				
				<input id="number_of_cocktails" type="text" placeholder="#" size="3" maxlength="5">
				<span class="words_by_inputs">
					<span id="cocktail_vs_cocktails"> cocktails</span>
				</span> 
				
				<input id="number_of_shots" type="text" placeholder="#" size="3" maxlength="5">
				<span class="words_by_inputs">
					<span id="shot_vs_shots"> shots</span>
				</span>
				
				<input id="move_to_phase_two" type="button" value="Process">
			</div>
		</div>
	</div>
	
	<div class="one_of_four_boxes" id="left_side_bottom">
		<div class="one_of_four_title" id="left_side_bottom_title">
		2 LSB -- Add detail
		</div>
		<br>
		<div class="one_of_four_content" id="left_side_bottom_content">
			<div id="lsb_content"></div>
		</div>
	</div>
</div>



<div id="right_side">
	<div class="one_of_four_boxes" id="right_side_top">
		<div class="one_of_four_title" id="right_side_top_title">
		3 RST -- Tally
		</div>
		<br>
		<div class="one_of_four_content" id="right_side_top_content">
			<div id="rst_content"></div>
		</div>
	</div>

	
	<div class="one_of_four_boxes" id="right_side_bottom">
		<div class="one_of_four_title" id="right_side_bottom_title">
		4 RSB -- Reset
		</div>
		<br>
		<div class="one_of_four_content" id="right_side_bottom_content">
			<div id="rsb_content">&nbsp;RESTART&nbsp;</div>
		</div>
	</div>

</div>

<div class="clear_all"></div>

<div>ABOUT: the idea is to hook up database and be able to pick various recipes and figure out how much of each ingredient you'll need depending on 
		 	how many people are over, how much they are going to drink, and which kind of drinks they want<br>
		 	Neat things that do work is the changing from plural to singular, sliding open of the details menu, and the tally.</div>