</main>
<?php
global $theme_logo;
?>
<footer class="footer-v2 trb-bg-lightyellow">
    <div class="footer-top trb-px">
        <div class="container-fluid">
            <div class="row g-3">
                <div class="col-lg-6 col-md-8">
                    <div class="left-footer">
                        <h2>Become an Insider</h2>
                        <p>Our weekly newsletter of tailored expert advice, tips and giveaways - straight to your inbox.</p>
                        <div class="button-accent-2 mt-4">
                            <a href="#">SIGN ME UP</a>
                        </div>
                        <div class="footer-logo-text my-5">
                            <div class="row g-3 align-items-center">
                                <div class="col-lg-3">
                                    <a href="<?= get_site_url() ?>">
                                        <?= $theme_logo ?>
                                    </a>
                                </div>
                                <div class="col-lg-9">
                                    <p>
                                        By your side through the highs and lows of preconception, pregnancy and parenthood.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="social-holder mt-4">
                            <?php echo do_shortcode("[get_socials]"); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                    <div class="right-footer ms-0 ms-md-auto mt-4 mt-md-0">
                        <div class="row g-3">
                            <div class="col-6">
                                <?php wp_nav_menu(array('menu' => 'Footer Menu V2 Left')); ?>
                            </div>
                            <div class="col-6">
                                <?php wp_nav_menu(array('menu' => 'FooterMenu')); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom trb-border-top trb-px mt-4 py-4">
        <div class="container-fluid">
            <p>
                © 2025 Edington Media Ltd
            </p>
        </div>
    </div>
</footer>
</div><!-- Close: .site-wrap -->


<?php
global $theme_option_page;
$subscribe_popup_heading = get_field('subscribe_popup_heading', $theme_option_page);
$subscribe_popup_description = get_field('subscribe_popup_description', $theme_option_page);
$subscribe_popup_links = get_field('subscribe_popup_links', $theme_option_page);
$subscribe_popup_image = get_field('subscribe_popup_image', $theme_option_page);
$subscribe_popup_form = get_field('subscribe_popup_form', $theme_option_page);

$subscribe_popup__heading_colour = get_field('subscribe_popup__heading_colour', $theme_option_page);
$subscribe_popup_description_colour = get_field('subscribe_popup_description_colour', $theme_option_page);
$subscribe_popup_links_colour = get_field('subscribe_popup_links_colour', $theme_option_page);
$subscribe_popup_form_colour = get_field('subscribe_popup_form_colour', $theme_option_page);
$subscribe_popup_bg_colour = get_field('subscribe_popup_bg_colour', $theme_option_page);

?>
<div id="subscribe-outer" class="post-follow-us insider-outer subscibe-outer" style="background-color: <?= $subscribe_popup_bg_colour ?>">
    <div class="subscribe-outer-close"><img src="<?php echo (get_template_directory_uri()) ?>/images/icons/menu-close.png" alt="Close"></div>
    <div class="post-follow-us-inner">
        <div class="subscribe-outer-img"><img src="<?= wp_get_attachment_image_url($subscribe_popup_image, 'large') ?>" alt="Subscribe"></div>
        <div class="subscribe-outer-txt">
            <h2 style="color: <?= $subscribe_popup__heading_colour ?> !important"><?= $subscribe_popup_heading ?> </h2>
            <div class="cat-links">
                <?php foreach ($subscribe_popup_links as $link) { ?>
                    <?php
                    $page_id = url_to_postid($link);
                    $url = get_permalink($page_id);
                    $title = get_the_title($page_id);
                    ?>
                    <a href="<?= $url ?>" style="color: <?= $subscribe_popup_links_colour ?> !important"><?= $title ?></a> |
                <?php } ?>

            </div>
            <hr>
            <div id="subscribe-outer-desc" style="color: <?= $subscribe_popup_description_colour ?> !important">
                <?= wpautop($subscribe_popup_description) ?>
            </div>
            <div class="sub---form" style="--color: <?= $subscribe_popup_form_colour ?> !important">
                <?= do_shortcode($subscribe_popup_form); ?>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>

</div><!-- Close: #fouc -->
<script>
    var offCanvasMenu = document.getElementById('offCanvasMenu')
    offCanvasMenu.addEventListener('show.bs.offcanvas', function() {
        jQuery('body').addClass('mobile-menu-active');
    });

    offCanvasMenu.addEventListener('hide.bs.offcanvas', function() {
        jQuery('body').removeClass('mobile-menu-active');

    });

    jQuery(document).ready(function() {
        $height = jQuery('#header-main-site').outerHeight();
        jQuery('body').css('--header-height', $height + 'px');

        jQuery('.newsletter-menu a').click(function(e) {
            jQuery('#subscribe-outer').show();
            jQuery('button[data-bs-target="#offCanvasMenu"]').click();
            e.preventDefault();
        });

        jQuery('.subscribe-outer-close').click(function(e) {
            jQuery('#subscribe-outer').hide();
            e.preventDefault();

        });
    });
</script>

<script src="<?php echo (get_template_directory_uri()) ?>/js/javascript2.js"></script>

<?php if (is_front_page()) {
    $_SESSION['homepage_array'] = "";
} ?>

</body>

</html>