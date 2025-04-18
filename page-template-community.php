<?php
/*-----------------------------------------------------------------------------------*/
/* Template Name: Community 
/* Template Post Type: page
/*-----------------------------------------------------------------------------------*/
?>
<?php get_header('community') ?>


<section class="forum-welcome py-5 mt-3 mt-lg-5">
    <div class="container text-center">
        <h1 class="mb-4"><?php the_title() ?></h1>
        <?php if (get_the_content()) { ?>
            <div class="welcome-text w-100">
                <?php the_content() ?>
            </div>
        <?php } ?>
        <?php if (!is_user_logged_in()) { ?>

            <div class="button-box button-box-v2 button-accent mb-3 mt-3">
                <a href="<?= get_the_permalink(39747) ?>">
                    LOGIN / CREATE AN ACCOUNT
                </a>
            </div>
        <?php } ?>
    </div>
</section>
<section class="forum-slider bg-purple lg-padding">
    <div class="container">
        <?= do_shortcode('[forum_slider]') ?>
    </div>
</section>
<?= do_shortcode('[forum_guidelines id="forum_guidelines_home"]') ?>
<section class="featured-topics-section lg-padding">
    <div class="container">
        <?= do_shortcode('[featured_topics]') ?>
    </div>
</section>

<?php get_footer('community') ?>