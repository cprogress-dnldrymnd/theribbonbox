var script = document.createElement('script');
 
script.src = '//code.jquery.com/jquery-1.11.0.min.js';
document.getElementsByTagName('head')[0].appendChild(script); 

jQuery(document).ready(function($) {
	$("#login h1 a").attr({
		"href":"www.allsortsdrama.com",
		"title":"Allsorts Drama"
	});
});