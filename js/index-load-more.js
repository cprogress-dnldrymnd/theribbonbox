/**
 * This file is included by index.php, so is on ...? pages.
 *
 * @type {boolean}
 */
let loadingItem = false;

let coverageAreaTriggered = false;
$(window).scroll(function() {
    if ($('#loadMore').length <= 0){
        return;
    }
    if (coverageAreaTriggered) {
        return;
    }

    const scrollTop = $(window).scrollTop(),
        windowHeight = $(window).height(),
        elem = $('#loadMore').offset().top,
        final = elem - windowHeight,
        distance = final - scrollTop;

    if (distance < 0 && !loadingItem) {
        //$('#loadMore').click();
        loadMoreFun();
        coverageAreaTriggered = true;
        loadingItem = true;
    }
});

$(".filter-btn").click(function(e){
    e.preventDefault();
    $(".filter-options").slideToggle();
});

//$('body').on('click', '#loadMore', function(e){

function loadMoreFun(){
    //alert("here");

    // The "Load more" button?
    const curItm = $("#loadMore");
    // The number of items?
    const curCnt = curItm.attr("data-count");
    // The post type of content on the current page?
    const curPt = curItm.attr("data-posttype");
    // ??
    const addAd = curItm.attr("data-add_ad");

    let lim = 9;

    if (curPt == "offer-items"
        || curPt == "giveaway-items"
        || curPt == "offer-items/giveaway-items"){

        lim = 11;
    } else if (curPt == "videos/podcasts" || curPt == "videos"){
        lim = 42;
    }

    //e.preventDefault();
    const data = {
        'action': 'blog_filter_load_function',
        //'course_id': $(this).parent("form").children("input[name=course_id]").val(),
        //'course_title': $(this).parent("form").children("input[name=course_title]").val(),
        'format': 'post-page',
        'post_type': curPt,
        'limit': lim,
        'curtotal': curCnt,
        'add_ad': addAd,
        'categoryid': category_id, // '<?php echo count($categories) ? $categories[0]->term_id : ""; ?>',
    };

    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php

    const url = ajaxurl;
    console.log(`Fetching more posts from: ${url}, with data:`, data);
    jQuery.post(url, data, function(response) {
        //$(".complete-pop-outer").css("display", "");
        $(curItm).parent(".loadingmoreOuter").html(response);
        $(curItm).remove();
        //$(".complete-pop-outer").css("display", "block");
        //alert(response);
        loadingItem = false;
        console.log(data);
    });

    //});
}