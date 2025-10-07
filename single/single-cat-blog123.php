<?php get_header(); ?>
<?php if (has_post_thumbnail( 36 ) ): ?>
<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(36), 'single-post-thumbnail'); ?>
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
                <div class="<?php the_title(); ?>-header <?php echo apply_filters( 'the_title', get_the_title( wp_get_post_parent_id( get_the_ID() ) ) );
?>-header page-header-outer" style="height: 200px !important;">


                    <div class="header-text">
                        <div class="page-title-outer">
                        <h1>Blog</h1>
                        </div>

                    </div>
                    <div class="top-breadcrumb">
                        <div class="breadcrumb-inner">
                            breadcrumb
                        </div>
                    </div>
                </div>
                <div class="page-content" style="padding-top:0 !important;">



<div class='blog-entry Blog-blog content-container unit size3of4'>

<?php 

if (!has_post_thumbnail() ) {
    echo "<div class='post-main-image-blog'>";
    echo "<img style='max-width:300px !important; margin:0 auto;' src='/wp-content/themes/lighttheme/images/logo-bl.png' />";
    echo "</div>";
}
else{
    echo "<div class='post-main-image-blog'>";
    echo the_post_thumbnail();
    echo "</div>";
}
	if ( have_posts() ) : while ( have_posts() ) : the_post();
echo "<h1>";
echo the_title('','',false);
echo "</h1>";
	
		echo '<p class="post-date-detail" style=" font-weight: 600; font-size:1.3em!important;">';
echo get_the_date('F j Y', get_the_ID());
echo "</p>";
echo "<div class='blog-content'>";
the_content();


	echo "</div>";



endwhile; else: ?>
<h1>Oops!</h1>
<p>404. We can't seem to find the page you're looking for.</p>
<?php endif; ?>
<input class="home-btn index-btn-middle" value="↵ Back to Blog" id="catwebformbutton" onclick="window.location.href='/blog'" type="submit">
</div>

<?php 
    if (the_title('','',false) == "Home")
    {
        //include 'banner.php';
    } 

?>

<?php 


?>

</div>

<?php       /*  if (the_title('','',false) != "Contact") {
        echo '<div class="call-to-action">
        <div class="call-to-action-content">
        <p>Contact us now to make a booking.</p>
        <input class="large-button button-center" value="Contact Now" id="catwebformbutton" onclick="window.location.href=&quot;/contact&quot;" type="submit"> 
        </div>
        </div>';
    } */
?>
<?php get_footer(); ?>