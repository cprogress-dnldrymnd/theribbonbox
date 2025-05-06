<?php
/*-----------------------------------------------------------------------------------*/
/* Template Name: Community 
/* Template Post Type: page
/*-----------------------------------------------------------------------------------*/
?>
<?php get_header('community') ?>

<?php
$hero_image = get_field('hero_image');
$hero_image = wp_get_attachment_image_url($hero_image, 'full');
?>

<section class="forum-welcome py-5 mt-3 mt-lg-5" style="background-image: url(<?= $hero_image ?>);">
    <div class="container text-center">
        <div class="inner">
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
            <?php } else { ?>
                <div class="button-box button-box-v2 button-accent mb-3 mt-3">
                    <a href="/forums">
                        Write Topic
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<section class="forum-latest lg-padding">
    <div class="container">
        <h2 class="text-heading mb-4">Latest Topics & Discussions</h2>
        <?= do_shortcode('[latest_topics]') ?>
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