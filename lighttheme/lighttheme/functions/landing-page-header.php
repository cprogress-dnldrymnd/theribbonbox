<?php

add_shortcode('b2b_header', 'b2b_header');

function b2b_header() {
    $current_user = wp_get_current_user();
    $user_profile_photo = get_avatar_url($current_user->ID);
    $profile_edit_url = admin_url('user-edit.php?user_id=' . $current_user->ID);
    $partner = user_get_partner($current_user);
    $partner_logo = get_field('logo', $partner->ID);
    ob_start();
    ?>

    <div class="b2b-home-header">
        <? if (is_user_logged_in()): ?>
        <img src="<?php echo $partner_logo['url'] ?>">
        <div class="user-profile">
            <div class="user-pic-container">
                <img class="profile-pic" src="<?php echo $user_profile_photo?>">
            </div>
            <div class="user-acc">
                <p><?php echo $current_user->display_name; ?></p>
                <div class="user-info">
                    <!--<a href="<?php /*echo $profile_edit_url*/?>">Edit Profile</a>-->
                    <a href="<?php echo wp_logout_url()?>">Logout</a>
                </div>
            </div>
        </div>
        <? else: ?>
        <p class="login">
            <a class="btn" href="/customer-login">Login</a>
        </p>
        <? endif; ?>
    </div>

    <?php return ob_get_clean(); 
}

