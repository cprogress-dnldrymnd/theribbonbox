<?php
echo "<!-- index-page-title.php -->";

// If not "Thank you for subscribing." page
// or "Thank you for entering our giveaway." page
if (get_the_ID() != "25547" && get_the_ID() != "25561"){
    echo "<h1>";
}


if (get_post_type( get_the_ID() ) == 'giveaway-items'){
    echo "Giveaways";
} else{
    if (get_the_ID() != "25547" && get_the_ID() != "25561"){
        echo the_title();
    }
}
//echo the_title();

if (get_the_ID() != "25547" && get_the_ID() != "25561"){
  echo "</h1>";
}



// =====================================================================================================================
// The little drop-down menu beside / under the h1, on pages like /wellbeing

$page_id = get_the_ID();

if (   get_the_ID() == "22828"
    || get_the_ID() == "22830"
    || get_the_ID() == "22832"
    || get_the_ID() == "22834"
    || get_the_ID() == "22836"){
    echo "<div class='toggle-submenu-h1'></div>";
    echo "<div class='h1-submenu'>";
    echo "<ul>";

    $this_id = get_the_ID();



    $recent_posts = wp_get_recent_posts(array(
        'post_status' => 'publish', // Show only the published posts
        'post_type' => 'page',
        'post__in' => array(22830, 22832, 22834, 22836)
    ));

    foreach($recent_posts as $post) :
        if ($this_id != $post['ID']){
            echo "<li><a href='".get_permalink($post['ID'])."'>".$post['post_title']."</a></li>";
        }
    endforeach; wp_reset_query();

    echo "</ul>";
    echo "</div>";

    ?>

    <script type="text/javascript">
        if ($(".toggle-submenu-h1").length > 0){
            $(".toggle-submenu-h1").click(function(e){
                $(".h1-submenu").slideToggle();
            });
        }
    </script>

    <?php

}


if (get_the_ID() == "22620" || get_the_ID() == "22659" || get_the_ID() == "22702" || get_the_ID() == "22749"){
    echo "<div class='toggle-submenu-h1'></div>";
    echo "<div class='h1-submenu'>";
    echo "<ul>";

    $this_id = get_the_ID();

    $recent_posts = wp_get_recent_posts(array(
        'post_status' => 'publish', // Show only the published posts
        'post_type' => 'page',
        'post__in' => array(22620, 22659, 22702, 22749)
    ));

    foreach($recent_posts as $post) :
        if ($this_id != $post['ID']){
            echo "<li><a href='".get_permalink($post['ID'])."'>".$post['post_title']."</a></li>";
        }
    endforeach; wp_reset_query();

    echo "</ul>";
    echo "</div>";

    ?>

    <script type="text/javascript">
        if ($(".toggle-submenu-h1").length > 0){
            $(".toggle-submenu-h1").click(function(e){
                $(".h1-submenu").slideToggle();
            });
        }
    </script>

    <?php

}

if (get_the_ID() == "22840" || get_the_ID() == "22842" || get_the_ID() == "22844" || get_post_type( get_the_ID() ) == 'giveaway-items'){
    echo "<div class='toggle-submenu-h1'></div>";
    echo "<div class='h1-submenu'>";
    echo "<ul>";

    $this_id = get_the_ID();

    if (get_post_type( get_the_ID() ) == 'giveaway-items'){
        $this_id = "22840";
    }

    $recent_posts = wp_get_recent_posts(array(
        'post_status' => 'publish', // Show only the published posts
        'post_type' => 'page',
        'post__in' => array(22840, 22842, 22844)
    ));

    foreach($recent_posts as $post) :
        if ($this_id != $post['ID']){
            echo "<li><a href='".get_permalink($post['ID'])."'>".$post['post_title']."</a></li>";
        }
    endforeach; wp_reset_query();

    echo "</ul>";
    echo "</div>";

    ?>

    <script type="text/javascript">
        if ($(".toggle-submenu-h1").length > 0){
            $(".toggle-submenu-h1").click(function(e){
                $(".h1-submenu").slideToggle();
            });
        }
    </script>

    <?php

}
?>
