<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<div class="<?php the_title(); ?>-header <?php echo apply_filters( 'the_title', get_the_title( wp_get_post_parent_id( get_the_ID() ) ) );
        ?>-header page-header-outer" style="">
    <div class="header-text">
        <div class="page-title-outer">
            <h1>Search Results</h1>
        </div>
    </div>
</div>

<div class='page-content-blg'>

<a class="searchBack" value="Back" href="javascript:history.go(-1)"><button class="mapButtons" style="">← Back</button></a>

<?php if ( have_posts() ) : ?>
    <h2 class="search-page-title"><?php printf( __( 'Search Results for: %s', 'lighttheme' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
<?php else : ?>
    <h2 class="search-page-title"><?php _e( 'Nothing Found', 'lighttheme' ); ?></h2>
<?php endif; ?>


<!--<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">-->

<div class='search-filter-results'>

<?php
if ( have_posts() ) :

        $id_list = "";

        $cnt = 0;

        while ( have_posts() ) : the_post();
            if ($cnt == 0){
                $id_list .= get_the_ID();
            } else{
                $id_list .= "," . get_the_ID();
            }
            $cnt++;
        endwhile; // End of the loop.

        $form_id = $_GET['id'];
        $post_type = "";

        if ($form_id == 23907) {
            //title="Discounts Search"
            $post_type = "offer-items";
        } else if ($form_id == 23880) {
            //title="Giveaways Search"
            $post_type = "giveaway-items";
        } else if ($form_id == 23695) {
            //title="Video Search"
            $post_type = "videos";
        } else if ($form_id == 23692) {
            //title="Podcast Search"
            $post_type = "podcasts";
        } else if ($form_id == 23679) {
            //title="Video & Podcast Search"
            $post_type = "videos/podcasts";
        } else if ($form_id == 23677) {
            //title="Experts Search"
            $post_type = "expert_profiles";
        }
         else if ($form_id == 24727) {
            //title="Events Search"
            $post_type = "events";
        }
         else if ($form_id == 24768) {
            //title="Events Search"
            $post_type = "offer-items/giveaway-items/videos/podcasts/expert_profiles/events/post";
        }

        //echo $post_type;

        if (!empty($form_id) && !empty($id_list)){
            $limit = 100; // 10 * 1000 * 1000 * 1000; // 10000000000;
            echo do_shortcode("[blog_filter format='post-page' post_type='".$post_type."' id_list='".$id_list."' limit='$limit']");
        }

    ?>
    <style type="text/css">
        .searc-pagenav nav{
            left: unset !important;
            border-bottom: none;
            display: block;
            float: none !important;
            background: transparent;
            overflow-y: visible;
            padding-bottom: 0;
            position: relative;
            text-align: right;
            top: 0;
            width: auto;
            z-index: 1;
            /* margin-right: 50px; */
            box-shadow: none !important;
            text-align: center;
        }
    </style>
    <div class="searc-pagenav">
    <?php
    the_posts_pagination( array(
        //'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'lighttheme' ) . '</span>',
        //'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'lighttheme' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
        //'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'lighttheme' ) . ' </span>',
    ) );
    ?>
    </div>
<?php else : ?>
    <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'lighttheme' ); ?></p>
<?php endif; ?>

    <!--</main>-->
    <!--</div>-->
    </div>
</div>

<!-- before footer -->
<?php get_footer(); ?>
<!-- after footer -->


