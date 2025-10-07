</main>
<?php
global $theme_logo;
?>
<footer class="footer-v2 trb-bg-lightyellow">
    <div class="footer-top trb-px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-footer">
                        <h2>Become an Insider</h2>
                        <p>Our weekly newsletter of tailored expert advice, tips and giveaways - straight to your inbox.</p>
                        <div class="button-accent-2 mt-4">
                            <a href="#">SIGN ME UP</a>
                        </div>
                        <div class="footer-logo-text my-5">
                            <div class="row g-3 align-items-center">
                                <div class="col-lg-3">
                                    <a href="#">
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
            </div>
        </div>
    </div>
    <div class="footer-bottom trb-px mt-4 py-4">
        <div class="container-fluid">
            <p>
                © 2025 Edington Media Ltd
            </p>
        </div>
    </div>
</footer>
</div><!-- Close: .site-wrap -->

<?php wp_footer(); ?>

</div><!-- Close: #fouc -->

<script src="<?php echo (get_template_directory_uri()) ?>/js/javascript2.js"></script>

<?php if (is_front_page()) {
    $_SESSION['homepage_array'] = "";
} ?>

</body>

</html>