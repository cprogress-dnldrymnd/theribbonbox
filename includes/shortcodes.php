<?php
function author_bio()
{
    ob_start();
    $article_author = get_field("article_author", get_the_ID());
    $article_author_role = get_field("article_author_role", get_the_ID());
    $article_bio_author_bio = get_field("article_bio_author_bio", get_the_ID());
    $article_author_linkedin_url = get_field("article_author_linkedin_url", get_the_ID());
    $article_author_image = get_field("article_author_image", get_the_ID());
    $placeholder_id = 39014;
    if ($article_author_image) {
        $image_id = $article_author_image;
    } else {
        $image_id = $placeholder_id;
    }
    if ($article_author) {
?>
        <div class="author-bio">
            <div class="author-bio-inner">
                <div class="author-image">
                    <?= wp_get_attachment_image($image_id, 'large') ?>
                </div>
                <div class="author-details">
                    <?php if ($article_author) { ?>
                        <div class="article-author">
                            <?= $article_author ?>
                            <?php if ($article_author_linkedin_url) { ?>
                                <div class="article-author-socials">
                                    <a href="<?= $article_author_role ?>" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                            <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                                        </svg>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if ($article_author_role) { ?>
                        <div class="article-author-role">
                            <?= $article_author_role ?>
                        </div>
                    <?php } ?>
                    <?php if ($article_bio_author_bio) { ?>
                        <div class="article-author-bio">
                            <?= $article_bio_author_bio ?>
                        </div>
                    <?php } ?>

                </div>
            </div>

        </div>
        <?php
    }
    return ob_get_clean();
}
add_shortcode('author_bio', 'author_bio');


function article_partnership()
{
    if (current_user_can('administrator')) {

        ob_start();
        $partnership_name = get_field("partnership_name", get_the_ID());
        $partnership_website = get_field("partnership_website", get_the_ID());
        $partnership_logo = get_field("partnership_logo", get_the_ID());
        $placeholder_id = 39014;
        if ($partnership_logo) {
            $image_id = $partnership_logo;
        } else {
            $image_id = $placeholder_id;
        }
        if ($partnership_name) {
        ?>
            <div class="author-bio">
                <div class="author-bio-inner">
                    <div class="author-image">
                        <?= wp_get_attachment_image($image_id, 'large') ?>
                    </div>
                    <div class="author-details">
                        <?php if ($partnership_name) { ?>
                            <div class="article-author">
                                In partnership with experts from <?= $partnership_name ?>
                                <?php if ($partnership_website) { ?>
                                    <div class="article-author-socials">
                                        <a href="<?= $partnership_website ?>" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                                <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                                            </svg>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>
        <?php
        }
        return ob_get_clean();
    }
}

add_shortcode('article_partnership', 'article_partnership');

function article_medically_reviewed_by()
{
    if (current_user_can('administrator')) {

        ob_start();
        $article_author = get_field("article_author", get_the_ID());
        $article_author_role = get_field("article_author_role", get_the_ID());
        $article_bio_author_bio = get_field("article_bio_author_bio", get_the_ID());
        $article_author_linkedin_url = get_field("article_author_linkedin_url", get_the_ID());
        $article_author_image = get_field("article_author_image", get_the_ID());
        $placeholder_id = 39014;
        if ($article_author_image) {
            $image_id = $article_author_image;
        } else {
            $image_id = $placeholder_id;
        }
        if ($article_author) {
        ?>
            <div class="author-bio">
                <div class="author-bio-inner">
                    <div class="author-image">
                        <?= wp_get_attachment_image($image_id, 'large') ?>
                    </div>
                    <div class="author-details">
                        <?php if ($article_author) { ?>
                            <div class="article-author">
                                <?= $article_author ?>
                                <?php if ($article_author_linkedin_url) { ?>
                                    <div class="article-author-socials">
                                        <a href="<?= $article_author_role ?>" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                                <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                                            </svg>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?php if ($article_author_role) { ?>
                            <div class="article-author-role">
                                <?= $article_author_role ?>
                            </div>
                        <?php } ?>
                        <?php if ($article_bio_author_bio) { ?>
                            <div class="article-author-bio">
                                <?= $article_bio_author_bio ?>
                            </div>
                        <?php } ?>

                    </div>
                </div>

            </div>
    <?php
        }
        return ob_get_clean();
    }
}

add_shortcode('article_medically_reviewed_by', 'article_medically_reviewed_by');

function display_subscribe()
{
    ob_start();
    ?>
    <div id="subscribe-outer" class="post-follow-us insider-outer subscibe-outer subscibe-outerv2">
        <div class="subscribe-outer-close"><img src="<?php echo (get_template_directory_uri()) ?>/images/icons/menu-close.png"></div>
        <div class="post-follow-us-inner">
            <div class="subscribe-outer-img"><img src="<?php echo (get_template_directory_uri()) ?>/images/subscribe-image-ph-1.jpg"></div>
            <div class="subscribe-outer-txt">
                <h2>Become an Insider</h2>
                <div class="cat-links">
                    <a href="/wellbeing">Wellbeing</a> |
                    <a href="/fertility">Fertility</a> |
                    <a href="/pregnancy">Pregnancy</a> |
                    <a href="/parenting">Parenting</a>
                </div>
                <hr>
                <p>Subscribe To Our Weekly Newsletter Of Tailored Expert Advice, Tips And Giveaways - Straight To Your Inbox</p>
                <div class="sub---form">
                    <?php echo do_shortcode('[mc-subscribe-form]'); ?>
                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}

add_shortcode('display_subscribe', 'display_subscribe');
