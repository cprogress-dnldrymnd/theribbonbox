<!DOCTYPE html>
<html lang="en" id="header-footer-v2">
<?php require 'head.php'; ?>
<?php global $wp; ?>

<body data-path="<?= $wp->request ?>" <?php body_class(); ?>>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PJH7VBG"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
    global $theme_logo;
    ?>
    <style>
        .is-search-form.is-search-form button.is-search-submit {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="17.179" height="17.179" viewBox="0 0 17.179 17.179"><g id="Icon_feather-search" data-name="Icon feather-search" transform="translate(0.75 0.75)"><path id="Path_1" data-name="Path 1" d="M18.161,11.33A6.83,6.83,0,1,1,11.33,4.5,6.83,6.83,0,0,1,18.161,11.33Z" transform="translate(-4.5 -4.5)" fill="none" stroke="%23000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_2" data-name="Path 2" d="M28.689,28.689l-3.714-3.714" transform="translate(-13.321 -13.321)" fill="none" stroke="%23000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></g></svg>') !important;
        }


        .instagram:before {
            content: "";
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="18.004" height="18" viewBox="0 0 18.004 18"><path id="Icon_awesome-instagram" data-name="Icon awesome-instagram" d="M9,6.623a4.615,4.615,0,1,0,4.615,4.615A4.608,4.608,0,0,0,9,6.623Zm0,7.615a3,3,0,1,1,3-3A3.006,3.006,0,0,1,9,14.238Zm5.88-7.8A1.076,1.076,0,1,1,13.8,5.358,1.074,1.074,0,0,1,14.879,6.434Zm3.057,1.092a5.327,5.327,0,0,0-1.454-3.772A5.362,5.362,0,0,0,12.71,2.3c-1.486-.084-5.94-.084-7.427,0a5.354,5.354,0,0,0-3.772,1.45A5.344,5.344,0,0,0,.058,7.522c-.084,1.486-.084,5.94,0,7.427A5.327,5.327,0,0,0,1.512,18.72a5.369,5.369,0,0,0,3.772,1.454c1.486.084,5.94.084,7.427,0a5.327,5.327,0,0,0,3.772-1.454,5.362,5.362,0,0,0,1.454-3.772c.084-1.486.084-5.936,0-7.423Zm-1.92,9.017A3.038,3.038,0,0,1,14.3,18.255c-1.185.47-4,.361-5.306.361s-4.125.1-5.306-.361a3.038,3.038,0,0,1-1.711-1.711c-.47-1.185-.361-4-.361-5.306s-.1-4.125.361-5.306A3.038,3.038,0,0,1,3.693,4.221c1.185-.47,4-.361,5.306-.361s4.125-.1,5.306.361a3.038,3.038,0,0,1,1.711,1.711c.47,1.185.361,4,.361,5.306S16.486,15.363,16.016,16.543Z" transform="translate(0.005 -2.238)"/></svg>');
        }

        .ticktok:before {
            content: "";
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="15.638" height="18" viewBox="0 0 15.638 18"><path id="Icon_simple-tiktok" data-name="Icon simple-tiktok" d="M10.582.015C11.564,0,12.539.007,13.514,0a4.671,4.671,0,0,0,1.312,3.127,5.289,5.289,0,0,0,3.18,1.342V7.492a8.028,8.028,0,0,1-3.15-.727,9.266,9.266,0,0,1-1.215-.7c-.007,2.19.007,4.38-.015,6.562a5.728,5.728,0,0,1-1.012,2.955,5.588,5.588,0,0,1-4.432,2.407,5.469,5.469,0,0,1-3.06-.772,5.656,5.656,0,0,1-2.737-4.282c-.015-.375-.022-.75-.007-1.117A5.646,5.646,0,0,1,8.924,6.81c.015,1.11-.03,2.22-.03,3.33a2.573,2.573,0,0,0-3.285,1.59,2.975,2.975,0,0,0-.1,1.207A2.553,2.553,0,0,0,8.129,15.09a2.52,2.52,0,0,0,2.077-1.207,1.73,1.73,0,0,0,.307-.795c.075-1.342.045-2.677.052-4.02.007-3.022-.007-6.037.015-9.052Z" transform="translate(-2.369)"/></svg>');
        }
    </style>
    <?php
    global $theme_option_page;

    $mode = isset($_GET['mode']) ? $_GET['mode'] : false;
    $top_banner_ad = get_field('top_banner_ad', $theme_option_page);
    $ad_strip = get_field('ad_strip', $theme_option_page);

    $ads = get_posts(array(
        'post_type' => 'ads',
        'numberposts' => 1, // Number of recent posts thumbnails to display
        'orderby' => 'rand',
        'post_status' => 'publish',
        'fields' => 'ids',
        'meta_query'  => array(
            array(
                'key'     => 'ad_type',   // The custom field key
                'value'   => 'ad_strip',  // The value to exclude
                'compare' => '!='         // The comparison operator (NOT EQUAL TO)
            )
        )
    ));

    ?>
    <div id="fouc">
        <div class="site-wrap">
            <?= do_shortcode('[ad_list]') ?>
            <header class="header-v2" id="header-main-site">
                <div class="header--inner py-4 trb-px trb-bg-lightyellow">
                    <div class="container-fluid">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto col-left col-logo">
                                <a href="<?= get_site_url() ?>" class="site-logo-v2">
                                    <?= $theme_logo ?>
                                </a>
                            </div>
                            <div class="col-auto col-right">
                                <div class="row g-5 align-items-center">
                                    <div class="col-auto">
                                        <div class="offcanvas offcanvas-start" tabindex="-1" id="offCanvasMenu" aria-labelledby="offCanvasMenuLabel">
                                            <div class="offcanvas-body p-0 d-flex flex-column">
                                                <div class="newsletter-menu d-block d-lg-none">
                                                    <a href="#" class="newsletter-trigger d-flex align-items-center gap-3 p-4 text-white text-uppercase sub-pop-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                                                        </svg>
                                                        <span>Sign up for our weekly newsletter</span>
                                                    </a>
                                                </div>
                                                <div class="offcanvas-body--inner flex-grow-1 d-flex flex-column justify-content-between gap-3">
                                                    <nav>
                                                        <div class="nav-menu text-uppercase">
                                                            <?php wp_nav_menu(
                                                                array(
                                                                    'theme_location' => 'header-menu',
                                                                    'walker' => new Walker_Nav_Pointers()
                                                                )
                                                            ); ?>
                                                        </div>
                                                    </nav>

                                                    <hr class="d-lg-none">
                                                    <div class="social-holder d-flex d-lg-none flex-column ">
                                                        <?php echo do_shortcode("[get_socials]"); ?>
                                                    </div>
                                                    <hr class="d-lg-none">
                                                    <div class="nav-menu d-block d-lg-none text-uppercase">
                                                        <?php
                                                        wp_nav_menu(array('menu' => 'FooterMenu'));
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="offcanvas offcanvas-start " tabindex="-1" id="offCanvasSearch" aria-labelledby="offCanvasSearchLabel">
                                            <div class="offcanvas-body p-0">
                                                <div class="offcanvas-body--inner">
                                                    <div class="search search-v2">
                                                        <div class="close--btn d-block d-xl-none text-end">
                                                            <button type="button" data-bs-dismiss="offcanvas" aria-label="Close">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <h4 class="d-block d-xl-none">Search</h4>
                                                        <?php echo do_shortcode('[ivory-search id="45284" title="Search for a topic"]'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="offCanvasSearch-btn d-block d-xl-none" data-bs-toggle="offcanvas" data-bs-target="#offCanvasSearch" aria-controls="offCanvasSearch" class="d-block d-xl-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17.179" height="17.179" viewBox="0 0 17.179 17.179">
                                                <g id="Icon_feather-search" data-name="Icon feather-search" transform="translate(0.75 0.75)">
                                                    <path id="Path_1" data-name="Path 1" d="M18.161,11.33A6.83,6.83,0,1,1,11.33,4.5,6.83,6.83,0,0,1,18.161,11.33Z" transform="translate(-4.5 -4.5)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                                                    <path id="Path_2" data-name="Path 2" d="M28.689,28.689l-3.714-3.714" transform="translate(-13.321 -13.321)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                                                </g>
                                            </svg>
                                        </button>

                                    </div>
                                    <div class="col-auto d-none d-lg-block">
                                        <div class="button-accent-2 button-community">
                                            <a href="https://theribbonbox.com/community/">COMMUNITY</a>
                                        </div>
                                    </div>
                                    <div class="col-auto d-block d-lg-none">
                                        <button class="menu-burger" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvasMenu" aria-controls="offCanvasMenu">
                                            <div class="icon">
                                                <div class="menu"></div>
                                            </div>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <?php if ($ad_strip) { ?>
                <div class="ad--strip">
                    <a href="<?= get_field('ad_url', $ad_strip) ?>" target="_blank">
                        <div class="container text-center">
                            <div class="ad--strip-holder d-inline-flex gap-3 align-items-center flex-wrap justify-content-center">
                                <span class="d-inline-block pt-4 pb-2 pb-lg-4">
                                    <?= get_field('ad_text', $ad_strip) ?>
                                </span>
                                <?= wp_get_attachment_image(get_field('ad_image', $ad_strip), 'thumb') ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
            <?php
            echo '<script type="text/javascript">
                    var ajaxurl = "' . admin_url('admin-ajax.php') . '";
                    </script>';
            ?>
            <script id="recent-posts-json" type="text/javascript" defer>
                const recentPostsJson = <?php echo do_shortcode("[get_category_posts_nav_new]"); ?>;
                console.log('recentPostsJson:', recentPostsJson);
            </script>
            <script src='<?php echo (get_template_directory_uri()) ?>/js/header.js'></script>
            <main class="main-v2 main-content-outer">
                <div class="messages">
                    <?php
                    $messages = get_transient('messages');
                    if (is_array($messages)) {
                        foreach ($messages as $message) : ?>
                            <p class="msg <?= $message->type ?>"><?= $message->text ?></p>
                    <?php endforeach;
                        delete_transient('messages');
                    }
                    ?>
                </div>