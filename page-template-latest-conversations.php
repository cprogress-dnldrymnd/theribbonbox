<?php
/*-----------------------------------------------------------------------------------*/
/* Template Name: Latest Conversations 
/* Template Post Type: page
/*-----------------------------------------------------------------------------------*/
?>
<?php get_header('community') ?>

<?php
$terms = get_terms(array(
    'taxonomy' => 'community-post-category',
    'parent'   => 0,
    'hide_empty' => false
));
?>
    <section class="title-section py-5">
        <div class="container text-center">
            <h2 class="mb-4 fs-32">
                <i>Latest</i> Conversations
            </h2>
            <div class="blog-filter category-holder row justify-content-center align-items-center g-3">
                <div class="search-box col-lg-4">
                    <input type="text" name="s" id="search" class="input-style" placeholder="SEARCH topics & discussions....">
                    <div class="filter-by ms-3">
                        Filter by
                    </div>
                </div>
                <div class="col-auto">
                    <div class="row justify-content-center">
                        <?php foreach ($terms as $term) { ?>
                            <?php
                            $category_colour = get_field('blog_cat_community_bg_color', $term);
                            ?>
                            <div class="col-auto <?= $term->slug ?>" style="--color: <?= $category_colour ?>">
                                <a href="?category=<?= $term->slug ?>">
                                    <span><?= $term->name ?></span>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="blogs ajax-loading">
        <input type="hidden" id="post_type" name="post-type" value="community-post">
        <div class="container">
            <div class="results-holder">
                <div class="loading-results p-5 text-center"> <svg class="spin" xmlns="http://www.w3.org/2000/svg" id="Group_27" data-name="Group 27" width="123" height="123" viewBox="0 0 123 123">
                        <g id="Ellipse_2" data-name="Ellipse 2" fill="none" stroke="#034146" stroke-width="2">
                            <circle cx="61.5" cy="61.5" r="61.5" stroke="none"></circle>
                            <circle cx="61.5" cy="61.5" r="60.5" fill="none"></circle>
                        </g>
                        <circle id="Ellipse_8" data-name="Ellipse 8" cx="6.5" cy="6.5" r="6.5" transform="translate(30 55)" fill="none" stroke="#034146" stroke-width="3"></circle>
                        <circle id="Ellipse_9" data-name="Ellipse 9" cx="6.5" cy="6.5" r="6.5" transform="translate(55 55)" fill="none" stroke="#034146" stroke-width="3"></circle>
                        <circle id="Ellipse_10" data-name="Ellipse 10" cx="6.5" cy="6.5" r="6.5" transform="translate(80 55)" fill="none" stroke="#034146" stroke-width="3"></circle>
                    </svg></div>
                <div id="results">
                    <?= do_shortcode('[blogs]') ?>
                </div>
            </div>
        </div>
    </section>


    <?php if (is_user_logged_in()) { ?>
        <section class="friends mt-5">
            <div class="container">
                <h2>Active Friends</h2>
                <?= do_shortcode('[friends]') ?>
            </div>
        </section>
    <?php } ?>

<?php get_footer('community') ?>