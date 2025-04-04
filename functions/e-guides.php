<?php

add_shortcode('display_e_guides', 'e_guides');

function e_guides() {
    $e_guides = get_posts(array(
        'posts_per_page' => 4,
        'post_type' => 'e-guide'
      ));

    ob_start(); ?>

    <section class="e-guides has-v-margins max-width">
        <div class="cols-2">
        <?php foreach($e_guides as $guide) {
            $gallery = get_post_meta($guide->ID, 'preview_image', true);
            preg_match('/\[gallery.*ids=.(.*).\]/', $gallery, $ids);
            $images_id = explode(",", $ids[1]);
            $e_guide_file = get_field('file', $guide->ID);
            $post = get_post($guide->ID); ?>
            <div class="cols-2 e-guide-container">
                <div class="e-guide-img-container splide">
                    <div class="splide__arrows">
                        <button class="splide__arrow splide__arrow--prev">
                            <span class="material-icons">arrow_backward</span>
                        </button>
                        <button class="splide__arrow splide__arrow--next">
                            <span class="material-icons">arrow_forward</span>
                        </button>
                    </div>
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php 
                                foreach ($images_id as $image) {
                                    $image_url = wp_get_attachment_image_src($image, 'large');
                                    ?>
                                    <li class="splide__slide e-guides-slide">
                                    <!-- <a href="<?php echo $image_url[0]; ?>"> -->
                                        <?php echo wp_get_attachment_image($image, 'destinatoin', 'false', array("class" => "img-responsive")); ?>
                                    <!-- </a> -->
                                    </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div>
                    <h3><?php echo get_the_title($guide->ID); ?></h3>
                    <p><?php echo $post->post_content; ?></p>
                    <div class="b2b-cta e-guide-download">
                        <button style="background-color: var(--colour-salmon);"><a href="<?php echo $e_guide_file['url'] ?>" target="_blank">Download</a></button>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </section>
    
    
<?php 
    return ob_get_clean();
}

?>