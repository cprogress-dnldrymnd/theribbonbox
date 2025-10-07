    <div class="blog-entry content-container unit size3of4 blog-home-page ">

    <?php
    $recent_posts = wp_get_recent_posts(array(
        'numberposts' => 200, // Number of recent posts thumbnails to display
        'post_status' => 'publish', // Show only the published posts
        'orderby' => 'post_date',
        'order' => 'DESC'
    ));

    $cnt = 0;
    foreach($recent_posts as $post) : ?>

    <?php

        $style = "";

        if (!has_post_thumbnail($post['ID']) ) {
            //echo "<p class="post-image"><img src='/wp-content/themes/lighttheme/images/logo-bl.png' />";
            $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
        }
        else{
            $style = 'style="background:url(';
            $style .= get_the_post_thumbnail_url($post['ID'], 'post-thumbnail');
            $style .= '); background-size:cover; background-position:center;"';;
        }
    ?>

    <?php $cnt = $cnt + 1; ?>
        <div class="post-summary Blog-blog-item">
            <div <?php echo $style; ?> class="blog-post-img">
        <a href="<?php echo get_permalink($post['ID']) ?>" title="Read more about '<?php echo $post['post_title'] ?>'...">
        

            <?php
               /* if (!has_post_thumbnail($post['ID']) ) {
                    //echo "<p class="post-image"><img src='/wp-content/themes/lighttheme/images/logo-bl.png' />";
                    echo '<p class="post-image" style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:contain; background-position:center;">';
                }
                else{
                    echo '<p class="post-image" style="background:url(';
                    echo get_the_post_thumbnail_url($post['ID'], 'post-thumbnail');
                    echo '); background-size:cover; background-position:center;">';;
                } */
            ?>
        

            <img src="/wp-content/themes/lighttheme/images/rec_trans.png">

        </div>

          <div class="blg-dt-out">
      <span><?php echo get_the_date('j', $post["ID"]);?></span>
      <span><?php echo get_the_date('M', $post["ID"]);?></span>
  </div>

        

        <div class="post-text">
            <div class="post-inner">
        <h2 style="margin-bottom: 0.5em;"><?php echo $post['post_title'] ?></h2>
  <!--      <p class="post-date" style=" font-size:0.9em;"><?php echo get_the_date('F j, Y', $post["ID"]);?></p>  -->

        <?php 

                        $html = $post['post_content'];

                        /*$whatIWant = substr($data, strpos($data, "_") + 1);
                        //$end = strpos($html, '.');
                        //echo $end;
                        $paragraph = html_entity_decode(strip_tags($html));
                        $paragraph = substr($paragraph, 0, 300);
                        //$paragraph = html_entity_decode(strip_tags($html));*/

                        $html = html_entity_decode(strip_tags($html));
                        
                        $strArray = explode('.', $html);

                        $paragraph = substr($html, 0, 250);

                        /*$paragraph = "";

                        $cnt = 0; 

                        foreach ($strArray as $value) {
                            if ($cnt <= 3){
                                if ($cnt <= 2){
                                    $paragraph .= $value . '. ';
                                } else{
                                    $paragraph .= $value;
                                }
                            }

                            $cnt = $cnt + 1;
                        }*/

                        echo "<p style='color:#484949; font-size:1.2em;font-weight:300;'>" . $paragraph . "..</p>"; 
                        ?>
            
        


            <p style="text-align: center; margin-top: 1em;"><a class="button-blog-list" href="<?php echo get_permalink($post['ID']) ?>" title="Read more about '<?php echo $post['post_title'] ?>'...">Read More</a></p>
            </a>
            </div>
        
    </div>
    </div>
    <?php endforeach; wp_reset_query(); ?>


    </div>




