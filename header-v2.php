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
            --trb-accent-2: #3B1527;
            --trb-border-color: #EADCC3;
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
            gap: 1vw;

        }

        #offCanvasMenu .menu li a {
            color: var(--trb-black);
        }

        .button-accent-2.button-accent-2 a {
            background-color: var(--trb-accent-2);
            color: var(--trb-white) !important;
            padding: 15px 30px 16px 30px;
            border-radius: 5px;
            position: relative;
            display: inline-block;
            transition: 400ms;
        }

        .button-accent-2.button-accent-2 a:hover {
            background-color: var(--trb-accent-1);

        }

        .button-community.button-community a {
            border-radius: 5px 0 0 5px;
            padding-right: 38px;
        }

        .button-community a:after {
            content: '';
            width: 0;
            height: 0;
            border-top: 26px solid transparent;
            border-right: 8px solid var(--trb-lightyellow);
            border-bottom: 26px solid transparent;
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
            width: 100% !important;
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
            margin-top: 0;
            color: var(--trb-accent-2);
        }

        .trb-border-top {
            border-top: 1px solid var(--trb-border-color);
        }

        .main-v2 {
            min-height: 300px;
        }

        .footer-logo-text p {
            font-size: 24px;
            font-family: "Playfair Display", serif;
            font-style: italic;
            font-weight: 600;
            color: var(--trb-accent-2);
            line-height: 1.2;
        }

        .left-footer {
            max-width: 750px;
        }

        .right-footer {
            max-width: 500px;
            margin-left: auto;
            font-size: 16px;
        }

        .right-footer .menu {
            display: flex !important;
            flex-direction: column;
            gap: 15px;
            text-align: left !important;
            margin: 0 !important;
        }


        .footer-v2.footer-v2.footer-v2.footer-v2 a {
            font-weight: 500;
        }


        .footer-v2.footer-v2.footer-v2.footer-v2 a:hover {
            color: var(--trb-accent-1);
        }

        .woocommerce-breadcrumb.woocommerce-breadcrumb {
            float: none;
            text-align: left;
            background-color: transparent !important;
            box-shadow: none;
            font-size: 14px;
            display: block !important;
            position: static;
            border: none !important;
        }

        .woocommerce-breadcrumb.woocommerce-breadcrumb a {
            color: var(--trb-black);
            text-decoration: underline;
        }

        .woocommerce-breadcrumb.woocommerce-breadcrumb svg {
            color: var(--trb-accent-1);
            margin-left: 5px;
            margin-right: 5px;
            width: 10px;

        }

        .hero-v2 .top {
            padding-bottom: 8%;
        }

        .hero-v2 h1 {
            font-size: clamp(46px, -11.4px + 12.9375vw, 237px);
            font-weight: bold;
            font-family: Playfair Display, sans-serif;
            color: var(--trb-accent-2);
            margin-top: -8%;
            line-height: 1;
            margin-bottom: 0;
        }

        .social-icons.social-icons-txt {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .instagram.instagram,
        .ticktok.ticktok {
            padding-left: 0 !important;
            background-image: none;
            display: inline-flex;
            align-items: center;
            gap: 20px
        }

        .instagram:before,
        .ticktok:before {
            width: 18px;
            height: 18px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }

        .instagram:before {
            content: '';
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="18.004" height="18" viewBox="0 0 18.004 18"><path id="Icon_awesome-instagram" data-name="Icon awesome-instagram" d="M9,6.623a4.615,4.615,0,1,0,4.615,4.615A4.608,4.608,0,0,0,9,6.623Zm0,7.615a3,3,0,1,1,3-3A3.006,3.006,0,0,1,9,14.238Zm5.88-7.8A1.076,1.076,0,1,1,13.8,5.358,1.074,1.074,0,0,1,14.879,6.434Zm3.057,1.092a5.327,5.327,0,0,0-1.454-3.772A5.362,5.362,0,0,0,12.71,2.3c-1.486-.084-5.94-.084-7.427,0a5.354,5.354,0,0,0-3.772,1.45A5.344,5.344,0,0,0,.058,7.522c-.084,1.486-.084,5.94,0,7.427A5.327,5.327,0,0,0,1.512,18.72a5.369,5.369,0,0,0,3.772,1.454c1.486.084,5.94.084,7.427,0a5.327,5.327,0,0,0,3.772-1.454,5.362,5.362,0,0,0,1.454-3.772c.084-1.486.084-5.936,0-7.423Zm-1.92,9.017A3.038,3.038,0,0,1,14.3,18.255c-1.185.47-4,.361-5.306.361s-4.125.1-5.306-.361a3.038,3.038,0,0,1-1.711-1.711c-.47-1.185-.361-4-.361-5.306s-.1-4.125.361-5.306A3.038,3.038,0,0,1,3.693,4.221c1.185-.47,4-.361,5.306-.361s4.125-.1,5.306.361a3.038,3.038,0,0,1,1.711,1.711c.47,1.185.361,4,.361,5.306S16.486,15.363,16.016,16.543Z" transform="translate(0.005 -2.238)"/></svg>');
        }

        .ticktok:before {
            content: '';
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="15.638" height="18" viewBox="0 0 15.638 18"><path id="Icon_simple-tiktok" data-name="Icon simple-tiktok" d="M10.582.015C11.564,0,12.539.007,13.514,0a4.671,4.671,0,0,0,1.312,3.127,5.289,5.289,0,0,0,3.18,1.342V7.492a8.028,8.028,0,0,1-3.15-.727,9.266,9.266,0,0,1-1.215-.7c-.007,2.19.007,4.38-.015,6.562a5.728,5.728,0,0,1-1.012,2.955,5.588,5.588,0,0,1-4.432,2.407,5.469,5.469,0,0,1-3.06-.772,5.656,5.656,0,0,1-2.737-4.282c-.015-.375-.022-.75-.007-1.117A5.646,5.646,0,0,1,8.924,6.81c.015,1.11-.03,2.22-.03,3.33a2.573,2.573,0,0,0-3.285,1.59,2.975,2.975,0,0,0-.1,1.207A2.553,2.553,0,0,0,8.129,15.09a2.52,2.52,0,0,0,2.077-1.207,1.73,1.73,0,0,0,.307-.795c.075-1.342.045-2.677.052-4.02.007-3.022-.007-6.037.015-9.052Z" transform="translate(-2.369)"/></svg>');
        }

        .offCanvasSearch-btn {
            background-color: transparent !important;
            padding: 0 !important;
        }

        .menu-burger.menu-burger.menu-burger.menu-burger {
            border: none;
            background-color: transparent !important;
            padding: 0 !important;
            position: relative;
            color: var(--trb-black) !important;
            outline: none;
            height: auto !important;
        }

        .menu-burger.menu-burger.menu-burger.menu-burger .icon .menu,
        .menu-burger.menu-burger.menu-burger.menu-burger .icon .menu::before,
        .menu-burger.menu-burger.menu-burger.menu-burger .icon .menu::after {
            background-color: currentColor;
            content: "";
            display: block;
            height: 3px;
            position: absolute;
            transition:
                background ease 0.3s,
                top ease 0.3s 0.3s,
                transform ease 0.3s;
            width: 25px;
        }

        .menu-burger.menu-burger.menu-burger.menu-burger .icon {
            cursor: pointer;
            display: block;
            height: 19px;
            width: 25px;
            position: relative;
        }

        .menu-burger.menu-burger.menu-burger.menu-burger .icon .menu {
            left: 0;
            top: 8px;
        }

        .menu-burger.menu-burger.menu-burger.menu-burger .icon .menu:before {
            top: -8px;
        }

        .menu-burger.menu-burger.menu-burger.menu-burger .icon .menu:after {
            top: 8px;
        }

        body.mobile-menu-active header .menu-burger.menu-burger.menu-burger.menu-burger .icon .menu:before {
            transform: rotate(45deg);
        }

        body.mobile-menu-active header .menu-burger.menu-burger.menu-burger.menu-burger .icon .menu:after {
            transform: rotate(-45deg);
        }

        body.mobile-menu-active header .menu-burger.menu-burger.menu-burger.menu-burger .icon .menu:before,
        body.mobile-menu-active header .menu-burger.menu-burger.menu-burger.menu-burger .icon .menu:after {
            top: 0;
            transition:
                top ease 0.3s,
                transform ease 0.3s 0.3s;
        }

        body.mobile-menu-active header .menu-burger.menu-burger.menu-burger.menu-burger .icon .menu {
            background-color: transparent;
        }

        .close--btn.close--btn button {
            color: #fff !important;
            background-color: var(--trb-accent-1) !important;
            padding: 5px;
            border-radius: 5px;
            background-color: transparent;
            height: auto;
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

        @media(min-width: 1200px) {
            #offCanvasSearch {
                position: static;
                opacity: 1;
                visibility: visible;
                transform: none;
                width: auto;
                background-color: transparent;
                border: none;
            }
        }

        @media(max-width: 1920px) {
            .is-search-form.is-search-form {
                min-width: 18vw;
            }
        }

        @media(max-width: 1503px) {
            .col-right>.row {
                --bs-gutter-y: 1.5rem;
                --bs-gutter-x: 1.5rem;
            }
        }


        @media(max-width: 1440px) {
            header.header-v2 a {
                font-size: 14px;
                letter-spacing: 0;
            }
        }


        @media(max-width: 1300px) {
            header.header-v2 a {
                font-size: 13px;
            }

            .is-search-input.is-search-input.is-search-input.is-search-input.is-search-input {
                padding-left: 15px !important;
                padding-right: 15px !important;
            }

            .button-community.button-community a {
                padding-left: 15px;
                padding-right: 23px;
            }

            .site-logo-v2 svg {
                max-width: 100px;
                height: auto;
            }
        }


        @media(max-width: 1199px) {
            .footer-v2 .left-footer h2 {
                font-size: 60px;
            }


        }

        @media(max-width: 991px) {
            .trb-px {
                padding-left: 50px;
                padding-right: 50px;
            }

            .footer-v2 .left-footer h2 {
                font-size: 50px;
            }

            #offCanvasMenu,
            #offCanvasSearch {
                padding: 60px 40px 40px;
            }

            #offCanvasMenu .menu {
                flex-direction: column;
                align-items: flex-start;
            }

            #offCanvasSearch {}
        }

        @media(max-width: 767px) {
            .trb-px {
                padding-left: 40px;
                padding-right: 40px;
            }

            .footer-v2 .left-footer h2 {
                font-size: 40px;
            }

            .hero-v2 h1 {
                margin-top: 0;
            }

            .hero-v2 .top {
                padding-top: 1.5rem !important;
                padding-bottom: 0;
            }

            .hero-v2 .bottom {
                padding-top: 0 !important;
            }

            .bottom {
                background-color: var(--trb-lightyellow);
                padding-bottom: 1.5rem !important;
            }
        }

        @media(max-width: 575px) {
            .trb-px {
                padding-left: 20px;
                padding-right: 20px;
            }

            .footer-v2 .left-footer h2 {
                font-size: 25px;
            }
        }

        @media(max-width: 375px) {
            .trb-px {
                padding-left: 10px;
                padding-right: 10px;
            }
        }
    </style>
    <?php
    $mode = isset($_GET['mode']) ? $_GET['mode'] : false;
    ?>
    <div id="fouc">
        <div class="site-wrap">
            <header class="header-v2 py-4 trb-px trb-bg-lightyellow">
                <div class="container-fluid">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto col-left">
                            <a href="#" class="site-logo-v2">
                                <?= $theme_logo ?>
                            </a>
                        </div>
                        <div class="col-auto col-right">
                            <div class="row g-5 align-items-center">
                                <div class="col-auto">
                                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offCanvasMenu" aria-labelledby="offCanvasMenuLabel">
                                        <div class="offcanvas-body p-0">
                                            <div class="close--btn d-block d-lg-none text-end">
                                                <button type="button" data-bs-dismiss="offcanvas" aria-label="Close">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <?php wp_nav_menu(
                                                array(
                                                    'menu' => 'Header V2',
                                                )
                                            ); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="offcanvas offcanvas-start " tabindex="-1" id="offCanvasSearch" aria-labelledby="offCanvasSearchLabel">
                                        <div class="offcanvas-body p-0">
                                            <div class="search search-v2">
                                                <div class="close--btn d-block d-lg-none text-end">
                                                    <button type="button" data-bs-dismiss="offcanvas" aria-label="Close">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <h4 class="d-block d-lg-none">Search</h4>
                                                <?php echo do_shortcode('[ivory-search id="24768" title="Search for a topic"]'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="offCanvasSearch-btn d-block d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#offCanvasSearch" aria-controls="offCanvasSearch" class="d-block d-xl-none">
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
                                        <a href="#">COMMUNITY</a>
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
            <div class="hero-v2 trb-border-top">
                <div class="top  pt-4 trb-bg-lightyellow trb-px">
                    <div class="container-fluid">
                        <div class="breadcrumbs-v2">
                            <?= woocommerce_breadcrumb(); ?>
                        </div>
                    </div>
                </div>
                <div class="bottom trb-px">
                    <div class="container-fluid">
                        <h1>Surrogacy</h1>
                    </div>

                </div>
            </div>
            <main class="main-v2">