function callValidation(){
    if(grecaptcha.getResponse().length == 0){
        alert('Please click the reCAPTCHA checkbox');
        return false;
    }
    return true;
}


function hpLinksHeight(){
    if ($(".wwd-btns-outer").length > 0){

        $(".wwd-btns-outer a").css("height", "");

        var p_height = 0;

        $(".wwd-btns-outer a").each(function(){
            if ($(this).outerHeight() > p_height){
                p_height = $(this).outerHeight();
            }
        });

        var hlf = p_height / 2;

        $(".wwd-btns-outer a").css("height", p_height + "px");

        //$(".wwd-btns-outer a span").css("padding-top", hlf + "px");
    }
}

function prodHeight(){
    if ($("ul.products").length > 0){

        $("ul.products li").css("height", "");

        var p_height = 0;

        $("ul.products li").each(function(){
            if ($(this).outerHeight() > p_height){
                p_height = $(this).outerHeight();
            }
        });

        $("ul.products li").css("height", p_height + "px");
    }
}


function tileSecHeight(){
    if ($(".oth-strip-in h3:not(.awards_outer h3)").length > 0){

        $(".oth-strip-in h3:not(.awards_outer h3)").css("height", "");

        var p_height = 0;

        $(".oth-strip-in h3:not(.awards_outer h3)").each(function(){
            if ($(this).outerHeight() > p_height){
                p_height = $(this).outerHeight();
            }
        });

        $(".oth-strip-in h3:not(.awards_outer h3)").css("height", p_height + "px");
    }

    if ($(".awards_outer h3").length > 0){

        $(".awards_outer h3").css("height", "");

        var p_height = 0;

        $(".awards_outer h3").each(function(){
            if ($(this).outerHeight() > p_height){
                p_height = $(this).outerHeight();
            }
        });

        $(".awards_outer h3").css("height", p_height + "px");
    }

    console.log("dn");
}

/*
$(window).load(function () {
    if ($("ul.products").length > 0){

        var p_height = 0;

        $("ul.products li").each(function(){
            if ($(this).outerHeight() > p_height){
                p_height = $(this).outerHeight();
            }
        });

        $("ul.products li").css("height", p_height + "px");
    }
});

*/

$(document).ready(function () {

    if ($(".prod-list-cat").length > 0){
        $("#menu-mainmenu li a").each(function(){
            if ($(this).html() == "Store"){
                $(this).parent().addClass("menu-item-has-children");
               $(this).parent().append($(".prod-list-cat").html());

            }
        });
    }



    

    var prodCatTop = 0;
    var searchSideHeight = 0;

    function fixSearch(){

        if ($(".store-sidebar").length > 0 && $(window).width() <= 750){

            //$(".store-sidebar").css("height", $(".store-sidebar").height() + "px");
            if (searchSideHeight == 0){
                searchSideHeight = $(".store-sidebar").height();
            }
            
            if (prodCatTop == 0){
                prodCatTop = $(".store-sidebar").offset().top;
            }

                var scrollTop     = $(window).scrollTop(),
                elementOffset = $(".store-sidebar").offset().top,
                distance      = (elementOffset - scrollTop);

            if (distance <= $("header").height() && scrollTop >= (prodCatTop - searchSideHeight)){
                $(".store-sidebar").addClass("store-sidebar-fixed");

                $(".store-sidebar").css("top", $("header").height() + "px");
            }else{
                $(".store-sidebar").removeClass("store-sidebar-fixed");

                $(".store-sidebar").css("top", "");
            }
        }
    
    }


$(".store-sidebar-close").click(function(e){
    var la = $(this)[0];
    
    if (la.className == "store-sidebar-close"){
        
        $(this).toggleClass("isopened");
        $(".store-sidebar .secondary").css("display", "block");
    }
    else{
        $(this).toggleClass("isopened");
        $(".store-sidebar .secondary").css("display", "");
    }
});

    $(window).scroll(function(){
        if ($(".store-sidebar").length > 0){
            fixSearch();
        }
    });


    $(window).resize(function(){
        if ($(".store-sidebar").length > 0  && $(window).width() > 750){
            $(".store-sidebar").removeClass("store-sidebar-fixed");
            $(".store-sidebar .secondary").css("display", "");
        }

        prodHeight();
        tileSecHeight();
        hpLinksHeight();
    });


var timer;

function hideCart(){
    clearTimeout(timer);
    $(".header-cart").css("display", "");
}

$(".cart-block--summary__icon").mouseover(function(){
    clearTimeout(timer);
    $(".header-cart").css("top", $("header").height() - 5 + "px");
    $(".header-cart").css("display", "block");
});

$(".cart-block--summary__icon").mouseout(function(){
    timer = setTimeout(hideCart, 2000);
});

$(".header-cart").mouseover(function(){
    clearTimeout(timer);
    $(".header-cart").css("display", "block");
});

$(".header-cart").mouseout(function(){
    clearTimeout(timer);
    $(".header-cart").css("display", "");
});

$(".main-content-outer").mouseover(function(){
    clearTimeout(timer);
    $(".header-cart").css("display", "");
});

$('div[data-type="background"]').each(function(){
        var $bgobj = $(this); // assigning the object
    
        $(window).scroll(function() {
            var yPos = (($(window).scrollTop() /2) / $bgobj.data('speed')); 


            yPos = yPos - 200;
            
            // Put together our final background position
            var coords = '50% '+ yPos + 'px';

            // Move the background
            $bgobj.css({ backgroundPosition: coords });
        }); 
    });    


        $(".faq-btn").click(function(e){

/*

        if (!$(this).hasClass("faq-btn-open")){

            $(".faq-btn-open").parent("li").find("span p").slideToggle();
            $(".faq-btn-open").removeClass("faq-btn-open");

            $(this).parent("li").find("span p").slideToggle();
            $(this).addClass("faq-btn-open");
        }
        else{

            $(".faq-btn-open").parent("li").find("span p").slideToggle();
            $(".faq-btn-open").removeClass("faq-btn-open");
        }

        */
    });

    $(".faq-outer ul li:not(.faq-outer ul li a)").click(function(e){

        console.log(e.target.localName);

        if (e.target.localName != "a"){


            if (!$(this).children(".faq-btn").hasClass("faq-btn-open")){

                $(".faq-btn-open").parent("li").find("span p").slideToggle();
                $(".faq-btn-open").removeClass("faq-btn-open");

                $(this).find("span p").slideToggle();
                $(this).children(".faq-btn").addClass("faq-btn-open");
            }
            else{

                $(".faq-btn-open").parent("li").find("span p").slideToggle();
                $(".faq-btn-open").removeClass("faq-btn-open");
            }

        }

    });





if ($(".top-breadcrumb").length > 0){
    $(".page-content").css("margin-top", "3em");
}


if ($(".side-part-info").length > 0){
    //$(".page-content").css({"padding-right": "340px", "position": "relative"});
    $(".page-content").addClass("two-col");
}


/*
    $("a").click(function(e){
        e.preventDefault();   
    });


    if($(".say-listing-home").length > 0){
       
        $(".say-listing-home a").attr("href", "/");
    }

    if($(".say-blog-item").length > 0){
        $(".say-blog-item a").attr("href", "");
    }


    $(".say-blog-item a").click(function(e){
        e.preventDefault();
    });

    */
    if($(".say-listing-home").length > 0 && $(".test-outer").length > 0){
        
        $(".test-inner").html($(".say-listing-home").html() + "<div class='end'></div>");

        $(".test-inner .say-listing-home").css("display", "block");
    }



    if ($(".People-blog-item").length > 0){

        var alphabeticallyOrderedDivs = $('.People-blog-item').sort(function(a, b) {
            return String.prototype.localeCompare.call($(a).data('name').split(" ").splice(-1)[0].toLowerCase(), $(b).data('name').split(" ").splice(-1)[0].toLowerCase());
        });

        $(".People-blog-item").remove();
    
        //var container = $(".content");
        //container.detach().empty().append(alphabeticallyOrderedDivs);
        $('.content').html(alphabeticallyOrderedDivs);

    }


    if ($(".page-left-onethird").length > 0){


        $(".page-title-outer h1").addClass("page-title-outer-h1-active");

        if ($(".page-left-onethird").html() == "&nbsp;"){

        var list = $(".testimonials-hide blockquote");

        var rand = list[Math.floor(Math.random() * list.length)];

        //$(".page-left-onethird").css({"background": "#fff", "background-position":"bottom right", "background-repeat":"no-repeat", "background-size":"150px", "padding-bottom":"5em"})

        $(".page-left-onethird").html(rand.outerHTML + '<p><a class="a-button" style="margin-top: 0; margin-bottom: 2em;" href="/about/testimonials">Read More</a></p>');
       }
    }


    if ($(".People-blog .post-image img").length > 0){

        var imgP = $(".People-blog .post-image img").attr("src").replace("35a00dc6d8", "74a4ccf7ea").replace(".jpg", "-header.jpg");

        imgP = imgP.replace(/^.*[\\\/]/, '');

        $(".People-header .header-text").css({"background":"url(/images/team-headers/"+imgP+")", "background-repeat":"no-repeat", "background-position":"top center", "background-size":"cover"});

    }



    if ($(".ul-scnd li").length > 0){
       $('.ul-scnd').each(function() {
            if(!$(this).has('li').length) $(this).parent().remove();
        });

       $('.secondary > ul > .link').each(function() {
           if(!$(this).has('.ul-scnd').length) $(this).remove();
       });
       
    }

    if ($(".top-breadcrumb").length > 0){

        var bcUrl = window.location.href;

        bcUrl = bcUrl.replace("https://", "").replace("http://", "").replace(window.location.hostname, "");
        //bcUrl = bcUrl.replace("http://", "");
        //bcUrl = bcUrl.replace(window.location.hostname, "");
        bcUrl = bcUrl.slice(0, bcUrl.length);

        var res = bcUrl.split("/");

        res = res.filter(Boolean)

        if (res.length > 0){

            var links = "";

            var prod = false;

            var cnt = 1;

            for (i = 0; i < res.length; i++) {

                var norm = false;
                if (norm){

                    if (i + 1 < res.length){

                        if (prod){
                            links += "<a href='/product-category/" + res[i].replace("project", "projects").replace("product-category", "store") + "'>" + res[i].replace("-", " ").replace("-", " ").replace("-", " ").replace("and", "&").replace("project", "projects").replace("product category", "store") + "</a> &raquo; ";
                        } else {
                            links += "<a href='/" + res[i].replace("category", "categories").replace("ads", "job-search") + "'>" + res[i].replace("-", " ").replace("-", " ").replace("-", " ").replace("and", "&").replace("category", "categories").replace("ads", "job search") + "</a> &raquo; ";
                        }
                        if (res[i] == "store" || res[i] == "product-category"){
                            prod = true;
                        }
                    }
                    else{


                        var ed_lnk = "";

                        if ($(".header-text h1").html() != undefined){
                            ed_lnk =  $(".header-text h1").html();
                        }
                        if ($("h1.product_title").html() != undefined){
                            ed_lnk =  $("h1.product_title").html();
                        }
                        if ($("h1.page-title").html() != undefined){
                            ed_lnk =  $("h1.page-title").html();
                        }

                        if (prod){
                            $("header nav li a").each(function(){
                                if ($(this).html() == "Store"){
                                    $(this).parent("li").addClass("current-menu-parent");
                                }
                                var aka = res.length - 1;
                                var akka = res[aka];
                                var akk = $(this).html().toLowerCase().replace(" ", "-");

                                if ($(this).html().toLowerCase() == res[aka]){
                                    $(this).parent("li").addClass("current-menu-item");
                                }
                            });
                        }

                        links += ed_lnk;
                    }
                }
                else{
                    if (i == res.length - 2){
                        links += "<a href='/" + res[i].replace("category", "categories").replace("product-category", "store") + "'>" + res[i].replace("-", " ").replace("-", " ").replace("-", " ").replace("and", "&").replace("category", "categories").replace("product category", "store") + "</a>";
                    } else if (res.length == 1){
                        links += "<a href='/'>Home</a>";
                    }
                }
            }

            links = links.replace("/our-sponsors", "/sponsorship/our-sponsors").replace("/ads", "/job-search").replace("ads", "job search").replace("project", "portfolio").replace("project", "portfolio");

            $(".top-breadcrumb").html("<div class='breadcrumb-inner'>" + links + '</div>');
        }
    }

    if ($(".People-blog").length > 0 && $(".people-partner-value").length > 0){
        $(".header-text h1").append("<br>" + $(".people-partner-value").html());
    }

    if ($('.reviews-outer').length > 0)
    {
        /* initialize masonry layout for blog listings page*/
        var $grid = $('.reviews-outer').imagesLoaded( function() {
            // init Masonry after all images have loaded
            $grid.masonry({
                itemSelector: '.reviews-outer ul li'
            });
        });
    }

    if ($('.blog-entry-page .post-summary').length > 0)
    {
        /* initialize masonry layout for blog listings page*/
        var $grid = $('.blog-entry').imagesLoaded( function() {
            // init Masonry after all images have loaded
            $grid.masonry({
                itemSelector: '.post-summary'
            });
        });
    }

    if ($('.the-blog-itm').length > 0)
    {
        /* initialize masonry layout for blog listings page*/
        var $grid = $('.the-blog-itm').imagesLoaded( function() {
            // init Masonry after all images have loaded
            $grid.masonry({
                itemSelector: '.home-blog-itm'
            });
        });
    }


    


    if($(".Actions").length > 0){
        //$(".Actions").prepend('<div class="g-recaptcha" style="margin-bottom:1em;" data-sitekey="6Ld2mGAUAAAAAPniMDML_IPLDlr9hxEcz87h5d0o"></div>');

        $(".Actions .action").attr("onclick", "return callValidation();");
    }


    $(".selected").parent("ul").parent("li").addClass("selected");

    $(".selected").parent().parent().parent().parent().addClass("selected");
    
    var home = false;
    $("header").css("background", "rgba(255, 255, 255, 0.50)");
    
    if ($(".banner-back").length > 0){
        home = true;
        
    }

    if (home){
        $("header").css("background", "rgba(255, 255, 255, 0.50)");
    }
    
    $(".meme").click(function(e){
        var scrollTop     = $(window).scrollTop(),
            elementOffset = $('#about-section').offset().top,
            distance      = (elementOffset - scrollTop);
        
        var cur = $("header").height();
        
        var la = distance;
    });
    
    if ($(".upcoming-events").length > 0 || $(".event-page").length > 0){
        $("body").css("background", "#fff");
    }
    
    $('.close').click(function(e) {
        $('.page-overlay').css("visibility", "hidden");
        $('.client-popup').css("visibility", "hidden");
        $("html").toggleClass("freeze");
        e.preventDefault();
    });
    
    
    
    function clientChange(com){
        
        var newid = parseInt($('.client-popup').attr("id"));
        
        var cnt = $(".client-section");
        
        if (com == "next"){ newid = parseInt($('.client-popup').attr("id")) + 1; }
        else{ newid = parseInt($('.client-popup').attr("id")) - 1;}
        
        if (newid > cnt.length){ newid = 1;}
        else if (newid == 0) { newid = cnt.length;}
        
        var img = $("#client_" + newid).children("img").attr("src");
        var yr = $("#client_" + newid).children("div").html();
        var txt = $("#client_" + newid).children("span").html();
        
        $('.client-popup').attr("id", newid);
        $('.client-popup').children("img").attr("src",img);
        $('.popup-txt').html(txt);
        $('.year').html(yr);
    }
    
    $('.next').click(function(e) {
        
        clientChange('next');
        
    });
    
    $('.prev').click(function(e) {
        
        clientChange('prev');
        
    });
    
    $(".client-section, .client-section-banner").click(function(e){
        
        $('.page-overlay').css("visibility", "visible");
        $('.client-popup').css("visibility", "visible");
        $("html").toggleClass("freeze");
        
        
        var id = $(this).attr('id').replace("client_", "");
        var img = $(this).children("img").attr("src");
        var yr = $(this).children("div").html();
        var txt = $(this).children("span").html();
        var la = "";
        
        $('.client-popup').attr("id", id);
        $('.client-popup').children("img").attr("src",img);
        $('.popup-txt').html(txt);
        $('.year').html(yr);
    });
    
    //$(".event-date span").css({"margin-left":"-" + $(".event-date span").width() / 2 + "px", "margin-top":"-" +$(".event-date span").height() / 2 + "px"});
    
    $(".read-more").click(function(e){
        
        var hidden = $(this).prev(".read-hidden").is(":hidden");
        $(this).prev(".read-hidden").slideToggle();
        if (hidden) {$(this).val("View Less");}
        else{
            $(this).val("Read More");
        }
        
    });
    
    if ($(".banner-back").length > 0){
        
        $(".flexslider").flexslider({
            pauseOnHover: !1,
            controlNav: 1,
            directionNav: 1
        });

        $(".client-logos").flexslider({
            pauseOnHover: !1,
            controlNav: 0,
            directionNav: 1
        });


        
    }
    
    /*
    $('.client-year-btn, .flex-next, .flex-prev').click(function(e){
        
        var la = $('#slider ul li').index($('li.flex-active-slide')[0]);
        
        $('.client-year-btn-selected').removeClass("client-year-btn-selected");
        
        $(this).addClass("client-year-btn-selected");
        
    });*/
    
    if ($(".clients-page-banner").length > 0){
        
        $('#carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 44,
            itemMargin: 0,
            asNavFor: '#slider'
        });
        
        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel"
        });  
        

    }
    
    
    $(".services-nav a").click(function(e){
        
        var loc = $(this).attr('id');
        
        $('html, body').animate({
            scrollTop: $('[name="' + loc + '"]').offset().top - 100
        }, 2000);
        
        
        
        
    });
    
    if( $(".img-section-list").length ){
        
        $(".img-section-list a").removeAttr("onclick").removeAttr("rel").click(function(e){
            e.preventDefault();
        });
        
        // now run fancybox
        $(".img-section-list a").attr("rel", "gallery01").fancybox({
            'margin': 0,
            'padding': 0,
            'arrows': true,
            'nextClick': true,
            'closeBtn': false
        });
    }
    

   if( $("a.img-pop").length > 0){
        $("a.img-pop").attr("rel", "gallery01").fancybox({
            'margin': 0,
            'padding': 0,
            'arrows': true,
            'nextClick': true,
            'closeBtn': false
        });
   }
    
    $("#services-menu").click(function(e){
        
        if ($(".services-nav").css("display") == "none")
        {
            this.className = "services-expand-close";
        }
        else{
            this.className = "services-expand-open";
        }
        
        $(".services-nav").animate({'width': 'toggle'});
        
    });
    
    function headScrollTrans(){
        
        var el;
        
        
        var hhightMax;
        var hhightMin;
        
        if ($(window).width() <= 1000)
        {
            hhightMax = 100;
            hhightMin = 90;
        }
        else{
            hhightMax = 100;
            hhightMin = 90;
        }
        

        if ($(".header-text h1").length > 0){

            el = ".header-text h1";
        }
        else{

            el = ".top-breadcrumb";

        }


        if ($(".banner-back").length > 0){
            el = ".banner-text";

            el = ".banner-text";
        }
        
        
        
        var scrollTop     = $(window).scrollTop(),
            elementOffset = $(el).offset().top,
            distance      = (elementOffset - scrollTop);
        
        if ($(".scroll-down").length > 0){
            if (distance <= 170){
                $(".scroll-down").fadeOut("slow");
            }
            else if (distance > 170){
                $(".scroll-down").fadeIn("slow");
                
            }
        }
        
        
        
        if($("header").height() > hhightMin && distance <= hhightMax)
        {
            var cur = $("header").height();
            
            var gap = $("header").height() - distance;
            var tot = cur - gap;
            
            if (tot >= hhightMin){
                $("header").css("height", cur - gap + "px");
            }
            else{
                $("header").css("height", hhightMin + "px");
            }
        }
        if ($("header").height() < hhightMax && distance > hhightMin)
        {
            var cur = $("header").height();
            
            var gap = $("header").height() - distance;
            var tot = cur - gap;
            
            if (tot <= hhightMax){
                $("header").css("height", cur - gap + "px");
            }
            else{
                $("header").css("height", hhightMax + "px");
            }
        }
        
        
        if (distance > hhightMin){

            $(".year-strip").removeClass("year-strip-small");

            $("header").css("background", "rgba(255, 255, 255, 0.50)");

            if (home){
                $("header").css("background", "rgba(255, 255, 255, 0.50)");
            } 
            
            /*if($(window).width() < 450) {
            $(".logo").css("margin-top", "");
            }*/
        }
        else{

            $(".year-strip").addClass("year-strip-small");

                //$("header").animate({ "background": "rgba(103, 103, 103, 0.84)" }, "slow");

            $("header").css("background", "rgba(255, 255, 255, 0.90)");
            
            /*if($(window).width() < 450) {
            $(".logo").css("margin-top", "5px");
            }*/
        }

        if( window.outerWidth < 1000) {
            
            $("nav").css("top", $("header").height() + "px");
        }
        else{
            $("nav").css("top", "");
        }


        if ($(window).width() > 999){
            $("#menu-mainmenu > li > a").css("line-height", $("header").height() + "px");
        } else{
            $("#menu-mainmenu > li > a").css("line-height", "");
        }
    }
    
    var width = $(window).width();
    var height = $(window).height();


    function backlineHeaders()
    {   /*
        $( ".backline-section a span" ).each(function() {
            var ajaka = $(this).width();

            $(this).css({"margin-top":"-" + $(this).height() / 2 + "px", "margin-left":"-" + $(this).width() / 2 + "px"});
        });
        */

        
        $( ".backline-button" ).each(function() {
           //$(this).css({"margin-bottom":"-" + parseFloat($(this).css("height")) / 2 + "px"});
           $(this).css({"margin-bottom":"-35px"});
        });
    }

    backlineHeaders();


    function homeThirdBox(){

        $('.backline-section').css("display", "block");

        $(".thid-item").css("height", "");
        var iHig7 = $(".first-item").height();

        if ($(window).width() < 900 && $(".backline-section a").length > 0 && $(".first-item").height() > 0){
            var iHig = $(".first-item").height();

            $(".thid-item").css("height", iHig + "px");
            $('.backline-section').css("display", "block");

            backlineHeaders();
        }
        else {
            //setTimeout(homeThirdBox(), 2000);
        }
    }


    


    var $grid123123 = $('.backline-section').imagesLoaded( function() {
            homeThirdBox();
    });

    

    function bannerHeight(){
        if ($(".slider1").length > 0){
            $(".slider1").css("height", $(window).height() + "px");
            $(".bannerimg").css("height", $(window).height() + "px");
        }
    }

    bannerHeight();
    
    $(window).resize(function(){
        
        $("nav").css("top", "");
        
        
        if($(this).width() != width){
            $(".services-nav").css("display", "");
            if($(window).width() > 1000) {
                $('nav').css('display', '');
                $("html").removeClass("freeze");
                $(".m-menu").attr("src", "/wp-content/themes/lighttheme/images/icons/menu.png");
            }
            
            $(".menu-item-has-children > ul").css('display', '');
            
            $(".opened").removeClass("opened");
        }
        
        if($(this).height() != height){
            $(".home-header").css("height", $(window).height());
            //$(".bannerimg").css("height", $(window).height());
        }
        
        backlineHeaders();
        homeThirdBox();
        bannerHeight();
    });
    
    /* To avoid FOUC (flash of unstyled content), js class is being added by the code in head. Remove this class from html element now document is ready */
    $('html').removeClass('js'); 

    if ($(".fancybox").length > 0){ 
    /*
        $(".fancybox").fancybox({
            'margin': 0,
            'padding': 0,
            'arrows': true,
            'closeBtn': false,
            'closeClick': true
        });
        
        $(function() {
            FastClick.attach(document.body);
        });
        */
    }
    
    if ($(".studios-outer").length > 0){
        $('#carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 80,
            itemMargin: 10,
            asNavFor: '#slider'
        });
        
        $('.flexslider1').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel"
        });  
        
        $('#carousel2').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 80,
            itemMargin: 10,
            asNavFor: '#slider2'
        });
        
        $('.flexslider2').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel2"
        });
    }
    
    $(".studio-tab").click(function(e){
        
        var loc = $(this).attr('id');
        $(".studio-tab").removeClass("studio-tab-active");
        
        $('.studio').css("display", "none");
        
        $(this).addClass("studio-tab-active");
        $('[name="' + loc + '"]').css("display", "block");
        
    });
    
    
    if ($('.blog').length > 0)
    {
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
    }
    
    /*****************   NAV   *****************/
    
    $(".m-menu").click(function(){

        var shown = $("nav").is(":hidden");

        if($(window).width() < 1001) {
            var la = $(".head-inner").height() + "px";

            $("header nav").css("top", la);

            $("nav").slideToggle();

        } else{
            $("nav").slideToggle();
        }



        var img = "/wp-content/themes/lighttheme/images/icons/menu.png";

        if (shown)
        {
            img = "/wp-content/themes/lighttheme/images/icons/menu-close.png";
        }



        $(".m-menu").attr("src", img);
        if($(window).width() < 1001) {
            $("html").toggleClass("freeze");
        }
    });
    
    $(".home-header").css("height", $(window).height());
    //$(".bannerimg").css("height", $(window).height());
    
    $(".map-header").css("height", $(window).height() - 200 + "px");
    $(".scroll-down").click(function(e){

        e.preventDefault();
        
        var pos;
        
        if ($(".home-content").length > 0){pos = $(".home-content").offset().top;}
        else if ($("#contact-section").length > 0){pos = $("#contact-section").offset().top;}
        var head = $("header").height();
        
        $("html, body").animate({
            scrollTop: pos - head
        },500);
    });
    
    
    $(".map-overlay").click(function(e){
        
        var pos = $("#contact-section").offset().top;
        var head = $("header").height();
        
        $("html, body").animate({
            scrollTop: pos - head
        },500);
    });
    
    
    $(".parent").click(function(e){
        e.stopPropagation();
        
        $(this).children("ul").slideToggle();
        
        
        var backgroundImage = $(this).css("backgroundImage");
        var submenuOpenImage = "submenu.png";
        
        if(backgroundImage.indexOf(submenuOpenImage) != -1) {
            $(this).css("backgroundImage", "url(/wp-content/themes/lighttheme/images/icons/submenu-close.png)");
        } else {
            $(this).css("backgroundImage", "url(/wp-content/themes/lighttheme/images/icons/submenu.png)");
        }
    });
    
    
    $(".menu-item-has-children").each(function() {
        $(this).append(
            "<div class='toggle-submenu'></div>"
        )
        
    });
    
    
    
    
    $(window).scroll(function() {
        
        
        headScrollTrans();  
        
        
        if($(window).scrollTop() == 0) {
            $(".back-to-top").fadeOut();
        }else{
            $(".back-to-top").fadeIn();
        }
        
        
        if ($(".services-nav-outer").length > 0)
        {
            var scrollTop     = $(window).scrollTop(),
                elementOffset = $(".services-nav-outer").offset().top,
                distance      = (elementOffset - scrollTop);
            
            
            if (distance <= 70 && $(window).width() < 700){
                $(".services-nav-outer").css({"position":"fixed", "top":"70px"});
            }
            
            if (scrollTop <= 230){
                $(".services-nav-outer").css({"position":"", "top":""});
                
            }
            
            
        }
    });
    
    

    
    
    
    $(".back-to-top").click(function(){
        $("html, body").animate({
            scrollTop: 0
        },500);
    });
    
    
    $(".toggle-submenu").click(function(event){
        if($(window).width() < 700) {
            
            
            
            var la = $(this)[0];
            
            if (la.className == "toggle-submenu"){
                
                $(".opened").each(function() {
                    $(this).removeClass("opened").prev("ul").css("display", '');
                });
                
                $(this).toggleClass("opened").prev("ul").slideToggle().parent("li");
                event.stopPropagation();
            }
            else{
                $(this).toggleClass("opened").prev("ul").slideToggle().parent("li");
                event.stopPropagation();
            }
        } else{

            var la = $(this)[0];

            if (la.className == "toggle-submenu"){

                $(".opened").each(function() {
                        $(this).removeClass("opened").prev("ul").css({"height":"", "visibility":""});
                });

                $(this).toggleClass("opened").prev("ul").css({"height":"auto", "visibility":"visible"});

                event.stopPropagation();
            } else{
                $(this).toggleClass("opened").prev("ul").css({"height":"", "visibility":""});
                event.stopPropagation();
            }
        }
        
    });
    
    /* To prevent the click event propogating to the parent li, and starting to drop down the child menu
    just before the link is navigated to - you need to stop propogation/bubbling when that link is clicked */
    $(".parent a").click(function(e) {
        e.stopPropagation();
    })
    
    /* Make it so you can single tap on touch device to open dropdown menu without automatically navigating to page */
    /* Adapted from source:   https://snippets.webaware.com.au/snippets/make-css-drop-down-menus-work-on-touch-devices/   */
    var hasTouch = ("ontouchstart" in window);
    
    if (hasTouch && document.querySelectorAll) {
        var i, len, element,
            dropdowns;
        
        var select = "";
        
        if ($(window).width() >= 700){
            select += "#myMenu1 li.parent > a, ";
        }
        
        select += ".services-home-section a, .backline-section a";
        
        dropdowns = document.querySelectorAll(select);
        
        function menuTouch(event) {
            // toggle flag for preventing click for this link
            var i, len, noclick = !(this.dataNoclick);
            
            // reset flag on all links
            for (i = 0, len = dropdowns.length; i < len; ++i) {
                dropdowns[i].dataNoclick = false;
            }
            
            // set new flag value and focus on dropdown menu
            this.dataNoclick = noclick;
            this.focus();
        }
        
        function menuClick(event) {
            // if click isn't wanted, prevent it
            if (this.dataNoclick) {
                event.preventDefault();
            }
        }
        
        for (i = 0, len = dropdowns.length; i < len; ++i) {
            element = dropdowns[i];
            element.dataNoclick = false;
            element.addEventListener("touchstart", menuTouch, false);
            element.addEventListener("click", menuClick, false);
        }
    }   
    
    
    setTimeout(function(){ $("#studio2").css("display", "none");}, 500);
    
    setTimeout(function(){ backlineHeaders(); }, 500);
    
    
    if($(".home-contact-form").length > 0)
    {
        $(".cta-outer").css("display", "none");   
    }


        function clearTouched()
        {
            $(".touched").each(function() {
                this.className = "";
                $(this).next('ul').css('display', 'none');
            });
        }

        $('.menu-item-has-children > a').on( 'touchstart', function(e) {
        if($(window).width() >= 1000){
        //clearTouched();
        e.preventDefault();
        e.stopPropagation();
        var cls = this.className;
            if (cls != "touched"){
                clearTouched();
                this.className = "touched";
                $(this).next('ul').css('display', 'block');
            }
            else{
                window.location.href = $(this).attr('href');
            }
    }});

    $('.mainContent').on( 'touchstart', function(e) {clearTouched();});
    
});






$(document).ready(function(e) {


hpLinksHeight();

        if ($(".mind-bread").length > 0 && $(".top-breadcrumb").length > 0){

            //var ul = $(".top-breadcrumb").outerHeight;

        //$(".mind-bread").css("margin-top", $(".top-breadcrumb").outerHeight() + "px");
    }

        if ($("ul.products").length > 0){

            var p_height = 0;

            $("ul.products li").each(function(){
                if ($(this).outerHeight() > p_height){
                    p_height = $(this).outerHeight();
                }
            });

            $("ul.products li").css("height", p_height + "px");
        }

        if ($(".oth-strip-in h3:not(.awards_outer h3)").length > 0){

            $(".oth-strip-in h3:not(.awards_outer h3)").css("height", "");

            var p_height = 0;

            $(".oth-strip-in h3:not(.awards_outer h3)").each(function(){
                if ($(this).outerHeight() > p_height){
                    p_height = $(this).outerHeight();
                }
            });

            $(".oth-strip-in h3:not(.awards_outer h3)").css("height", p_height + "px");
        }

        if ($(".awards_outer h3").length > 0){

            $(".awards_outer h3").css("height", "");

            var p_height = 0;

            $(".awards_outer h3").each(function(){
                if ($(this).outerHeight() > p_height){
                    p_height = $(this).outerHeight();
                }
            });

            $(".awards_outer h3").css("height", p_height + "px");
        }

        tileSecHeight();

});