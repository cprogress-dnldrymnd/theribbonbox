<?php
/*-----------------------------------------------------------------------------------*/
/* Template Name: Default Template V2
/* Template Post Type: page
/*-----------------------------------------------------------------------------------*/
?>
<?php get_header() ?>
<?php
$forums = get_posts(array(
    'post_type' => 'forum',
    'numberposts' => -1
));
?>

<main class="main-content-outer">
	<div class="header-text">
        <div class="page-title-outer">
          <h1><?php the_title() ?></h1>        
		</div>
    </div>
	<div class="not-front page-content-blg page_pageItem">
		<?php the_content() ?>
	</div>
</main>
<?php get_footer() ?>