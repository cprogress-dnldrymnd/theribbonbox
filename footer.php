</main>
<?php
global $theme_logo;
?>
<footer class="footer-v2 trb-bg-lightyellow">
  <div class="footer-top trb-px">
    <div class="container-fluid">
      <div class="row g-3">
        <div class="col-lg-6 col-md-8">
          <div class="left-footer">
            <h2>Become an insider</h2>
            <p>
              Sign up to our weekly fertility, wellbeing and pregnancy/early parenting newsletters, and get the best curated expert advice, tips and giveaways straight to your inbox.
            </p>
            <div class="button-accent-2 mt-4">
              <a href="#" class="newsletter-trigger">SIGN ME UP</a>
            </div>
            <div class="footer-logo-text my-5">
              <div class="row g-3 align-items-center">
                <div class="col-lg-3">
                  <a href="<?= get_site_url() ?>">
                    <?= $theme_logo ?>
                  </a>
                </div>
                <div class="col-lg-9">
                  <p>
                    By your side through the highs and lows of preconception, pregnancy and parenthood.
                  </p>
                </div>
              </div>
            </div>
            <div class="social-holder mt-4">
              <?php echo do_shortcode("[get_socials]"); ?>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-4">
          <div class="right-footer ms-0 ms-md-auto mt-4 mt-md-0">
            <div class="row g-3">
              <div class="col-6">
                <?php wp_nav_menu(array('menu' => 'Footer Menu V2 Left')); ?>
              </div>
              <div class="col-6">
                <?php wp_nav_menu(array('menu' => 'FooterMenu')); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom trb-border-top trb-px mt-4 py-4">
    <div class="container-fluid">
      <p>
        © 2026 Edington Media Ltd
      </p>
    </div>
  </div>
</footer>
</div><!-- Close: .site-wrap -->


<?php
global $theme_option_page;
$home_section_discover_links = get_field('home_section_discover_links', $theme_option_page);

$subscribe_popup_heading = get_field('subscribe_popup_heading', $theme_option_page);
$subscribe_popup_description = get_field('subscribe_popup_description', $theme_option_page);
$subscribe_popup_links = get_field('subscribe_popup_links', $theme_option_page);

$subscribe_popup_image = get_field('subscribe_popup_image', $theme_option_page);
$subscribe_popup_form = get_field('subscribe_popup_form', $theme_option_page);

$subscribe_popup__heading_colour = get_field('subscribe_popup__heading_colour', $theme_option_page);
$subscribe_popup_description_colour = get_field('subscribe_popup_description_colour', $theme_option_page);
$subscribe_popup_links_colour = get_field('subscribe_popup_links_colour', $theme_option_page);
$subscribe_popup_form_colour = get_field('subscribe_popup_form_colour', $theme_option_page);
$subscribe_popup_bg_colour = get_field('subscribe_popup_bg_colour', $theme_option_page);

?>
<div id="subscribe-outer" class="post-follow-us insider-outer subscibe-outer" style="background-color: <?= $subscribe_popup_bg_colour ?>">
  <div class="subscribe-outer-close"><img src="<?php echo (get_template_directory_uri()) ?>/images/icons/menu-close.png" alt="Close"></div>
  <div class="post-follow-us-inner">
    <div class="subscribe-outer-img"><img src="<?= wp_get_attachment_image_url($subscribe_popup_image, 'large') ?>" alt="Subscribe"></div>
    <div class="subscribe-outer-txt">
      <h2 style="color: <?= $subscribe_popup__heading_colour ?> !important"><?= $subscribe_popup_heading ?> </h2>
      <div class="cat-links">
        <?php foreach ($subscribe_popup_links as $link) { ?>
          <?php
          $page_id = url_to_postid($link);
          $url = get_permalink($page_id);
          $title = get_the_title($page_id);
          ?>
          <a href="<?= $url ?>" style="color: <?= $subscribe_popup_links_colour ?> !important"><?= $title ?></a> |
        <?php } ?>

      </div>
      <hr>
      <div id="subscribe-outer-desc" style="color: <?= $subscribe_popup_description_colour ?> !important">
        <?= wpautop($subscribe_popup_description) ?>
      </div>
      <div class="sub---form" style="--color: <?= $subscribe_popup_form_colour ?> !important">
        <?= do_shortcode($subscribe_popup_form); ?>
      </div>
    </div>
  </div>
</div>


<?php if (current_user_can('administrator')) { ?>

  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#SignUpModal">
    Launch demo modal
  </button>

  <!-- Modal -->
  <div class="modal fade" id="SignUpModal" tabindex="-1" aria-labelledby="SignUpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="SignUpModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="background-color: <?= $subscribe_popup_bg_colour ?>">

          <div class="row g-0">
            <div class="col-lg-6">
              <div class="image-box">
                <img src="<?= wp_get_attachment_image_url($subscribe_popup_image, 'large') ?>" alt="Subscribe">
              </div>
            </div>
            <div class="col-lg-6 p-3 p-lg-4 d-flex align-items-center">
              <div class="content-box">
                <h2 style="color: <?= $subscribe_popup__heading_colour ?> !important"><?= $subscribe_popup_heading ?> </h2>
                <div class="discovery-links discovery-links-v2">
                  <?php foreach ($home_section_discover_links as $term) { ?>
                    <?php
                    $page_category = get_field('page_category', $term->taxonomy . '_' . $term->term_id);
                    $category_colour = get_field('category_colour', $term->taxonomy . '_' . $term->term_id);
                    $category_text_color = get_field('category_text_color', $term->taxonomy . '_' . $term->term_id);
                    $page_link = get_the_permalink($page_category[0]);
                    ?>

                    <a href="<?= $page_link ?>" style="--bg-color: <?= $category_colour ?>; --text-color: <?= $category_text_color ?>">
                      <?= $term->name ?>
                    </a>
                  <?php } ?>
                </div>


                <div id="subscribe-outer-desc" style="color: <?= $subscribe_popup_description_colour ?> !important">
                  <?= wpautop($subscribe_popup_description) ?>
                </div>

                <div class="sub---form" style="--color: <?= $subscribe_popup_form_colour ?> !important">
                  <?= do_shortcode($subscribe_popup_form); ?>
                </div>

              </div>
            </div>
          </div>
        </div>



      </div>
    </div>
  </div>
  </div>
<?php } ?>


<?php wp_footer(); ?>

</div><!-- Close: #fouc -->
<script>
  jQuery(window).scroll(function(event) {
    var scroll = jQuery(window).scrollTop();

    if (scroll > 100) {
      jQuery('.ads--v2').addClass('hide--ad');
    } else {
      jQuery('.ads--v2').removeClass('hide--ad');
    }
    // Do something
  });
  var offCanvasMenu = document.getElementById('offCanvasMenu')
  offCanvasMenu.addEventListener('show.bs.offcanvas', function() {
    jQuery('body').addClass('mobile-menu-active');
  });

  offCanvasMenu.addEventListener('hide.bs.offcanvas', function() {
    jQuery('body').removeClass('mobile-menu-active');

  });

  jQuery(document).ready(function() {
    $height = jQuery('#header-main-site').outerHeight();
    jQuery('body').css('--header-height', $height + 'px');

    jQuery(document).on('click', '.newsletter-trigger', function(e) {
      e.preventDefault(); // Good practice to put this first to prevent default jump immediately
      jQuery('#subscribe-outer').show();
      if (window.innerWidth < 1001) {
        jQuery('button[data-bs-target="#offCanvasMenu"]').click();

      }
    });

    jQuery('.subscribe-outer-close').click(function(e) {
      jQuery('#subscribe-outer').hide();
      e.preventDefault();

    });
  });
</script>

<script src="<?php echo (get_template_directory_uri()) ?>/js/javascript3.js"></script>

<?php if (is_front_page()) {
  $_SESSION['homepage_array'] = "";
} ?>

</body>

</html>