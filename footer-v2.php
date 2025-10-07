</main>
<footer class="footer-v2 trb-bg-lightyellow trb-px">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h2>Become an Insider</h2>
                <p>Our weekly newsletter of tailored expert advice, tips and giveaways - straight to your inbox.</p>
                <div class="button-accent-2 ">
                    <a href="#">SIGN ME UP</a>
                </div>
            </div>
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