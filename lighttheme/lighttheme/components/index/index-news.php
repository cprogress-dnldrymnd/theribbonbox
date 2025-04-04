<?php
echo "<!-- index-news.php -->";

if ( empty( get_the_content() ) ){
    echo '<div class="blog-lst-outer mind-bread">';
} else{
    echo '<div class="blog-lst-outer">';
}
echo do_shortcode("[blog_list]");

echo '<div class="end"></div>';
echo '</div>';