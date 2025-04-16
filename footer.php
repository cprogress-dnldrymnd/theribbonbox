<?php /* <div id="subscribe-outer" class="post-follow-us insider-outer subscibe-outer">
                        <div class="subscribe-outer-close"><img src="<?php echo(get_template_directory_uri())?>/images/icons/menu-close.png"></div>
                        <div class="post-follow-us-inner">
                            <div class="subscribe-outer-img"><img src="<?php echo(get_template_directory_uri())?>/images/subscribe-image-ph-1.jpg"></div>
                            <div class="subscribe-outer-txt">
                                <h2>Become an Insider</h2>
                                <div class="cat-links">
                                    <a href="/wellbeing">Wellbeing</a> |
                                    <a href="/fertility">Fertility</a> |
                                    <a href="/pregnancy">Pregnancy</a> |
                                    <a href="/parenting">Parenting</a>
                                </div>
                                <hr>
                                <p>Subscribe To Our Weekly Newsletter Of Tailored Expert Advice, Tips And Giveaways - Straight To Your Inbox</p>
                                <?php if( function_exists("wd_form_maker") ) { wd_form_maker(7, "embedded"); } ?>
                            </div>
                                </div>
                    </div>
                    */ ?>
<?php
global $theme_option_page;
$subscribe_popup_heading = get_field('subscribe_popup_heading', $theme_option_page);
$subscribe_popup_description = get_field('subscribe_popup_description', $theme_option_page);
$subscribe_popup_links = get_field('subscribe_popup_links', $theme_option_page);
$subscribe_popup_image = get_field('subscribe_popup_image', $theme_option_page);
$subscribe_popup_form = get_field('subscribe_popup_form', $theme_option_page);
?>
<div id="subscribe-outer" class="post-follow-us insider-outer subscibe-outer">
  <div class="subscribe-outer-close"><img src="<?php echo (get_template_directory_uri()) ?>/images/icons/menu-close.png"></div>
  <div class="post-follow-us-inner">
    <div class="subscribe-outer-img"><img src="<?= wp_get_attachment_image_url($subscribe_popup_image, 'large') ?>"></div>
    <div class="subscribe-outer-txt">
      <h2><?= $subscribe_popup_heading ?> </h2>
      <div class="cat-links">
        <?php foreach ($subscribe_popup_links as $link) { ?>
          <?php
          $page_id = url_to_postid($link);
          $url = get_permalink($page_id);
          $title = get_the_title($page_id);
          ?>
          <a href="<?= $url ?>"><?= $title ?></a> |
        <?php } ?>
  
      </div>
      <hr>
      <?= wpautop($subscribe_popup_description) ?>
      <div class="sub---form">
        <?= do_shortcode($subscribe_popup_form); ?>
      </div>
    </div>
  </div>
</div>

<?php
$today = date('Ymd');
$args = [
  'numberposts' => 1, // Number of recent posts thumbnails to display
  'post_status' => 'publish', // Show only the published posts
  'orderby' => 'rand',
  'post_type' => 'giveaway-items',
  'meta_query' => [
    [
      'key'     => 'featured',
      'value'   => '1',
      'compare' => '='
    ],
    [
      'key' => 'select_competition_date',
      'value' => $today,
      'compare' => '>=',
      'type' => 'DATE'
    ],
  ],
];
$recent_posts = wp_get_recent_posts($args);
//d(count($recent_posts));
//d($recent_posts);
?>

<?php if (count($recent_posts)): ?>
  <div id="giveaway-pop-outer">
    <div class="giveaway-outer-close" style="z-index: 1;"><img src="<?php echo (get_template_directory_uri()) ?>/images/icons/menu-close.png"></div>
    <!--<div class="dont-show-again"><input type="checkbox" id="dsa" name="dsa" /> <label for="dsa">Don't show again</label></div>-->
    <div class="giveaway-pop-inner-top"><img src="<?php echo (get_template_directory_uri()) ?>/images/arch.png">
      <h2>WIN</h2>
    </div>
    <div class="giveaway-pop-inner">
      <?php
      ob_start();
      foreach ($recent_posts as $post) : ?>
        <?php $img_url = get_the_post_thumbnail_url($post['ID'], 'thumbnail') ?>

        <h3><?= $post['post_title'] ?></h3>
        <div style='background:url(<?= $img_url ?>); background-size:cover; background-position:center;'>
          <div class='give-border'>
            <img src='<?php echo (get_template_directory_uri()) ?>/images/vid_req.png'>
          </div>
        </div><br>
        <a class="button-expert" href="<?= get_permalink($post['ID']) ?>" title="Read more about '<?= $post['post_title'] ?>">ENTER NOW</a>
      <?php endforeach;
      print ob_get_clean();
      wp_reset_query();
      ?>
    </div>
  </div>
<?php endif; ?>

<script src="<?= get_template_directory_uri() ?>/js/footer.js"></script>

<div class="floating-footer">
  <div class="footer-links">
    <?php wp_nav_menu(array('menu' => 'FooterMenu')); ?>
  </div>
  <span style="padding: 6px 0 0 6px; font-size: 8pt"> © <?php echo date("Y"); ?> EDINGTON MEDIA LIMITED</span>
</div>

<?php
if (get_the_ID() != "22808" && get_the_ID() != "22810" && get_the_ID() != "22812" && get_the_ID() != "22814" && get_the_ID() != "22816" && get_the_ID() != "22818" && get_the_ID() != "22826" && get_page_template_slug() != 'page-template-e-guides.php') {
  echo '<div class="footer-insider">';
  echo do_shortcode("[display_insider]");
  echo '</div>';
}
?>

<div class="footer-outer" id="footer">
  <footer>
    <table>
      <tr>
        <td>
          <h3 class="footer-ttl" style="margin-top: 0 !important;">By your side through the highs and lows of preconception, pregnancy and parenthood.</h3>
          <a href="/"><img class="footerlogo" src="<?php echo (get_template_directory_uri()) ?>/images/logo-hdr-7.png"> </a>
        </td>
        <td>
          <div class="footer-links footer-desk">
            <?php wp_nav_menu(array('menu' => 'FooterMenu')); ?>
          </div>
          <div class="footer-mobile">
            FOLLOW US
            <?php echo do_shortcode("[get_socials]"); ?>
          </div>
        </td>
      </tr>
      <tr class="footer-desk">
        <td>
          FOLLOW US
          <?php echo do_shortcode("[get_socials]"); ?>
        </td>
        <td>
          <span>© <?php echo date("Y"); ?> EDINGTON MEDIA LIMITED</span>
        </td>
      </tr>
      <tr class="footer-mobile">
        <td>
          <div class="footer-links">
            <?php wp_nav_menu(array('menu' => 'FooterMenu')); ?>
          </div>
          <span style="font-size:8pt;padding-left:6px">© <?php echo date("Y"); ?> EDINGTON MEDIA LIMITED</span>
        </td>
      </tr>
    </table>
  </footer>
</div><!-- Close: .footer-outer -->

<div class="back-to-top button">
  <!--<img src="<?php /*echo(get_template_directory_uri())*/ ?>/images/back-to-top-n.png">-->
  <img src="<?php echo (get_template_directory_uri()); ?>/images/up-arrow.svg">
</div>

</div>
</main>

</div><!-- Close: .site-wrap -->

<?php wp_footer(); ?>

</div><!-- Close: #fouc -->

<!--
    <script type="text/javascript" src="<?php echo (get_template_directory_uri()) ?>/js/jquery.fancybox.pack.js"></script>
    <script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>
    <script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
    -->

<script src="<?php echo (get_template_directory_uri()) ?>/js/javascript2.js"></script>

<?php if (is_front_page()) {
  $_SESSION['homepage_array'] = "";
} ?>

</body>

</html>