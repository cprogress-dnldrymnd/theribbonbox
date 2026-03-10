<?php get_header('v2') ?>
<?php
$forums = get_posts(array(
    'post_type' => 'forum',
    'numberposts' => -1
));
?>

<?php get_footer('v2') ?>