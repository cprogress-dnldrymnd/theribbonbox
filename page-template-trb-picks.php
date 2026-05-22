<?php
/*-----------------------------------------------------------------------------------*/
/* Template Name: TRB Picks
/* Template Post Type: page
/*-----------------------------------------------------------------------------------*/
?>
<?php get_header() ?>
<style>
    .trb-picks-nav {
        padding-top: 1rem;
        padding-bottom: 1rem;
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

    .page-title h1 {
        font-size: 3rem;
        font-weight: bold;
        color: var(--trb-accent-2);
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
    .post-main-content p, p.text, .expert-inner p, .category-inner-pop-text p, .desc p, .post-excerpt, .bbp-forum-content, .bbp-reply-content p, .bio p, .activity-item p, .blog-l-text p {
        font-size: 1rem;
    }
</style>
<?php get_template_part('sections/navigation') ?>
<?php get_template_part('sections/page-title') ?>
<?php get_footer() ?>