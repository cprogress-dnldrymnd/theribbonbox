<?php
echo "<!-- index-testimonials.php -->";

$args = array( 'post_type' => 'testimonial', 'post_status' => 'publish', 'posts_per_page' => 1000000, 'orderby' => 'post_date',
    'order' => 'DESC',);

$loop = new WP_Query( $args );
echo '<div class="home-test-sec">';
while ( $loop->have_posts() ) : $loop->the_post();
    echo '<div class="hm-test-itm">';
    echo '<img src="/wp-content/themes/lighttheme/images/icons/quote-img.png">';
    echo '<p class="excerpt">' . the_excerpt() . '</p>';
    echo '<p class="title"><strong>' . the_title() . '</strong></p>';
    echo '</div>';
endwhile;
echo '</div>';