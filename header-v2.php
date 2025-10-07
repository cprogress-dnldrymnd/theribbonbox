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
            --trb-accent-1: #F77D66;
            --trb-accent-2: #3B1527
        }

        body {
            background-color: var(--trb-white);
        }

        .trb-bg-lightyellow {
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

        .button-accent-2.button-accent-2 a {
            background-color: var(--trb-accent-2);
            color: var(--trb-white);
            padding: 16px 38px 16px 30px;
            border-radius: 5px 0 0 5px;
            position: relative;
        }

        .button-community a:after {
            content: '';
            width: 0;
            height: 0;
            border-top: 25px solid transparent;
            border-right: 8px solid var(--trb-lightyellow);
            border-bottom: 25px solid transparent;
            position: absolute;
            right: 0;
            top: 0;
        }

        .search form {
            margin: 0;

        }

        .is-search-form.is-search-form {
            width: auto;
        }

        .is-search-input.is-search-input.is-search-input.is-search-input.is-search-input {
            background-color: transparent;
            height: auto !important;
            padding: 17px 45px 17px 30px !important;
            border-radius: 50px;
            min-width: 346px;
            border: 1px solid !important;
        }

        .is-search-input.is-search-input.is-search-input {
            font-family: Work Sans, sans-serif;
            font-size: 14px !important;
            text-transform: initial !important;
            letter-spacing: 0 !important;
            text-transform: initial !important;
        }

        .is-search-form.is-search-form.is-search-form>label {
            height: auto;
            width: auto !important;
        }

        .is-search-form.is-search-form button.is-search-submit {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="17.179" height="17.179" viewBox="0 0 17.179 17.179"><g id="Icon_feather-search" data-name="Icon feather-search" transform="translate(0.75 0.75)"><path id="Path_1" data-name="Path 1" d="M18.161,11.33A6.83,6.83,0,1,1,11.33,4.5,6.83,6.83,0,0,1,18.161,11.33Z" transform="translate(-4.5 -4.5)" fill="none" stroke="%23000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_2" data-name="Path 2" d="M28.689,28.689l-3.714-3.714" transform="translate(-13.321 -13.321)" fill="none" stroke="%23000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></g></svg>') !important;
            background-size: contain !important;
            border: none !important;
            padding: 0 !important;
            position: absolute;
            right: 25px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px !important;
            height: 16px !important;
            border-radius: 0;
        }

        .ad-strip a {
            display: block;
            background-color: var(--trb-accent-1);
            font-family: "Playfair Display", serif;
            font-size: 17px;
            letter-spacing: 0.85px;
            color: var(--trb-black);
            font-weight: 500;
        }

        .ad-strip strong {
            font-weight: 800;
        }

        .ad-strip img {
            height: 74px;
            width: auto;
            object-fit: cover;
        }

        .footer-v2 {
            padding-top: 70px;
        }
        .footer-v2 .left-footer h2 {
            font-size: 70px;
            font-weight: bold;
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
            <header class="header-v2 py-4 trb-px trb-bg-lightyellow">
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
                                    <div class="button-accent-2 button-community">
                                        <a href="#">COMMUNITY</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </header>

            <div class="ad-strip">
                <a href="#">
                    <div class="container text-center">
                        <div class="ad-strip-holder d-inline-flex gap-3 align-items-center flex-wrap">
                            <span class="d-inline-block py-4">
                                <strong><i>WIN</i></strong> 1 of 5 Zita <strong><i>West Fertility Collagen Pro supplements</i></strong> for preconception, pregnancy & postnatal
                            </span>
                            <?= wp_get_attachment_image(44844, 'thumbnail') ?>
                        </div>
                    </div>
                </a>

            </div>
            <main>


                <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offCanvasMenu" role="button" aria-controls="offCanvasMenu">
                    Link with href
                </a>
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvasMenu" aria-controls="offCanvasMenu">
                    Button with data-bs-target
                </button>