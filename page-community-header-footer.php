<?php
/*-----------------------------------------------------------------------------------*/
/* Template Name: Community Header and Footer
/* Template Post Type: page
/*-----------------------------------------------------------------------------------*/
?>
<?php get_header('community') ?>
<?php
$forums = get_posts(array(
    'post_type' => 'forum',
    'numberposts' => -1
));
?>

  <section class="community-header-footer pt-5 mt-lg-5">
        <div class="container">
            <div class="header-text">
                <div class="page-title-outer">
                    <h1><?php the_title() ?></h1>
                </div>
            </div>
            <div class="not-front page-content-blg page_pageItem">
                <?php the_content() ?>
            </div>
	  </div>
</section>
			
<?php get_footer('community') ?>