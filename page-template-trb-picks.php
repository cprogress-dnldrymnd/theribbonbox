<?php
/*-----------------------------------------------------------------------------------*/
/* Template Name: TRB Picks
/* Template Post Type: page
/*-----------------------------------------------------------------------------------*/
?>
<?php get_header() ?>
<style>
    :root {
        --trb-green: #034146;
        --trb-wine: #3B1527;
        --trb-coral: #F77D67;
        --trb-petal: #FFDBD1;
    }

    #trb-page hr {
        border-color: #E1E1E1;
        opacity: 1;
    }

    @media (min-width: 1500px) {
        #trb-page .container {
            max-width: 1420px;
        }
    }

    @media (min-width: 1600px) {
        #trb-page .container {
            max-width: 1520px;
        }
    }

    @media (min-width: 1700px) {
        #trb-page .container {
            max-width: 1620px;
        }
    }

    @media (min-width: 1800px) {
        #trb-page .container {
            max-width: 1820px;
        }
    }

    #trb-page h3:not(.product-name) {
        font-weight: bold;
        font-size: 2.625rem;
    }

    .trb-mb-large {
        margin-bottom: 6rem;
    }

    .trb-mt-large {
        margin-top: 6rem;
    }

    .trb-my-large {
        margin-block: 6rem;
    }

    .trb-mb-medium {
        margin-bottom: 3rem;
    }

    .trb-mt-medium {
        margin-top: 3rem;
    }

    .trb-my-medium {
        margin-block: 3rem;
    }

    .trb-green-color {
        color: var(--trb-green);
    }

    .trb-wine-color {
        color: var(--trb-wine);
    }

    .trb-coral-color {
        color: var(--trb-coral);
    }

    .trb-petal-color {
        color: var(--trb-petal) !important;
    }

    .trb-bg-wine {
        background-color: var(--trb-wine);
    }

    .large-heading {
        font-size: clamp(3rem, 5.5vw, 110px);
        font-weight: bold;
    }

    .rounded {
        border-radius: 20px;
    }

    .trb-picks-nav {
        padding-block: 1rem;
    }

    .trb-picks-nav nav {
        float: none;
        background-color: transparent !important;
        box-shadow: none !important;
    }

    .trb-picks-nav nav ul {
        font-family: Work Sans, sans-serif;
        font-size: 15px;
        text-transform: uppercase;
    }

    .picks-nav-title {
        color: #FFDBD1;
    }

    .page-title {
        padding-top: 3rem;
        padding-bottom: 5rem;
    }

    .page-title .inner {
        max-width: 1050px;
    }

    .page-title h1 {
        font-size: 3rem;
        font-weight: bold;
    }

    .page-title .desc {
        font-size: 1.25rem;
        max-width: 700px;
        margin: 0 auto;
    }

    .page-title .woocommerce-breadcrumb {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .post-main-content p,
    p.text,
    .expert-inner p,
    .category-inner-pop-text p,
    .desc p,
    .post-excerpt,
    .bbp-forum-content,
    .bbp-reply-content p,
    .bio p,
    .activity-item p,
    .blog-l-text p {
        font-size: 1rem !important;
    }

    .category-navigation .inner {
        background-color: #EDF7F6;
        ;
        padding-block: clamp(2rem, 4vw, 76px);
    }

    .category-navigation-holder {
        padding-inline: 2rem;
        max-width: 1500px;
    }

    .cat-nav-holder {
        display: flex;
        flex-direction: column;
    }

    .cat-decor {
        font-weight: 600;
        padding-bottom: 1rem;
    }

    .cat-text {
        font-family: Playfair Display, serif;
        font-size: 2rem;
        font-weight: bold;
        border-top: 1px solid var(--trb-green);
        padding-top: 1rem;
    }

    .nav-tabs.nav-tabs {
        margin: 0;
        padding: 0;
        border: none;
        margin-bottom: 1px;
    }

    .nav-tabs.nav-tabs .nav-link {
        border: none;
        padding: 1rem 0;
        border-radius: 0;
        color: var(--trb-wine) !important;
        font-size: 2rem !important;
        font-family: 'Playfair Display', sans-serif;
        font-weight: bold;
        height: auto;
        text-transform: initial;
        border-bottom: 4px solid transparent !important;
        background-color: transparent;
    }
    .nav-tabs.nav-tabs .nav-link.trb-petal-color {
        color: var(--trb-petal) !important;
    }

    .nav-tabs.nav-tabs .nav-link:hover {
        background-color: transparent;
        opacity: 0.7;
    }

    .nav-tabs.nav-tabs .nav-link.active {
        border-color: var(--trb-wine) !important;
    }

    .nav-tabs-holder-inner {
        border-bottom: 1px solid var(--trb-wine);
        margin-bottom: 2rem;
        max-width: calc(100% - 140px);
        margin-inline: auto;
        line-height: 1;
    }



    .nav-tabs-holder .button-box {
        padding-bottom: 1rem;
    }

    .nav-tabs-holder .button-box a {
        color: var(--trb-wine)
    }
</style>
<main id="trb-page">
    <?php get_template_part('sections/navigation') ?>
    <?php get_template_part('sections/page-title') ?>
    <?php get_template_part('sections/category-navigation') ?>
    <?php get_template_part('sections/product-tabs') ?>
    <div class="container">
        <hr>
    </div>
    <?php get_template_part('sections/two-columns') ?>
    <?php get_template_part('sections/product-tabs-2') ?>
    <?php get_template_part('sections/two-columns-2') ?>


</main>

<?php get_footer() ?>