jQuery(document).ready(function ($) {


	$(".view-product-catalog .views-field-field-category span").each(function(e){
		if ($(this).html() == "Weekly Classes"){
			$(this).parent().parent().addClass("classes-border");
			$(this).parent().parent().attr("data-order", "b b");

		}

		if ($(this).html() == "Schools Drama"){
			$(this).parent().parent().addClass("schools-border");
			$(this).parent().parent().attr("data-order", "a a");
		}

		if ($(this).html() == "Holiday Workshops"){
			$(this).parent().parent().addClass("workshops-border");
			$(this).parent().parent().attr("data-order", "c c");
		}
	});






	$(".single-product div.product").each(function(e){

		var txt = "";


		var border_class = "";
		var head_class = "";

		if ($(this).hasClass("product_cat-weekly-classes")){
			txt = "Weekly Classes";
			border_class = "classes-border";
			head_class = "Classes-header";
		}
		if ($(this).hasClass("product_cat-holiday-workshops")){
			txt = "Holiday Workshops";
			border_class = "workshops-border";
			head_class = "Workshops-header";
		}
		if ($(this).hasClass("product_cat-schools-drama")){
			txt = "Schools Drama";
			border_class = "schools-border";
			head_class = "Drama-header";
		}



		var added = false;


		var ages_class = "";

		if ($(".main_single_prod_title").html().indexOf("4-6") >= 0){
			ages_class = "ages-4-6-bottom-img";
			added = true;
			$(this).addClass("ages-4-6-buy-btn");
		}
		if ($(".main_single_prod_title").html().indexOf("7-11") >= 0 || $(".main_single_prod_title").html().indexOf("Ages 7-11 LAMDA") >= 0){
 			ages_class = "ages-7-11-bottom-img";
 			added = true;
 			$(this).addClass("ages-7-11-buy-btn");
		}
		if ($(".main_single_prod_title").html().indexOf("11-14") >= 0){
			ages_class = "ages-11-14-bottom-img";
			added = true;
			$(this).addClass("ages-11-14-buy-btn");
		}
		if ($(".main_single_prod_title").html().indexOf("14-18") >= 0){
			ages_class = "ages-14-18-bottom-img";
			added = true;
			$(this).addClass("ages-14-18-buy-btn");
		}
		if ($(".main_single_prod_title").html().indexOf("Free Trial Class") >= 0){
            ages_class = "ages-trial-bottom-img";
            added = true;
            $(this).addClass("ages-trial-buy-btn");
		}

		if (!added){
			ages_class = "schools-trial-bottom-img";
			$(this).addClass("schools-trial-buy-btn");
		}


			$(this).find(".section-category-single").addClass(ages_class);

			$(this).find(".section-category-single").html(txt);


			$(".main-page-header").addClass(head_class);

	});




	$(".products .product").each(function(e){

		var txt = "";


		var border_class = "";

		if ($(this).hasClass("product_cat-weekly-classes")){
			txt = "Weekly Classes";
			border_class = "classes-border";
		}
		if ($(this).hasClass("product_cat-holiday-workshops")){
			txt = "Holiday Workshops";
			border_class = "workshops-border";
		}
		if ($(this).hasClass("product_cat-schools-drama")){
			txt = "Schools Drama";
			border_class = "schools-border";
		}



		var added = false;

		$(this).find(".add_to_cart_button").html("Book Now");
		$(this).find(".product_type_variable").html("Book Now");

		$(this).find(".add_to_cart_button").addClass("btn");

		$(this).addClass(border_class);

		if ($(this).html().indexOf("4-6") >= 0){
			$(this).find(".attachment-woocommerce_thumbnail").after('<div class="section-category ages-4-6-bottom-img">'+txt+'</div>');

			$(this).addClass("ages-4-6-buy-btn");


			added = true;
		}
		if ($(this).html().indexOf("7-11") >= 0 || $(this).html().indexOf("Ages 7-11 LAMDA") >= 0){
			$(this).find(".attachment-woocommerce_thumbnail").after('<div class="section-category ages-7-11-bottom-img">'+txt+'</div>');

			$(this).addClass("ages-7-11-buy-btn");

			added = true;
		}
		if ($(this).html().indexOf("11-14") >= 0){
			$(this).find(".attachment-woocommerce_thumbnail").after('<div class="section-category ages-11-14-bottom-img">'+txt+'</div>');


			$(this).addClass("ages-11-14-buy-btn");

			added = true;
		}
		if ($(this).html().indexOf("14-18") >= 0){
			$(this).find(".attachment-woocommerce_thumbnail").after('<div class="section-category ages-14-18-bottom-img">'+txt+'</div>');
			$(this).addClass("ages-14-18-buy-btn");

			added = true;
		}

		if ($(this).html().indexOf("Free Trial Class") >= 0){
			$(this).find(".attachment-woocommerce_thumbnail").after('<div class="section-category ages-trial-bottom-img">'+txt+'</div>');

			$(this).addClass("ages-trial-buy-btn");

			added = true;
		}

		if (!added){
			$(this).find(".attachment-woocommerce_thumbnail").after('<div class="section-category schools-trial-bottom-img">'+txt+'</div>');

			$(this).addClass("schools-trial-buy-btn");
		}
	});




if ($(".view-product-catalog").length > 0){
	 var alphabeticallyOrderedDivs = $('.views-row').sort(function(a, b) {
            return String.prototype.localeCompare.call($(a).data('order').split(" ").splice(-1)[0].toLowerCase(), $(b).data('order').split(" ").splice(-1)[0].toLowerCase());
        });

        $(".views-row").remove();
    
        //var container = $(".content");
        //container.detach().empty().append(alphabeticallyOrderedDivs);
        $('.view-content').html(alphabeticallyOrderedDivs);
}



if ($(".field--name-field-category").length > 0){


		if ($(".field--name-field-category").html() == "Weekly Classes"){
			$(".field--name-field-category").parent().addClass("classes-border");
		}

		if ($(".field--name-field-category").html() == "Schools Drama"){
			$(".field--name-field-category").parent().addClass("schools-border");
		}

		if ($(".field--name-field-category").html() == "Holiday Workshops"){
			$(".field--name-field-category").parent().addClass("workshops-border");
		}

}


$(".contact-message-form").prepend("<h2>Contact Us</h2>");

	//$(".field--name-variations").append('<button class="button button--primary js-form-submit form-submit btn-success btn select-cart-btn" type="submit" id="edit-submit" name="op" value="Select">Select</button>');


if ($(".header-text h1").html() == "Ages 4 - 6"){
	$(".main-page-header").append("<div class='ages-4-6-header'></div>");
}

if ($(".header-text h1").html() == "Ages 7 - 11"){
	$(".main-page-header").append("<div class='ages-7-11-header'></div>");
}

if ($(".header-text h1").html() == "Ages 11 - 14"){
	$(".main-page-header").append("<div class='ages-11-14-header'></div>");
}

if ($(".header-text h1").html() == "Ages 14 - 18"){
	$(".main-page-header").append("<div class='ages-14-18-header'></div>");
}

if ($(".header-text h1").html() == "Classes" || $(".header-text h1").html() == "Weekly Classes"){
	$(".main-page-header").append("<div class='classes-colour-header'></div>");
}

if ($(".header-text h1").html() == "Schools" || $(".header-text h1").html() == "Schools Drama" || $(".header-text h1").html() == "LAMDA"){
	$(".main-page-header").append("<div class='schools-colour-header'></div>");
}

if ($(".header-text h1").html() == "Workshops" || $(".header-text h1").html() == "Holiday Workshops" || $(".header-text h1").html() == "Location of Workshops"){
	$(".main-page-header").append("<div class='workshops-colour-header'></div>");
}

if ($(".header-text h1").html() == "Workshop Themes Age 4 - 6"){
	$(".main-page-header").append("<div class='workshops-4-6-header'></div>");
}

if ($(".header-text h1").html() == "Workshop Themes Ages 7 - 11"){
	$(".main-page-header").append("<div class='workshops-7-11-header'></div>");
}

	if ($(".path-product .page-header .field--name-title").length > 0){

		var txt = "";

		if ($(".region-content article").hasClass("classes-border")){
			txt = "Classes";
		}
		if ($(".region-content article").hasClass("workshops-border")){
			txt = "Workshops";
		}
		if ($(".region-content article").hasClass("schools-border")){
			txt = "Schools";
		}

		var ttl = $(".path-product .page-header .field--name-title").html();

		$("<div class='field--title-itm'>" + ttl + "</div>").insertAfter(".field--name-field-product-image");


		if (ttl.indexOf("4-6") >= 0){
			$(".field--name-field-product-image").append('<div class="ages-4-6-bottom-img">'+txt+'</div>');

			$(".path-product .region-content article").addClass("ages-4-6-buy-btn");
		}
		if (ttl.indexOf("7-11") >= 0 || ttl.indexOf("7-11 LAMDA") >= 0){
			$(".field--name-field-product-image").append('<div class="ages-7-11-bottom-img">'+txt+'</div>');
		}
		if (ttl.indexOf("11-14") >= 0){
			$(".field--name-field-product-image").append('<div class="ages-11-14-bottom-img">'+txt+'</div>');
		}
		if (ttl.indexOf("14-18") >= 0){
			$(".field--name-field-product-image").append('<div class="ages-14-18-bottom-img">'+txt+'</div>');
		}

		if (ttl == "Free Trial Class"){
			$(".field--name-field-product-image").append('<div class="ages-trial-bottom-img">'+txt+'</div>');
		}
		
	}

setTimeout(function(){
var lasdasd = $(".alert-danger").length;
  	if ($(".alert-danger").length > 0 && $(".alert-success").length > 0){
		$(".alert-success").remove();
		$(".alert").css("display", "block");
	}
	else{
		$(".alert").css("display", "block");
	}

}, 2000);

	
$("#block-views-block-product-catalog-block-1  .views-field-title-1 span a").html("Book Now");
$("#block-views-block-product-catalog-block-1  .views-field-title-1 span a").addClass("button button--primary js-form-submit form-submit btn-success btn");
$("#block-views-block-product-catalog-block-1  .views-field-title-1 span a").css("display","table");

	$(".select-cart-btn").click(function(e){


			$(".select-cart-btn").css("display", "");
			$(this).css("display","none");
			$(".field--name-field-parents-name").css("display", "");
			$(".field--name-field-child-dob").css("display", "");
			$(".field--name-field-child-medical-conditions").css("display", "");
			$(".form-actions").css("display", "");

			$(this).parent().parent().find(".field--name-field-parents-name").css("display", "block");
			$(this).parent().parent().find(".field--name-field-child-dob").css("display", "block");
			$(this).parent().parent().find(".field--name-field-child-medical-conditions").css("display", "block");
			$(this).parent().parent().find(".form-actions").css("display", "block");
	});



	$(".dropdown-toggle").click(function(){

		if ($(this).attr("aria-expanded") == "true"){
			window.location.href = $(this).attr("href");
		}

	});

	if ($(".page-node-type-article article").length > 0){

		$(".header-text h1").remove();
		$(".header-text").html("<h2>Blog</h2>");
		$(".header-text").css("display", "block");

		$(".page-node-type-article article").append('<div style="text-align:center; margin:0 auto; margin-top:4em; max-width:600px; border-top:1px solid #efefef; padding-top:2em;"><input class="home-btn index-btn-middle" value="View All Blog Posts" id="catwebformbutton1" onclick="window.location.href=\'/allsorts-blog\'" type="submit"></div>');

	}
	else{
		$(".header-text").css("display", "block");
	}



	var prodCatTop = 0;

	function fixProdCat(){

		if ($("#block-bookingcategories").length > 0){

		$("#block-bookingcategories").css("height", $("#block-bookingcategories").height() + "px");

		if (prodCatTop == 0){
			prodCatTop = $("#block-bookingcategories").offset().top;
		}

	        var scrollTop     = $(window).scrollTop(),
            elementOffset = $("#block-bookingcategories").offset().top,
            distance      = (elementOffset - scrollTop);

		if (distance <= $("#head").height() && scrollTop >= (prodCatTop - $("#block-bookingcategories").height())){
			$("#block-bookingcategories .field--name-body").addClass("cat-fixed");

			$("#block-bookingcategories .field--name-body").css("top", $("#head").height() + "px");
		}else{
			$("#block-bookingcategories .field--name-body").removeClass("cat-fixed");

			$("#block-bookingcategories .field--name-body").css("top", "");
		}
	}
	}


	fixProdCat();

	$(window).scroll(function () { 
		if ($("#block-bookingcategories").length > 0){
			fixProdCat();
		}
	});


	if ($(".booking-btn").length > 0){
		
		var area = "";
		var loc = document.location.href;

		if (loc.indexOf("classes") >= 0){
			area = "classes";

		} else if (loc.indexOf("schools") >= 0){
			area = "schools";

		} else if (loc.indexOf("workshops") >= 0){
			area = "workshops";

		}

		$(".booking-btn").attr("onclick", "window.location.href='/booking?"+ area +"'")

	}


	$(".views_slideshow_cycle_slide").each(function(){


		//var wHei = $(window).height();

		bannerHeig();

		var imgSrc = $(this).find(".views-field-field-image img").attr("src");

		$(this).find(".views-field-field-image img").css("opacity", "0");

		$(this).css({"background":"url("+imgSrc+")", "background-position":"center", "background-size":"cover"});

	});


	function bannerHeig(){
		if ($(".views_slideshow_cycle_slide").length > 0){
		//var wHei = ($(window).height() / 3) * 2;
		var wHei = ($(window).height() / 4) * 2;
		$(".views_slideshow_cycle_slide").css({"height": wHei+"px", "min-height":"430px"});
	}
	}

	bannerHeig();



	$(window).resize(function(){
		bannerHeig();

		fixProdCat();
	});



	if ($("#block-bookingcategories").length > 0){
		//$(".view-prod-cat-test").prepend("<h2 class='sec-title'>" + "All Categories" + "</h2>")
		$("#block-views-block-product-catalog-block-1").prepend("<h2 class='sec-title'>" + "All Categories" + "</h2>");
	}

	if (document.location.href.indexOf("/booking?") >= 0){

		var loc = document.location.href;

		$(".sec-title").remove();

		var slcTxt = "";
		$(".prod-cat-selected").removeClass("prod-cat-selected");

		if (loc.indexOf("?classes") >= 0){
			slcTxt = "Weekly Classes";
		} else if (loc.indexOf("?schools") >= 0){
			slcTxt = "Schools Drama";
		} else if (loc.indexOf("?workshops") >= 0){
			slcTxt = "Holiday Workshops";
		}

		$( "#block-bookingcategories a:contains('"+slcTxt+"')" ).addClass("prod-cat-selected");

		$(".view-prod-cat-test").prepend("<h2 class='sec-title'>" + slcTxt + "</h2>");
		$(".view-product-catalog .views-row").css("display", "none");
		$(".views-field-field-category span").each(function(){
				if ($(this).html() == slcTxt){
					$(this).parent().parent().css("display", "");
				}
		});

		/*$("#block-views-block-product-catalog-block-1 .views-row").css("display", "none");
		$(".views-field-field-category span").each(function(){
				if ($(this).html() == slcTxt){
					$(this).parent().parent().css("display", "");
				}
		});*/
	}


	$("#block-bookingcategories a").click(function(e){
		e.preventDefault();

		$(".prod-cat-selected").removeClass("prod-cat-selected");

		$(this).addClass("prod-cat-selected");

		var slcTxt = $(this).html();

		$(".sec-title").remove();
		$("#block-views-block-product-catalog-block-1").prepend("<h2 class='sec-title'>" + slcTxt + "</h2>");

		//$("").prepend("<h2 class='sec-title'>" + "All Categories" + "</h2>");

		/*if (slcTxt == "All Categories"){
			$(".view-prod-cat-test .views-row").css("display", "");
		}else{
			$(".view-prod-cat-test .views-row").css("display", "none");

			$(".field--name-field-category").each(function(){
				if ($(this).html() == slcTxt){
					$(this).parent().parent().css("display", "");
				}
			});
		}*/


		if (slcTxt == "All Categories"){
			$(".product").css("display", "");
		}else{
			$(".product").css("display", "none");

			$(".section-category").each(function(){
				if ($(this).html() == slcTxt){
					$(this).parent().parent().css("display", "");
				}
			});
		}
	});


		$(".classes-border .price, .product_cat-weekly-classes .price").each(function(){
		$(this).append("<br/>Per Term");
	});



	if ($("#block-views-block-prod-cat-test-block-1 .views-row").length > 0){

		var height = 0;


		$("#block-views-block-prod-cat-test-block-1 .views-row").each(function(){

			if ($(this).height() > height){
				//height = $(this).height();
			}

		});


		//$("#block-views-block-prod-cat-test-block-1 .views-row").css("height", (height + 118) + "px")


	}

	if ($(".block-views-blockslideshow-block-1").length > 0){
		//$(".main-container").css("margin-top",  $(".block-views-blockslideshow-block-1").height() + "px");
	}
	else{
		//$(".main-container").css("margin-top",  $(".navbar-default").height() + "px");
	}
	
	
	//$(".logo img").css("height",  $(".navbar-default").height() + "px");


	$(".tabs-btns div").click(function(){

		
		$(".tabs-content div").removeClass("active");
		$("#"+$(this).attr("id")+"-1").addClass("active");

	});

	if ($(".view-blog-front-page").length > 0){
		$(".view-blog-front-page").append('<div class="end">&nbsp;</div><div style="text-align:center;"><input class="home-btn index-btn-middle" value="View All" id="catwebformbutton1" onclick="window.location.href=\'/allsorts-blog\'" type="submit"></div>');
	}


	if ($(".views_slideshow_cycle_slide").length > 0){

		var rd3 = ($(window).height() / 4)*3;

		//$('.views_slideshow_cycle_slide').css('cssText', 'width: '+rd3+'px !important');
		//$('.views_slideshow_cycle_slide img').css('cssText', 'width: '+rd3+'px!important');

	}

	//.views_slideshow_cycle_slide, 


	function homeAges(){
		if ($(".age-txt").length > 0){

			$(".age-txt p").css("height", "");

			var atht = 0;

			$(".age-txt p").each(function(){

				if ($(this).height() > atht){
					atht = $(this).height();
				}

			});

			$(".age-txt p").css("height", atht + "px");
		}
	}


	homeAges();


	$(window).resize(function(){
		homeAges();
	});



	if ($("#block-views-block-prod-cat-test-block-1").length > 0){

		$("select").each(function(){

			/*$(this + " option").each(function(i){
        		alert($(this).text() + " : " + $(this).val());
    		});
    		alert(1);*/

		});

		// HIDE block-views-block-prod-cat-test-block-1

		// SHOW block-views-block-prod-cat-test-block-1

		/*

				$(document).on("change", "#edit-purchased-entity-0-attributes-attribute-location", function(e){
		alert("hi");
	});


	$('#edit-purchased-entity-0-attributes-attribute-location').on('change', function() {
  alert( this.value );
});


		*/

	}


	if ($(".posted_in").length > 0) {

		if ($(".posted_in a").first().html() == "Weekly Classes"){
			$(".product").addClass("product_cat-weekly-classes main-product-outer");
		}

		if ($(".posted_in a").first().html() == "Holiday Workshops"){
			$(".product").addClass("product_cat-holiday-workshops main-product-outer");
		}

		if ($(".posted_in a").first().html() == "Schools Drama"){
			$(".product").addClass("product_cat-schools-drama main-product-outer");
		}


	}

});


 jQuery(document).ready(function($) {

             var latt = $(".lat").html();
             var long = $(".long").html();


             var mapel = [
             ];
             if ($('#workshops-map').length > 0){
                var el = ["workshops-map","51.458230","-0.131928","Plough Studios","Plough Studios, 9 Park Hill, London SW4 9NS, UK"];

                loadMap(el[0]);
             }

             if ($('#classes-map').length > 0){
                var el = ["classes-map","51.419370","-0.193674","126 Merton Rd","126 Merton Rd, London SW19 1EJ, UK"];

                loadMap(el[0]);
             }


          	if ($('#contact-map').length > 0){
                var el = ["contact-map","51.419370","-0.193674","126 Merton Rd","126 Merton Rd, London SW19 1EJ, UK"];

                loadMap(el[0]);
             }


             

            /* for (i = 0; i < mapel.length; i++) { 
                var el = mapel[i].split("|");

                var divv = el[0];


               

            }*/


});


 var markersArray = [];

    function loadMap(mapid) {

var locations = [];


//mapid, latt, long, title, address
//el[0], el[1], el[2], el[3], el[4]

var clat, clong, czoom;

        if (mapid == "workshops-map"){
            var el = ["workshops-map","51.497327","-0.159490","Plough Studios","Plough Studios, 9 Park Hill, London SW4 9NS, UK"];
            var els = ["wimbledon-map","51.419370","-0.193674","126 Merton Rd","126 Merton Rd, London SW19 1EJ, UK"];


            var loc = {"title":"More House School","address":"More House School, 22-24 Pont St, Knightsbridge, London SW1X 0AA","desc":"","tel":"","int_tel":"","email":"","web":"","web_formatted":"","open":"","time":"","lat":"51.497327","lng":"-0.159490","vicinity":"","open_hours":"","iw":{"address":true,"desc":true,"email":true,"enable":true,"int_tel":true,"open":true,"open_hours":true,"photo":true,"tel":true,"title":true,"web":true}};

            var loct = {"title":"Notting Hill Preparatory School","address":"Notting Hill Preparatory School, 95 Lancaster Rd, London W11 1QQ","desc":"","tel":"","int_tel":"","email":"","web":"","web_formatted":"","open":"","time":"","lat":"51.516828","lng":"-0.208775","vicinity":"","open_hours":"","iw":{"address":true,"desc":true,"email":true,"enable":true,"int_tel":true,"open":true,"open_hours":true,"photo":true,"tel":true,"title":true,"web":true}};

            locations.push(loc);
            locations.push(loct);

            clat = "51.506439";
            clong = "-0.184061";

            czoom = 13;
        } 

        if (mapid == "classes-map"){

            var loc = {"title":"More House School","address":"More House School, 22-24 Pont St, Knightsbridge, London SW1X 0AA","desc":"","tel":"","int_tel":"","email":"","web":"","web_formatted":"","open":"","time":"","lat":"51.497327","lng":"-0.159490","vicinity":"","open_hours":"","iw":{"address":true,"desc":true,"email":true,"enable":true,"int_tel":true,"open":true,"open_hours":true,"photo":true,"tel":true,"title":true,"web":true}};

            var loct = {"title":"Notting Hill Preparatory School","address":"Notting Hill Preparatory School, 95 Lancaster Rd, London W11 1QQ","desc":"","tel":"","int_tel":"","email":"","web":"","web_formatted":"","open":"","time":"","lat":"51.516828","lng":"-0.208775","vicinity":"","open_hours":"","iw":{"address":true,"desc":true,"email":true,"enable":true,"int_tel":true,"open":true,"open_hours":true,"photo":true,"tel":true,"title":true,"web":true}};

			var locth = {"title":"South Hampstead High School","address":"South Hampstead High School, 3 Maresfield Gardens, London NW3 5SS","desc":"","tel":"","int_tel":"","email":"","web":"","web_formatted":"","open":"","time":"","lat":"51.546235","lng":"-0.176132","vicinity":"","open_hours":"","iw":{"address":true,"desc":true,"email":true,"enable":true,"int_tel":true,"open":true,"open_hours":true,"photo":true,"tel":true,"title":true,"web":true}};


            locations.push(loc);
            locations.push(loct);
            locations.push(locth);

            clat = "51.519980";
            clong = "-0.170017";



            czoom = 12;
        } 



        if (mapid == "contact-map"){
			
			var loc = {"title":"Allsorts","address":"Allsorts, 34 Crediton Rd, London NW10 3DU","desc":"","tel":"","int_tel":"","email":"","web":"","web_formatted":"","open":"","time":"","lat":"51.536987","lng":"-0.219911","vicinity":"","open_hours":"","iw":{"address":true,"desc":true,"email":true,"enable":true,"int_tel":true,"open":true,"open_hours":true,"photo":true,"tel":true,"title":true,"web":true}};


        	locations.push(loc);

            clat = "51.536987";
            clong = "-0.219911";

        	czoom = 15;
        }





        var mapOptions = {
            center: new google.maps.LatLng(clat,clong),
            zoom: czoom,
            gestureHandling: 'auto',
            fullscreenControl: false,
            zoomControl: true,
            disableDoubleClickZoom: true,
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            },
            scaleControl: true,
            scrollwheel: true,
            streetViewControl: true,
            draggable : true,
            clickableIcons: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [
    {
        "featureType": "all",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#6e6e6e"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#444444"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
            {
                "color": "#f2f2f2"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "hue": "#ff0076"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "color": "#6a6a6a"
            },
            {
                "visibility": "on"
            }
        ]
    }
]
        }
        var mapElement = document.getElementById(mapid);
        var map = new google.maps.Map(mapElement, mapOptions);

        //,"marker":"/../images/icons/map-pin.png"

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                icon: locations[i].marker,
                position: new google.maps.LatLng(locations[i].lat, locations[i].lng),
                map: map,
                title: locations[i].title,
                address: locations[i].address,
                desc: locations[i].desc,
                tel: locations[i].tel,
                int_tel: locations[i].int_tel,
                vicinity: locations[i].vicinity,
                open: locations[i].open,
                open_hours: locations[i].open_hours,
                photo: locations[i].photo,
                time: locations[i].time,
                email: locations[i].email,
                web: locations[i].web,
                iw: locations[i].iw
            });
            markersArray.push(marker);

            if (locations[i].iw.enable === true){
                bindInfoWindow(marker, map, locations[i]);
            }
        }
    }



function bindInfoWindow(marker, map, location) {
        google.maps.event.addListener(marker, 'click', function() {
            function close(location) {
                location.ib.close();
                location.infoWindowVisible = false;
                location.ib = null;
            }

            if (location.infoWindowVisible === true) {
                close(location);
            } else {
                markersArray.forEach(function(loc, index){
                    if (loc.ib && loc.ib !== null) {
                        close(loc);
                    }
                });

                var boxText = document.createElement('div');
                boxText.style.cssText = 'background: #fff;';
                boxText.classList.add('md-whiteframe-2dp');

                function buildPieces(location, el, part, icon) {
                    if (location[part] === '') {
                        return '';
                    } else if (location.iw[part]) {
                        switch(el){
                            case 'photo':
                                if (location.photo){
                                    return '<div class="iw-photo" style="background-image: url(' + location.photo + ');"></div>';
                                 } else {
                                    return '';
                                }
                                break;
                            case 'iw-toolbar':
                                return '<div class="iw-toolbar"><h3 class="md-subhead">' + location.title + '</h3></div>';
                                break;
                            case 'div':
                                switch(part){
                                    case 'email':
                                        return '<div class="iw-details"><i class="material-icons" style="color:#4285f4;"><img src="//cdn.mapkit.io/v1/icons/' + icon + '.svg"/></i><span><a href="mailto:' + location.email + '" target="_blank">' + location.email + '</a></span></div>';
                                        break;
                                    case 'web':
                                        return '<div class="iw-details"><i class="material-icons" style="color:#4285f4;"><img src="//cdn.mapkit.io/v1/icons/' + icon + '.svg"/></i><span><a href="' + location.web + '" target="_blank">' + location.web_formatted + '</a></span></div>';
                                        break;
                                    case 'desc':
                                        return '<label class="iw-desc" for="cb_details"><input type="checkbox" id="cb_details"/><h3 class="iw-x-details">Details</h3><i class="material-icons toggle-open-details"><img src="//cdn.mapkit.io/v1/icons/' + icon + '.svg"/></i><p class="iw-x-details">' + location.desc + '</p></label>';
                                        break;
                                    default:
                                        return '<div class="iw-details"><i class="material-icons"><img src="//cdn.mapkit.io/v1/icons/' + icon + '.svg"/></i><span>' + location[part] + '</span></div>';
                                    break;
                                }
                                break;
                            case 'open_hours':
                                var items = '';
                                if (location.open_hours.length > 0){
                                    for (var i = 0; i < location.open_hours.length; ++i) {
                                        if (i !== 0){
                                            items += '<li><strong>' + location.open_hours[i].day + '</strong><strong>' + location.open_hours[i].hours +'</strong></li>';
                                        }
                                        var first = '<li><label for="cb_hours"><input type="checkbox" id="cb_hours"/><strong>' + location.open_hours[0].day + '</strong><strong>' + location.open_hours[0].hours +'</strong><i class="material-icons toggle-open-hours"><img src="//cdn.mapkit.io/v1/icons/keyboard_arrow_down.svg"/></i><ul>' + items + '</ul></label></li>';
                                    }
                                    return '<div class="iw-list"><i class="material-icons first-material-icons" style="color:#4285f4;"><img src="//cdn.mapkit.io/v1/icons/' + icon + '.svg"/></i><ul>' + first + '</ul></div>';
                                 } else {
                                    return '';
                                }
                                break;
                         }
                    } else {
                        return '';
                    }
                }

                boxText.innerHTML = 
                    buildPieces(location, 'photo', 'photo', '') +
                    buildPieces(location, 'iw-toolbar', 'title', '') +
                    buildPieces(location, 'div', 'address', 'location_on') +
                    buildPieces(location, 'div', 'web', 'public') +
                    buildPieces(location, 'div', 'email', 'email') +
                    buildPieces(location, 'div', 'tel', 'phone') +
                    buildPieces(location, 'div', 'int_tel', 'phone') +
                    buildPieces(location, 'open_hours', 'open_hours', 'access_time') +
                    buildPieces(location, 'div', 'desc', 'keyboard_arrow_down');

                var myOptions = {
                    alignBottom: true,
                    content: boxText,
                    disableAutoPan: true,
                    maxWidth: 0,
                    pixelOffset: new google.maps.Size(-140, -40),
                    zIndex: null,
                    boxStyle: {
                        opacity: 1,
                        width: '280px'
                    },
                    closeBoxMargin: '0px 0px 0px 0px',
                    infoBoxClearance: new google.maps.Size(1, 1),
                    isHidden: false,
                    pane: 'floatPane',
                    enableEventPropagation: false
                };

                location.ib = new InfoBox(myOptions);
                location.ib.open(map, marker);
                location.infoWindowVisible = true;
            }
        });
    }

    function InfoBox(opt_opts){opt_opts=opt_opts||{},google.maps.OverlayView.apply(this,arguments),this.content_=opt_opts.content||"",this.disableAutoPan_=opt_opts.disableAutoPan||!1,this.maxWidth_=opt_opts.maxWidth||0,this.pixelOffset_=opt_opts.pixelOffset||new google.maps.Size(0,0),this.position_=opt_opts.position||new google.maps.LatLng(0,0),this.zIndex_=opt_opts.zIndex||null,this.boxClass_=opt_opts.boxClass||"infoBox",this.boxStyle_=opt_opts.boxStyle||{},this.closeBoxMargin_=opt_opts.closeBoxMargin||"2px",this.closeBoxURL_=opt_opts.closeBoxURL||"http://www.google.com/intl/en_us/mapfiles/close.gif",""===opt_opts.closeBoxURL&&(this.closeBoxURL_=""),this.infoBoxClearance_=opt_opts.infoBoxClearance||new google.maps.Size(1,1),void 0===opt_opts.visible&&(void 0===opt_opts.isHidden?opt_opts.visible=!0:opt_opts.visible=!opt_opts.isHidden),this.isHidden_=!opt_opts.visible,this.alignBottom_=opt_opts.alignBottom||!1,this.pane_=opt_opts.pane||"floatPane",this.enableEventPropagation_=opt_opts.enableEventPropagation||!1,this.div_=null,this.closeListener_=null,this.moveListener_=null,this.contextListener_=null,this.eventListeners_=null,this.fixedWidthSet_=null}InfoBox.prototype=new google.maps.OverlayView,InfoBox.prototype.createInfoBoxDiv_=function(){var i,events,bw,me=this,cancelHandler=function(e){e.cancelBubble=!0,e.stopPropagation&&e.stopPropagation()},ignoreHandler=function(e){e.returnValue=!1,e.preventDefault&&e.preventDefault(),me.enableEventPropagation_||cancelHandler(e)};if(!this.div_){if(this.div_=document.createElement("div"),this.setBoxStyle_(),void 0===this.content_.nodeType?this.div_.innerHTML=this.getCloseBoxImg_()+this.content_:(this.div_.innerHTML=this.getCloseBoxImg_(),this.div_.appendChild(this.content_)),this.getPanes()[this.pane_].appendChild(this.div_),this.addClickHandler_(),this.div_.style.width?this.fixedWidthSet_=!0:0!==this.maxWidth_&&this.div_.offsetWidth>this.maxWidth_?(this.div_.style.width=this.maxWidth_,this.div_.style.overflow="auto",this.fixedWidthSet_=!0):(bw=this.getBoxWidths_(),this.div_.style.width=this.div_.offsetWidth-bw.left-bw.right+"px",this.fixedWidthSet_=!1),this.panBox_(this.disableAutoPan_),!this.enableEventPropagation_){for(this.eventListeners_=[],events=["mousedown","mouseover","mouseout","mouseup","click","dblclick","touchstart","touchend","touchmove"],i=0;i<events.length;i++)this.eventListeners_.push(google.maps.event.addDomListener(this.div_,events[i],cancelHandler));this.eventListeners_.push(google.maps.event.addDomListener(this.div_,"mouseover",function(e){this.style.cursor="default"}))}this.contextListener_=google.maps.event.addDomListener(this.div_,"contextmenu",ignoreHandler),google.maps.event.trigger(this,"domready")}},InfoBox.prototype.getCloseBoxImg_=function(){var img="";return""!==this.closeBoxURL_&&(img='<md-button class="md-icon-button infoBox-close" aria-label="More"><img src="//cdn.mapkit.io/v1/icons/close.svg"/></md-button>'),img},InfoBox.prototype.addClickHandler_=function(){var closeBox;""!==this.closeBoxURL_?(closeBox=this.div_.firstChild,this.closeListener_=google.maps.event.addDomListener(closeBox,"click",this.getCloseClickHandler_())):this.closeListener_=null},InfoBox.prototype.getCloseClickHandler_=function(){var me=this;return function(e){e.cancelBubble=!0,e.stopPropagation&&e.stopPropagation(),google.maps.event.trigger(me,"closeclick"),me.close()}},InfoBox.prototype.panBox_=function(disablePan){var map,xOffset=0,yOffset=0;if(!disablePan&&(map=this.getMap())instanceof google.maps.Map){map.getBounds().contains(this.position_)||map.setCenter(this.position_),map.getBounds();var mapDiv=map.getDiv(),mapWidth=mapDiv.offsetWidth,mapHeight=mapDiv.offsetHeight,iwOffsetX=this.pixelOffset_.width,iwOffsetY=this.pixelOffset_.height,iwWidth=this.div_.offsetWidth,iwHeight=this.div_.offsetHeight,padX=this.infoBoxClearance_.width,padY=this.infoBoxClearance_.height,pixPosition=this.getProjection().fromLatLngToContainerPixel(this.position_);if(pixPosition.x<-iwOffsetX+padX?xOffset=pixPosition.x+iwOffsetX-padX:pixPosition.x+iwWidth+iwOffsetX+padX>mapWidth&&(xOffset=pixPosition.x+iwWidth+iwOffsetX+padX-mapWidth),this.alignBottom_?pixPosition.y<-iwOffsetY+padY+iwHeight?yOffset=pixPosition.y+iwOffsetY-padY-iwHeight:pixPosition.y+iwOffsetY+padY>mapHeight&&(yOffset=pixPosition.y+iwOffsetY+padY-mapHeight):pixPosition.y<-iwOffsetY+padY?yOffset=pixPosition.y+iwOffsetY-padY:pixPosition.y+iwHeight+iwOffsetY+padY>mapHeight&&(yOffset=pixPosition.y+iwHeight+iwOffsetY+padY-mapHeight),0!==xOffset||0!==yOffset){map.getCenter();map.panBy(xOffset,yOffset)}}},InfoBox.prototype.setBoxStyle_=function(){var i,boxStyle;if(this.div_){this.div_.className=this.boxClass_,this.div_.style.cssText="",boxStyle=this.boxStyle_;for(i in boxStyle)boxStyle.hasOwnProperty(i)&&(this.div_.style[i]=boxStyle[i]);this.div_.style.WebkitTransform="translateZ(0)",void 0!==this.div_.style.opacity&&""!==this.div_.style.opacity&&(this.div_.style.MsFilter='"progid:DXImageTransform.Microsoft.Alpha(Opacity='+100*this.div_.style.opacity+')"',this.div_.style.filter="alpha(opacity="+100*this.div_.style.opacity+")"),this.div_.style.position="absolute",this.div_.style.visibility="hidden",null!==this.zIndex_&&(this.div_.style.zIndex=this.zIndex_)}},InfoBox.prototype.getBoxWidths_=function(){var computedStyle,bw={top:0,bottom:0,left:0,right:0},box=this.div_;return document.defaultView&&document.defaultView.getComputedStyle?(computedStyle=box.ownerDocument.defaultView.getComputedStyle(box,""))&&(bw.top=parseInt(computedStyle.borderTopWidth,10)||0,bw.bottom=parseInt(computedStyle.borderBottomWidth,10)||0,bw.left=parseInt(computedStyle.borderLeftWidth,10)||0,bw.right=parseInt(computedStyle.borderRightWidth,10)||0):document.documentElement.currentStyle&&box.currentStyle&&(bw.top=parseInt(box.currentStyle.borderTopWidth,10)||0,bw.bottom=parseInt(box.currentStyle.borderBottomWidth,10)||0,bw.left=parseInt(box.currentStyle.borderLeftWidth,10)||0,bw.right=parseInt(box.currentStyle.borderRightWidth,10)||0),bw},InfoBox.prototype.onRemove=function(){this.div_&&(this.div_.parentNode.removeChild(this.div_),this.div_=null)},InfoBox.prototype.draw=function(){this.createInfoBoxDiv_();var pixPosition=this.getProjection().fromLatLngToDivPixel(this.position_);this.div_.style.left=pixPosition.x+this.pixelOffset_.width+"px",this.alignBottom_?this.div_.style.bottom=-(pixPosition.y+this.pixelOffset_.height)+"px":this.div_.style.top=pixPosition.y+this.pixelOffset_.height+"px",this.isHidden_?this.div_.style.visibility="hidden":this.div_.style.visibility="visible"},InfoBox.prototype.setOptions=function(opt_opts){void 0!==opt_opts.boxClass&&(this.boxClass_=opt_opts.boxClass,this.setBoxStyle_()),void 0!==opt_opts.boxStyle&&(this.boxStyle_=opt_opts.boxStyle,this.setBoxStyle_()),void 0!==opt_opts.content&&this.setContent(opt_opts.content),void 0!==opt_opts.disableAutoPan&&(this.disableAutoPan_=opt_opts.disableAutoPan),void 0!==opt_opts.maxWidth&&(this.maxWidth_=opt_opts.maxWidth),void 0!==opt_opts.pixelOffset&&(this.pixelOffset_=opt_opts.pixelOffset),void 0!==opt_opts.alignBottom&&(this.alignBottom_=opt_opts.alignBottom),void 0!==opt_opts.position&&this.setPosition(opt_opts.position),void 0!==opt_opts.zIndex&&this.setZIndex(opt_opts.zIndex),void 0!==opt_opts.closeBoxMargin&&(this.closeBoxMargin_=opt_opts.closeBoxMargin),void 0!==opt_opts.closeBoxURL&&(this.closeBoxURL_=opt_opts.closeBoxURL),void 0!==opt_opts.infoBoxClearance&&(this.infoBoxClearance_=opt_opts.infoBoxClearance),void 0!==opt_opts.isHidden&&(this.isHidden_=opt_opts.isHidden),void 0!==opt_opts.visible&&(this.isHidden_=!opt_opts.visible),void 0!==opt_opts.enableEventPropagation&&(this.enableEventPropagation_=opt_opts.enableEventPropagation),this.div_&&this.draw()},InfoBox.prototype.setContent=function(content){this.content_=content,this.div_&&(this.closeListener_&&(google.maps.event.removeListener(this.closeListener_),this.closeListener_=null),this.fixedWidthSet_||(this.div_.style.width=""),void 0===content.nodeType?this.div_.innerHTML=this.getCloseBoxImg_()+content:(this.div_.innerHTML=this.getCloseBoxImg_(),this.div_.appendChild(content)),this.fixedWidthSet_||(this.div_.style.width=this.div_.offsetWidth+"px",void 0===content.nodeType?this.div_.innerHTML=this.getCloseBoxImg_()+content:(this.div_.innerHTML=this.getCloseBoxImg_(),this.div_.appendChild(content))),this.addClickHandler_()),google.maps.event.trigger(this,"content_changed")},InfoBox.prototype.setPosition=function(latlng){this.position_=latlng,this.div_&&this.draw(),google.maps.event.trigger(this,"position_changed")},InfoBox.prototype.setZIndex=function(index){this.zIndex_=index,this.div_&&(this.div_.style.zIndex=index),google.maps.event.trigger(this,"zindex_changed")},InfoBox.prototype.setVisible=function(isVisible){this.isHidden_=!isVisible,this.div_&&(this.div_.style.visibility=this.isHidden_?"hidden":"visible")},InfoBox.prototype.getContent=function(){return this.content_},InfoBox.prototype.getPosition=function(){return this.position_},InfoBox.prototype.getZIndex=function(){return this.zIndex_},InfoBox.prototype.getVisible=function(){return void 0!==this.getMap()&&null!==this.getMap()&&!this.isHidden_},InfoBox.prototype.show=function(){this.isHidden_=!1,this.div_&&(this.div_.style.visibility="visible")},InfoBox.prototype.hide=function(){this.isHidden_=!0,this.div_&&(this.div_.style.visibility="hidden")},InfoBox.prototype.open=function(map,anchor){var me=this;anchor&&(this.position_=anchor.getPosition(),this.moveListener_=google.maps.event.addListener(anchor,"position_changed",function(){me.setPosition(this.getPosition())})),this.setMap(map),this.div_&&this.panBox_()},InfoBox.prototype.close=function(){var i;if(this.closeListener_&&(google.maps.event.removeListener(this.closeListener_),this.closeListener_=null),this.eventListeners_){for(i=0;i<this.eventListeners_.length;i++)google.maps.event.removeListener(this.eventListeners_[i]);this.eventListeners_=null}this.moveListener_&&(google.maps.event.removeListener(this.moveListener_),this.moveListener_=null),this.contextListener_&&(google.maps.event.removeListener(this.contextListener_),this.contextListener_=null),this.setMap(null)};

