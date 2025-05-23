$(document).ready(function () {
    const loginField = document.querySelector('#user_login')
    if (loginField) loginField.setAttribute("placeholder", "Username");
    const passwordField = document.querySelector('#user_pass')
    if (passwordField) passwordField.setAttribute('placeholder', "Password");

    var triggeredTop = false;
    var triggeredBtm = false;

    $(window).scroll(function () {
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




$(".show-search").click(function (e) {
    e.preventDefault();
    $(".header-search:not(.header-search-mobile)").slideToggle();
});

$("#h-search-close1").click(function (e) {
    $(".header-search:not(.header-search-mobile)").slideToggle();
});

var loadingMenu = false;

$('.level-0').each(function (index, element) {
    pageid = jQuery(this).find('a[level="first"]').attr('pageid');
    categoryid = jQuery(this).find('a[level="first"]').attr('categoryid');

    if (pageid) {
        jQuery(this).find('a[level="not-first"]').attr('pageid', pageid);
    }
    if (categoryid) {
        jQuery(this).find('a[level="not-first"]').attr('categoryid', categoryid);
    }

    $(this).mouseover(function (e) {
        $parent_width = jQuery(this).find('.menu-item-has-children.level-1').parent().outerWidth();
        console.log('xxxx');
        jQuery(this).find('.menu-item-has-children.level-1').parent().css('--parent-width', $parent_width + 'px');
    });

});

$("nav div ul li a").mouseover(function (e) {
    e.preventDefault();
    const currentElement = this;

    //console.log('category:', $(this));
    const categoryId = $(this).attr("categoryId");
    //console.log('categoryId:', categoryId);
    const postTypes = $(this).attr("post_type");
    // console.log('postTypes', postTypes);


    if ($(this).attr("level") == 'not-first') {
        var menuItemId = $(this).parent().parents('.level-0').attr("id");
    } else {
        var menuItemId = $(this).parent().attr("id");
    }
    // console.log('menuItemId:' + menuItemId);
    console.log(menuItemId);

    const submenu = $(currentElement).parents().children(".sub-menu");
    const hasCusPosts = $(this).attr("cus_post");



    // If the menu item has one of these attributes: categoryId, cus_post
    // In other words, if it's a category
    if (($(this).attr("categoryId") || hasCusPosts)) {
        // var data = {
        //     'action': 'load_cate_posts',
        //     'categoryId': $(this).attr("categoryId"),
        //     'post_type': $(this).attr("post_type"),
        // };

        loadingMenu = true;

        //console.log($(this).attr("categoryId"));

        var hasJoinedPostTypes = false; // joint post type??

        // If this isn't a category link, but it does have post types
        if (categoryId == undefined && postTypes != "") {
            hasJoinedPostTypes = true;
        }

        //if ($cont){}

        // // console.log('recentPostsJson:', recentPostsJson);
        // recentPostsJson.findIndex(function (entry, i) {
        //     // Ensure that only posts of the preferred type are shown
        //     // const isThisCategory = (entry.post_type === postTypes || (postTypes.split('/')).includes(entry.post_type));
        //     // if (! isThisCategory) {
        //     //     return;
        //     // }
        //
        //     if (entry.hasOwnProperty('menuItemId')) {
        //         // console.log('entry.menuItemId:' + entry.menuItemId)
        //         if ('menu-item-' + entry.menuItemId === menuItemId) {
        //             console.log('entry:', entry)
        //         }
        //         return;
        //     }
        //
        //     // If it has only 1 preferred post type
        //     if (! hasJoinedPostTypes){
        //         // If the menu item's category ID doesn't match this JSON ITEM
        //         if (entry.id != categoryId) {
        //             return;
        //         }
        //     }
        //     //console.log('entry:', entry);
        // });
        const entry = recentPostsJson.find((post) => {
            return (post.id === parseInt(categoryId) && !hasCusPosts)
                || ('menu-item-' + post.menuItemId === menuItemId)
        })
        //console.log('entry.id:', entry.id)
        //console.log('entry.html:', entry.html.substring(0, 100))

        const hasRecentPostsWrapper = (submenu.children('.menu-posts').length > 0);
        if (hasRecentPostsWrapper) {
            submenu.children('.menu-posts').html(entry.html);
        } else {
            submenu.prepend('<li class="menu-posts">' + entry.html + '</li>');
        }

        // submenu.children().remove();
        // if (entry) {
        //     submenu.prepend('<li class="menu-posts">' + entry.html + '</li>');
        // }
    }
    else {
        // Show no posts
        const hasRecentPostsWrapper = (submenu.children('.menu-posts').length > 0);
        if (hasRecentPostsWrapper) {
            submenu.children('.menu-posts').html("");
        } else {
            submenu.prepend('<li class="menu-posts">' + '' + '</li>');
        }
    }
});

var data = {
    'action': 'load_cate_posts',
    'categoryId': 1160,
    //'all': 1
};

jQuery.post(ajaxurl, data, function (response) {
    //console.log(response);
    $("#menu-mainmenu").append('<li id="menu-posts-main-mob" class="menu-posts">' + response + '</li>');
});