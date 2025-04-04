<style type="text/css">
            .banner-txt-edited h1{
                font-size: 25pt !important;
                line-height: 26pt !important;
            }

                        .banner-txt-edited h2{
                font-size: 22pt !important;
                line-height:23pt !important;
            }


.banner-txt-edited .reg-btn{
        border: 2px solid #fff;
    padding: 0.5em 1.5em;
    margin: 1em;
    display: inline-block;
    color: #fff;
    float: left;
    margin-left: 0;
}

        @media (max-width: 500px){
            .banner-txt-edited h1{
                font-size: 20pt !important;
                line-height: 21pt !important;
            }

                        .banner-txt-edited h2{
                font-size: 16pt !important;
                line-height: 17pt !important;
            }
        }


</style>

<div class="banner-back">


    <div class="banner-container">
        <div class="flexslider slider1 banner">

<?php

   $args = array( 'post_type' => 'banner-gallery', 'post_status' => 'publish', 'posts_per_page' => 1000000, 'orderby' => 'menu_order', 'order' => 'ASC');

            $loop = new WP_Query( $args );
            echo '<ul class="slides">';
            while ( $loop->have_posts() ) : $loop->the_post();

                //$title1 = the_title();
                $video = get_field('video_url', get_the_ID());
                $url_text = get_post_meta( get_the_ID(), 'banner_url_text', true );
                $url = get_post_meta( get_the_ID(), 'banner_url', true );

                $alt_text = get_post_meta( get_the_ID(), 'banner_alt_txt', true );
                $url_text_alt = get_post_meta( get_the_ID(), 'banner_url_text_alt', true );
                $url_alt = get_post_meta( get_the_ID(), 'banner_url_alt', true );

                if (!empty($url) && !empty($url_text)){
                echo '<li class="bannerimg" style="background:url(';
                echo get_the_post_thumbnail_url();
                echo '); background-size:cover; background-position:center top;" data-type="background" data-speed="2">';

                    echo '<a href="'.$url.'" class="banner-a-side">'.$url_text.'</a>';
                    echo '<div class="banner-text">';
                    echo '<div class="banner-txt-inner">';
                    echo '';
                    echo the_content();
                    echo '';
                    echo '</div>';
                    echo '</div>';

                    if (!empty($alt_text) && !empty($url_text_alt) && !empty($url_alt)){
                        /*echo '<div class="home-content home-content-ban">
                            <div class="hp-split"><div class="hp-split-in"></div></div>
                        <div class="home-boxes-outer ban-boxes-outer">

                        <div class="home-boxes">
                            <div class="hm-bx-txt">
                            <h2>'. $alt_text .'</h2>
                            <a href="'. $url_alt .'" class="hm-btn">'. $url_text_alt .'</a>
                            </div>
                        </div>

                        </div>


                        </div>'; */
                    }



                    echo '</li>';
                }
                else{
                echo '<li class="bannerimg" style="background:url(';
                echo get_the_post_thumbnail_url();
                echo '); background-size:cover; background-position:center top;" data-type="background" data-speed="2">';
                    if (!empty($url)){
                        echo '<a class="banner-url" href="';
                        echo $url;
                        echo '" ';
                        echo '>';
                    }

                    if (!empty($video)){
                        echo '<div class="banner-iframe-content"><video playsinline="" autoplay="" muted="" loop="" poster="/wp-content/themes/lighttheme/images/banner-vid-replacement.jpg" id="bgvideo" width="x" height="y"> <source src="'.$video.'" type="video/mp4"></video></div>';
                    }


                    echo '<div class="banner-text">';
                    echo '<div class="banner-txt-inner">';
                    echo '';
                    echo the_content();
                    echo '';
                    echo '</div>';
                    echo '</div>';
                    if (!empty($url)){
                        echo '</a>';
                    }



                    echo '</li>';
                }



            endwhile;

wp_reset_postdata();
?>



</div>
<?php 
/*
$nav = array(
    'post_type' => 'page',
    'orderby' => 'menu_order',
    'numberposts' => 100000,
    'order' => 'ASC',
    'post__in' => array(9,11,13)
    //'post_parent' => $post->ID
);

$child_pages = get_posts($nav);

echo '<div class="hp-mx-wd">';

foreach ($child_pages as $postItm) :
echo '<a href="'.get_permalink($postItm->ID).'" class="oth-strip-itm" style="background:url('.get_the_post_thumbnail_url($postItm->ID).'); background-size: cover; background-position: center;"><img src="/wp-content/themes/lighttheme/images/squ_trans.png"><span class="oth-tl-over"></span><span class="oth-strip-in"><h3>'.$postItm->post_title.'</h3><span class="oth-strip-lnk">Read More</span></span></a>';

endforeach;


echo '</div>';

*/

?>
<!-- <img class="scroll-down" alt="Scroll Down" title="Scroll Down" src="/wp-content/themes/lighttheme/images/icons/scroll-down.png" style="display: none;"> -->
    </div>
</div>



<!-- <script type="text/javascript" src="/wp-content/themes/lighttheme/js/jquery.fancybox.pack.js"></script> -->

<script src="/wp-content/themes/lighttheme/js/jquery.flexslider-min.js"></script>


<!--
<div class="hp-mx-wd hp-mx-wd-mobile">
<?php 

$nav = array(
    'post_type' => 'page',
    'orderby' => 'menu_order',
    'numberposts' => 100000,
    'order' => 'ASC',
    'post__in' => array(9,11,13)
    //'post_parent' => $post->ID
);

$child_pages = get_posts($nav);

echo '<div class="hp-mx-wd">';

foreach ($child_pages as $postItm) :
echo '<a href="'.get_permalink($postItm->ID).'" class="oth-strip-itm" style="background:url('.get_the_post_thumbnail_url($postItm->ID).'); background-size: cover; background-position: center;"><img src="/wp-content/themes/lighttheme/images/squ_trans.png"><span class="oth-tl-over"></span><span class="oth-strip-in"><h3>'.$postItm->post_title.'</h3><span class="oth-strip-lnk">Read More</span></span></a>';

endforeach;


echo '</div>';

?>

</div>

-->

