
<?php

        $args = array(
            'post_parent' => '0',
            'post_type' => 'page',
            'orderby' => 'menu_order'
        );

        $parent_query = new WP_Query( $args );

        echo '<div class="page-content">';  
        echo '<ul class="sitemap">'; 

        while ( $parent_query->have_posts() ) : $parent_query->the_post();

            ?>

<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

    <?php 
            $args1 = array(
            'post_parent' => get_the_ID(),
            'post_type' => 'page',
           
        );

        $child_query = new WP_Query( $args1 );

        if ($child_query->found_posts > 0){
        echo '<ul>'; 

        while ( $child_query->have_posts() ) : $child_query->the_post();
            ?>

            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

    <?php 
        endwhile;
        echo '</ul>';
        

        wp_reset_postdata();
    }

    ?>

</li>

<?php

    endwhile;
    echo '</ul>';
    echo '</div>';

    wp_reset_postdata();


    ?>