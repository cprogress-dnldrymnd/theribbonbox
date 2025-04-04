<?php

add_shortcode('experts_slide', 'experts_slide');

function experts_slide() {
    $args = get_posts(array(
        'post_type'      => 'expert_profiles',
        'posts_per_page' => 3,
        'orderby' => 'DESC'
      ));
      //$loop = new WP_Query($args);
    
      ob_start(); ?>
    
      <section class="splide">
        <h1>Test</h1>
        <div class="splide__track">
          <ul class="splide__list">
            <?php foreach ($args as $testimonial) :
              //var_dump($testimonial->ID); 
              $expert_image = get_field('expert_image', $testimonial->ID);
              $expert_testimonial = get_field('expert_testimonial', $testimonial->ID);?>
              <li class="splide__slide experts-slide">
                <div>
                  <img src="<?php print $expert_image['url'] ?>" class="light-text"></img>
                </div>
                <div>
                  <p class="light-text"><?php print $expert_testimonial; ?></p>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </section>
    <?php return ob_get_clean();
}

?>