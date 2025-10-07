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
        }

        body {
            background-color: #fff;
        }

        header.header-v2 {
            background-color: var(--trb-lightyellow);
        }
    </style>
    <div id="fouc">
        <div class="site-wrap">
            <main>
                <header class="header-v2 py-4">
                    <div class="container">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <a href="#">
                                    <?= $theme_logo ?>
                                </a>
                            </div>
                            <div class="col-auto">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="offcanvas offcanvas-start" tabindex="-1" id="offCanvasMenu" aria-labelledby="offCanvasMenuLabel">
                                            <div class="offcanvas-body">
                                            </div>
                                            <?php wp_nav_menu(
                                                array(
                                                    'theme_location' => 'header-menu',
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