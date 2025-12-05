<script type="text/javascript">
var loadingHome = false;
$(window).scroll(function() {
    if ($('#loadHome').length > 0){
        var coverageAreaTriggered = false;
        if (!coverageAreaTriggered ){
            var scrollTop = $(window).scrollTop(),
                windowHeight = $(window).height(),
                elem = $('#loadHome').offset().top,
                final = elem - windowHeight,
                distance = final - scrollTop;
            if (distance < 0 && !loadingHome) {
                loadingHome = true;
                //$('#loadNext').click();
                LoadHomeFun();
                coverageAreaTriggered = true;
            }
        }
    }

});

//$('body').on('click', '#loadNext', function(e){
/**
 * Fetches additional posts to display on the page, using the jQuery.post() function.
 *
 * When posts have been loaded, re-loads Slick carousel, and runs any new shortcodes.
 *
 * @constructor
 */
function LoadHomeFun(){
    //alert("here");

    var curItm = $('#loadHome');
    var curEx = $('.homepage_array').last().attr("data-exclude");
    var curCat = $('#loadNext').attr("data-categoryid");
    var curPosttype = $('#loadNext').attr("data-posttype");

    //e.preventDefault();
    var data = {
        'action': 'home_page_load_function',
        'excludeids':curEx,
    };

    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
    const url = ajaxurl;
    console.log(`Fetching more posts from: ${url}, with data:`, data);
    jQuery.post(url, data, function(response) {
        //$(".complete-pop-outer").css("display", "");
        $(curItm).parent(".loadingnextOuter").html(response);
        $(curItm).remove();

        loadingHome = false;

        //loadSlick();

        <?php WPBMap::addAllMappedShortcodes(); ?>
        //$(".complete-pop-outer").css("display", "block");
        //alert(response);
    });
}


function loadSlick(){
    //$('.loadingnextOuter .expert-entry').slick("unslick");
    const entry = $('.loadingnextOuter .expert-entry');
    if (! entry.length) {
        console.warn('No slides for Slick');
        return;
    }
    entry.slick({
        centerMode: true,
        centerPadding: '0',
        slidesToShow: 3,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 900,
                settings: {
                    centerMode: true,
                    centerPadding: '150px',
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 600,
                settings: {
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });
}
</script>