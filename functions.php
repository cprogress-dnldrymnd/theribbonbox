<?php
//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);

function action_after_theme_setup()
{
    global $theme_option_page, $icons;
    $theme_option_page = 39610;
    $icons['facebook'] = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16"> <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" /> </svg>';
    $icons['pinterest'] = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pinterest" viewBox="0 0 16 16"> <path d="M8 0a8 8 0 0 0-2.915 15.452c-.07-.633-.134-1.606.027-2.297.146-.625.938-3.977.938-3.977s-.239-.479-.239-1.187c0-1.113.645-1.943 1.448-1.943.682 0 1.012.512 1.012 1.127 0 .686-.437 1.712-.663 2.663-.188.796.4 1.446 1.185 1.446 1.422 0 2.515-1.5 2.515-3.664 0-1.915-1.377-3.254-3.342-3.254-2.276 0-3.612 1.707-3.612 3.471 0 .688.265 1.425.595 1.826a.24.24 0 0 1 .056.23c-.061.252-.196.796-.222.907-.035.146-.116.177-.268.107-1-.465-1.624-1.926-1.624-3.1 0-2.523 1.834-4.84 5.286-4.84 2.775 0 4.932 1.977 4.932 4.62 0 2.757-1.739 4.976-4.151 4.976-.811 0-1.573-.421-1.834-.919l-.498 1.902c-.181.695-.669 1.566-.995 2.097A8 8 0 1 0 8 0" /> </svg>';
    $icons['linkedin'] = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16"> <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" /> </svg>';
    $icons['x'] = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16"> <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" /> </svg>';
    $icons['youtube'] = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16"> <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z" /> </svg>';
    $icons['whatsapp'] = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16"> <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/> </svg>';
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
        wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js');
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
    $image_url = get_field('icon', $item->object_id);
    if ($image_url) {
        //  Important: Adjust the image size and styling as needed.  This example
        //  uses a small inline style.  For more complex styling, use CSS in your
        //  theme's stylesheet.  Consider adding a class to the image.
        $image = '<img src="' . esc_url($image_url['url']) . '" alt="' . esc_attr($item->title) . '" style="width:20px; height:20px; vertical-align:middle; margin-right:5px;" />';
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
