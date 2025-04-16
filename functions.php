<?php
//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);

function action_after_theme_setup()
{
    global $theme_option_page;
    $theme_option_page = 39610;
}
add_action('after_setup_theme', 'action_after_theme_setup');

include 'functions/core.php';
include 'functions/custom-shortcodes.php';
include 'functions/menus.php';
include 'functions/blog.php';
include 'functions/lazyload.php';
include 'functions/next-prev-links.php';
include 'functions/home.php';
include 'functions/hide-shippen-when-free.php';
include 'functions/load_cate_posts.php';
include 'functions/widgets.php';
include 'functions/commerce.php';
include 'functions/sitemap.php';
include 'functions/pw.php';
include 'functions/products.php';
include 'functions/custom-post-types.php';
include 'functions/custom-taxonomies.php';
include 'functions/forms.php';
include 'functions/unique-pages.php';
include 'functions/b2b-content.php';
include 'functions/landing-page-header.php';
include 'functions/e-guides.php';
include 'functions/b2b-discounts.php';
//include 'functions/experts-slide.php';
include 'shortcodes/member-login-button.php';

add_action('wp_enqueue_scripts', 'load_scripts');
function load_scripts()
{
    wp_enqueue_script('jquery');

    wp_enqueue_script('splide_script', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js');
    wp_enqueue_script('splide_init', get_stylesheet_directory_uri() . '/js/splide.js');


    if (is_community_page()) {
        wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
        wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
        wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css');
    }
    wp_enqueue_script('additional', get_stylesheet_directory_uri() . '/includes/_additional.js');
    wp_enqueue_style('additional', get_stylesheet_directory_uri() . '/includes/_additional.css');
}

add_action('wp_head', 'load_styles', 99);
function load_styles()
{
    wp_enqueue_style('material_icons', 'https://fonts.googleapis.com/icon?family=Material+Icons');
}


//include 'functions/search.php';
//include 'functions/ARCHIVED.php';

function is_b2b_page(): bool
{
    global $wp;
    $b2b_pages = ['b2b', 'b2b-home'];
    return in_array($wp->request, $b2b_pages);
}

function is_b2b_user(): bool
{
    // return false;
    $user = wp_get_current_user();
    return user_get_partner($user) ? true : false;
}
//var_dump(is_b2b_user());

function user_get_partner($user)
{

    $b2b_partners = get_posts(array(
        'posts_per_page' => -1,
        'post_type' => 'b2b_partner'
    ));

    $current_user_email = $user->user_email;

    $current_user_email_ending = substr($current_user_email, strpos($current_user_email, "@"));

    foreach ($b2b_partners as $partner) {
        $email_ending = get_field('email_ending', $partner->ID);

        if ($email_ending === $current_user_email_ending) {
            return $partner;
        }
    }

    return null;
}

add_filter('login_redirect', 'redirect_b2b_users', 10, 3);

function redirect_b2b_users()
{
    global $user;
    //$is_b2b_user = is_b2b_user();
    if (user_get_partner($user)) {
        $is_b2b_user = true;
    } else {
        $is_b2b_user = false;
    }

    $prev_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

    $request_url = 'https://theribbonbox.com/b2b-home';
    $default_url = home_url();

    if (($prev_url == 'https://theribbonbox.com/customer-login') && $is_b2b_user) {
        $redirect_to = $request_url;
    } else {
        $redirect_to = $default_url;
    }

    return $redirect_to;
}


//redirect non-b2b users if they navigate to B2B home page
add_action('template_redirect', 'non_b2b_redirect');

function non_b2b_redirect()
{
    global $wp;

    if ($wp->request === 'b2b-home' && !is_b2b_user()) {
        wp_redirect(site_url('customer-login'));
        exit;
    }
}

add_action('init', 'add_b2b_user_role');

function add_b2b_user_role()
{
    add_role(
        'b2b_user',
        'B2B User',
        array(
            'read' => false,
            'edit_posts' => false,
            'delete_posts' => false,
            'publish_posts' => false,
            'upload_files' => false,
        )
    );
}

// add_action('init', 'restrict_dashboard_access');

// function restrict_dashboard_access() {
//     $user = wp_get_current_user();
//     if (in_array( 'b2b_user', (array) $user->roles )) {
//         wp_redirect(site_url());
//     }
// }

add_filter('show_admin_bar', 'hide_admin_bar_for_b2b_users');
function hide_admin_bar_for_b2b_users($show_admin_bar)
{
    $user = wp_get_current_user();
    if (in_array('b2b_user', (array) $user->roles)) {
        return false;
    }
    return $show_admin_bar;
}

add_action('wp_login_failed', 'custom_login_fail');

function custom_login_fail($username)
{
    $referrer = $_SERVER['HTTP_REFERER'];  // where the post submission came from
    if (!empty($referrer) && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin')) {
        wp_redirect($referrer . '?login=failed');
        exit;
    }
}

// function get_b2b_organization() {
//     $user = wp_get_current_user();
//     $current_user_email = $user->user_email;
//     $current_user_email_ending = substr($current_user_email, strpos($current_user_email, "@"));

//     $b2b_partners = get_posts(array(
//         'posts_per_page' => -1,
//         'post_type' => 'b2b_partner'
//     ));

//     foreach($b2b_partners as $partner) {
//         $email_ending = get_field('email_ending', $partner->ID);
//         if($current_user_email_ending == $email_ending);

//     }

// }

//get_b2b_organization();

add_action('wp_logout', 'redirect_after_logout');
function redirect_after_logout()
{
    wp_safe_redirect(home_url());
    exit;
}

function action_wp_header()
{
    $post_type = get_post_type();

    if ($post_type == 'events') {
        $link =  get_field('website_link', get_the_ID());
        if ($link) {
            wp_redirect($link);
            exit;
        }
    }
}

add_action('wp_head', 'action_wp_header');

function match_expert_form()
{
    ob_start();
?>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="experts-page-head" id="">
        <h2>Take Our Quiz</h2>
    </div>
    <div class="quiz-outer-out" id="quiz-outer-out">
        <div class="quiz-bg"></div>
        <div class="quiz-outer">
            <div class="quiz-inner">
                <div class="quiz-inner-in-out-out">
                    <div class="quiz-inner-in-out">
                        <div class="quiz-inner-in">
                            <div class="match-expert-form">
                                <h3>What do you need help with?</h3>
                                <div class="form-box">
                                    <div class="input-box">
                                        <input type="radio" name="help-type" id="IMPROVED-WELLBEING" value="IMPROVED WELLBEING"> <label for="IMPROVED-WELLBEING">IMPROVED WELLBEING</label>
                                    </div>
                                    <div class="input-box">
                                        <input type="radio" name="help-type" id="GUIDANCE-THROUGHOUT-PREGNANCY" value="GUIDANCE THROUGHOUT PREGNANCY"> <label for="GUIDANCE-THROUGHOUT-PREGNANCY">GUIDANCE THROUGHOUT PREGNANCY</label>
                                    </div>
                                    <div class="input-box">
                                        <input type="radio" name="help-type" id="FERTILITY-SUPPORT" value="FERTILITY SUPPORT"> <label for="FERTILITY-SUPPORT">FERTILITY SUPPORT</label>
                                    </div>
                                    <div class="input-box">
                                        <input type="radio" name="help-type" id="PARENTING-ADVICE" value="PARENTING ADVICE"> <label for="PARENTING-ADVICE">PARENTING ADVICE</label>
                                    </div>
                                </div>
                                <div class="active-form">
                                    <div form="PARENTING ADVICE" class="form-holder form-holder-7-page">
                                        <?= do_shortcode('[wpforms id="38623"]') ?>
                                    </div>
                                    <div form="FERTILITY SUPPORT" class="form-holder form-holder-8-page">
                                        <?= do_shortcode('[wpforms id="38618"]') ?>
                                    </div>
                                    <div form="GUIDANCE THROUGHOUT PREGNANCY" class="form-holder form-holder-7-page">
                                        <?= do_shortcode('[wpforms id="38612"]') ?>
                                    </div>
                                    <div form="IMPROVED WELLBEING" class="form-holder form-holder-7-page">
                                        <?= do_shortcode('[wpforms id="38597"]') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        jQuery(document).ready(function() {
            jQuery('input[name="help-type"]').change(function() {
                selected = $("input[name='help-type']:checked").val();
                jQuery('.match-expert-form').addClass('active').find('h3').text(selected);
                jQuery('.form-holder[form="' + selected + '"]').addClass('active');

            });
        });
    </script>

    <?php
    return ob_get_clean();
}

add_shortcode('match_expert_form', 'match_expert_form');


function is_community_page()
{
    if (get_post_type() == 'community-post' || is_bbpress() || is_buddypress() || get_page_template_slug() == 'page-template-e-guides.php' || get_page_template_slug() == 'page-template-community.php' || get_page_template_slug() == 'page-template-latest-conversations.php' || get_page_template_slug() == 'page-community-header-footer.php') {
        return true;
    } else {
        return false;
    }
}
add_filter('body_class', 'custom_class');
function custom_class($classes)
{
    if (is_community_page()) {
        $classes[] = 'is-community-page';
    }
    return $classes;
}
/*-----------------------------------------------------------------------------------*/
/* Require Files
/*-----------------------------------------------------------------------------------*/
require_once('includes/guides.php');
require_once('includes/shortcodes.php');
require_once('includes/forum.php');
require_once('includes/updated_functions.php');

function action_admin_head()
{
    if (isset($_GET['post']) && $_GET['post'] == 39610) {
    ?>
        <style>
            .misc-pub-post-status,
            .post-type-switcher,
            .misc-pub-curtime,
            .rank-math-seo-score,
            .rank-math-lock-modified-date,
            #screen-meta-links,
            #export-action,
            #minor-publishing-actions,
            #acf-group_67d2631c29e16,
            #postexcerpt,
            #bialty_post_options,
            #visibility,
            #delete-action,
            #delete-action,
            #titlediv,
            #postdivrich,
            #rank_math_metabox,
            #rank_math_metabox_content_ai,
            #pageparentdiv,
            #sheknows-infuse_metabox,
            #cmplz_hide_banner_meta_box,
            #rank_math_metabox_link_suggestions,
            #postimagediv,
            .composer-switch.composer-switch {
                display: none !important;
            }
        </style>
    <?php
    }
}

add_action('admin_head', 'action_admin_head');

add_action('admin_menu', 'theme_options');

function theme_options()
{
    add_menu_page('theme_options', 'Theme Options', 'read', 'theme_options', '', 'dashicons-admin-generic', 1);
}

add_action('admin_menu', 'theme_options_function');
function theme_options_function()
{
    global $menu;
    $menu[1][2] = "https://theribbonbox.com/wp-admin/post.php?post=39610&action=edit";
}


/**
 * Function to get a list of images in the media library without alt text.
 *
 * @return array An array of image attachment IDs without alt text.
 */
function get_images_without_alt_text()
{
    ob_start();
    $images_without_alt = array();

    // Query for all image attachments.
    $args = array(
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'posts_per_page' => -1, // Get all images.
    );

    $attachments = get_posts($args);

    if ($attachments) {
        foreach ($attachments as $attachment) {
            // Get the alt text for the current image.
            $alt_text = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);

            // If the alt text is empty, add the image ID to the array.
            if (empty($alt_text)) {
                $images_without_alt[] = $attachment->ID;
            }
        }
    }
    echo '<pre>';
    if (!empty($images_without_alt)) {
        foreach ($images_without_alt as $image_id) {
            $url = get_edit_post_link($image_id);
            echo "<a href='$url'>$image_id</a>";
            echo '<br>';
        }
    } else {
        echo 'No images without alt text';
    }
    echo '</pre>';
    echo '<br>';
    return ob_get_clean();
}

add_shortcode('get_images_without_alt_text', 'get_images_without_alt_text');


function bulk_update_image_alt_text_extended()
{
    if (!current_user_can('upload_files')) {
        wp_die(__('You do not have permission to access this page.'));
    }

    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Bulk Update Image Alt Text (Extended)', 'bulk-alt-text-extended'); ?></h1>
        <p><?php esc_html_e('This tool will find all images in your media library that do not have alt text and automatically set it based on the following priority:', 'bulk-alt-text-extended'); ?></p>
        <ol>
            <li><?php esc_html_e('Caption (if it exists).', 'bulk-alt-text-extended'); ?></li>
            <li><?php esc_html_e('Description (if caption is empty and description exists).', 'bulk-alt-text-extended'); ?></li>
            <li><?php esc_html_e('Filename (if both caption and description are empty).', 'bulk-alt-text-extended'); ?></li>
        </ol>
        <form method="post">
            <?php wp_nonce_field('bulk_alt_text_extended_action', 'bulk_alt_text_extended_nonce'); ?>
            <p class="submit">
                <input type="submit" name="bulk_update_alt_extended" class="button button-primary" value="<?php esc_attr_e('Bulk Update Alt Text', 'bulk-alt-text-extended'); ?>">
            </p>
        </form>

        <?php
        if (isset($_POST['bulk_update_alt_extended']) && check_admin_referer('bulk_alt_text_extended_action', 'bulk_alt_text_extended_nonce')) {
            $args = array(
                'post_type' => 'attachment',
                'post_mime_type' => 'image/*',
                'posts_per_page' => -1,
            );

            $images = get_posts($args);
            $updated_count = 0;

            if ($images) {
                foreach ($images as $image) {
                    $attachment_id = $image->ID;
                    $alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);

                    if (empty($alt_text)) {
                        $caption = $image->post_excerpt;
                        $description = $image->post_content;
                        $new_alt_text = '';

                        $filename_with_ext = basename(get_attached_file($attachment_id));
                        $filename_without_ext = pathinfo($filename_with_ext, PATHINFO_FILENAME);
                        $file_name = sanitize_text_field($filename_without_ext);

                        if (!empty($caption)) {
                            $new_alt_text = sanitize_text_field($caption);
                        } elseif (!empty($description)) {
                            $new_alt_text = sanitize_text_field($description);
                        } else {
                            $new_alt_text = $file_name;
                        }
                        if (!$new_alt_text) {
                            $new_alt_text = $file_name;
                        }

                        if (!empty($new_alt_text) && update_post_meta($attachment_id, '_wp_attachment_image_alt', $new_alt_text)) {
                            $updated_count++;
                        }
                    }
                }

                if ($updated_count > 0) {
                    echo '<div class="notice notice-success is-dismissible"><p>' . sprintf(esc_html__('%d images updated with alt text.', 'bulk-alt-text-extended'), $updated_count) . '</p></div>';
                } else {
                    echo '<div class="notice notice-info is-dismissible"><p>' . esc_html__('No images found without alt text.', 'bulk-alt-text-extended') . '</p></div>';
                }
            } else {
                echo '<div class="notice notice-warning is-dismissible"><p>' . esc_html__('No images found in the media library.', 'bulk-alt-text-extended') . '</p></div>';
            }
        }
        ?>
    </div>
<?php
}

function bulk_alt_text_extended_menu()
{
    add_media_page(
        __('Bulk Update Alt Text (Extended)', 'bulk-alt-text-extended'),
        __('Bulk Update Alt Text (Extended)', 'bulk-alt-text-extended'),
        'upload_files',
        'bulk-update-alt-text-extended',
        'bulk_update_image_alt_text_extended'
    );
}
add_action('admin_menu', 'bulk_alt_text_extended_menu');

class Walker_Nav_Pointers extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
        $output .= "\n$indent<li class=\"submenu-wrapper\">\n";
        $output .= "\n$indent<ul class=\"menu-items-holder\">\n";
    }
    function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
        $output .= "$indent</li>\n";
        $output .= "$indent</ul>\n";
    }
}

function add_image_to_menu_item($item_output, $item, $depth, $args)
{
    // Check if it's the menu you want to modify (optional, for specific menus)
    // if ( $args->theme_location == 'primary' ) { // Change 'primary' to your menu's location
    // Add this check if you only want to apply this to a specific menu.
    // Get the image URL from a custom field.  You'll need to add a custom field
    // to your menu items in the WordPress admin.  I'm using 'menu_image' here,
    // but you can use any name you like.
    $image_url = get_field('menu_image', $item->ID); // Use ACF or similar
    $icon = get_field('icon', $item->object_id);
    if ($image_url) {
        //  Important: Adjust the image size and styling as needed.  This example
        //  uses a small inline style.  For more complex styling, use CSS in your
        //  theme's stylesheet.  Consider adding a class to the image.
        $image = '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($item->title) . '" style="width:20px; height:20px; vertical-align:middle; margin-right:5px;" />';
        $item_output = str_replace(
            $args->link_before . $item->title . $args->link_after,
            $args->link_before . $image . $item->title . $args->link_after,
            $item_output
        );
    }
    // } // End check for specific menu.  Remove this if you want it on all menus.
    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'add_image_to_menu_item', 10, 4);
