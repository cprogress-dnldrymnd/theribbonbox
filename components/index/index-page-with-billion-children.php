<?php
echo "<!-- index-page-with-billion-children.php -->";

$args = array(
    'post_parent' => $post->ID,
    'post_type' => 'page',
    'orderby' => 'menu_order'
);

$child_query = new WP_Query( $args );

echo '<div class="backline-section page-content" style="    padding-top: 2.5em !important;">';
echo '<div class="home-blog-list-inner">';

while ( $child_query->have_posts() ) : $child_query->the_post(); ?>

    <a href="<?php the_permalink(); ?>" class="first-item" style="background:#dedede url(<?php if (!has_post_thumbnail() ) { echo '/wp-content/themes/lighttheme/images/home-grid/logo_grey.png';} else { echo get_the_post_thumbnail_url('full');} ?>); background-size:cover; background-position:center;">
        <div class="sec-overlay">
            <div class="sec-overlay-content">
                <table>
                    <tbody><tr>
                        <td><h3>Learn More</h3></td>
                        <td><a class="read-more-blog" href="<?php the_permalink(); ?>" title="Learn more about <?php the_title(); ?>">Learn More</a>
                        </td>
                    </tr>
                    </tbody></table>
            </div>
        </div>
        <img src="/wp-content/themes/lighttheme/images/trans-square.png"> <span><?php the_title(); ?></span>
    </a>

<?php endwhile;
echo '</div>';
echo '</div>';
wp_reset_postdata();