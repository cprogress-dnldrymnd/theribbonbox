<!-- index-alt-post-types-header.php -->
<?php $raw_page_title = apply_filters( 'the_title', get_the_title( wp_get_post_parent_id( get_the_ID() ) ) ); ?>

<div class="<?php the_title(); ?>-header <?php echo $raw_page_title; ?>-header page-header-outer" style="">
    <div class="header-text">
        <div class="page-title-outer">
            <?php include 'index-page-title.php'; ?>
        </div>
    </div>
</div>
<?php /*<div class="top-breadcrumb">
                <div class="breadcrumb-inner">breadcrumb</div>
            </div> */?>
<?php