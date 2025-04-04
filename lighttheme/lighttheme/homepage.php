<?php the_content(); ?>
<div class="loadingnextOuter">
    <a id="loadHome"></a>
</div>

<?php //WPBMap::addAllMappedShortcodes(); ?>

<?php include 'js/home-js.php'; ?>

<?php 

/*echo '<link rel="stylesheet" href="<?php echo(get_template_directory_uri())?>/stylesheet/slick.css">
                                  <link rel="stylesheet" href="<?php echo(get_template_directory_uri())?>/stylesheet/slick-theme.css">
                                  <script src="<?php echo(get_template_directory_uri())?>/js/slick.js"></script>';
*/


/*
$nav = array(
    'post_type' => 'page',
    'orderby' => 'menu_order',
    'numberposts' => 100000,
    'order' => 'ASC',
    'post__in' => array(11,19,21)
    //'post_parent' => $post->ID
);

$child_pages = get_posts($nav);

echo '<div class="hp-mx-wd">';

foreach ($child_pages as $postItm) :
echo '<a href="'.get_permalink($postItm->ID).'" class="oth-strip-itm" style="background:url('.get_the_post_thumbnail_url($postItm->ID).'); background-size: cover; background-position: center;"><img src="<?php echo(get_template_directory_uri())?>/images/squ_trans.png"><span class="oth-tl-over"></span><span class="oth-strip-in"><h3>'.$postItm->post_title.'</h3><span class="oth-strip-lnk">Read More</span></span></a>';

endforeach;


//$h_content = get_the_content();


echo '</div>';

<div class="home-content">
    <div class="home-boxes-outer">
        <div class="hm-cont-itm">
            <?php the_content(); ?>
        </div>
    </div>
</div>


<?php echo do_shortcode( '[hp_blog]' );; ?>
<?php echo do_shortcode( '[people_list]' );; ?>
<div class="home-topics-outer" style="background:url(<?php echo get_the_post_thumbnail_url(); ?>); background-position:center; background-size: cover;">
    <div class="home-topics-inner">
        <div class="home-topics-txt"></div>
    </div>
</div>

*/
?>

