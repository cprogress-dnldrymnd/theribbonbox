<?php
//    error_reporting(E_ALL);
//    ini_set('display_errors', TRUE);
//    ini_set('display_startup_errors', TRUE);

if (!is_bbpress() && !is_buddypress()) {
    get_header();
    $global_id = get_the_ID();

    if (is_front_page()):
        //include 'banner.php';
        //<script src=get_template_directory_uri() . '/js/jquery.fancybox.pack.js'></script>
        //<script src=get_template_directory_uri() . '/js/jquery.flexslider-min.js'></script>
        include 'homepage.php';
    elseif (is_page(48087)):
        $fertility_category_id = 1164;
        $wellbeing_category_id = 1159;
        echo  do_shortcode('[blog_filter format="home-banner" categoryid="' . $fertility_category_id . '" home="1"]');
        echo  do_shortcode('[blog_filter format="normal-2" limit="2" categoryid="' . $wellbeing_category_id . '" home="1"]');
        echo   do_shortcode('[_giveaway_list]');

        echo '<div class="home-slider">';
        echo "<script async src='https://app.addsauce.com/widgets/widget_loader/b5e9e572-93fb-ff48-5213-dbb8e74cc9ec/sauce_homepage.js' class='snapppt-widget'></script>";
        echo '</div>';

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
        echo '<link rel="stylesheet" href="/wp-content/themes/lighttheme/stylesheet/slick.css">
                  <link rel="stylesheet" href="/wp-content/themes/lighttheme/stylesheet/slick-theme.css">
                  <script src="/wp-content/themes/lighttheme"></script>';
?>
        <script>
            var swiper = new Swiper(".swiper-experts", {
                slidesPerView: 3,
                spaceBetween: 40,
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    dynamicBullets: true,
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next-experts",
                    prevEl: ".swiper-button-prev-experts",
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                }
            });

            $('.category-entry').slick({
                dots: true,
                centerMode: true,
                centerPadding: '60px',
                slidesToShow: 3,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 2000,
                responsive: [{
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
                            centerPadding: '1px',
                            slidesToShow: 1
                        }
                    }
                ]
            });
        </script>
    <?php
    else:
        $post_type = get_post_type(get_the_ID());

        // Only "page", "ads" "giveaway-items"
        if (
            $post_type != 'videos'
            && $post_type != 'podcasts'
            && $post_type != 'expert_profiles'
            && $post_type != 'offer-items'
            /*&& $post_type!= 'giveaway-items'*/
            && $post_type != 'post'
            && $post_type != 'events'
        ) {

            include 'components/index/index-alt-post-types-header.php';
        }

        //if ( !empty(  $post->post_content ) || the_title('','',false) == "Entry FAQ"){
        $cur_post_type_val = get_post_type(get_the_ID());
    ?>

        <div class="not-front page-content-blg <?php echo $cur_post_type_val; ?>_pageItem">

            <?php if (in_array($cur_post_type_val, [
                'videos',
                'podcasts',
                'expert_profiles',
                'offer-items',
                'giveaway-items',
                'post',
                'events'
            ])) {

                // Pagination
                $id = get_queried_object_id();
                $pagination_posts = get_posts([
                    'tag_id' => $id,
                    'nopaging' => true,
                ]);
                include 'components/pagination.php';
                // End of pagination

                include 'components/index/index-post-types-featured-content.php';
            }
        endif;

        if (have_posts()) :
            while (have_posts()) :
                the_post();
            endwhile;
        else:
            include 'components/index/index-error-not-found.php';
        endif;
        echo '<!--Debug-213213123123432423-->';


        if (the_title('', '', false) == "Contact990079808970") {
            include 'components/index/index-contact-page.php';
        }

        if (the_title('', '', false) == "Reviews") {
            include 'components/index/index-reviews-page.php';
        }

        if (!is_front_page() && the_title('', '', false) != "Contact12312312357"):

            $cat_args = [
                'orderby' => 'name',
                'order' => 'ASC',
                'meta_query' => [
                    [
                        'key'     => 'page_category',
                        'value'   =>  get_the_ID(),
                        'compare' => 'LIKE'
                    ],
                ],
                'post_status' => 'publish',
            ];

            $categories = get_categories($cat_args);

            $loadMoreEv = false;

            // Watch & Listen, All Videos and Podcasts
            if (get_the_ID() == "22822" || get_the_ID() == "22824") {
                include 'components/index/index-videos-podcasts-page.php';
            }
            // If is one of: Videos, Fertility Videos, Wellbeing Videos, Pregnancy Videos, Parenting Videos
            //else if (get_the_ID() == "22828" || get_the_ID() == "22832" || get_the_ID() == "22830" || get_the_ID() == "22834" || get_the_ID() == "22836"){
            else if (in_array(get_the_ID(), ['22828', '22832', '22830', '22834', '22836'])) {
                //$atts['post_type'] = "videos";

                $design = "";
                //if (get_the_ID() == "22832" || get_the_ID() == "22830" || get_the_ID() == "22834" || get_the_ID() == "22836") {
                if (in_array(get_the_ID(), ["22832", "22830", "22834", "22836"])) {
                    include 'components/index/index-videos-subpage.php';
                } else {
                    include 'components/index/index-videos-page.php';
                }
            }
            // The Ribbon Box Podcast
            else if (get_the_ID() == "22826") {
                include 'components/index/index-the-ribbon-box-podcast.php';
            }
            // Podcast category pages: Wellbeing, Fertility, Pregnancy, Parenting
            //else if ( get_the_ID() == "" || get_the_ID() == "" || get_the_ID() == "" || get_the_ID() == ""){
            else if (in_array(get_the_ID(), ['23883', '23885', '23887', '23889'])) {
                include 'components/index/index-podcast-category-pages.php';
            }
            // Experts, All Experts
            // Offers
            else if (get_the_ID() == "22808" || get_the_ID() == "22810") {
                include 'components/index/index-experts.php';
            } else if (in_array(get_the_ID(), ['22812', '22814', '22816', '22818'])) {
                // Experts: Wellbeing, Fertility, Pregnancy, Parenting, Match With an Expert (but disabled)??
                include 'components/index/index-experts-subpages.php';
            }
            // Offers
            //code workings
            else if (get_the_ID() == "22838") {
                echo do_shortcode("[blog_filter format='post-page' limit='8' post_type='offer-items/giveaway-items' categoryid='" . $categories[0]->term_id . "']");
            }
            // Offers: Events
            //code workings
            else if (get_the_ID() == "22844") {
                include 'components/index/index-offers-events.php';
            }
            // Offers: Giveaways
            //code workings
            else if (get_the_ID() == "22840") {
                include 'components/index/index-offers-giveaways.php';
            }
            // Offers: Discounts
            //code workings
            else if (get_the_ID() == "22842") {
                include 'components/index/index-offers-discounts.php';
            } else {
                //html comments remove by dd
                //echo '<!-- index.php: All other page types -->';
                if (count($categories) > 0) {
                    $loadMoreEv = true;
                    //$categories[0]->term_id;
                    //echo do_shortcode("[blog_filter format='post-page' limit='10' add_ad='Yes' categoryid='".$categories[0]->term_id."']");

                    // Pagination
                    $id = get_queried_object_id();
                    $pagination_posts = get_posts([
                        'cat' => $categories[0]->term_id,
                        'nopaging' => true,
                    ]);
                    include 'components/pagination.php';
                    // End of pagination

                    echo do_shortcode("[blog_filter format='post-page' add_ad='Yes' categoryid='" . $categories[0]->term_id . "']");
                }
            }
            /*echo '<script type="text/javascript">
        var ajaxurl = "' . admin_url('admin-ajax.php') . '";
        </script>';*/
            ?>
            <script type="text/javascript">
                const category_id = <?php echo count($categories) ? $categories[0]->term_id : "''"; ?>;
                <?php /*include 'js/index-load-more.js'; */ ?>
            </script>
            <script src="<?= get_template_directory_uri() ?>/js/slick.js"></script>
            <script src="<?= get_template_directory_uri() ?>/js/index-load-more.js"></script>

        <?php
            $post_type = get_post_type(get_the_ID());
            if (
                !empty(get_the_content())
                && $post_type != 'videos'
                && $post_type != 'podcasts'
                && $post_type != 'expert_profiles'
                && $post_type != 'offer-items'
                && $post_type != 'giveaway-items'
                && $post_type != 'post'
                && $post_type != 'events'
                && get_the_ID() != "22820"
                && get_the_ID() != "24552"
            ) {

                include 'components/index/index-alt-post-types.php';
            }

            //if (!empty(get_the_content()) && get_post_type( get_the_ID() ) != 'videos' && get_post_type( get_the_ID() ) != 'podcasts' && get_post_type( get_the_ID() ) != 'expert_profiles' && get_post_type( get_the_ID() ) != 'offer-items' && get_post_type( get_the_ID() ) != 'giveaway-items' && get_post_type( get_the_ID() ) != 'post' && get_the_ID() != "22820" && get_the_ID() != "24552" && false){
            $post_type = get_post_type(get_the_ID());
            // This isn't being used because the 'if' statement ends in '&& false'
            if (
                !empty(get_the_content())
                && $post_type != 'videos'
                && $post_type != 'podcasts'
                && $post_type != 'expert_profiles'
                && $post_type != 'offer-items'
                && $post_type != 'giveaway-items'
                && $post_type != 'post'
                && get_the_ID() != "22820"
                && get_the_ID() != "24552"
                && false
            ) {
                include 'components/index/index-false-pages.php';
            }
            /*else {
            if ($post_type != 'events-pt'
                && $post_type != 'research-pt'
                && $post_type != 'programmes-pt'
                && $post_type != 'policy-pt'
                && $post_type != 'post'){
                //echo "<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>";
                //echo "<h3>Fusce euismod, diam et viverra rutrum, eros elit consectetur libero, ut dignissim lectus ante nec erat. Aenean mattis justo sit amet cursus rhoncus.</h3>";
                //echo "<p>Cras eget felis accumsan, fermentum dui non, viverra arcu. Fusce id nulla ipsum. Cras auctor aliquam eros. Phasellus vel tellus id sem faucibus sodales. Mauris tincidunt, dui vitae pretium auctor, diam purus commodo enim, ac tempor purus orci ut ante. Vestibulum ac massa ac nibh elementum sollicitudin ac vel sapien. Quisque congue magna sit amet risus mattis tincidunt. Etiam et lorem tellus. Sed nec ex sem. Duis a gravida lorem. Duis enim mi, aliquam in viverra pretium, dignissim quis enim. Etiam rutrum lacinia fringilla. Ut vel nibh venenatis, posuere eros quis, volutpat tellus.</p>";
            }
        }*/


            if (the_title('', '', false) == "About") {
                //if( function_exists("wd_form_maker") ) { echo "<div class='cf-outer'>"; echo wd_form_maker(1, "embedded"); echo "</div>";  }
            }
        endif;

        // Thanks for taking our quiz!
        if (get_the_ID() == "24552") {
            include 'components/index/index-thanks-quiz.php';
        }

        // Match With an Expert
        if (get_the_ID() == "22820") {
            include 'components/index/index-match-with-expert.php';
        }

        // Community
        if (get_the_ID() == "22885") {
            include 'components/index/index-community.php';
        }

        // News
        if (the_title('', '', false) == "News") {
            include 'components/index/index-news.php';
        }

        // Testimonials
        if (the_title('', '', false) == "Testimonials") {
            include 'components/index/index-testimonials.php';
        }

        // Portfolio, Services
        $cur_post = get_post($global_id);
        $parent = ($cur_post && isset($cur_post->post_parent)) ? get_the_title($cur_post->post_parent) : '';
        if (
            $parent == "Portfolio"
            || the_title('', '', false) == "Portfolio"
            || $parent == "Services"
        ) {
            include 'components/index/index-portfolio-services.php';
        }

        // Portfolio list post type
        if (get_post_type(get_the_ID()) == 'portfolio_list') {
            include 'components/index/index-portfolio-list.php';
        }

        // FAQs
        if (the_title('', '', false) == "FAQs") {
            echo do_shortcode("[faq_list]");
        }

        // Projects
        if (the_title('', '', false) == "Projects") {
            $cat = "";
            include 'project_posts_all.php';
        }

        // Entry FAQ
        // if ( !empty( get_the_content() )  || the_title('','',false) == "Entry FAQ"){}
        ?>
        </div>
    <?php
    $the_title = the_title('', '', false);
    $shortcode_text = '';
    if ($the_title === "Events") {
        $shortcode_text = "[cat_list_events]";
    }
    if ($the_title === "Research") {
        $shortcode_text = "[cat_list_research]";
    }
    if ($the_title === "Programmes") {
        $shortcode_text = "[cat_list_programmes]";
    }
    if ($the_title === "Policy") {
        $shortcode_text = "[cat_list_policy]";
    }
    if ($the_title === "Press") {
        $shortcode_text = "[cat_list_press]";
    }
    do_shortcode($shortcode_text);

    // Contact
    if (!is_front_page() && the_title('', '', false) != "Contact") {
        include 'components/index/index-contact.php';
    }

    // Site map
    if (the_title('', '', false) == "Site Map") {
        include 'functions/pretty-sitemap-loop.php';
    }

    // Page with more than 1 billion children??
    global $post;
    $children = isset($post->ID) ? get_pages(['child_of' => $post->ID]) : [];
    if (is_page() && ($post->post_parent && count($children) > 1000 * 1000 * 1000)) {
        include 'components/index/index-page-with-billion-children.php';
    }

    // Front page
    if (is_front_page()) {
        include 'components/index/index-front-page-carousel.php';
    }

    include 'components/index/index-footer-scripts.php';
    get_footer();
} else {
    get_header('community');
    if (have_posts()) :
        if (bp_is_user_profile()) {
            $section_class = 'bb-press-profile';
            $class = 'col-lg-12';
        } else {
            $section_class = '';
            $class = 'col-lg-9';
        }
        echo '<section class="bb-press-section large-container' . $section_class . '">';
        echo '<div class="container">';
        while (have_posts()) :
            the_post();
            echo '<h1>';
            the_title();
            echo '</h1>';
            if (bbp_is_forum_archive()) {
                echo "<div class='form-text-below-heading'><p><strong>To post a question or start a discussion, click on the category below that best fits your topic — fertility, pregnancy, parenting or wellbeing.</strong> </p><p>Once you're in, you'll find the option to create your post. Ask a question, share your story, or offer advice.</p></div>";
                echo do_shortcode('[forum_guidelines autop=0]');
            }
            echo '<div class="row">';
            echo '<div class="' . $class . '">';
            the_content();
            echo '</div>';
            if (!bp_is_user_profile()) {
                echo '<div class="col-lg-3">';
                echo do_shortcode('[forum_sidebar]');
                echo '</div>';
            }
            echo '</div>';
        endwhile;
        echo '</div>';
        echo '</section>';
    endif;
    get_footer('community');
}
    ?>