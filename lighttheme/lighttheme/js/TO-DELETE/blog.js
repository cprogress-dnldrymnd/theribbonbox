jQuery.noConflict();
jQuery( document ).ready(function( $ ) {
    
        /* initialize masonry layout for blog listings page*/
    var $grid = $('#catblogoutput').imagesLoaded( function() {
      	// init Masonry after all images have loaded
      	$grid.masonry({
        	itemSelector: '.post-preview',
      		columnWidth: '.blog-post-preview.grid-sizer',
        	gutter: '.blog-post-preview.gutter-sizer'
      	});
    });
    
    /* initialize masonry layout for stories */
    var $storyGrid = $('.stories-container').imagesLoaded( function() {
      	// init Masonry after all images have loaded
      	$storyGrid.masonry({
        	itemSelector: '.story',
      		columnWidth: '.grid-sizer',
        	gutter: '.gutter-sizer'
      	});
    });

    

}); //end document ready




