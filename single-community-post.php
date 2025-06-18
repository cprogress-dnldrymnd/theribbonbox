<?php get_header('community') ?>
<main class="main-content-outer">
    <?php while (have_posts()) { ?>
        <?php the_post() ?>
        <?php
        echo '
    <div data-template="index-other-pages.php" class="blog-top-ban blog-top-ban-main-content format-full">
        <!--<img class="blog-l-img" src="/wp-content/themes/lighttheme/images/logo-bl.png">-->
        <div class="blog-l-img">
            <img src="' . get_the_post_thumbnail_url() . '">
        </div>
        <div class="blog-l-text-out" ' . $border . '>
            ' . $featured_cur . '
            <header class="blog-l-text blog-p-text" >
                <h3>' . $currentcatname . '</h3>
                <h1>' . get_the_title($post->ID) . '</h1>
                <p>' . (isset($text) ? $text : '') . '</p>
                <h4>
                    <span itemscope itemtype="https://schema.org/Person">
                        <span itemprop="name" title="' . $author_bio . '">' . $author . '</span>
                        <span description="' . $author_bio . '"></span>
                    </span>
                    ' . get_the_date('j M Y', $post->ID) . '
                </h4>
                <div class="detail-page-socials">' . create_item_socials(get_permalink($post->ID), get_the_title()) . '</div>
            </header>
            <hr class="hr-post">';

        if ($post_type == 'podcasts') {
            $podcast_iframe_code = get_field("podcast_iframe_code", $post->ID);
            if (!empty($podcast_iframe_code) && false) {
                echo '<div class="podcast-iframe-outer">';
                echo $podcast_iframe_code;
                echo '</div>';
            }
        }
        $pagep = "";
        if ($post_type == 'page') {
            $pagep = "page-padding";
        }

        echo '<div class="post-main-content ' . $pagep . '">';
        the_content();

        // get and echo previous and next post in the same category
        $ids = (object) getPrevNextIds();

        echo '
                </div>
                ' . do_shortcode('[author_bio][article_partnership][article_medically_reviewed_by]') . '
                <div class="post-sub">
                   <h3>Want to receive more great articles like this every day? Subscribe to our mailing list</h3>
                   <a href="/subscribe" class="sub-pop-btn">SUBSCRIBE</a>
                </div>
                ' . ($tags_links ? '<p class="tags">Tags: ' . $tags_links . '</p>' : '') . '
                
                ' . get_the_breadcrumb_function($_SERVER['REQUEST_URI'], get_the_title()) . '
                
                <section class="sharing-box">
                    <div class="prev-next">
                        <a rel="prev" href="' . get_permalink($ids->prev) . '">Previous</a>
                        <a rel="next" href="' . get_permalink($ids->next) . '">Next</a>
                    </div>
                
                    <h4>Share This Post</h4>
                    <div class="giveaway-outer-form giveaway-outer giveaway-thanks" style="margin:0;">
                        <div class="giveaway-inner-form giveaway-inner" style="padding:0;">
                         ' . create_item_socials(get_permalink($post->ID), get_the_title()) . '
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>';
        ?>
        <section class="section-comment-form">
            <div class="container">
                <div class="post-comments-single post-comments-single-community">
                    <div class="inner">
                        <?php comments_template(); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
</main>
<?php get_footer('community') ?>