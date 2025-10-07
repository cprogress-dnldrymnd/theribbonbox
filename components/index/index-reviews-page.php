<?php
//html comments remove by dd
//echo "<!-- index-reviews-page.php -->";

$recent_posts = wp_get_recent_posts(array(
    'post_type'=> 'reviews',
    'numberposts' => 100000, // Number of recent posts thumbnails to display
    'orderby' => 'id',
    'order' => 'ASC',
    'post_status' => 'publish' // Show only the published posts
));

echo '<div class="reviews-outer"><ul>';

foreach($recent_posts as $post) :
    echo '<li>';
    echo '<div class="pub-item-rating" style="backface-visibility: hidden;">'
        . '<img title="Star" alt="Star" src="/wp-content/themes/lighttheme/images/icons/star.png" draggable="false" style="backface-visibility: hidden;">'
        . '<img title="Star" alt="Star" src="/wp-content/themes/lighttheme/images/icons/star.png" draggable="false" style="backface-visibility: hidden;">'
        . '<img title="Star" alt="Star" src="/wp-content/themes/lighttheme/images/icons/star.png" draggable="false" style="backface-visibility: hidden;">'
        . '<img title="Star" alt="Star" src="/wp-content/themes/lighttheme/images/icons/star.png" draggable="false" style="backface-visibility: hidden;">'
        . '<img title="Grey Star" alt="Grey Star" src="/wp-content/themes/lighttheme/images/icons/star.png" draggable="false" style="backface-visibility: hidden;">'
        .'</div>';
    echo '<span><p class="post-content">' . $post['post_content'] . '</p></span>';
    echo '<p><strong>' . $post['post_title'] . '</strong></p>';
    echo '</li>';
endforeach;
wp_reset_query();
echo '</ul></div>';