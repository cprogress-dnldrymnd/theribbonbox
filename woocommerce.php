<!-- WooCommerce Classic theme integration: woocommerce_content() -->
<!-- This template file needs to live in the theme root. -->
<!-- See https://github.com/woocommerce/woocommerce/blob/trunk/docs/theme-development/classic-theme-developer-handbook.md -->
<?php get_header(); ?>

<?php if (has_post_thumbnail( $post->ID ) ): ?>
    <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>
    <style>
      .page-header-outer {
        background-image: url('<?php echo $image[0]; ?>')!important;
        background-size: cover !important;
        background-position: center !important;

      }
    </style>
<?php else : ?>
    <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->post_parent), 'single-post-thumbnail'); ?>
    <style>
      .page-header-outer {
        background-image: url('<?php echo $image[0]; ?>')!important;
        background-size: cover !important;
        background-position: center !important;
      }
    </style>
<?php endif; ?>

<div class="<?php the_title(); ?>-header
    <?php echo apply_filters( 'the_title', get_the_title( wp_get_post_parent_id( get_the_ID() ) ) ); ?>-header page-header-outer" style="height: 200px !important;">
    <div class="header-text">
        <div class="page-title-outer">
          <h1> <?php woocommerce_page_title(); ?></h1>
        </div>
    </div>
    <div class="top-breadcrumb">
        <div class="breadcrumb-inner">
            breadcrumb
        </div>
    </div>
</div>
<div class="page-content">
  <?php woocommerce_content(); ?>
  <?php /*if (is_product()){

  woocommerce_content();

} else{
  ?>
<div class="store-sidebar">
<h2>Search</h2>
<div class="store-sidebar-close"></div>
<?php 
get_sidebar();
?>
</div>


<div class="store-products">
<?php woocommerce_content(); ?>
</div>
  <?php
  } */ ?>
</div>

<?php get_footer(); ?>