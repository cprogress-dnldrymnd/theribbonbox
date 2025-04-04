<!DOCTYPE html>
<html lang="en" style="margin-top: 0 !important;">
<?php require 'head.php'; ?>
<?php
if(is_page(41256)) {
  echo '<style id="nav-styles">';
  $menuLocations = get_nav_menu_locations();
  $menuID = $menuLocations['header-menu'];
  $primaryNav = wp_get_nav_menu_items($menuID); 
  foreach($primaryNav as $nav) {
    $id =  $nav->object_id;
    $icon = get_field('icon', $id);
    if($icon) {
      $url = $icon['url'];
      echo 'a[pageid="'.$id.'"]:before { ';
      echo 'content: "";';
      echo 'background-image: url('.$url.');';
      echo '}';
    }
  }
  echo '</style>';

}
?>
<?php global $wp; ?>
<body data-path="<?= $wp->request ?>" <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PJH7VBG"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
	
    <div id="fouc">
        <div class="site-wrap">
            <div id="menu-posts" style="display: none;">
                <?php //echo do_shortcode("[get_category_posts_nav]"); ?>
            </div>
            <header id="header-main-site" role="banner" style="background: rgba(255, 255, 255, 0.22);">
                <?php
                    echo '<div class="header-ad">';
                    echo do_shortcode("[ad_list]");
                    echo '</div>';
                ?>

                <div class="head-inner">
                    <div class="head-sub">
                        <a href="#" class="show-search"><img src="<?php echo(get_template_directory_uri())?>/images/search.png"><span>SEARCH</span></a>
                        <a href="/subscribe" class="sub-pop-btn"><img src="<?php echo(get_template_directory_uri())?>/images/subscribe.png"><span>SUBSCRIBE</span></a>
                        <a href="/community"><img src="<?php echo(get_template_directory_uri())?>/images/account.png"><span>LOG IN</span></a>
                </div>

                    <!--<a href="tel:+440000000" style="display: none !important;">
                        <table class="phone-head">
                            <tbody><tr>
                                <td>
                                    <img style="height:20px; width:20px;" alt="phone" src="<?php echo(get_template_directory_uri())?>/images/icons/phone.png">
                                </td>
                                <td style="vertical-align: middle;">
                                    <span>00000 000 000</span>
                                </td>
                                </tr>
                        </tbody></table>
                    </a>-->
                    <img class="m-menu" src="<?php echo(get_template_directory_uri())?>/images/icons/menu.png">
                    <a class="logo-h-a" href="/">
                        <img class="logo" src="<?php echo(get_template_directory_uri())?>/images/logo-hdr-7.png">
                    </a>


                    <!-- <div class="head-acc">
                        <a href="/community"><img src="<?php echo(get_template_directory_uri())?>/images/account.png"><span>LOG IN / COMMUNITY</span></a>
                        <a href="/" class="show-search"><img src="<?php echo(get_template_directory_uri())?>/images/search.png"><span>SEARCH</span></a>
                    </div> -->

              
					 <div class="head-acc header-ribbon-v2">
						 <a href="/community"><span>Community</span></a>
					</div>
					

                    <!--<div class="social-icons">
                    <a href="/" target="_blank" class="facebook"></a>
                    <a href="/" target="_blank" class="twitter"></a>
                    <a href="/" target="_blank" class="instagram"></a>
                    <a href="/" target="_blank" class="youtube"></a>
                    <a href="/" target="_blank" class="linkedin"></a>
                    </div>-->
                </div>

                <nav>
                    <a class="mobile-nav-subscibe sub-pop-btn" href="">Sign up for our weekly newsletter</a>
                    <div class="header-search header-search-mobile">
						<div class="header-search-inner header-search-inner-mobile">
							<?php echo do_shortcode('[ivory-search id="24768" title="Search All Content"]'); ?>
							<img id="h-search-close" class="h-search-close" src="<?php echo(get_template_directory_uri())?>/images/icons/menu-close.png">
						</div>
                    </div>
                    <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
                    <div class="navigation-footer-sec">
                        <div class="footer-links">
                            <?php
                                wp_nav_menu( array( 'menu' => 'FooterMenu') );
                            ?>
                        </div>
                        <div class="follow-mm-head">
                            FOLLOW US
                            <?php echo do_shortcode("[get_socials]"); ?>
                            <span>© <?php echo date("Y"); ?> EDINGTON MEDIA LIMITED</span>
                        </div>
                    </div>
                </nav>
                <?php
                    echo '<script type="text/javascript">
                    var ajaxurl = "' . admin_url('admin-ajax.php') . '";
                    </script>';
                ?>

                <div class="header-search header-search-v2 ?>">
                    <div class="header-search-inner">
                        <?php 
							echo do_shortcode('[ivory-search id="24768" title="Search All Content"]');
						?>
                        <img id="h-search-close1" class="h-search-close" src="<?php echo(get_template_directory_uri())?>/images/icons/menu-close.png">
                    </div>
                </div>

                <script id="recent-posts-json" type="text/javascript" defer>
                    const recentPostsJson = <?php echo do_shortcode("[get_category_posts_nav_new]"); ?>;
                    console.log('recentPostsJson:', recentPostsJson);
                </script>
                <script src='<?php echo(get_template_directory_uri())?>/js/header.js'></script>
            </header>
            <main class="main-content-outer">
                <div class="messages">
                    <?php
                    $messages = get_transient( 'messages' );
                    if (is_array($messages)) {
                        foreach ($messages as $message) : ?>
                            <p class="msg <?= $message->type ?>"><?= $message->text ?></p>
                        <?php endforeach;
                        delete_transient('messages');
                    }
                    ?>
                </div>