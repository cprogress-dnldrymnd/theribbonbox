<?php
/*-----------------------------------------------------------------------------------*/
/* Template Name: Page Builder
/* Template Post Type: page
/*-----------------------------------------------------------------------------------*/
?>
<?php get_header() ?>
<main id="trb-page-builder">
    <?php trb_render_builder_sections(get_the_ID()) ?>
</main>
<?php get_footer() ?>
