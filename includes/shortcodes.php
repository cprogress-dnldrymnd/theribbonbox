<?php
function author_bio()
{
    ob_start();
    $article_author = get_field("article_author", get_the_ID());
    $article_author_role = get_field("article_author_role", get_the_ID());
    $article_bio_author_bio = get_field("article_bio_author_bio", get_the_ID());
    $article_author_linkedin_url = get_field("article_author_linkedin_url", get_the_ID());
    $article_author_image = get_field("article_author_image", get_the_ID());
    $placeholder_id = 39014;
    if ($article_author_image) {
        $image_id = $article_author_image;
    } else {
        $image_id = $placeholder_id;
    }
    if ($article_author) {
?>
        <div class="author-bio">
            <div class="author-bio-inner">
                <div class="author-image">
                    <?= wp_get_attachment_image($image_id, 'large') ?>
                </div>
                <div class="author-details">
                    <?php if ($article_author) { ?>
                        <div class="article-author">
                            <?= $article_author ?>
                        </div>
                    <?php } ?>
                    <?php if ($article_author_role) { ?>
                        <div class="article-author-role">
                            <?= $article_author_role ?>
                        </div>
                    <?php } ?>
                    <?php if ($article_bio_author_bio) { ?>
                        <div class="article-author-bio">
                            <?= $article_bio_author_bio ?>
                        </div>
                    <?php } ?>

                    <?php if ($article_author_linkedin_url) { ?>
                        <div class="article-author-socials">
                            <a href="<?= $article_author_linkedin_url ?>" target="_blank"> Connect:
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                    <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                                </svg>
                            </a>
                        </div>
                    <?php } ?>

                </div>
            </div>

        </div>
    <?php
    }
    return ob_get_clean();
}
add_shortcode('author_bio', 'author_bio');

function author_bio_v2($atts)
{
    ob_start();
    extract(
        shortcode_atts(
            array(
                'id' => get_the_ID(),
                'avatar' => 1
            ),
            $atts
        )
    );

    $article_author = get_field("article_author", $id);
    $article_author_role = get_field("article_author_role", $id);
    $article_bio_author_bio = get_field("article_bio_author_bio", $id);
    $article_author_linkedin_url = get_field("article_author_linkedin_url", $id);
    $article_author_image = get_field("article_author_image", $id);
    $placeholder_id = 39014;
    if ($article_author_image) {
        $image_id = $article_author_image;
    } else {
        $image_id = $placeholder_id;
    }
    if ($article_author) {
    ?>
        <div class="author-bio author-bio-v2">
            <div class="author-bio-inner">
                <?php if ($avatar) { ?>
                    <div class="author-image">
                        <?= wp_get_attachment_image($image_id, 'thumbnail') ?>
                    </div>
                <?php } ?>
                <div class="author-details">
                    <?php if ($article_author) { ?>
                        <div class="article-author">
                            <?= $article_author ?>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
    <?php
    }
    return ob_get_clean();
}
add_shortcode('author_bio_v2', 'author_bio_v2');


function article_partnership()
{

    ob_start();
    $partnership_name = get_field("partnership_name", get_the_ID());
    $partnership_website = get_field("partnership_website", get_the_ID());
    $partnership_logo = get_field("partnership_logo", get_the_ID());
    $placeholder_id = 42993;
    if ($partnership_logo) {
        $image_id = $partnership_logo;
    } else {
        $image_id = $placeholder_id;
    }
    if ($partnership_name) {
    ?>
        <div class="author-bio article-partnership">
            <div class="author-bio-inner">
                <div class="author-image">
                    <?= wp_get_attachment_image($image_id, 'large') ?>
                </div>
                <div class="author-details">
                    <?php if ($partnership_name) { ?>
                        <div class="article-author partnership-name">
                            <span><span class="text-label">In partnership with experts from</span> <span class="text-highlight"><?= $partnership_name ?></span></span>
                        </div>
                        <?php if ($partnership_website) { ?>
                            <a href="<?= $partnership_website ?>" target="_blank" class="partner-website">
                                Visit Website
                            </a>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

        </div>
    <?php
    }
    return ob_get_clean();
}

add_shortcode('article_partnership', 'article_partnership');

function article_medically_reviewed_by()
{

    ob_start();
    $reviewed_by = get_field("reviewed_by", get_the_ID());
    $link_type = get_field("link_type", get_the_ID());
    $reviewed_by_url = get_field("reviewed_by_url", get_the_ID());
    $reviewed_by_photo = get_field("reviewed_by_photo", get_the_ID());
    $link_text = get_field("link_text", get_the_ID());
    $reviewd_by_text = get_field("reviewd_by_text", get_the_ID());

    $placeholder_id = 39014;
    if ($reviewed_by_photo) {
        $image_id = $reviewed_by_photo;
    } else {
        $image_id = $placeholder_id;
    }
    if ($reviewed_by) {
    ?>
        <div class="author-bio medically-reviewd-by">
            <div class="author-bio-inner">
                <div class="author-image">
                    <?= wp_get_attachment_image($image_id, 'large') ?>
                </div>
                <div class="author-details">
                    <div class="article-author">
                        <span><span class="text-label">Medically reviewed by</span> <span class="text-highlight"><?= $reviewed_by ?></span></span>
                    </div>
                    <?php if ($reviewd_by_text) { ?>
                        <div class="article-author-bio">
                            <?= $reviewd_by_text ?>
                        </div>
                    <?php } ?>
                    <?php if ($reviewed_by_url && $link_type == 'linkedin') { ?>
                        <div class="article-author-socials">
                            <a href="<?= $reviewed_by_url ?>" target="_blank"> Connect:
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                    <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                                </svg>
                            </a>
                        </div>
                    <?php } else if ($link_type == 'external' && $link_text) {  ?>
                        <a class="partner-website" href="<?= $reviewed_by_url ?>" target="_blank">
                            <?= $link_text ?>
                        </a>
                    <?php } ?>
                </div>
            </div>

        </div>
    <?php
    }
    return ob_get_clean();
}

add_shortcode('article_medically_reviewed_by', 'article_medically_reviewed_by');

function display_subscribe()
{
    ob_start();
    ?>
    <div id="subscribe-outer" class="post-follow-us insider-outer subscibe-outer subscibe-outerv2">
        <div class="subscribe-outer-close"><img src="<?php echo (get_template_directory_uri()) ?>/images/icons/menu-close.png"></div>
        <div class="post-follow-us-inner">
            <div class="subscribe-outer-img"><img src="<?php echo (get_template_directory_uri()) ?>/images/subscribe-image-ph-1.jpg"></div>
            <div class="subscribe-outer-txt">
                <h2>Become an Insider</h2>
                <div class="cat-links">
                    <a href="/wellbeing">Wellbeing</a> |
                    <a href="/fertility">Fertility</a> |
                    <a href="/pregnancy">Pregnancy</a> |
                    <a href="/parenting">Parenting</a>
                </div>
                <hr>
                <p>Subscribe To Our Weekly Newsletter Of Tailored Expert Advice, Tips And Giveaways - Straight To Your Inbox</p>
                <div class="sub---form">
                    <?php echo do_shortcode('[mc-subscribe-form]'); ?>
                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}

add_shortcode('display_subscribe', 'display_subscribe');

function product_widget($atts)
{
    ob_start();
    extract(
        shortcode_atts(
            array(
                'id' => '',
            ),
            $atts
        )
    );
    $products = get_field('products', $id);
    if ($products) {
        echo '<div class="product-widget--holder">';
        echo '<h2>' . get_the_title($id) . '</h2>';
        echo '<div class="product-widget--outer" id="product--widget-' . rand() . '">';
        echo '<div class="product-widget--inner">';
        foreach ($products as $product) {
            $product_obj = wc_get_product($product);
            if ($product_obj->is_type('external')) {
                // This is an external product, so we can get the link
                $url = $product_obj->get_product_url();
                $button_text = $product_obj->get_button_text();
            } else {
                $url = get_the_permalink($product);
                $button_text = 'Visit Product';
            }

            $_external_product_currency = get_post_meta($product, '_external_product_currency', true);

            if ($_external_product_currency) {
                $price = '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">' . $_external_product_currency . '</span>' . $product_obj->get_regular_price() . ' </bdi></span>';
            } else {
                $price = $product_obj->get_price_html();
            }

            echo '<div class="product-widget--box">'; //product-widget--box

            echo '<div class="product-widget--image"><a href="' . $url . '"> ' . $product_obj->get_image() . '</a></div>';

            echo '<div class="product-widget--content">';
            echo '<div class="product-price">' . $price . '</div>';
            echo '<h3>' . $product_obj->get_name() . '</h3>';
            echo '<div><a href="' . $url . '"> ' . $button_text . ' </a></div>';
            echo '</div>';

            echo '</div>'; //product-widget--box
        }
        echo '</div>';
        echo '<div class="swiper-pagination"></div> ';
        echo '</div>';
        echo '</div>';
    }
?>

    <script>
        jQuery(document).ready(function() {
            jQuery('.product-widget--holder').each(function(index, element) {
                $id = jQuery(this).find('.product-widget--outer').attr('id');
                $count = jQuery(this).find('.product-widget--box').length;
                jQuery(this).find('.product-widget--outer').addClass('swiper swiper--product-widget');
                jQuery(this).find('.product-widget--inner').addClass('swiper-wrapper');
                jQuery(this).find('.product-widget--box').addClass('swiper-slide');
                var swiper_product_widget = new Swiper('#' + $id, {
                    loop: true,
                    spaceBetween: 20,
                    autoplay: false,
                    breakpoints: {
                        0: {
                            slidesPerView: 2,
                        },

                        768: {
                            slidesPerView: 3,
                        },


                        992: {
                            slidesPerView: 4,
                        },
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                });

            });
        });
    </script>
<?php
    return ob_get_clean();
}

add_shortcode('product_widget', 'product_widget');

/**
 * Add a new custom field to the General product data tab for External products.
 * This function hooks into `woocommerce_product_options_general_product_data`.
 */
function add_custom_external_product_field()
{

    // Define the custom field using the `woocommerce_wp_text_input()` function.
    // The field has been renamed to "Currency".
    woocommerce_wp_text_input(array(
        'id'          => '_external_product_currency',
        'label'       => 'Currency (Default is $)',
        'placeholder' => 'Enter currency (e.g., $, £)',
        'desc_tip'    => 'true',
        'description' => 'The currency for the external product.',
    ));
}
add_action('woocommerce_product_options_general_product_data', 'add_custom_external_product_field');


/**
 * Save the data from the custom field.
 * This function hooks into `woocommerce_process_product_meta_{product_type}`.
 * In this case, we're targeting 'external_product'.
 *
 * @param int $post_id The ID of the post (product) being saved.
 */
function save_custom_external_product_field($post_id)
{
    // Check if the custom field is present in the form submission.
    $custom_field_value = isset($_POST['_external_product_currency']) ? $_POST['_external_product_currency'] : '';

    // Sanitize the value before saving to prevent security issues.
    $sanitized_value = sanitize_text_field($custom_field_value);

    // Save the value using `update_post_meta()`.
    // The meta key has been updated to match the new field ID.
    update_post_meta($post_id, '_external_product_currency', $sanitized_value);
}
add_action('woocommerce_process_product_meta_external', 'save_custom_external_product_field');


function post_box($atts)
{
    ob_start();
    extract(
        shortcode_atts(
            array(
                'id' => '',
                'format' => 'default',
                'count' => '',
                'in_count' => ''
            ),
            $atts
        )
    );



    if ($format == 'video') {
        $icon_id = 47093;
    } else if ($format == 'podcast') {
        $icon_id = 47094;
    } else {
        $icon_id = false;
    }


?>
    <div class="post-box-blogs trb-column format-<?= $format ?>">
        <div class="post-image image-box">
            <span style="display: none; position: absolute; top: 0;left: 0;z-index: 2; background: #fff; padding: 10px"><?= $count ?> | <?= $in_count ?></span>
            <a href="<?= get_the_permalink($id) ?>">
                <?= get_the_post_thumbnail($id, 'large') ?>
                <?php if ($icon_id) { ?>
                    <span class="image-icon"><?= wp_get_attachment_image($icon_id, 'medium') ?></span>
                <?php } ?>
            </a>
        </div>
        <div class="post-details">
            <a href="<?= get_the_permalink($id) ?>">
                <h3 class="post-box-title"><?= get_the_title($id) ?></h3>
            </a>
            <div class="post-box-date">
                <?= get_the_date('j M Y', $id) ?>
            </div>
            <?php if ($format == 'podcast') { ?>
                <div class="button-box button-box-v2 button-bordered text-center">
                    <a href="<?= get_the_permalink($id) ?>">LISTEN NOW</a>
                </div>
            <?php } ?>
        </div>
    </div>
<?php
    return ob_get_clean();
}

add_shortcode('post_box', 'post_box');


function post_box_trending_video($atts)
{
    ob_start();
    extract(
        shortcode_atts(
            array(
                'id' => '',
            ),
            $atts
        )
    );
?>
    <div class="post-box-trending-video-holder mw-large trb-px">
        <div class="post-box-trending-video post-box-blogs">
            <div class="trb-row align-items-center">
                <div class="trb-column">
                    <div class="post-image-with-ribbon">
                        <div class="ribbon">
                            Trending Video
                        </div>
                        <div class="post-image image-box">
                            <a href="<?= get_the_permalink($id) ?>">
                                <?= get_the_post_thumbnail($id, 'large') ?>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="trb-column">
                    <div class="post-details">
                        <h2 class="post-box-title"><?= get_the_title($id) ?></h2>
                        <div class="post-box-excerpt">
                            <?= get_the_excerpt($id) ?>
                        </div>
                        <div class="post-box-date">
                            <?= get_the_date('j M Y', $id) ?>
                        </div>
                        <div class="button-group-box row">
                            <div class="button-box button-box-v2 button-accent col-auto">
                                <a href="<?= get_the_permalink($id) ?>">WATCH NOW</a>
                            </div>
                            <div class="button-box button-box-v2 button-bordered col-auto">
                                <a href="<?= get_the_permalink(22822) ?>">MORE VIDEOS</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}

add_shortcode('post_box_trending_video', 'post_box_trending_video');


function post_box_hero($atts)
{
    ob_start();
    extract(
        shortcode_atts(
            array(
                'id' => '',
            ),
            $atts
        )
    );
    $post_id = $id;
    $cat = get_top_level_term_by_post_id($post_id, 'category');
    $category_colour = get_field('category_colour', $cat) ? get_field('category_colour', $cat) : '#3B1527';
    $category_text_color = get_field('category_text_color', $cat) ? get_field('category_text_color', $cat) : '#FFDBD1';
?>
    <div class="post-hero-outer trb-px">
        <div class="post-hero" style="--bg-color: <?= $category_colour ?>; --text-color: <?= $category_text_color ?>">
            <div class="container-fluid g-0 p-0">
                <div class="row g-0 flex-column-reverse flex-lg-row">
                    <div class="col-lg-6 d-flex align-items-center">
                        <div class="post-hero-content">
                            <div class="post-title">
                                <a href="<?= get_the_permalink($post_id) ?>">
                                    <h1>
                                        <?= get_the_title($post_id) ?>
                                    </h1>
                                </a>
                            </div>
                            <?php if (get_the_excerpt($post_id)) { ?>
                                <div class="post-excerpt">
                                    <?= get_the_excerpt($post_id) ?>
                                </div>
                            <?php } ?>
                            <div class="author-date d-flex gap-3 align-items-center flex-wrap">
                                <?= do_shortcode("[author_bio_v2 avatar=0 id=$post_id]") ?>
                                <div class="dot"></div>
                                <div class="date">
                                    <?= get_the_date('', $post_id) ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <a href="<?= get_the_permalink($post_id) ?>">

                            <div class="post-image image-box h-100">
                                <?= get_the_post_thumbnail($post_id, 'large') ?>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $page_id = (int) get_the_ID();

    $widget_paths = [
        22659 => 'fertility-category-page.js',
        22620 => 'wellbeing-category-page-gallery.js',
        22702 => 'pregnancy-category-page-gallery.js',
        22749 => 'parenting-category-page-gallery.js',
    ];

    if (isset($widget_paths[$page_id])) {
        $rtn .= '<script async class="snapppt-widget" src="' .
            esc_url('https://app.addsauce.com/widgets/widget_loader/b5e9e572-93fb-ff48-5213-dbb8e74cc9ec/' . $widget_paths[$page_id]) .
            '"></script>';
    }

    return ob_get_clean();
}
add_shortcode('post_box_hero', 'post_box_hero');


function giveaway_list_swiper($attr)
{

    ob_start();
    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'giveaway-items',
        'numberposts' => 3, // Number of recent posts thumbnails to display
        'orderby' => 'date',
        'order' => 'desc',
        'post_status' => 'publish', // Show only the published posts,
        'has_password' => false,
        'meta_query' => array(
            array(
                'key' => 'select_competition_date', // Replace with your custom field key.
                'value' => date('Y-m-d'), // Today's date.
                'compare' => '>=', // Greater than or equal to today.
                'type' => 'DATE' // Important: Specify the meta_value type as DATE.
            )
        )
    ));
    $wp_unique_id = wp_unique_id();

    ?>

    <div class="giveaways-carousel trb-px ">
        <div class="giveaways-carousel-inner">
            <h2>Giveaways</h2>
            <div class="swiper swiper-post-slider-v2">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($recent_posts as $post) {
                        $select_competition_date = get_field("select_competition_date", $post['ID']);
                        $date = $select_competition_date;
                        $time = strtotime($date);
                        $displayformatB = date('j M Y', $time);
                        $categories = get_the_category($post['ID']);
                        $currentcat = $categories[0]->cat_ID;
                        $currentcatname = $categories[0]->cat_name;
                        $display_form_on_homepage = get_field('display_form_on_homepage', $post['ID']);

                    ?>

                        <div class="swiper-slide">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="giveaway-details">
                                        <div class="giveaway-details-inner">
                                            <h3><?= get_the_title($post['ID']) ?></h3>

                                            <?php if (isDatePast($displayformatB) != false) { ?>
                                                <?php if ($display_form_on_homepage) { ?>
                                                    <div class="giveaway-form-email">
                                                        <?= do_shortcode('[wpforms id="40566" title="false"]') ?>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="button-box button-box-v2 button-accent">
                                                        <a href="<?= get_the_permalink($post['ID']) ?>">Enter Now</a>
                                                    </div>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <div class="button-box button-box-v2 button-accent">
                                                    <a href="<?= get_the_permalink($post['ID']) ?>">Giveaway Closed</a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="post-image image-box">
                                        <a href="<?= get_the_permalink($post['ID']) ?>">
                                            <?= get_the_post_thumbnail($post['ID'], 'large') ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    wp_reset_query();
                    ?>
                </div>
                <?= swiper_navigation($wp_unique_id) ?>
            </div>
        </div>
    </div>

    <script>
        var swiper = new Swiper(".swiper-post-slider-v2", {
            slidesPerView: 1,

            navigation: {
                nextEl: ".swiper-button-next-<?= $wp_unique_id ?>",
                prevEl: ".swiper-button-prev-<?= $wp_unique_id ?>",
            },
        });
    </script>

<?php
    return ob_get_clean();
}
add_shortcode('giveaway_list_swiper', 'giveaway_list_swiper');

function _giveaway_list_old_function($attr)
{

    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'giveaway-items',
        'numberposts' => 3, // Number of recent posts thumbnails to display
        'orderby' => 'date',
        'order' => 'desc',
        'post_status' => 'publish', // Show only the published posts,
        'has_password' => false,
        'meta_query' => array(
            array(
                'key' => 'select_competition_date', // Replace with your custom field key.
                'value' => date('Y-m-d'), // Today's date.
                'compare' => '>=', // Greater than or equal to today.
                'type' => 'DATE' // Important: Specify the meta_value type as DATE.
            )
        )
    ));


    $rtn = "";

    $count = count($recent_posts);
    /*
    if ($count > 1) {
        $class = 'bg-cream';
    } else {
        $class = 'bg-white';
    }*/
    $class = 'bg-white';

    $rtn .= '<div class="expert-outer giveaways-homepage ' . $class . '"><h2>Giveaways</h2>';
    $rtn .= '<div class="blogs-loop-carousel-holder">';
    $rtn .= '<div class="blogs-loop-carousel-inner">';
    $rtn .= '<div class="blogs-loop blogs-loop-v2 blogs-loop-carousel">';
    /*
    if ($count > 1) {
        $rtn .= '<div class="blogs-loop-inner">';
    }*/
    foreach ($recent_posts as $post) :
        $select_competition_date = get_field("select_competition_date", $post['ID']);
        $date = $select_competition_date;
        $time = strtotime($date);
        $displayformatB = date('j M Y', $time);
        $categories = get_the_category($post['ID']);
        $currentcat = $categories[0]->cat_ID;
        $currentcatname = $categories[0]->cat_name;
        $cat_p = get_ancestors($categories[0]->term_id, 'category');
        $termIdVal = 'term_' . $currentcat;

        if (count($cat_p) > 0) {
            $termIdVal = 'term_' . $cat_p[0];
        }

        $bcolour = "#F77D66";

        if (!empty(get_field("category_colour", $termIdVal))) {
            $bcolour = get_field("category_colour", $termIdVal);
        }

        $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
        if (!has_post_thumbnail($post['ID'])) {
            $style = 'style="background:url(';
            $iUrl = get_field("post_large_image", $post['ID']);
            $style .= $iUrl;
            $style .= '); background-size:cover; background-position:center;  ' . $addBorder . '"';
        } else {
            $style = 'style="background:url(';
            $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], 'full'));
            $style .= $iUrl;
            $style .= '); background-size:cover; background-position:center;  ' . $addBorder . '"';
        }

        $post_args = array(
            'post_id' => $post['ID'],
            'post_title' => get_the_title($post['ID']),
            'post_permalink' => get_the_permalink($post['ID']),
            'date' => $displayformatB,
            'style' => $style,
            'addBorder' => $addBorder,
            'currentcatname' => $currentcatname,
        );
        /*
        if ($count > 1) {
            $rtn .= blog_post_style_1($post_args);
        } else {
            $rtn .= blog_post_style_2($post_args);
        }*/

        $rtn .= blog_post_style_2($post_args);

    endforeach;
    /*
    if ($count > 1) {
        $rtn .= '</div>';
    }*/
    $rtn .= '</div>';
    $rtn .= '</div>';
    $rtn .= '</div>';

    wp_reset_query();


    $rtn .= '</div>';
    $rtn .= "<script type='text/javascript'>
    $(document).ready(function () {
        if ($('.blogs-loop-carousel').length > 0) {
            $('.blogs-loop-carousel').slick({
                centerMode: true,
                centerPadding: '0px',
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 5000,
            });
        }
    });
</script>";

    return $rtn;
}
add_shortcode('_giveaway_list_old', '_giveaway_list_old_function');




function _giveaway_list_function($attr)
{

    if (current_user_can('administrator')) {
        return do_shortcode('[giveaway_list_swiper]');
    } else {
        return do_shortcode('[_giveaway_list_old]');
    }
}
add_shortcode('_giveaway_list', '_giveaway_list_function');

function swiper_navigation($class)
{
    return '<div class="swiper-navigation"> <div class="swiper-button-prev-' . $class . '"><svg xmlns="http://www.w3.org/2000/svg" id="Component_3_1" data-name="Component 3 – 1" width="53" height="53" viewBox="0 0 53 53"> <g id="Group_42" data-name="Group 42" transform="translate(924 4312) rotate(180)"> <g id="Ellipse_2" data-name="Ellipse 2" transform="translate(871 4259)" fill="none" stroke="currentColor" stroke-width="1"> <circle cx="26.5" cy="26.5" r="26.5" stroke="none" /> <circle cx="26.5" cy="26.5" r="26" fill="none" /> </g> <path id="Path_28" data-name="Path 28" d="M4756.17,1529.5l12.3,12.3-12.3,12.3" transform="translate(-3862.67 2743.696)" fill="currentColor" /> </g> </svg> </div> <div class="swiper-button-next-' . $class . '"><svg xmlns="http://www.w3.org/2000/svg" width="53" height="53" viewBox="0 0 53 53"> <g id="Group_41" data-name="Group 41" transform="translate(-871 -4259)"> <g id="Ellipse_2" data-name="Ellipse 2" transform="translate(871 4259)" fill="none" stroke="currentColor" stroke-width="1"> <circle cx="26.5" cy="26.5" r="26.5" stroke="none" /> <circle cx="26.5" cy="26.5" r="26" fill="none" /> </g> <path id="Path_28" data-name="Path 28" d="M4756.17,1529.5l12.3,12.3-12.3,12.3" transform="translate(-3862.67 2743.696)" fill="currentColor" /> </g> </svg> </div> </div>';
}

function become_insider()
{
    ob_start();
?>
    <div class="become-insider">
        <div class="become-insider-inner trb-px mw-large">
            <div class="row g-3 g-lg-5 justify-content-between align-items-center">
                <div class="col-auto">
                    <div class="row g-3 g-lg-5 justify-content-between align-items-center">
                        <div class="col-auto">
                            <h3>Become an <i>Insider</i></h3>

                        </div>
                        <div class="col-auto">
                            <p>
                                Our weekly newsletter of tailored expert advice, tips and giveaways - straight to your inbox.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="button-box button-box-v2 button-bordered col-auto">
                        <a href="#" class="newsletter-trigger">SIGN ME UP</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('become_insider', 'become_insider');


function careers()
{
    ob_start();

    // 1. Query the 'career' post type
    $args = array(
        'post_type'      => 'career',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) : ?>



        <div class="careers-wrapper">
            <?php while ($query->have_posts()) : $query->the_post();
                $post_id = get_the_ID();

                // --- UPDATED: FETCH META KEYS ---
                // details_1 = details_1 status
                // details_2 = Type (Full-time)
                // details_3 = Location
                $details_1   = get_field('details_1', $post_id);
                $details_2   = get_field('details_2', $post_id);
                $details_3   = get_field('details_3', $post_id);
            ?>

                <div class="career-row py-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#careerOffcanvas"
                    data-id="<?php echo $post_id; ?>">

                    <div class="col-auto">
                        <h3 class="career-title h3 mb-0"><?php the_title(); ?></h3>
                    </div>

                    <div class="col-auto d-flex justify-content-md-end align-items-center">
                        <div class="career-meta text-uppercase d-flex align-items-center flex-wrap justify-content-md-end">
                            <?php if ($details_1): ?><span class="meta-item"><?php echo esc_html($details_1); ?></span><?php endif; ?>
                            <?php if ($details_2): ?><span class="meta-item"><?php echo esc_html($details_2); ?></span><?php endif; ?>
                            <?php if ($details_3): ?><span class="meta-item"><?php echo esc_html($details_3); ?></span><?php endif; ?>
                        </div>

                        <span class="career-arrow fs-4 text-dark ms-4 d-none d-md-block">
                            <img src="https://theribbonbox.com/wp-content/uploads/2026/01/Group-41.png">
                        </span>
                    </div>
                </div>

                <hr class="career-divider">

                <div id="career-content-<?php echo $post_id; ?>" class="d-none">
                    <div class="job-description-wrapper p-3">

                        <h3 class="career-title mb-2"><?php the_title(); ?></h3>

                        <div class="career-meta text-uppercase d-flex align-items-center flex-wrap ">
                            <?php if ($details_1): ?><span class="meta-item"><?php echo esc_html($details_1); ?></span><?php endif; ?>
                            <?php if ($details_2): ?><span class="meta-item"><?php echo esc_html($details_2); ?></span><?php endif; ?>
                            <?php if ($details_3): ?><span class="meta-item"><?php echo esc_html($details_3); ?></span><?php endif; ?>
                        </div>
                        <div class="job-body">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>

            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>



    <?php else : ?>
        <p>No open positions found.</p>
    <?php endif;

    return ob_get_clean();
}
add_shortcode('careers', 'careers');

function careers_form()
{
    ?>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="careerOffcanvas" aria-labelledby="careerOffcanvasLabel">
        <div class="offcanvas-header">
            <h2>Apply for this role</h2>
            <button type="button" class="btn--close text-white" data-bs-dismiss="offcanvas" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                </svg>
            </button>
        </div>
        <div class="offcanvas-body" id="careerOffcanvasBody">
            <div class="d-flex justify-content-center align-items-center offcanvas-body-content">
                <div class="spinner-border text-secondary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <?= do_shortcode('[wpforms id="47389" title="false"]') ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var careerOffcanvas = document.getElementById('careerOffcanvas');
            if (careerOffcanvas) {
                careerOffcanvas.addEventListener('show.bs.offcanvas', function(event) {
                    // Button that triggered the offcanvas
                    var button = event.relatedTarget;
                    // Extract info from data-id
                    var postId = button.getAttribute('data-id');
                    // Find the hidden content div
                    var contentSource = document.getElementById('career-content-' + postId);
                    var modalBody = careerOffcanvas.querySelector('.offcanvas-body-content');

                    if (contentSource) {
                        modalBody.innerHTML = contentSource.innerHTML;
                    } else {
                        modalBody.innerHTML = 'Content not found.';
                    }
                });
            }
        });
    </script>

<?php
}
add_action('wp_footer', 'careers_form');
