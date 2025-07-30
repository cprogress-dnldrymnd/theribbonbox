jQuery(document).ready(function ($) {
    ajax_buy_now();
    ajax_add_to_favorites_trigger();
    e_guides_ajax_trigger();
    swiper_sliders();
    header_sticky();
    guidelines();
});

function guidelines() {
    jQuery('#guidelines-readmore').click(function (e) {

        if (jQuery('.guidelines-holder').hasClass('active')) {
            jQuery('.guidelines-holder').removeClass('active');
            jQuery(this).text('Read Guidelines +');
        } else {
            jQuery('.guidelines-holder').addClass('active');
            jQuery(this).text('Collapse Guidelines -');
        }
        e.preventDefault();
    });
}
function header_sticky() {
    if (window.innerWidth > 999) {
        var lastScrollTop = 0;
        jQuery(window).scroll(function (event) {
            var st = $(this).scrollTop();
            if (st > lastScrollTop && lastScrollTop > 500) {
                jQuery('body').addClass('hide-header');
            } else {
                jQuery('body').removeClass('hide-header');
            }
            lastScrollTop = st;
        });
    }
}

function ajax_add_to_favorites_trigger() {
    jQuery('.add-to-favorites-trigger').click(function (e) {
        add_to_favorites_ajax(jQuery(this).parents('.post-box'));
        e.preventDefault();
    });
}

function add_to_favorites_ajax(post) {
    $post_id = post.attr('post-id');
    jQuery('.add-to-favorites-trigger').attr('disabled');
    post.addClass('disabled').attr('disabled');
    jQuery.ajax({

        type: "POST",

        url: "https://theribbonbox.com/wp-admin/admin-ajax.php",

        data: {
            action: 'add_to_favorites_ajax',
            post_id: $post_id,
        },

        success: function (response) {
            post.removeClass('disabled');
            if (response.data.message == 'added') {
                post.find('.add-to-favorites-trigger').addClass('is-user-favorite');
            } else {
                post.find('.add-to-favorites-trigger').removeClass('is-user-favorite');
            }
            post.find('.add-to-favorites-trigger span').text(response.data.count);

        },
        error: function (e) {
            console.log(e);
        }
    });
}

function ajax_buy_now() {
    jQuery('.buy-now-trigger').click(function (e) {
        buy_now_ajax(jQuery(this));
        e.preventDefault();
    });
}

function buy_now_ajax(button) {
    $buy_now_id = button.attr('buy_now_id');
    jQuery('.buy-now-trigger').attr('disabled');
    button.addClass('active').attr('disabled');
    console.log('sdsdsd');
    jQuery.ajax({

        type: "POST",

        url: "https://theribbonbox.com/wp-admin/admin-ajax.php",

        data: {
            action: 'buy_now_ajax',
            buy_now_id: $buy_now_id,
        },

        success: function (response) {
            button.removeClass('active');
            window.location.href = 'https://theribbonbox.com/checkout/';
        },
        error: function (e) {
            console.log(e);
        }
    });
}

function e_guides_ajax_trigger() {
    jQuery('#product_cat').change(function (e) {
        ajax_e_guides();
        e.preventDefault();
    });

    var typingTimer;
    var doneTypingInterval = 500;

    jQuery('input[name="s"]').on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });
}

function ajax_e_guides() {
    $archive_section = jQuery('.ajax-loading');
    $result_holder = jQuery('#results');
    $s = jQuery('#search').val();
    $product_cat = jQuery('#product_cat').val();
    $post_type = jQuery('#post_type').val();
    $archive_section.addClass('loading-post');
    $posts_per_page = -1;

    jQuery.ajax({
        type: "POST",

        url: 'https://theribbonbox.com/wp-admin/admin-ajax.php',

        data: {
            action: 'e_guides_ajax',
            s: $s,
            posts_per_page: $posts_per_page,
            product_cat: $product_cat,
            post_type: $post_type
        },

        success: function (response) {
            $result_holder.html(response);
            $archive_section.removeClass('loading-post');
            jQuery('.post-grid-holder + .pagination').remove();
        },
        error: function (e) {
            console.log(e);
        }
    });
}


function doneTyping() {
    ajax_e_guides();
}

function swiper_sliders() {
    if (window.innerWidth < 992) {
        var swiper = new Swiper(".swiper-post-slider", {
            slidesPerView: 1,
            spaceBetween: 6,
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
                clickable: true,
            },
        });

        jQuery('.swiper-post-slider .swiper-wrapper').removeClass('row');
        jQuery('.swiper-post-slider .swiper-slide').removeClass('col-lg-6 col-lg-3');
    } else {
        jQuery('.swiper-post-slider .swiper-wrapper').removeClass('swiper-wrapper');
        jQuery('.swiper-post-slider .swiper-slide').removeClass('swiper-slide');
    }
    var swiper_community = new Swiper(".swiper-community-banner", {
        slidesPerView: 1,
        autoplay: true,
        spaceBetween: 0,
        pagination: {
            el: ".swiper-pagination",
            dynamicBullets: true,
            clickable: true,
        },
    });

}