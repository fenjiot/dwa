$(document).ready(function() {

	// Set default values
	name_of_board 		= 'board',
	name_of_scoreboard	= 'scoreboard',
	number_of_people	= 0,
	number_of_cocktails	= 0,
	number_of_shots		= 0,

	// Get values
	$('#number_of_people').keyup(function() {
		// figure out how many people are drinking
		number_of_people = $(this).val();
		
		// make singular if only 1
		if(parseInt(number_of_people) == 1) {
			peoplez = ' person drinking';
		}
		else {
			peoplez = ' people drinking';
		}
		
		// push to HTML
		$('#person_vs_people').html(peoplez);
		console.log(number_of_people + peoplez);
	});
	
	$('#number_of_cocktails').keyup(function() {
		// figure out how many cocktails to be consumed
		number_of_cocktails = $(this).val();
		
		// make singular if only 1
		if(parseInt(number_of_cocktails) == 1) {
			cocktailz = ' cocktail';
		}
		else {
			cocktailz = ' cocktails';
		}
		
		// push to HTML
		$('#cocktail_vs_cocktails').html(cocktailz);
		console.log(number_of_cocktails + cocktailz);
	});
	
	$('#number_of_shots').keyup(function() {
		// figure out how many shots to be taken
		number_of_shots = $(this).val();
		
		// make singular if only 1
		if(parseInt(number_of_shots) == 1) {
			shotz = 'shot'		
		}
		else {
			shotz = 'shots'
		}
		
		// push to HTML
		$('#shot_vs_shots').html(shotz);
		console.log(number_of_shots + ' ' + shotz);
	});

	$('#move_to_phase_two').click(function() {
		if(number_of_people != 0 || null && number_of_cocktails != 0 || null && number_of_shots != 0 || null) {
			console.log('going to phase two');
			
			// Initiate our board
			name_of_board = 'lsb_content',
			name_of_scoreboard = 'rst_content',
			Damage.set_board(name_of_board, name_of_scoreboard, number_of_people, number_of_cocktails, number_of_shots);
			console.log('and we are back to one');
		}
		else {
			console.log('not ready');
		}
	});

});	// end of document ready fct


/* ---------------------------------------------------------------------------------------------
	Primarily deals with LSB_content
--------------------------------------------------------------------------------------------- */
var Damage = {
	
	// {int} Keep running total
	number_of_people: 0,
	number_of_cocktails: 0,
	number_of_shots: 0,
	
	// {Object} HTML Objects
	board: '',
	scoreboard: '',
	
	// {array} To check numerical value entered
	numbers: ['1','2','3','4','5','6','7','8','9','0'],
	
	// {int} Keep track of drinks distributed
	drinks_distributed: 0,
	
	/* -------------------------------------------------------------------------------------------------------
	@param {string} id_of_board
	@param {string} id_of_scoreboard 
	@param {string}    how_many_people
	@param {string}    how_many_cocktails
	@param {string}    how_many_shots
	@return void
	-------------------------------------------------------------------------------------------------------- */	
	set_board: function(id_of_board, id_of_scoreboard, how_many_people, how_many_cocktails, how_many_shots) {
	
		console.log(id_of_board, id_of_scoreboard, how_many_people, how_many_cocktails, how_many_shots);

		// First, identify the board and the scoreboard objects
		this.board      = $('#' + id_of_board);
		this.scoreboard = $('#' + id_of_scoreboard);

		// Make sure everything is reset
		this.board.html("");
		
		// This will hold all the drinks as we load them
		var cocktailsArr = [];
		var shotsArr = [];

		// This will hold the HTML string of divs that are our list of drinks
		var cocktailsStr = String();
		var shotsStr = String();

/* START -- This has to be reversed for now.  Fix later so that it can show up in logical order */
		this.board.prepend('<input id="move_to_phase_three" type="button" value="Process II">');
		
		// Loop for how many shots we have
		for(var i = 0; i < how_many_shots; i++) {
			shotsArr[i] = '<div class="clear_all"><div id="shot-' + i + '"></div>' +
						'<input type="text" placeholder="enter kind of shot"><br></div>';
		};
		
		for(var shot in shotsArr) {
			shotsStr = shotsStr + shotsArr[shot];
		};		

		// Now inject the people string into the board
		this.board.prepend(shotsStr + "<br><br>");
		
		
		// Loop for how many cocktails we have
		for(var i = 0; i < how_many_cocktails; i++) {
			cocktailsArr[i] = '<div class="clear_all"><div id="cocktail-' + i + '"></div>' +
							'<input type="text" placeholder="enter name of cocktail"><br></div>';
		};
		
		// Now load the cocktails array into a string; building the string
		for(var cocktail in cocktailsArr) {
			cocktailsStr = cocktailsStr + cocktailsArr[cocktail];
		};
		
		// Now inject the cocktails string into the board
		this.board.prepend(cocktailsStr + '<br><br>');
/* END -- This has to be reversed for now.  Fix later so that it can show up in logical order */
	
		
		$('#move_to_phase_three').click(function() {
			
			console.log('going to phase three');
			
			// Initiate our board
			Damage.detail_board(name_of_board, name_of_scoreboard, number_of_people, number_of_cocktails, number_of_shots);
			
			// slide lsb_content out of the way	
			console.log('slide lsb_content out of the way');
			$('#lsb_content').slideToggle('slow');
			
			console.log('and we are back to two');
		});
		
		// clicking on title will also allow slide toggling
		$('#left_side_bottom_title').click(function(){
			$('#lsb_content').slideToggle('slow');
		});		
		
		console.log('set_board ran');
		
	}, // end of set_board
	
	/* -------------------------------------------------------------------------------------------------------
	@param {string} id_of_board
	@param {string} id_of_scoreboard 
	@param {string}    how_many_people
	@param {string}    how_many_cocktails
	@param {string}    how_many_shots
	@return void
	-------------------------------------------------------------------------------------------------------- */	
	detail_board: function(id_of_board, id_of_scoreboard, how_many_people, how_many_cocktails, how_many_shots) {
		
		// identify the board and the scoreboard objects
		this.board      = $('#' + id_of_board);
		this.scoreboard = $('#' + id_of_scoreboard);
		
		total_number_of_drinks = parseInt(number_of_cocktails) + parseInt(number_of_shots);
	
		this.scoreboard.prepend('<div>Total cocktails: ' + number_of_cocktails + '</div><br>' +
								'<div>Total shots: ' + number_of_shots + '</div><br>' +
								'<div>Total drinks: ' + total_number_of_drinks + '</div><br>');
		
	}, // end of detail_board
	
	/* -------------------------------------------------------------------------------------------------------
	@param {string} id_of_board
	@param {string} id_of_scoreboard 
	@param {string}    how_many_people
	@param {string}    how_many_cocktails
	@param {string}    how_many_shots
	@return void
	-------------------------------------------------------------------------------------------------------- */	
//	answer_board: function(id_of_board, id_of_scoreboard, how_many_people, how_many_cocktails, how_many_shots) {
	
		// First, identify the board and the scoreboard objects
//		this.board      = $('#' + id_of_board);
//		this.scoreboard = $('#' + id_of_scoreboard);
		
		/* since I don't have a DB actually set up, we are going to use the following:
		 	-- recipe for one cocktail:
		 			- 3 shots	gin
		 			- 1 shot	vodka
		 			- 1/2 shot	vermouth
		 			
		 	-- 1 shot = 44 mL 
		 	
		 	idea is to hook up database and be able to pick various recipes and figure out how much of each ingredient you'll need depending on 
		 	how many people are over, how much they are going to drink, and which kind of drinks they want
		 	
		 	so if there were 4 ppl, 4 cocktails, 3 shots of vodka...
		 	
		 	amt_of_people = 4
		 	amt_of_cocktail_type = 4
		 	amt_of_shot_type = 3
		 	
		 	this cocktail has 3 ingredients, so
		 	
		 	number_of_ingredients = 3 - 1
		 	
		 	ingredient[0] = 3
		 	ingredient[1] = 1
		 	ingredient[2] = 0.5
		 	
		 	
		*/
		
		// start off with empty arrays
//		ingredientArry = '',
//		ingredientStr = '',
		
		// popluate ingredientArry, get values for amt_of_cocktail_type, amt_of_ingredientArry, etc
		
		// calculations
//		for(var i = 0; i < number_of_ingredients; i++) {
//			ingredientArry[i] = amt_of_cocktail_type * amt_of_ingredient[i];
//		};
		
//		for(var ingredient in ingredientArry) {
//			ingredientStr = ingredientStr + ingredientArr[ingredient];
//		};
	
		// adjust string
	
		// load string
		



		
//	}, // end of answer_board
	
	
	
}; // end of class