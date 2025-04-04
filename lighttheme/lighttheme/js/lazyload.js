/**
 * On scroll, lazy load images
 * This reduces the initial page load time, because not all images need to be loaded initially.
 */

// jQuery(document).ready(function() {    
//   let toEasyLoad = jQuery("img");
//   toEasyLoad.each(function(element) {  
//     const src = jQuery(this).attr('src');
//           //console.log(src);
//           //jQuery(this).attr('data-src', src);
//           //jQuery(this).attr("loading", "lazy");
//       // const top_of_element = jQuery(this).offset().top;
//       // const bottom_of_screen = jQuery(window).scrollTop() + jQuery(window).innerHeight();

//       // //change this value if you want images to load much sooner than user comes to the div
//       // const offset = 5;    
          
//       // if ((bottom_of_screen + offset > top_of_element)) {
//       //     // the element is visible, do something         
//       //     const src = jQuery(this).attr('src');
//       //     //console.log(src);
//           //jQuery(this).attr('data-src', src);
//        jQuery(this).attr("loading", "lazy");                    
//       // }
//   })    
// });

( function() { 'use strict';
  let images = document.querySelectorAll('img[data-src]');
              
  document.addEventListener('DOMContentLoaded', onReady);
  function onReady() {
    // Show above-the-fold images first
    showImagesOnView();

    // scroll listener
    window.addEventListener( 'scroll', showImagesOnView, false );
  }
  
  // Show the image if reached on viewport
  function showImagesOnView( e ) {
    
    for( let i of images ) {
      if( i.getAttribute('src') ) { continue; } // SKIP if already displayed
      
      // Compare the position of image and scroll
      let bounding = i.getBoundingClientRect();
      let isOnView = bounding.top >= 0 &&
      bounding.left >= 0 &&
      bounding.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
      bounding.right <= (window.innerWidth || document.documentElement.clientWidth);
      
      if( isOnView ) {
        i.setAttribute( 'src', i.dataset.src );
        if( i.getAttribute('data-srcset') ) {
          i.setAttribute( 'srcset', i.dataset.srcset );
        }
      }
    }
  }
              
})();

$('.read-more-toggle').click(function() {
  var toggle = false;
  return function () {
      if (toggle) {
          $(this).html('Read More');
          $(this).siblings('.show-content').css("overflow", "hidden");
          $(this).siblings('.show-content').css("height", "10em");
          $(this).siblings('.show-content').css("overflow", "inherit");
          $(this).closest('.toggle-wrapper').children('.show-content').css("display", "none");
      } else {
          $(this).html('Show Less');
          $(this).siblings('.show-content').css("overflow", "inherit");
          //$(this).siblings('.show-content').css("height", "auto");
          $(this).siblings('.show-content').css("display", "block");
          $(this).closest('.toggle-wrapper').css("height", "auto");
          $(this).closest('.toggle-wrapper').children('.show-content').css("display", "block");
      }
      toggle = !toggle;
}}());

const root = document.querySelector(':root');
const blueCircle = $('.blue-circle');
blueCircle.each(function(index, element) {
  const blueCircleText = parseInt($(this).text(), 10);
  //console.log(blueCircleText);
  //blueCircle.attr('percentage', blueCircleText);
  $(this).attr('style', '--percentage:'+blueCircleText+'%');
  //root.style.setProperty(--percentage, blueCircleText);
  //blueCircle.css('--mask', 'linear-gradient(red, red) padding-box, conic-gradient(red var(--p,' + blueCircleText + '), transparent 0%) border-box;');
})


