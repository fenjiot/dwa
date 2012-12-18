$(function() {
	$(".rslides").responsiveSlides({
		timeout: 8000, // how long it stops on an image
		speed: 1000, // how long the transition takes
		nav: true,
		prevText: "<< ",	// String: Text for the "previous" button
		nextText: " >>",	// String: Text for the "next" button
		maxwidth: "836",	// max width is constrained by the div that it is in (i.e. col-2)
    });
  });
