// Drink Mix Generator

$(document).ready(function() {
	console.log("what's the damage");
	
	var number_of_people = 0;
	var number_of_cocktails = 0;
	var number_of_shots = 0;
		
	/* INPUT total number of people */	
	$('#number_of_people').keyup(function() {
		// figure out which color was chosen
		number_of_people = $(this).val();
		
		console.log(number_of_people + ' people');
	
		if(parseInt(number_of_people) == 1) {
			$('#person_people').html('person drinking');
		}
		else {
			$('#person_people').html('people drinking');
		}
	
		// writes number of people drinking to right top
		$('#total_people').html('<div class="words">Total drinkers: ' + number_of_people + '</div>');
		
	}); // end of number of people input fct

	/* INPUT total number of cocktails */		
	$('#select_total_cocktails').keyup(function() {
		// figure out which color was chosen
		number_of_cocktails = $(this).val();
		
		console.log(number_of_cocktails + ' cocktails');
		
		// write number of cocktails to right top
		$('#total_cocktails').html('<div class="words">Total cocktails: ' + number_of_cocktails + '</div>');
		
	}); // end of number of cocktails input fct

/* INPUT total number of shots */	
	$('#select_total_shots').keyup(function() {
		// figure out which color was chosen
		number_of_shots = $(this).val();

		console.log(number_of_shots + ' shots');
		
		// write number of shots to canvas
		$('#total_shots').html('<div class="words">Total shots: ' + number_of_shots + '</div>');
		
	}); // end of number of shots input fct

	$('#submit').click(function() {
		
		console.log('user entered: people = ' + number_of_people + '; cocktails = ' + number_of_cocktails + '; shots = ' + number_of_shots + ';');
		
		// write total to canvas
		var total_drinks = parseInt(number_of_cocktails) + parseInt(number_of_shots);
		
		// write recipient to canvas
		$('#total_drinks').html('<div class="words">Total drinks: ' + total_drinks + '</div>');
		
		// Initiate Application
		Dmg.set_app("board", "scoreboard", parseInt(number_of_people), parseInt(number_of_cocktails), parseInt(number_of_shots));
		
	}); // end of reset card fct		
 
//console.log('before if: people = ' + number_of_people + '; cocktails = ' + number_of_cocktails + '; shots = ' + number_of_shots + ';');
			
}); // end doc ready; do not delete this!
		
		

var Dmg = {

	// {int} Keep a running total of people drinking and drinks
	people_drinking: 0,
	cocktails: 0,
	shots: 0,

	// {Object} HTML Objects
	board: '',
	scoreboard: '',

	/*-------------------------------------------------------------------------------------------------
	@param {string} id_of_board
	@param {string} id_of_scoreboard
	@param {int}    how_many_people
	@param {int}    how_many_cocktails
	@param {int}    how_many_shots
	@return void
	-------------------------------------------------------------------------------------------------*/
	set_app: function(id_of_board, id_of_scoreboard, how_many_people, how_many_cocktails, how_many_shots) {

		// First, identify the board and the scoreboard objects
		this.board      = $('#' + id_of_board);
		this.scoreboard = $('#' + id_of_scoreboard);

		// This will hold all the cards as we load them
		var cocktailsArr = [];
		var shotsArr = [];
//		var peopleArr = [];

		// This will hold the HTML string of divs that are our cards
		var cocktailsStr = String();
		var shotsStr = String();
//		var peopleStr = String();


	/* PEOPLE -- commented out for now since I decided to change how the app will work for now */
		// Loop for how many cards we're playing with
/*		for(var i = 0; i < how_many_people; i++) {

			// Add the individual to the array
			peopleArr[i] = "<div class='individuals' id='person" + i + "'>" + 
						"<div class='cocktails' id='cocktail'></div>" +
						"<div class='cocktails' id='shots'></div>" +
						"</div>";
		}
		
		// Now load the people array into a string. Building the string
		for(var person in peopleArr) {
			peopleStr = peopleStr + peopleArr[person];
		}		

		// Now inject the people string into the board
		this.board.html(peopleStr);

*/	
		
	/* SHOTS */
		// Loop for how many shots we have
		for(var i = 0; i < how_many_shots; i++) {
			shotsArr[i] = "<div class='clear'><div class='drinks' id='shot-" + i + "'></div>" +
							"<input class='shown' type='text' placeholder='enter kind of shot'><br></div>";
	
		}
		
		for(var shot in shotsArr) {
			shotsStr = shotsStr + shotsArr[shot];
		}		

		// Now inject the people string into the board
		this.board.prepend(shotsStr + "<br><br>");
		
		
	/* COCKTAILS */
		// Loop for how many cocktails we have
		for(var i = 0; i < how_many_cocktails; i++) {
			cocktailsArr[i] = "<div class='clear'><div class='drinks' id='cocktail-" + i + "'></div>" +
							"<input class='shown' type='text' placeholder='enter name of cocktail'><br></div>";
	
		}
		
		// Now load the cocktails array into a string; building the string
		for(var cocktail in cocktailsArr) {
			cocktailsStr = cocktailsStr + cocktailsArr[cocktail];
		}
		
		// Now inject the cocktails string into the board
		this.board.prepend(cocktailsStr + "<br><br>");


		this.board.prepend("<h2>Customize drinks</h2>");


		// Set up the event listener for the cards of individuals
		// Have to use "DMG" instead of "this" because in this context "this" is referring to the event handler, not the class
		// Also, have to use "on" method instead of "click" because we'll be adding and removing the "clickable" class and will need to re-register the listener
		// See http://api.jquery.com/on/ for more details
		$('.drinks').on('click', function() {
			Dmg.choose_a_drink($(this));
		});
		




	},
	/*-------------------------------------------------------------------------------------------------
	@param {Object}: HTML element; the card that was clicked
	-------------------------------------------------------------------------------------------------*/
	choose_a_drink: function(cardObj) {

// want to click on card
// make text field visible
// user enter text field
// collect text field
// store to array
// do calculations
// spit out totals 


		// If we already have two cards flipped, unflip them by removing the class "flipped"
		if(this.flipped_card_count == 2) {
			this.board.children().removeClass('flipped');
			this.board.children().addClass('clickable');

			// Reset the count
			this.flipped_card_count = 0;
		}

		// Increment count of how many cards are flipped
		this.flipped_card_count++;

		// To see if the cards match, figure out the letter in the other card vs selected card
		var other_card    = $('.flipped').html();
		var selected_card = cardObj.html();

		// Flip the card and remove the clickable class so it can't be clicked again
		cardObj.addClass('flipped');
		cardObj.removeClass('clickable');

		// If we have a match!
		if(other_card == selected_card) {

			// Award points
			this.points++;	

			// Fade out the two active cards
			$('.flipped').hide('slow');
		}

		// Update the scoreboard
		this.scoreboard.html(this.points);

	},
	/*-------------------------------------------------------------------------------------------------
	From: http://dzone.com/snippets/array-shuffle-javascript
	-------------------------------------------------------------------------------------------------*/
	shuffle: function(obj){ 
    	for(var j, x, i = obj.length; i; j = parseInt(Math.random() * i), x = obj[--i], obj[i] = obj[j], obj[j] = x);
    	return obj;
    }

}; // eoc
		
		
		
		
		
		
		

