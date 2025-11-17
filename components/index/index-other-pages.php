<?php
/**
 * Used for "post" type detail pages (and possibly other types)
 */
//html comments remove by dd
//echo "<!-- index-other-pages.php -->";

//var_dump(get_the_ID());
//var_dump($post->ID);

$author = "";

$post_type = get_post_type( get_the_ID() );

//$this_post = get_queried_object(); // $post
//d($this_post);
//var_dump($this_post->ID);

if ($post_type == 'post'){
    $article_author = get_field("article_author", $post->ID);
    $article_author_role = get_field("article_author_role", $post->ID);
    if ( !empty($article_author)){
        $author = $article_author;
        if($article_author_role) {
            $author .= ', '.$article_author_role;
        }
        $author .=" &nbsp;&nbsp;|&nbsp;&nbsp;";

    } else {
        $author = get_the_author() . "&nbsp;&nbsp;|&nbsp;&nbsp;";
    }
}
if ($post_type == 'videos'){
    $article_author = get_field("article_author", $post->ID);
    if ( !empty($article_author)){
        $author .= "" . $article_author . "&nbsp;&nbsp;|&nbsp;&nbsp; ";
    }

    $guest_name = get_field("guest_name", $post->ID);
    if ( !empty($guest_name)){
        $author .= "FEATURING " . $guest_name . "&nbsp;&nbsp;|&nbsp;&nbsp;";
    }
}

$queried_post = get_post(get_the_ID());

$author_bio = get_the_author_meta( 'user_description', $queried_post->post_author );

//display post tags
$separate_meta = __(', ');
$tags_links = get_the_tag_list('', $separate_meta);


// echo '
//<div class="blog-top-ban blog-top-ban-main-content">
//<div class="blog-l-img" '.$style.'>
//  <img src="/wp-content/themes/lighttheme/images/menu-trans-req.png">
//</div>
//<div class="blog-l-text-out" '.$border.'>
//'.$featured_cur.'
//<div class="blog-l-text blog-p-text" >
//<h3>'.$currentcatname.'</h3>
//<h1>'.get_the_title().'</h1>
//<p>'.$text.'</p><h4>'.$author.get_the_date('j M Y', $post->ID).'</h4><div class="detail-page-socials">'. create_item_socials(get_permalink($post->ID), get_the_title()).'</div><hr class="hr-post">';

if(current_user_can('administrator')) { ?>
Note: This new hero is visible only for admin
<style>
    .post-hero-content {
        padding: 40px;
    }
    .post-hero-content h1 ,.post-hero-content .woocommerce-breadcrumb.woocommerce-breadcrumb a {
        color: inherit;
    }
    .post-hero-content h1 {
        text-align: left;
        font-size: 69px;
        margin-top: 0;
        font-weight: bold;
        line-height: 1.1;
        margin-bottom: 30px;
    }
    .post-image img {
        height: 100%;
        object-fit: cover;
    }
    .author-bio-v2 .author-bio-inner .author-image {
        width: 63px;
    }
    .author-bio-v2 .author-bio-inner .author-image img {
        width: 63px !important;
        height: 63px;
    }
    .author-bio-v2 .author-bio-inner .author-details{
        display: flex;
        padding: 0;
    }
    .date {
        text-transform: uppercase;
    }
    .dot.dot {
        border-radius: 50%;
        background-color: #F77D67;
        width: 5px;
        height: 5px;
    }
    .author-date {
        margin-top: 30px;
        margin-bottom: 30px;
    }
    .author-bio-v2 .author-bio-inner {
        gap: 16px;
    }
    .post-categories {
        gap: 13px;
    }
    .post-categories a {
        font-family: 'Playfair Display';
        font-size: 17px;
        font-weight: bold;
        padding: 7px 18px;
        border-radius: 50px;
        color: #3B1527;
        background-color: #F77D67;
        line-height: 1;
    }
    .share-post {
        margin-top: 30px;
    }
    .share-post svg{
        color: #FFDBD1;
        width: 17px;
        height: 17px;
    }
</style>
<div class="post-hero" style="background-color: #3B1527; color: #FFDBD1">
    <div class="container-fluid g-0 p-0">
        <div class="row g-0">
            <div class="col-lg-6 d-flex  align-items-center">
                <div class="post-hero-content">
                    <div class="breadcrumbs-v2">
                        <?= woocommerce_breadcrumb(); ?>
                    </div>
                    <div class="post-title">
                        <h1>
                            <?php the_title() ?>
                        </h1>
                    </div>
                    <div class="post-excerpt">
                        <?php the_excerpt() ?>
                    </div>
                    <div class="author-date d-flex gap-3 align-items-center">
                        <?= do_shortcode('[author_bio_v2]') ?>
                        <div class="dot"></div>
                        <div class="date">
                            <?php the_date() ?>
                        </div>
                    </div>
                    <div class="post-categories d-flex flex-wrap">
                        <?=  get_post_categories_as_links(get_the_ID()) ?>
                    </div>
                    <div class="share-post d-flex align-items-center gap-3">
                        <div>SHARE</div>
                        <div class="dot"></div>
                        <?= create_item_socials_v3(get_the_permalink(), get_the_title()) ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="post-image image-box h-100">
                    <?= get_the_post_thumbnail(get_the_ID(), 'large') ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
echo '
    <div data-template="index-other-pages.php" class="blog-top-ban blog-top-ban-main-content format-full">
        <!--<img class="blog-l-img" src="/wp-content/themes/lighttheme/images/logo-bl.png">-->
        <div class="blog-l-img">
            <img src="' . $iUrl . '">
        </div>
        <div class="blog-l-text-out" '.$border.'>
            '.$featured_cur.'
            <header class="blog-l-text blog-p-text" >
                <h3>'.$currentcatname.'</h3>
                <h1>'.get_the_title($post->ID).'</h1>
                <p>'. (isset($text) ? $text : '') .'</p>
                <h4>
                    <span itemscope itemtype="https://schema.org/Person">
                        <span itemprop="name" title="' . $author_bio . '">'. $author .'</span>
                        <span description="'. $author_bio .'"></span>
                    </span>
                    '.get_the_date('j M Y', $post->ID).'
                </h4>
                <div class="detail-page-socials">'. create_item_socials(get_permalink($post->ID), get_the_title()).'</div>
            </header>
            <hr class="hr-post">';

            if ($post_type == 'podcasts'){
                $podcast_iframe_code = get_field("podcast_iframe_code", $post->ID);
                if ( !empty($podcast_iframe_code) && false){
                    echo '<div class="podcast-iframe-outer">';
                    echo $podcast_iframe_code;
                    echo '</div>';
                }
            }
            $pagep = "";
            if ($post_type == 'page'){
                $pagep = "page-padding";
            }

            echo '<div class="post-main-content '.$pagep.'">';
            the_content();

            // get and echo previous and next post in the same category
            $ids = (object) getPrevNextIds();
$author_bio = do_shortcode('[author_bio]');
$article_partnership = do_shortcode('[article_partnership]');
$article_medically_reviewed_by = do_shortcode('[article_medically_reviewed_by]');
			if($author_bio || $article_partnership || $article_medically_reviewed_by) {
				$post_footer_info = '<div class="post--footer-info">'.$author_bio.$article_partnership.$article_medically_reviewed_by.'</div>';
			} else {
				$post_footer_info = '';
}
            echo '
                </div>
              '.$post_footer_info.' 
                <div class="post-sub">
                   <h3>Want to receive more great articles like this every day? Subscribe to our mailing list</h3>
                   <a href="/subscribe" class="sub-pop-btn">SUBSCRIBE</a>
                </div>
                ' . ($tags_links ? '<p class="tags">Tags: '.$tags_links.'</p>' : '') . '
                
                '.get_the_breadcrumb_function($_SERVER['REQUEST_URI'], get_the_title()).'
                
                <section class="sharing-box">
                    <div class="prev-next">
                        <a rel="prev" href="' . get_permalink($ids->prev) . '">Previous</a>
                        <a rel="next" href="' . get_permalink($ids->next) . '">Next</a>
                    </div>
                
                    <h4>Share This Post</h4>
                    <div class="giveaway-outer-form giveaway-outer giveaway-thanks" style="margin:0;">
                        <div class="giveaway-inner-form giveaway-inner" style="padding:0;">
                         '. create_item_socials(get_permalink($post->ID), get_the_title()).'
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>';

        //echo $_SERVER['REQUEST_URI'];



        echo do_shortcode("[display_followus]");

        //WPBMap::addAllMappedShortcodes();
            // Load more post on scroll - dd
       // echo '<div class="loadingnextOuter sdsds"><a id="loadNext" onclick="return false;" data-posttype="'.$post_type.'" data-exclude="'.$post->ID.'" data-categoryid="'.$categories[0]->term_id.'" class="loadmore"></a></div>';


        //echo '<script type="text/javascript">
        //var ajaxurl = "' . admin_url('admin-ajax.php') . '";
        // </script>';
        ?>
    <script type="text/javascript">

        function changeurl(url, title) {
            var new_url = '/' + url;
            window.history.pushState('data', title, new_url);

        }

        var loadingItem1 = false;


        $(window).scroll(function() {
            if ($('#loadNext').length > 0){
                var coverageAreaTriggered = false;
                if (!coverageAreaTriggered ){
                    var scrollTop = $(window).scrollTop(),
                        windowHeight = $(window).height(),
                        elem = $('#loadNext').offset().top,
                        final = elem - windowHeight,
                        distance = final - scrollTop;
                    if (distance < 0 && !loadingItem1) {
                        loadingItem1 = true;
                        //$('#loadNext').click();
                        LoadNextFun();
                        coverageAreaTriggered = true;
                    }
                }
            }

            if ($(".blog-postitem").length > 0){
                $(".blog-postitem").each(function(e){
                    //var coverageAreaTriggered1 = false;
                    //if (!coverageAreaTriggered1 ){
                    var scrollTop1 = $(window).scrollTop(),
                        windowHeight1 = $(window).height(),
                        elem1 = $(this).offset().top,
                        final1 = elem1 - windowHeight1,
                        distance1 = final1 - scrollTop1;
                    if (distance1 < 0) {
                        //$('#loadNext').click();
                        //alert($(this).attr("data-posturl"));
                        //changeurl($(this).attr("data-posturl"), "aaa");
                        var url = $(this).attr("data-posturl");
                        var new_url = url;
                        window.history.pushState('data', new_url, new_url);
                        //coverageAreaTriggered1 = true;
                    }
                    //}
                });

            }
        });

        //$('body').on('click', '#loadNext', function(e){
        function LoadNextFun(){
            //alert("here");

            var curItm = $('#loadNext');
            var curEx = $('#loadNext').attr("data-exclude");
            var curCat = $('#loadNext').attr("data-categoryid");
            var curPosttype = $('#loadNext').attr("data-posttype");

            //e.preventDefault();
            var data = {
                'action': 'blog_load_post_function',
                'categoryid':curCat,
                'posttype':curPosttype,
                'excludeids':curEx,
            };

            // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
            jQuery.post(ajaxurl, data, function(response) {
                //$(".complete-pop-outer").css("display", "");
                $(curItm).parent(".loadingnextOuter").html(response);
                $(curItm).remove();

                loadingItem1 = false;

                <?php //WPBMap::addAllMappedShortcodes(); ?>
                //$(".complete-pop-outer").css("display", "block");
                //alert(response);
            });
        }
        //});
    </script>

<?php