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
$banners = get_posts(array(
    'post_type' => 'community-banner',
    'numberposts' => -1,
));
?>

<section class="forum-welcome  mt-3 mt-lg-5" style="background-image: url(<?= $hero_image ?>);">
    <div class="container text-center">
        <?php if ($banner) { ?>
            <div class="community-banner">
                <?php foreach ($banners as $banner) { ?>
                    <?php
                    $banner_image = get_field('banner_image', $banner->ID);
                    $banner_url = get_field('banner_url', $banner->ID);
                    $open_in_new_tab = get_field('open_in_new_tab', $banner->ID);
                    ?>
                    <div class="swiper swiper-community-banner">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a <?= $open_in_new_tab ? 'target="_blank"' : '' ?> href="<?= $banner_url ?>">
                                    <img src="<?= wp_get_attachment_image_url($banner_image) ?>">
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="inner">
            <h1 class="mb-4 mt-0"><?php the_title() ?></h1>
            <?php if (get_the_content()) { ?>
                <div class="welcome-text w-100">
                    <?php the_content() ?>
                </div>
            <?php } ?>
            <?php if (!is_user_logged_in()) { ?>

                <div class="button-box button-box-v2 button-accent button-with-icon mb-3 mt-3">
                    <a href="<?= get_the_permalink(39747) ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                            <path id="download" d="M3,14a.979.979,0,0,1-1-1c0-1,1-4,6-4s6,3,6,4a.979.979,0,0,1-1,1ZM8,8A3,3,0,1,0,5,5,3,3,0,0,0,8,8" transform="translate(-2 -2)" fill="currentColor" />
                        </svg> LOGIN / CREATE AN ACCOUNT
                    </a>
                </div>
            <?php } else { ?>
                <div class="button-box button-box-v2 button-accent button-with-icon mb-3 mt-3">
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
        <div class="bbp-search-custom mb-5">
            <h2 class="text-heading text-heading-with-icon mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg>
                Search Community Forums
            </h2>
            <?= do_shortcode('[bbp-search-form]') ?>
        </div>
        <div class="mb-4">

            <div class="row g-4 align-items-end justify-content-between ">
                <div class="col-auto">
                    <h2 class="text-heading text-heading-with-icon"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10" fill="none">
                            <path d="M10.2012 6.41961C10.2012 4.65038 8.76686 3.21606 6.99771 3.21606C5.22839 3.21606 3.79407 4.65038 3.79407 6.41961C3.79407 8.18885 5.22837 9.62315 6.99771 9.62315C7.33963 9.62315 7.66896 9.56904 7.97794 9.46988L9.82427 10L9.44942 8.4809C9.91831 7.92386 10.2012 7.20486 10.2012 6.41961Z" fill="currentColor"></path>
                            <path d="M6.84682 2.48104C7.34755 2.48104 7.82493 2.57988 8.2643 2.75416C7.65231 1.14428 6.0958 0 4.27136 0C1.91242 0 0 1.91242 0 4.27144C0 5.31837 0.377264 6.27696 1.00248 7.0197L0.502587 9.04527L2.96432 8.33844C3.18219 8.40835 3.40811 8.46025 3.63961 8.49484C3.22572 7.87966 2.98362 7.13968 2.98362 6.34411C2.98362 4.21402 4.71661 2.48104 6.84682 2.48104Z" fill="currentColor"></path>
                        </svg> Latest Topics & Discussions</h2>
                </div>
                <div class="d-none d-lg-block col-auto text-center button-box button-box-v2 button-accent button-with-icon">
                    <a href="/forums">
                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10" fill="none">
                            <path d="M10.2012 6.41961C10.2012 4.65038 8.76686 3.21606 6.99771 3.21606C5.22839 3.21606 3.79407 4.65038 3.79407 6.41961C3.79407 8.18885 5.22837 9.62315 6.99771 9.62315C7.33963 9.62315 7.66896 9.56904 7.97794 9.46988L9.82427 10L9.44942 8.4809C9.91831 7.92386 10.2012 7.20486 10.2012 6.41961Z" fill="currentColor"></path>
                            <path d="M6.84682 2.48104C7.34755 2.48104 7.82493 2.57988 8.2643 2.75416C7.65231 1.14428 6.0958 0 4.27136 0C1.91242 0 0 1.91242 0 4.27144C0 5.31837 0.377264 6.27696 1.00248 7.0197L0.502587 9.04527L2.96432 8.33844C3.18219 8.40835 3.40811 8.46025 3.63961 8.49484C3.22572 7.87966 2.98362 7.13968 2.98362 6.34411C2.98362 4.21402 4.71661 2.48104 6.84682 2.48104Z" fill="currentColor"></path>
                        </svg>
                        Visit Forums
                    </a>
                </div>
            </div>
        </div>
        <?= do_shortcode('[latest_topics]') ?>
        <div class="text-center button-box button-box-v2 button-accent button-with-icon mt-5 d-block d-lg-none">
            <a href="/forums">
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10" fill="none">
                    <path d="M10.2012 6.41961C10.2012 4.65038 8.76686 3.21606 6.99771 3.21606C5.22839 3.21606 3.79407 4.65038 3.79407 6.41961C3.79407 8.18885 5.22837 9.62315 6.99771 9.62315C7.33963 9.62315 7.66896 9.56904 7.97794 9.46988L9.82427 10L9.44942 8.4809C9.91831 7.92386 10.2012 7.20486 10.2012 6.41961Z" fill="currentColor"></path>
                    <path d="M6.84682 2.48104C7.34755 2.48104 7.82493 2.57988 8.2643 2.75416C7.65231 1.14428 6.0958 0 4.27136 0C1.91242 0 0 1.91242 0 4.27144C0 5.31837 0.377264 6.27696 1.00248 7.0197L0.502587 9.04527L2.96432 8.33844C3.18219 8.40835 3.40811 8.46025 3.63961 8.49484C3.22572 7.87966 2.98362 7.13968 2.98362 6.34411C2.98362 4.21402 4.71661 2.48104 6.84682 2.48104Z" fill="currentColor"></path>
                </svg>
                Visit Forums
            </a>
        </div>
    </div>
</section>
<section class="forum-slider bg-purple lg-padding">
    <div class="container">
        <div class="mb-4">
            <div class="row g-4 align-items-end justify-content-between">
                <div class="col-auto">
                    <h2 class="text-heading text-heading-with-icon"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10" fill="none">
                            <path d="M10.2012 6.41961C10.2012 4.65038 8.76686 3.21606 6.99771 3.21606C5.22839 3.21606 3.79407 4.65038 3.79407 6.41961C3.79407 8.18885 5.22837 9.62315 6.99771 9.62315C7.33963 9.62315 7.66896 9.56904 7.97794 9.46988L9.82427 10L9.44942 8.4809C9.91831 7.92386 10.2012 7.20486 10.2012 6.41961Z" fill="currentColor"></path>
                            <path d="M6.84682 2.48104C7.34755 2.48104 7.82493 2.57988 8.2643 2.75416C7.65231 1.14428 6.0958 0 4.27136 0C1.91242 0 0 1.91242 0 4.27144C0 5.31837 0.377264 6.27696 1.00248 7.0197L0.502587 9.04527L2.96432 8.33844C3.18219 8.40835 3.40811 8.46025 3.63961 8.49484C3.22572 7.87966 2.98362 7.13968 2.98362 6.34411C2.98362 4.21402 4.71661 2.48104 6.84682 2.48104Z" fill="currentColor"></path>
                        </svg> FORUMS TOPICS & DISCUSSIONS</h2>
                </div>
                <div class="d-none d-lg-block col-auto text-center button-box button-box-v2 button-accent button-with-icon">
                    <a href="/forums">
                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10" fill="none">
                            <path d="M10.2012 6.41961C10.2012 4.65038 8.76686 3.21606 6.99771 3.21606C5.22839 3.21606 3.79407 4.65038 3.79407 6.41961C3.79407 8.18885 5.22837 9.62315 6.99771 9.62315C7.33963 9.62315 7.66896 9.56904 7.97794 9.46988L9.82427 10L9.44942 8.4809C9.91831 7.92386 10.2012 7.20486 10.2012 6.41961Z" fill="currentColor"></path>
                            <path d="M6.84682 2.48104C7.34755 2.48104 7.82493 2.57988 8.2643 2.75416C7.65231 1.14428 6.0958 0 4.27136 0C1.91242 0 0 1.91242 0 4.27144C0 5.31837 0.377264 6.27696 1.00248 7.0197L0.502587 9.04527L2.96432 8.33844C3.18219 8.40835 3.40811 8.46025 3.63961 8.49484C3.22572 7.87966 2.98362 7.13968 2.98362 6.34411C2.98362 4.21402 4.71661 2.48104 6.84682 2.48104Z" fill="currentColor"></path>
                        </svg>
                        Visit Forums
                    </a>
                </div>
            </div>
        </div>
        <?= do_shortcode('[forum_slider]') ?>
        <div class="d-block d-lg-none mt-4 text-center button-box button-box-v2 button-with-icon button-accent">
            <a href="/forums">
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10" fill="none">
                    <path d="M10.2012 6.41961C10.2012 4.65038 8.76686 3.21606 6.99771 3.21606C5.22839 3.21606 3.79407 4.65038 3.79407 6.41961C3.79407 8.18885 5.22837 9.62315 6.99771 9.62315C7.33963 9.62315 7.66896 9.56904 7.97794 9.46988L9.82427 10L9.44942 8.4809C9.91831 7.92386 10.2012 7.20486 10.2012 6.41961Z" fill="currentColor"></path>
                    <path d="M6.84682 2.48104C7.34755 2.48104 7.82493 2.57988 8.2643 2.75416C7.65231 1.14428 6.0958 0 4.27136 0C1.91242 0 0 1.91242 0 4.27144C0 5.31837 0.377264 6.27696 1.00248 7.0197L0.502587 9.04527L2.96432 8.33844C3.18219 8.40835 3.40811 8.46025 3.63961 8.49484C3.22572 7.87966 2.98362 7.13968 2.98362 6.34411C2.98362 4.21402 4.71661 2.48104 6.84682 2.48104Z" fill="currentColor"></path>
                </svg> Visit Forums
            </a>
        </div>
    </div>
</section>

<?= do_shortcode('[forum_guidelines id="forum_guidelines_home"]') ?>
<section class="featured-topics-section lg-padding">
    <div class="container">
        <?= do_shortcode('[featured_topics]') ?>
        <div class="mt-5 text-center d-block d-lg-none button-box button-box-v2 button-with-icon button-accent">
            <a href="/forums">
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10" fill="none">
                    <path d="M10.2012 6.41961C10.2012 4.65038 8.76686 3.21606 6.99771 3.21606C5.22839 3.21606 3.79407 4.65038 3.79407 6.41961C3.79407 8.18885 5.22837 9.62315 6.99771 9.62315C7.33963 9.62315 7.66896 9.56904 7.97794 9.46988L9.82427 10L9.44942 8.4809C9.91831 7.92386 10.2012 7.20486 10.2012 6.41961Z" fill="currentColor"></path>
                    <path d="M6.84682 2.48104C7.34755 2.48104 7.82493 2.57988 8.2643 2.75416C7.65231 1.14428 6.0958 0 4.27136 0C1.91242 0 0 1.91242 0 4.27144C0 5.31837 0.377264 6.27696 1.00248 7.0197L0.502587 9.04527L2.96432 8.33844C3.18219 8.40835 3.40811 8.46025 3.63961 8.49484C3.22572 7.87966 2.98362 7.13968 2.98362 6.34411C2.98362 4.21402 4.71661 2.48104 6.84682 2.48104Z" fill="currentColor"></path>
                </svg> Visit Forums
            </a>
        </div>
    </div>
</section>

<?php get_footer('community') ?>