<?php
//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);

function action_after_theme_setup()
{
    global $theme_option_page, $theme_icons, $theme_logo;
    $theme_option_page = 39610;
    $theme_logo = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="134.712" height="68.251" viewBox="0 0 134.712 68.251"> <defs> <clipPath id="clip-path"> <rect id="Rectangle_9" data-name="Rectangle 9" width="134.712" height="68.251"/> </clipPath> </defs> <g id="Group_9" data-name="Group 9" transform="translate(0 0)"> <g id="Group_8" data-name="Group 8" transform="translate(0 0)" clip-path="url(#clip-path)"> <path id="Path_6" data-name="Path 6" d="M7.342,45.71H6.154V54.9H2.659V33.234H7.2c4.893,0,8.108,2.306,8.108,6.116a5.3,5.3,0,0,1-3.7,5.067c2.866,1.083,4.753,7.758,8.807,7.758l-.7,2.936c-6.92,0-7.164-9.4-12.372-9.4m.21-9.75h-1.4v7.059h1.5c2.481,0,4.194-1.294,4.194-3.6,0-2.2-1.782-3.459-4.3-3.459" transform="translate(-1.191 -14.885)"/> <path id="Path_7" data-name="Path 7" d="M76.659,54.929H71.522V33.3h4.264c5,0,8.387,1.572,8.387,5.452A3.966,3.966,0,0,1,81.1,42.8c3.075.489,4.962,2.271,4.962,5.731,0,4.683-3.6,6.4-9.4,6.4M76.17,35.988H75.017v5.7h1.4c3.285,0,4.229-1.083,4.229-2.761.035-2.062-1.328-2.936-4.473-2.936m1.4,8.422H75.017v7.653h2.551c3.984,0,4.823-1.573,4.928-3.7,0-1.887-.874-3.949-4.928-3.949" transform="translate(-32.034 -14.914)"/> <path id="Path_8" data-name="Path 8" d="M118.811,54.929h-5.137V33.3h4.264c5,0,8.387,1.572,8.387,5.452A3.966,3.966,0,0,1,123.25,42.8c3.075.489,4.963,2.271,4.963,5.731,0,4.683-3.6,6.4-9.4,6.4m-.489-18.941h-1.153v5.7h1.4c3.285,0,4.229-1.083,4.229-2.761.035-2.062-1.328-2.936-4.473-2.936m1.4,8.422h-2.551v7.653h2.551c3.984,0,4.823-1.573,4.928-3.7,0-1.887-.874-3.949-4.928-3.949" transform="translate(-50.914 -14.914)"/> <path id="Path_9" data-name="Path 9" d="M165.111,54.926c-6.221,0-11.182-4.055-11.182-11.149,0-7.059,4.961-11.113,11.182-11.113S176.3,36.718,176.3,43.812c0,7.059-4.963,11.114-11.184,11.114m0-19.361c-4.158,0-7.583,3.04-7.583,8.213,0,5.278,3.425,8.213,7.583,8.213s7.584-2.936,7.584-8.178c0-5.207-3.425-8.247-7.584-8.247" transform="translate(-68.944 -14.63)"/> <path id="Path_10" data-name="Path 10" d="M213.754,39.84V54.448h-3.5V32.222h.489l14.643,15.132V32.781h3.494V54.9H228.4Z" transform="translate(-94.174 -14.432)"/> <path id="Path_11" data-name="Path 11" d="M7.8,105.564H2.659V83.932H6.923c5,0,8.387,1.572,8.387,5.452a3.966,3.966,0,0,1-3.075,4.054c3.075.489,4.962,2.271,4.962,5.731,0,4.683-3.6,6.4-9.4,6.4M7.307,86.623H6.154v5.7h1.4c3.285,0,4.229-1.083,4.229-2.761.035-2.062-1.328-2.936-4.473-2.936m1.4,8.422H6.154V102.7H8.705c3.984,0,4.823-1.573,4.928-3.7,0-1.887-.874-3.949-4.928-3.949" transform="translate(-1.191 -37.593)"/> <path id="Path_12" data-name="Path 12" d="M54.1,105.56c-6.221,0-11.183-4.054-11.183-11.148,0-7.059,4.962-11.113,11.183-11.113s11.183,4.054,11.183,11.148c0,7.059-4.962,11.113-11.183,11.113m0-19.361c-4.158,0-7.583,3.04-7.583,8.213,0,5.278,3.425,8.213,7.583,8.213s7.583-2.936,7.583-8.178c0-5.207-3.424-8.247-7.583-8.247" transform="translate(-19.22 -37.309)"/> <path id="Path_13" data-name="Path 13" d="M97.3,105.536H93.421l7.933-12.686-5.7-8.982h4.019l3.53,6.326,3.53-6.326h4.019l-5.661,8.982,7.9,12.686h-3.88l-5.905-10.169Z" transform="translate(-41.843 -37.564)"/> <path id="Path_14" data-name="Path 14" d="M141.863,120.176a2.048,2.048,0,0,1-2.237-2.062,2,2,0,0,1,2.237-2.027,2.051,2.051,0,0,1,2.306,2.062,2.082,2.082,0,0,1-2.306,2.027" transform="translate(-62.538 -51.995)"/> <path id="Path_15" data-name="Path 15" d="M4.717,1.362,2.708,10.83H.978L2.97,1.362H0L.612,0h7.2L7.529,1.362Z" transform="translate(0 0)"/> <path id="Path_16" data-name="Path 16" d="M24.528,10.83l1.118-5.275h-5.66L18.868,10.83H17.121L19.41,0h1.747l-.891,4.192h5.66L26.816,0h1.765L26.275,10.83Z" transform="translate(-7.669 0)"/> <path id="Path_17" data-name="Path 17" d="M46.163,1.362l-.611,2.9h3.371l-.279,1.362H45.255l-.8,3.826H50.3l-.612,1.38H42.408L44.7,0h6.166l-.3,1.362Z" transform="translate(-18.994 0)"/> <path id="Path_18" data-name="Path 18" d="M47.471,37.22V54.977h3.495V33.4Z" transform="translate(-21.262 -14.961)"/> </g> </g> </svg>';
    $theme_icons['facebook'] = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16"> <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" /> </svg>';
    $theme_icons['pinterest'] = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pinterest" viewBox="0 0 16 16"> <path d="M8 0a8 8 0 0 0-2.915 15.452c-.07-.633-.134-1.606.027-2.297.146-.625.938-3.977.938-3.977s-.239-.479-.239-1.187c0-1.113.645-1.943 1.448-1.943.682 0 1.012.512 1.012 1.127 0 .686-.437 1.712-.663 2.663-.188.796.4 1.446 1.185 1.446 1.422 0 2.515-1.5 2.515-3.664 0-1.915-1.377-3.254-3.342-3.254-2.276 0-3.612 1.707-3.612 3.471 0 .688.265 1.425.595 1.826a.24.24 0 0 1 .056.23c-.061.252-.196.796-.222.907-.035.146-.116.177-.268.107-1-.465-1.624-1.926-1.624-3.1 0-2.523 1.834-4.84 5.286-4.84 2.775 0 4.932 1.977 4.932 4.62 0 2.757-1.739 4.976-4.151 4.976-.811 0-1.573-.421-1.834-.919l-.498 1.902c-.181.695-.669 1.566-.995 2.097A8 8 0 1 0 8 0" /> </svg>';
    $theme_icons['linkedin'] = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16"> <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" /> </svg>';
    $theme_icons['x'] = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16"> <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" /> </svg>';
    $theme_icons['youtube'] = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16"> <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z" /> </svg>';
    $theme_icons['whatsapp'] = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16"> <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/> </svg>';
    $theme_icons['email'] = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16"> <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/> </svg>';
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


    // if (is_community_page()) {
    wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js');
    //  }
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
    if (isset($_GET['post_type']) && $_GET['post_type'] == 'product') {
        echo '<style>.column-rank_math_seo_details, #rank_math_seo_details {display: none !important} </style>';
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

// if page is password protected, bypass cache
if (post_password_required()) {
    header('Cache-Control: no-cache, must-revalidate, max-age=0');
}

/**
 * Adds a meta box to the post editing screen to display a shortcode with the current post's ID.
 *
 * This code should be placed in your theme's functions.php file or a custom plugin.
 */

// Hook into the 'add_meta_boxes' action to register our new meta box.
add_action('add_meta_boxes', 'wpdocs_add_product_widget_metabox');

/**
 * Register the custom meta box.
 *
 * This function defines the meta box's properties, including its ID, title, and the callback
 * function that will render its content.
 */
function wpdocs_add_product_widget_metabox()
{
    // We are adding the meta box to the 'product_widget' post type.
    // To add it to a different post type, replace 'product_widget' with the
    // post type slug.
    add_meta_box(
        'product_widget_shortcode_metabox',        // Unique ID for the meta box
        'Product Widget Shortcode',                // Title of the meta box
        'wpdocs_render_product_widget_metabox_content', // Callback function to display the content
        'product_widget',                          // The screen (post type) to show the box on
        'side',                                    // Where to display the box ('normal', 'side', 'advanced')
        'high'                                     // Priority within the context ('high', 'core', 'default', 'low')
    );
}

/**
 * Render the content for the product widget shortcode meta box.
 *
 * This function is the callback for our meta box. It retrieves the current post's ID
 * and then displays the complete shortcode in an easy-to-copy format.
 *
 * @param WP_Post $post The post object.
 */
function wpdocs_render_product_widget_metabox_content($post)
{
    // Get the current post ID.
    $post_id = $post->ID;

    // Construct the shortcode string, including the dynamic post ID.
    $shortcode = '[product_widget id="' . esc_attr($post_id) . '"]';

    // Display a description and the shortcode itself.
    echo '<p>Use the following shortcode to display the product widget for this post:</p>';

    // We'll use an input field so the user can easily copy the shortcode.
    echo '<input type="text" value="' . esc_attr($shortcode) . '" class="widefat" readonly />';
}



/**
 * Add a custom "Shortcode" column to the product_widget post type admin list.
 *
 * @param array $columns The existing columns.
 * @return array The modified columns array.
 */
add_filter('manage_product_widget_posts_columns', 'wpdocs_add_product_widget_shortcode_column');

function wpdocs_add_product_widget_shortcode_column($columns)
{
    // Add our new column after the 'title' column.
    $new_columns = array();
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ('title' === $key) {
            $new_columns['product_widget_shortcode'] = 'Shortcode';
        }
    }
    return $new_columns;
}

/**
 * Render the content for the custom "Shortcode" column.
 *
 * @param string $column  The name of the column to display.
 * @param int    $post_id The ID of the current post.
 */
add_action('manage_product_widget_posts_custom_column', 'wpdocs_show_product_widget_shortcode_column', 10, 2);

function wpdocs_show_product_widget_shortcode_column($column, $post_id)
{
    if ('product_widget_shortcode' === $column) {
        $shortcode = '[product_widget id="' . esc_attr($post_id) . '"]';
        echo '<code>' . esc_html($shortcode) . '</code>';
    }
}
/**
 * Change the breadcrumb separator
 */
add_filter('woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter');
function wcc_change_breadcrumb_delimiter($defaults)
{
    // Change the breadcrumb delimeter from '/' to '>'
    $defaults['delimiter'] = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/> </svg>';
    return $defaults;
}


/**
 * get_post_categories_as_links
 *
 * Retrieves the categories for a given post (or the current post) and
 * formats them as a string of HTML anchor links.
 *
 * @param int|null $post_id Optional. The ID of the post. Defaults to the current post ID.
 * @param string $separator Optional. The string to use between category links. Defaults to ''. (No separator)
 * @param string $css_class Optional. A CSS class to apply to the anchor tags. Defaults to 'post-category-link'.
 * @return string The formatted HTML string of category links, or an empty string if none are found.
 */
function get_post_categories_as_links($post_id = null, $separator = '', $css_class = 'post-category-link')
{

    // Ensure we are in a WordPress environment and categories can be retrieved
    if (!function_exists('get_the_category') || !function_exists('get_category_link')) {
        // Fallback for non-WordPress environments or error state
        error_log("WordPress functions not found. Cannot retrieve categories.");
        return '';
    }

    // Use get_the_category to fetch the categories for the specified post ID
    $categories = get_the_category($post_id);

    // Check if any categories were found
    if (empty($categories)) {
        return '';
    }

    $links = [];

    // Loop through each category object
    foreach ($categories as $category) {
        // Get the URL for the category archive
        $category_link = get_category_link($category->term_id);

        // Build the anchor tag
        $link_html = sprintf(
            '<a href="%s" title="%s" class="%s">%s</a>',
            esc_url($category_link),
            esc_attr(sprintf(__('View all posts in %s', 'textdomain'), $category->name)),
            esc_attr($css_class),
            esc_html($category->name)
        );

        $links[] = $link_html;
    }

    // Join the array of links with the specified separator and return the result
    return implode($separator, $links);
}

/**
 * Function to get the highest level (root) term for a given post in a specific taxonomy.
 *
 * This is useful for hierarchical taxonomies (like categories or custom hierarchical ones)
 * where you need the main parent category of a post.
 *
 * @param int $post_id The ID of the post.
 * @param string $taxonomy The slug of the taxonomy (e.g., 'category', 'product_cat').
 * @return WP_Term|false The top-level WP_Term object, or false if no terms are found or an error occurs.
 */
function get_top_level_term_by_post_id($post_id, $taxonomy)
{
    // Ensure both parameters are provided and the post exists.
    if (! $post_id || ! $taxonomy || ! get_post($post_id)) {
        return false;
    }

    // 1. Get all terms associated with the post in the specified taxonomy.
    $terms = wp_get_post_terms($post_id, $taxonomy, array('fields' => 'all'));

    // Check if any terms were found.
    if (is_wp_error($terms) || empty($terms)) {
        return false;
    }

    $top_level_term = false;
    $top_level_id   = 0;

    // 2. Iterate through the terms to find the highest ancestor.
    foreach ($terms as $term) {
        // If the term has a parent, find its ancestors.
        if ($term->parent) {
            // Get all ancestor IDs for the current term (sorted from closest parent to root).
            $ancestors = get_ancestors($term->term_id, $taxonomy);

            // The last ID in the array is the root (top-level) term ID.
            if (! empty($ancestors)) {
                $root_id = end($ancestors);

                // If this root is lower (or the same) as the currently found top_level_id,
                // we update our current best root.
                if ($root_id !== $top_level_id) {
                    $top_level_id = $root_id;
                    $top_level_term = get_term($top_level_id, $taxonomy);
                    // Break the loop if we've found the root. If a post has multiple top-level
                    // terms, this will return the first one found among the terms.
                    break;
                }
            } else {
                // This scenario should only happen if get_ancestors() fails, but we handle it.
                continue;
            }
        } else {
            // This term IS a top-level term (parent is 0).
            $top_level_term = $term;
            $top_level_id = $term->term_id;
            // If the term itself is top-level, we can return it immediately.
            break;
        }
    }

    // Fallback: If no top-level term was explicitly identified (e.g., post only in one child term),
    // we return the top_level_term found in the loop.
    return $top_level_term;
}

function custom_archive_post_count($query)
{
    // Only modify the main query on the frontend and on archive pages
    if (! is_admin() && $query->is_main_query() && is_archive()) {
        $query->set('posts_per_page', 50);
    }
}
add_action('pre_get_posts', 'custom_archive_post_count');

function admin_only()
{
    if (current_user_can('administrator')) {
    ?>
        <style>
            .blogs-loop-inner {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
            }
        </style>
<?php

    }
}
add_action('wp_head', 'admin_only');
