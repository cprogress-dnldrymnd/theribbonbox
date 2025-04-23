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
<section class="exclusive-articles bg-white lg-padding-bottom text-center">
        <div class="container">
            <a href="<?= get_the_permalink(39546) ?>" class="d-block box-style-1 position-relative rounded overflow-hidden">
                <div class="bg-image">
                    <?= wp_get_attachment_image(get_field('latest_conversation_background', 39318), 'large') ?>
                </div>
                <div class="inner position-relative">
                    <div class="heading">
                        <h2><?= get_field('latest_conversation_heading', 39318) ?></h2>
                    </div>
                    <div class="subheading" style="text-decoration: underline">
                        <?= get_field('latest_conversation_button_text', 39318) ?>
                    </div>
                </div>
            </a>
        </div>
    </section>
<?= do_shortcode('[forum_guidelines id="forum_guidelines_home"]') ?>
<section class="featured-topics-section lg-padding">
    <div class="container">
        <?= do_shortcode('[featured_topics]') ?>
    </div>
</section>

<?php get_footer('community') ?>