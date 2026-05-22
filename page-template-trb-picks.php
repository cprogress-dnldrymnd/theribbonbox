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
</style>
<?php get_template_part('sections/navigation') ?>
<?php get_template_part('sections/page-title') ?>
<?php get_footer() ?>