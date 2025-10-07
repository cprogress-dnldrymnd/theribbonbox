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