/**
 * It appears that this is the javascript1.js file, after being run through some sort of minification process.
 */


function callValidation() {
    return 0 != grecaptcha.getResponse().length || (alert("Please click the reCAPTCHA checkbox"), !1)
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


$("html").removeClass("js");


function scrollSidebar() {
    $(".store-sidebar").length > 0 && function () {
        if ($(".store-sidebar").length > 0 && $(window).width() <= 750) {

            //$(".store-sidebar").css("height", $(".store-sidebar").height() + "px");
            if (searchSideHeight == 0) {
                searchSideHeight = $(".store-sidebar").height();
            }

            if (prodCatTop == 0) {
                prodCatTop = $(".store-sidebar").offset().top;
            }

            var scrollTop = $(window).scrollTop(),
                elementOffset = $(".store-sidebar").offset().top,
                distance = (elementOffset - scrollTop);

            if (distance <= $("header").height() && scrollTop >= (prodCatTop - searchSideHeight)) {
                $(".store-sidebar").addClass("store-sidebar-fixed");

                $(".store-sidebar").css("top", $("header").height() + "px");
            } else {
                $(".store-sidebar").removeClass("store-sidebar-fixed");

                $(".store-sidebar").css("top", "");
            }
        }
    }()
}

function setHeaderHeight() {
    if ($(".main-content-outer").length > 0 && $("header").length > 0){
        let header_height = $("header[role='banner']").outerHeight();
        if ($(".header-text").length > 0 && $(".header-text").is(":visible")){
            const header_text_height = $('.header-text').outerHeight();
            header_height += header_text_height;
        }
        // console.log('header_height:', header_height);
        $(".main-content-outer").css("margin-top", header_height + "px");
    }
}

$(document).ready(function() {
    // Call it after 1 second to account for ads loading
    setTimeout(setHeaderHeight, 1000);

    if ($(".prod-list-cat").length > 0){
        $("#menu-mainmenu li a").each(function(){
            if ($(this).html() == "Store"){
                $(this).parent().addClass("menu-item-has-children");
                $(this).parent().append($(".prod-list-cat").html());
            }
        });
    }

    let e, t = 0;
    let iHigherLevel = 0;

    // $('body').on('click', '#loadNext'$(".post-share-btn").click(function(e){
    $('body').on('click', '.post-share-btn', function(e){
        e.preventDefault();
        $(this).parent().children('.post-share-items').toggle("slide");
    });

    let coverageAreaTriggered1 = false;

    $(window).scroll(function() {
        if ($('.footer-outer').length > 0){
            //if (!coverageAreaTriggered1 ){
            let scrollTop = $(window).scrollTop(),
                windowHeight = $(window).height(),
                elem = $('.footer-outer').offset().top,
                final = elem - windowHeight,
                distance = final - scrollTop;
            if (distance < 0) {
                //$(".floating-footer").fadeOut();
                $(".floating-footer").addClass("floating-footer-hide");
                coverageAreaTriggered1 = true;
            }
            else{
                $(".floating-footer").removeClass("floating-footer-hide");
            }
        }
        //}
    });

    function s() {
        clearTimeout(e), $(".header-cart").css("display", "")
    }
    if (
        $(".store-sidebar-close").click(function(e) {
            var la = $(this)[0];

            if (la.className == "store-sidebar-close"){
                $(this).toggleClass("isopened");
                $(".store-sidebar .secondary").css("display", "block");
            }
            else{
                $(this).toggleClass("isopened");
                $(".store-sidebar .secondary").css("display", "");
            }
        }),

        $(window).scroll(function() {
            scrollSidebar();
        }), $(window).resize(function() {
            //$(".store-sidebar").length > 0 && $(window).width() > 750 && ($(".store-sidebar").removeClass("store-sidebar-fixed"), $(".store-sidebar .secondary").css("display", "")), prodHeight(), tileSecHeight(), hpLinksHeight()
        }),

        $(".cart-block--summary__icon").mouseover(function() {
            clearTimeout(e), $(".header-cart").css("top", $("header").height() - 5 + "px"), $(".header-cart").css("display", "block")
        }),

        $(".cart-block--summary__icon").mouseout(function() {
            e = setTimeout(s, 2e3)
        }),

        $(".header-cart").mouseover(function() {
            clearTimeout(e), $(".header-cart").css("display", "block")
        }),

        $(".header-cart").mouseout(function() {
            clearTimeout(e), $(".header-cart").css("display", "")
        }),

        $(".main-content-outer").mouseover(function() {
            clearTimeout(e), $(".header-cart").css("display", "")
        }),

        $('div[data-type="background"]').each(function() {
            let e = $(this);
            $(window).scroll(function() {
                let t = $(window).scrollTop() / 2 / e.data("speed"),
                    i = "50% " + (t -= 200) + "px";
                e.css({
                    backgroundPosition: i
                })
            })
        }),

        $(".faq-btn").click(function(e) {}),

        $(".faq-outer ul li:not(.faq-outer ul li a)").click(function(e) {
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
        }),

        $(".top-breadcrumb").length > 0 && $(".page-content").css("margin-top", "3em"),
        $(".side-part-info").length > 0 && $(".page-content").addClass("two-col"),
        $(".say-listing-home").length > 0 && $(".test-outer").length > 0 && (
            $(".test-inner").html($(".say-listing-home").html() + "<div class='end'></div>"),
                $(".test-inner .say-listing-home").css("display", "block")
        ),
        $(".People-blog-item").length > 0
    ) {
        let o = $(".People-blog-item").sort(function(e, t) {
            return String.prototype.localeCompare.call($(e).data("name").split(" ").splice(-1)[0].toLowerCase(), $(t).data("name").split(" ").splice(-1)[0].toLowerCase())
        });
        $(".People-blog-item").remove(), $(".content").html(o)
    }
    if ($(".page-left-onethird").length > 0 && ($(".page-title-outer h1").addClass("page-title-outer-h1-active"), "&nbsp;" == $(".page-left-onethird").html())) {
        let n = $(".testimonials-hide blockquote"),
            a = n[Math.floor(Math.random() * n.length)];
        $(".page-left-onethird").html(a.outerHTML + '<p><a class="a-button" style="margin-top: 0; margin-bottom: 2em;" href="/about/testimonials">Read More</a></p>')
    }
    if ($(".People-blog .post-image img").length > 0) {
        let r = $(".People-blog .post-image img").attr("src").replace("35a00dc6d8", "74a4ccf7ea").replace(".jpg", "-header.jpg");
        r = r.replace(/^.*[\\\/]/, ""), $(".People-header .header-text").css({
            background: "url(/images/team-headers/" + r + ")",
            "background-repeat": "no-repeat",
            "background-position": "top center",
            "background-size": "cover"
        })
    }
    if ($(".ul-scnd li").length > 0 && (
        $(".ul-scnd").each(function() {
            $(this).has("li").length || $(this).parent().remove()
        }),
        $(".secondary > ul > .link").each(function() {
            $(this).has(".ul-scnd").length || $(this).remove()
        })
    ),
    $(".top-breadcrumb").length > 0) {
        alterTopBreadcrumb();
    }
    if ($(".People-blog").length > 0 && $(".people-partner-value").length > 0 && $(".header-text h1").append("<br>" + $(".people-partner-value").html()), $(".reviews-outer").length > 0) 

        /*var d = $(".reviews-outer").imagesLoaded(function() {
        d.masonry({
            itemSelector: ".reviews-outer ul li"
        })
    });
    if ($(".blog-entry-page .post-summary").length > 0) /*d = $(".blog-entry").imagesLoaded(function() {
        d.masonry({
            itemSelector: ".post-summary"
        })
    });
    if ($(".the-blog-itm").length > 0) /*d = $(".the-blog-itm").imagesLoaded(function() {
        d.masonry({
            itemSelector: ".home-blog-itm"
        })
    });*/
    $(".Actions").length > 0 && $(".Actions .action").attr("onclick", "return callValidation();"), $(".selected").parent("ul").parent("li").addClass("selected"), $(".selected").parent().parent().parent().parent().addClass("selected");
    let p = !1;

    function clientChange(e) {
        var newid = parseInt($('.client-popup').attr("id"));
        var cnt = $(".client-section");

        if (com == "next"){
            newid = parseInt($('.client-popup').attr("id")) + 1;
        }
        else {
            newid = parseInt($('.client-popup').attr("id")) - 1;
        }

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
    $(".meme").click(function(e) {
        let t = $(window).scrollTop();
        $("#about-section").offset().top, $("header").height()
    }),

    ($(".upcoming-events").length > 0 || $(".event-page").length > 0) && $("body").css("background", "#fff"), $(".close").click(function(e) {
        $(".page-overlay").css("visibility", "hidden"), $(".client-popup").css("visibility", "hidden"), $("html").toggleClass("freeze"), e.preventDefault()
    }),

    $(".next").click(function(e) {
        clientChange("next")
    }),

    $(".prev").click(function(e) {
        clientChange("prev")
    }),

    $(".client-section, .client-section-banner").click(function(e) {
        $(".page-overlay").css("visibility", "visible"), $(".client-popup").css("visibility", "visible"), $("html").toggleClass("freeze");
        let t = $(this).attr("id").replace("client_", ""),
            i = $(this).children("img").attr("src"),
            s = $(this).children("div").html(),
            o = $(this).children("span").html();
        $(".client-popup").attr("id", t), $(".client-popup").children("img").attr("src", i), $(".popup-txt").html(o), $(".year").html(s)
    }),

    $(".read-more").click(function(e) {
        let t = $(this).prev(".read-hidden").is(":hidden");
        $(this).prev(".read-hidden").slideToggle(), t ? $(this).val("View Less") : $(this).val("Read More")
    }),

    $(".banner-back, .test-container .flexslider").length > 0 && ($(".flexslider").flexslider({
        pauseOnHover: !1,
        controlNav: 1,
        directionNav: 1
    }),

    $(".client-logos").flexslider({
        pauseOnHover: !1,
        controlNav: 0,
        directionNav: 1
    })),

    $(".clients-page-banner").length > 0 && ($("#carousel").flexslider({
        animation: "slide",
        controlNav: !1,
        animationLoop: !1,
        slideshow: !1,
        itemWidth: 44,
        itemMargin: 0,
        asNavFor: "#slider"
    }),

    $(".flexslider").flexslider({
        animation: "slide",
        controlNav: !1,
        animationLoop: !1,
        slideshow: !1,
        sync: "#carousel"
    })),

    $(".services-nav a").click(function(e) {
        let t = $(this).attr("id");
        $("html, body").animate({
            scrollTop: $('[name="' + t + '"]').offset().top - 100
        }, 2e3)
    }),

    $(".img-section-list").length && ($(".img-section-list a").removeAttr("onclick").removeAttr("rel").click(function(e) {
        e.preventDefault()
    }),

    $(".img-section-list a").attr("rel", "gallery01").fancybox({
        margin: 0,
        padding: 0,
        arrows: !0,
        nextClick: !0,
        closeBtn: !1
    })),

    $("a.img-pop").length > 0 && $("a.img-pop").attr("rel", "gallery01").fancybox({
        margin: 0,
        padding: 0,
        arrows: !0,
        nextClick: !0,
        closeBtn: !1
    }),

    $("#services-menu").click(function(e) {
        "none" == $(".services-nav").css("display") ? this.className = "services-expand-close" : this.className = "services-expand-open", $(".services-nav").animate({
            width: "toggle"
        })
    });
    let u = $(window).width(),
        m = $(window).height();

    function backlineHeaders() {
        $(".backline-button").each(function() {
            $(this).css({
                "margin-bottom": "-35px"
            })
        })
    }

    function homeThirdBox() {

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
    backlineHeaders();
    /*$(".backline-section").imagesLoaded(function() {
        homeThirdBox()
    });*/

    function bannerHeight() {
        $(".slider1").length > 0 && ($(".slider1").css("height", $(window).height() + "px"), $(".bannerimg").css("height", $(window).height() + "px"))
    }

    const width = $(window).width();
    const height = $(window).height();
    if (bannerHeight(), $(window).resize(function() {
        $("nav").css("top", "");
        var width = $(window).width();

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

        // backlineHeaders();
        // homeThirdBox();
        // bannerHeight();
        backlineHeaders();
        homeThirdBox();
        bannerHeight();
        if ($(window).width() < 1000) {
            $("nav").css("left","-100%");
            menuopen = false;
        }
    }), $(".fancybox").length,

    $(".studios-outer").length > 0 && ($("#carousel").flexslider({
            animation: "slide",
            controlNav: !1,
            animationLoop: !1,
            slideshow: !1,
            itemWidth: 80,
            itemMargin: 10,
            asNavFor: "#slider"
        }), $(".flexslider1").flexslider({
            animation: "slide",
            controlNav: !1,
            animationLoop: !1,
            slideshow: !1,
            sync: "#carousel"
        }), $("#carousel2").flexslider({
            animation: "slide",
            controlNav: !1,
            animationLoop: !1,
            slideshow: !1,
            itemWidth: 80,
            itemMargin: 10,
            asNavFor: "#slider2"
        }), $(".flexslider2").flexslider({
            animation: "slide",
            controlNav: !1,
            animationLoop: !1,
            slideshow: !1,
            sync: "#carousel2"
        })
    ),

    $(".studio-tab").click(function(e) {
        let t = $(this).attr("id");
        $(".studio-tab").removeClass("studio-tab-active"), $(".studio").css("display", "none"), $(this).addClass("studio-tab-active"), $('[name="' + t + '"]').css("display", "block")
    }),

    $(".blog").length > 0) {
        /*d = $("#catblogoutput").imagesLoaded(function() {
            d.masonry({
                itemSelector: ".post-preview",
                columnWidth: ".blog-post-preview.grid-sizer",
                gutter: ".blog-post-preview.gutter-sizer"
            })
        });*/
        /*var w = $(".stories-container").imagesLoaded(function() {
            w.masonry({
                itemSelector: ".story",
                columnWidth: ".grid-sizer",
                gutter: ".gutter-sizer"
            })
        })*/
    }

    let menuopen = false;
    if (
        $(document).on('click','.m-menu',function() {
            var shown = $("nav").is(":hidden");

            if($(window).width() < 1001) {
                const headerHeight = $("header").height() + "px";
                $("header nav").css("top", headerHeight);
                if (!menuopen) {
                    $("nav").animate({left: "0"}, 200);
                    menuopen = true;
                }
                else {
                    $("nav").animate({left: "-100%"}, 200);
                    menuopen = false;
                }
            }

            let img = "/wp-content/themes/lighttheme/images/icons/menu.png";
            if (menuopen) {
                img = "/wp-content/themes/lighttheme/images/icons/menu-close.png";
            }
            $(".m-menu").attr("src", img);
            if($(window).width() < 1001) {
                $("html").toggleClass("freeze");
            }
        }),

        $(".home-header").css("height", $(window).height()),

        $(".map-header").css("height", $(window).height() - 200 + "px"),

        $(".scroll-down").click(function(e) {
            e.preventDefault();
            var pos;
            if ($(".home-content").length > 0){pos = $(".home-content").offset().top;}
            else if ($("#contact-section").length > 0){pos = $("#contact-section").offset().top;}
            var head = $("header").height();

            $("html, body").animate({
                scrollTop: pos - head
            },500);
        }),

        $(".map-overlay").click(function(e) {
            let t = $("#contact-section").offset().top,
                i = $("header").height();
            $("html, body").animate({
                scrollTop: t - i
            }, 500)
        }),

        $(".parent").click(function(e) {
            e.stopPropagation();
            $(this).children("ul").slideToggle();

            var backgroundImage = $(this).css("backgroundImage");
            var submenuOpenImage = "submenu.png";

            if (backgroundImage.indexOf(submenuOpenImage) != -1) {
                $(this).css("backgroundImage", "url(/wp-content/themes/lighttheme/images/icons/submenu-close.png)");
            } else {
                $(this).css("backgroundImage", "url(/wp-content/themes/lighttheme/images/icons/submenu.png)");
            }
        }), $(".menu-item-has-children > a").each(function() {
            $(this).append("<div class='toggle-submenu'></div>")
        }),

        $(window).scroll(function() {
            setupScrollBehaviours();
        }),

        $(".back-to-top").click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, 500)
        }),

        $(".toggle-submenu").click(function(e) {
            setupSubmenuToggle(e);
        }),

        $(".parent a").click(function(e) {
            e.stopPropagation()
        }),

        "ontouchstart" in window && document.querySelectorAll) {
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

    function _() {
        $(".touched").each(function() {
            this.className = "", $(this).next("ul").css("display", "none")
        })
    }
    setTimeout(function() {
        $("#studio2").css("display", "none")
    }, 500),
    setTimeout(function() {
        backlineHeaders()
    }, 500), $(".home-contact-form").length > 0 && $(".cta-outer").css("display", "none"), $(".menu-item-has-children > a").on("touchstart", function(e) {
        $(window).width() >= 1e3 && (e.preventDefault(), e.stopPropagation(), "touched" != this.className ? (_(), this.className = "touched", $(this).next("ul").css("display", "block")) : window.location.href = $(this).attr("href"))
    }),

    // This below isn't in javascript1
    $(".mainContent").on("touchstart", function(e) {
        _()
    })
});

function setupSubmenuToggleCompressed(e) {
    console.log('setupSubmenuToggleCompressed()');
    e.preventDefault();
    $(window).width() > 0 ? "toggle-submenu" == $(this)[0].className ? (
        $(".opened").each(function() {
            //$(this).removeClass("opened").prev("ul").css("display", "")
        }),
            $(this).toggleClass("opened").parent("a").next("ul").slideToggle().parent("li"),
            e.stopPropagation()
    ) : (
        $(this).toggleClass("opened").parent("a").next("ul").slideToggle().parent("li"),
        e.stopPropagation()
    ) :
    "toggle-submenu" == $(this)[0].className ? (
        $(".opened").each(function() {
            $(this).removeClass("opened").parent("a").next("ul").css({
                //height: "",
                //visibility: ""
            })
        }),
        $(this).toggleClass("opened").parent("a").next("ul").css({
            //height: "auto",
            //visibility: "visible"
        }),
        e.stopPropagation()
    ) : (
        $(this).toggleClass("opened").parent("a").next("ul").css({
            //height: "",
            //visibility: ""
        }
    ), e.stopPropagation())
}

function setupSubmenuToggle(event) {
    console.log('setupSubmenuToggle(), event:', event);
    event.preventDefault();

    const toggle = event.target;
    console.log('toggle:', toggle);

    if($(window).width() > 0) {
        // console.log('$(window).width() < 700');

        if (toggle.className === "toggle-submenu") {
            console.log('target.className == "toggle-submenu"');
            $(".opened").each(function() {
                $(toggle).removeClass("opened")
                    .parent('a').siblings("ul")
                    .css("display", '');
            });

            $(toggle).toggleClass("opened")
                .parent('a').siblings("ul")
                .slideToggle();
                // .parent("li");
        }
        else{
            $(toggle).toggleClass("opened")
                .parent('a').siblings("ul")
                .slideToggle();
                // .parent("li");
        }
    }
    // ???
    else {
        console.log('NOT $(window).width() < 700');
        //var target = $(this)[0];

        if (toggle.className === "toggle-submenu") {
            $(".opened").each(function() {
                $(toggle).removeClass("opened")
                    .parent('a').siblings("ul")
                    .css({"height":"", "visibility":""});
            });

            $(toggle).toggleClass("opened")
                .parent('a').siblings("ul")
                .css({"height":"auto", "visibility":"visible"});
        }
        else {
            $(toggle).toggleClass("opened")
                .parent('a').siblings("ul")
                .css({"height":"", "visibility":""});
        }
    }
    event.stopPropagation();
}

function alterTopBreadcrumb() {
    var bcUrl = window.location.href;

    bcUrl = bcUrl.replace("https://", "").replace("http://", "").replace(window.location.hostname, "");
    //bcUrl = bcUrl.replace("http://", "");
    //bcUrl = bcUrl.replace(window.location.hostname, "");
    bcUrl = bcUrl.slice(0, bcUrl.length);

    var res = bcUrl.split("/");

    res = res.filter(Boolean)

    if (! (res.length > 0)){
        return;
    }

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
            else {
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

function headScrollTrans() {
    var el;
    var hhightMax;
    var hhightMin;

    if ($(window).width() <= 1000) {
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
    else {
        el = ".top-breadcrumb";
    }

    if ($(".banner-back").length > 0){
        el = ".banner-text";
    }

    if (! $(el).length) {
        //console.error(`Cannot find '${el}' in headScrollTrans()`);
        return;
    }
    //console.log('$(el):', $(el));
    var scrollTop     = $(window).scrollTop();
    var elementOffset = $(el).offset().top;
    var distance = (elementOffset - scrollTop);

    if ($(".scroll-down").length > 0){
        if (distance <= 170){
            $(".scroll-down").fadeOut("slow");
        }
        else if (distance > 170){
            $(".scroll-down").fadeIn("slow");

        }
    }

    if($("header").height() > hhightMin && distance <= hhightMax) {
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
    if ($("header").height() < hhightMax && distance > hhightMin) {
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

        if (typeof home !== 'undefined' && home){
            $("header").css("background", "rgba(255, 255, 255, 0.50)");
        }
    }
    else {
        $(".year-strip").addClass("year-strip-small");
        //$("header").animate({ "background": "rgba(103, 103, 103, 0.84)" }, "slow");
        $("header").css("background", "rgba(255, 255, 255, 0.90)");
    }

    if (window.outerWidth < 1000) {
        $("nav").css("top", $("header").height() + "px");
    }
    else {
        $("nav").css("top", "");
    }

    if ($(window).width() > 999){
        $("#menu-mainmenu > li > a").css("line-height", $("header").height() + "px");
    } else{
        $("#menu-mainmenu > li > a").css("line-height", "");
    }
}

function setupScrollBehaviours() {
    headScrollTrans();

    if($(window).scrollTop() == 0) {
        $(".back-to-top").fadeOut();
    } else{
        $(".back-to-top").fadeIn();
    }

    if ($(".services-nav-outer").length > 0) {
        var scrollTop     = $(window).scrollTop(),
            elementOffset = $(".services-nav-outer").offset().top,
            distance      = (elementOffset - scrollTop);

        if (distance <= 70 && $(window).width() < 700) {
            $(".services-nav-outer").css({"position":"fixed", "top":"70px"});
        }

        if (scrollTop <= 230) {
            $(".services-nav-outer").css({"position":"", "top":""});
        }
    }
}



/** This below is not in javascript1 */
$(document).ready(function(e) {
    alterMainMenu();
    // tileSecHeight();

    /** Everything below was added manually */
    setupDiscountClick();
});

function alterMainMenu() {
    if ($(".menu-mainmenu-container").length > 0){
        $(".menu-mainmenu-container").append('<img class="m-menu" src="/wp-content/themes/lighttheme/images/icons/menu-close.png">');
    }
    if (hpLinksHeight(), $(".mind-bread").length > 0 && $(".top-breadcrumb").length, $("ul.products").length > 0) {
        let t = 0;
        $("ul.products li").each(function() {
            $(this).outerHeight() > t && (t = $(this).outerHeight())
        }), $("ul.products li").css("height", t + "px")
    }
    if ($(".oth-strip-in h3:not(.awards_outer h3)").length > 0) {
        $(".oth-strip-in h3:not(.awards_outer h3)").css("height", "");

        var p_height = 0;

        $(".oth-strip-in h3:not(.awards_outer h3)").each(function(){
            if ($(this).outerHeight() > p_height){
                p_height = $(this).outerHeight();
            }
        });

        $(".oth-strip-in h3:not(.awards_outer h3)").css("height", p_height + "px");
    }
    if ($(".awards_outer h3").length > 0) {
        $(".awards_outer h3").css("height", "");

        var p_height = 0;

        $(".awards_outer h3").each(function(){
            if ($(this).outerHeight() > p_height){
                p_height = $(this).outerHeight();
            }
        });

        $(".awards_outer h3").css("height", p_height + "px");
    }
}

function setupDiscountClick() {
    $(document).on('click','.copy-discount',function(e) {
        e.preventDefault();
        //var vcode = $(this).attr("data-code");
        //navigator.clipboard.writeText(vcode);
        //alert("Copied the text: " + vcode);
        let vcode = $(this).attr("data-code");
        navigator.clipboard.writeText(vcode);
        $(this).attr('class', "copy-discount-1");
        $(this).html("COPY DISCOUNT CODE");
    });

    $(document).on('click','.copy-discount-1',function(e) {
        //e.preventDefault();
        //var vcode = $(this).attr("data-code");
        //navigator.clipboard.writeText(vcode);
        //$(this).attr('class', "copy-discount-2");
        $(this).html("CODE COPIED");
    });
}