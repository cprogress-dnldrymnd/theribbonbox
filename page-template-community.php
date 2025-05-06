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

<section class="forum-welcome  mt-3 mt-lg-5" style="background-image: url(<?= $hero_image ?>);">
    <div class="container text-center">
        <div class="inner">
            <h1 class="mb-4 mt-0"><?php the_title() ?></h1>
            <?php if (get_the_content()) { ?>
                <div class="welcome-text w-100">
                    <?php the_content() ?>
                </div>
            <?php } ?>
            <?php if (!is_user_logged_in()) { ?>

                <div class="button-box button-box-v2 button-accent mb-3 mt-3">
                    <a href="<?= get_the_permalink(39747) ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                            <path id="download" d="M3,14a.979.979,0,0,1-1-1c0-1,1-4,6-4s6,3,6,4a.979.979,0,0,1-1,1ZM8,8A3,3,0,1,0,5,5,3,3,0,0,0,8,8" transform="translate(-2 -2)" fill="currentColor" />
                        </svg> LOGIN / CREATE AN ACCOUNT
                    </a>
                </div>
            <?php } else { ?>
                <div class="button-box button-box-v2 button-accent mb-3 mt-3">
                    <a href="/forums">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg> Write Topic
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