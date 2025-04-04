<?php
add_shortcode('member-login-button', 'member_login_button_shortcode');
function member_login_button_shortcode(){
  $url = '/customer-login'; //https://theribbonbox.com
  if (is_user_logged_in()) {
    $url = '/b2b-home';
  }
  ob_start();
  ?>
  <div class="vc_btn3-container  b2b-log-in vc_btn3-inline">
    <a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-modern vc_btn3-color-grey"
       href="<?= $url ?>" title="Customer login">
      Member Login</a>
  </div>
  <?php
  return ob_get_clean();
}