<!DOCTYPE html>
<html lang="en">
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
        :root {
            --trb-lightyellow: #FAF2E4;
            --trb-black: #000000;
            --trb-white: #ffffff;
            --trb-accent-1: #3B1527
        }

        body {
            background-color: var(--trb-white);
        }

        header.header-v2 {
            background-color: var(--trb-lightyellow);
        }

        header.header-v2 a {
            font-size: 15px;
            letter-spacing: 0.75px;
            font-weight: 500;
        }

        .trb-px {
            padding-left: 65px;
            padding-right: 65px;
        }

        #offCanvasMenu .menu {
            padding: 0;
            display: flex;
            align-items: center;
            gap: 25px;

        }

        #offCanvasMenu .menu li a {
            color: var(--trb-black);
        }

        .button-community a {
            background-color: var(--trb-accent-1);
            color: var(--trb-white);
            padding: 16px 30px;
            border-radius: 5px 0 0 5px;
        }

        .button-community a:after {
            content: '';
            width: 0;
            height: 0;
            border-top: 50px solid transparent;
            border-right: 100px solid var(--trb-lightyellow);
            border-bottom: 50px solid transparent;
        }

        .search form {
            margin: 0;

        }

        .is-search-input.is-search-input.is-search-input {
            background-color: transparent;
            height: auto !important;
            padding: 19px 30px;
            border-radius: 50px;
        }

        @media(min-width: 992px) {
            #offCanvasMenu {
                position: static;
                opacity: 1;
                visibility: visible;
                transform: none;
                width: auto;
                background-color: transparent;
                border: none;
            }
        }
    </style>
    <div id="fouc">
        <div class="site-wrap">
            <main>
                <header class="header-v2 py-4 trb-px">
                    <div class="container-fluid">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <a href="#">
                                    <?= $theme_logo ?>
                                </a>
                            </div>
                            <div class="col-auto">
                                <div class="row g-5 align-items-center">
                                    <div class="col-auto">
                                        <div class="offcanvas offcanvas-start" tabindex="-1" id="offCanvasMenu" aria-labelledby="offCanvasMenuLabel">
                                            <div class="offcanvas-body p-0">
                                                <?php wp_nav_menu(
                                                    array(
                                                        'menu' => 'Header V2',
                                                    )
                                                ); ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="search">
                                            <?php echo do_shortcode('[ivory-search id="24768" title="Search All Content"]'); ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="button-community">
                                            <a href="#">COMMUNITY</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
        </div>
        </header>

        <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offCanvasMenu" role="button" aria-controls="offCanvasMenu">
            Link with href
        </a>
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvasMenu" aria-controls="offCanvasMenu">
            Button with data-bs-target
        </button>