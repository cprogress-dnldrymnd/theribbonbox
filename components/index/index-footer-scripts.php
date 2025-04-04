<!-- index-footer-scripts.php -->
<script type="text/javascript">
    if ($(".aol-filter-button").length > 0) {
        $(".aol-filter-button").html("Search");
    }
</script>

<?php
    $pageTitle = the_title('','',false);
    if ($pageTitle === "Job Search") : ?>
        <script type="text/javascript">
            <?php include get_template_directory() . '/js/aol-ad-form/aol-ad-form-job-search.js'; ?>
        </script>
    <?php endif;
?>

<script type="text/javascript">
    <?php include get_template_directory() . '/js/aol-ad-form/aol-ad-form.js'; ?>
</script>

<?php if (get_post_type( get_the_ID() ) === 'aol_ad') : ?>
    <script type="text/javascript">
        <?php include get_template_directory() . '/js/aol-ad-form/aol-ad-form-for-ads.js'; ?>
    </script>
<?php endif; ?>

<?php if(the_title('','',false) != "Testimonials" && !is_front_page()) : ?>
    <script src="/wp-content/themes/lighttheme/js/fancybox/jquery.fancybox.pack.js"></script>
    <script src="/wp-content/themes/lighttheme/js/jquery.flexslider-min.js"></script>
<?php endif; ?>

<?php // echo do_shortcode( '[testimonials_list]' ); ?>
