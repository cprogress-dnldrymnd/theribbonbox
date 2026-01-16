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
            <span style="position: absolute; top: 0;left: 0;z-index: 2; background: #fff; padding: 10px"><?= $count ?> | <?= $in_count ?></span>
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
    <div class="post-box-trending-video-holder mw-1500 trb-px">
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


function _giveaway_list_function($attr)
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

?>

    <div class="giveaways-carousel">
        <div class="swiper swiper-post-slider-v2">
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

                <div class="swiper-slider">
                    <div class="row g-0">
                        <div class="col-lg-g">
                            <h2><?= get_the_title($post['ID']) ?></h2>

                            <?php if (isDatePast($select_competition_date) != false) { ?>
                                <?php if ($display_form_on_homepage) { ?>
                                    <div class="giveaway-form-email">
                                        <?= do_shortcode('[wpforms id="40566" title="false"]') ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="button-box button-box-v2 button-accent">

                                    </div>
                                    <a
                                        href="<?= get_the_permalink($post['ID']) ?>">Enter Now</a>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="button-box button-box-v2 button-accent">
                                    <a
                                        href="<?= get_the_permalink($post['ID']) ?>">Giveaway Closed</a>
                                </div>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            wp_reset_query();
            ?>
        </div>
    </div>

<?php
    return ob_get_clean();
}
add_shortcode('_giveaway_list', '_giveaway_list_function');
