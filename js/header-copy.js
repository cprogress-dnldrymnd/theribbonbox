$(document).ready(function(){
    const loginField = document.querySelector('#user_login')
    if (loginField) loginField.setAttribute("placeholder", "Username");
    const passwordField = document.querySelector('#user_pass')
    if (passwordField) passwordField.setAttribute('placeholder', "Password");

    var triggeredTop = false;
    var triggeredBtm = false;

    $(window).scroll(function() {
        if ($(".header-ad").length > 0) {
            var scrollTop = $(window).scrollTop();
            //console.log(scrollTop);
            if (scrollTop <= 0) {
                triggeredTop = false;
            }

            if (scrollTop <= 0 && !triggeredTop) {
                $(".header-ad").slideDown();
                triggeredTop = true;
                triggeredBtm = false;
            }

            if (scrollTop >= 100 && !triggeredBtm) {
                $(".header-ad").slideUp();
                triggeredTop = false;
                triggeredBtm = true;
            }
        }
    });
});




$(".show-search").click(function(e){
    e.preventDefault();
    $(".header-search:not(.header-search-mobile)").slideToggle();
});

$("#h-search-close1").click(function(e){
    $(".header-search:not(.header-search-mobile)").slideToggle();
});

var loadingMenu = false;


$("nav div ul li a").mouseover(function(e){
    e.preventDefault();
    const currentElement = this;

    //console.log('category:', $(this));
    const categoryId = $(this).attr("categoryId");
    //console.log('categoryId:', categoryId);
    const postTypes = $(this).attr("post_type");
    // console.log('postTypes', postTypes);

    const submenu = $(currentElement).parents().children(".sub-menu");

    // If the menu item has one of these attributes: categoryId, cus_post
    // In other words, if it's a category
    if (($(this).attr("categoryId") || $(this).attr("cus_post"))){
        // var data = {
        //     'action': 'load_cate_posts',
        //     'categoryId': $(this).attr("categoryId"),
        //     'post_type': $(this).attr("post_type"),
        // };

        loadingMenu = true;

        //console.log($(this).attr("categoryId"));

        var hasJoinedPostTypes = false; // joint post type??

        // If this isn't a category link, but it does have post types
        if (categoryId == undefined && postTypes != ""){
            hasJoinedPostTypes = true;
        }

        //if ($cont){}

        //console.log('recentPostsJson:', recentPostsJson);
        recentPostsJson.findIndex(function (entry, i) {
            // Ensure that only posts of the preferred type are shown
            // const isThisCategory = (entry.post_type === postTypes || (postTypes.split('/')).includes(entry.post_type));
            // if (! isThisCategory) {
            //     return;
            // }

            if (! hasJoinedPostTypes){
                if (entry.id != categoryId) {
                    return;
                }
            }
            //console.log('entry:', entry);

            const hasRecentPostsWrapper = (submenu.children('.menu-posts').length > 0);
            if (hasRecentPostsWrapper){
                submenu.children('.menu-posts').html(entry.html);
            } else{
                submenu.prepend('<li class="menu-posts">'+entry.html+'</li>');
            }
        });
    }
    else {
        const hasRecentPostsWrapper = (submenu.children('.menu-posts').length > 0);
        if (hasRecentPostsWrapper){
            submenu.children('.menu-posts').html("");
        } else{
            submenu.prepend('<li class="menu-posts">'+''+'</li>');
        }
    }
});

var data = {
    'action': 'load_cate_posts',
    'categoryId': 1160,
    //'all': 1
};

jQuery.post(ajaxurl, data, function(response) {
    //console.log(response);
    $("#menu-mainmenu").append('<li id="menu-posts-main-mob" class="menu-posts">'+response+'</li>');
});