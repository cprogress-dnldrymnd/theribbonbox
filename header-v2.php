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
                <header class="header-v2 py-y">
                    <div class="container">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <a href="#">
                                    <?= $theme_logo ?>
                                </a>
                            </div>
                            <div class="col-auto">

                            </div>
                        </div>
                    </div>
                </header>