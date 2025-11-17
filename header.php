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