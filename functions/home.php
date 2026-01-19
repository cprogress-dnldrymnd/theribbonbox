<?php
//Templates displays after first 3 sections (Giveaways)

//Search for homeblog_filter_function() for these 3 sections/shortcodes

add_action('wp_ajax_home_page_load_function', 'home_page_load_function');
add_action('wp_ajax_nopriv_home_page_load_function', 'home_page_load_function');
function home_page_load_function()
{
    //$count = $_POST['count'];
    //echo do_shortcode("[blog_filter format='".$format."' limit='".$limit."' add_ad='".$add_ad."' curtotal='".$curtotal."' categoryid='".$categoryid."' post_type='".$post_type."']");
    $excludeids = $_POST['excludeids'];
    //echo($excludeids);

    echo do_shortcode('[expert_list categoryid="1164,1159" title="Wellbeing &amp; Fertility Experts" home="1"]');
    echo do_shortcode('[blog_filter format="normal-4" limit="3" categoryid="1159" home="1"  exclude="' . $excludeids . '"]');
    echo do_shortcode('[category_list]');
    echo '<div class="blogs-loop-watch-listen">';
    echo '<div class="mw-large trb-px">';
    echo '<h2 class="hp-h2">Watch &amp; Listen</h2>';
    echo do_shortcode('[blog_filter format="video-half" post_type="videos" limit="3" categoryid="1159" home="1"]');
    echo '</div>';
    echo '</div>';
    echo do_shortcode('[blog_filter format="video" limit="4"]');
    echo do_shortcode('[blog_filter format="normal-4" limit="3" categoryid="1165" home="1"]');
    echo do_shortcode('[expert_list categoryid="1165,1163" title="Pregnancy &amp; Parenting Experts"]');
    echo do_shortcode('[display_home_section]');
    echo do_shortcode('[blog_filter format="normal-4" limit="3" categoryid="1165" home="1"]');
    echo do_shortcode('[blog_filter format="normal-1" limit="2" categoryid="1163" home="1"]');
    echo do_shortcode('[blog_filter format="normal-2" limit="2" categoryid="1159" home="1"]');
    echo do_shortcode('[display_followus]');
    echo do_shortcode('[blog_filter format="normal-4" limit="6" categoryid="1159" home="1"]');
    echo do_shortcode('[blog_filter format="normal-3" limit="2" categoryid="1165" home="1"]');


    WPBMap::addAllMappedShortcodes();
    wp_die();
}
