<?php
/**
 * Template part for displaying posts in archives
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

<!-- content-post.php -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( is_sticky() && is_home() ) :
		//echo twentyseventeen_get_svg( array( 'icon' => 'thumb-tack' ) );
	endif;
	?>

    <?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('post-thumbnail'); ?>
            </a>
        </div><!-- .post-thumbnail -->
    <?php endif; ?>

	<header class="entry-header">
		<?php
		if ( 'post' === get_post_type() ) {
			echo '<div class="entry-meta">';
			echo '</div><!-- .entry-meta -->';
		};

        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_excerpt();

		wp_link_pages( array(
			'before'      => '<div class="page-links">' . __( 'Pages:', 'lighttheme' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php
	if ( is_single() ) {
		entry_footer();
	}
	?>

</article><!-- #post-## -->
