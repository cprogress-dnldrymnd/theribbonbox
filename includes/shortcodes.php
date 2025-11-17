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

function author_bio_v2()
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
        <div class="author-bio author-bio-v2">
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