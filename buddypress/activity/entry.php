<?php
/**
 * BuddyPress - Activity Stream (Single Item)
 *
 * This template is used by activity-loop.php and AJAX functions to show
 * each activity.
 *
 * @since 3.0.0
 * @version 10.0.0
 */

bp_nouveau_activity_hook( 'before', 'entry' ); ?>

<li  class="<?php bp_activity_css_class(); ?>" id="activity-<?php bp_activity_id(); ?>" <?php bp_nouveau_activity_data_attribute_id(); ?> data-bp-timestamp="<?php bp_nouveau_activity_timestamp(); ?>">

	<div class="activity-avatar item-avatar align-items-center">
		<a class="avatar-wrapper" href="<?php bp_activity_user_link(); ?>">
			<?php bp_activity_avatar( array( 'type' => 'full' ) ); ?>
		</a>
		<div class="right">
			<?php bp_activity_action(); ?>
		</div>
	</div>

	<div class="activity-content">


		<?php if ( bp_nouveau_activity_has_content() ) : ?>

			<div class="activity-inner">

				<?php bp_get_template_part( 'activity/type-parts/content',  bp_activity_type_part() ); ?>

			</div>

		<?php endif; ?>

		<?php bp_nouveau_activity_entry_buttons(); ?>

	</div>

	<?php bp_nouveau_activity_hook( 'before', 'entry_comments' ); ?>

	<?php if ( bp_activity_get_comment_count() || ( is_user_logged_in() && ( bp_activity_can_comment() || bp_is_single_activity() ) ) ) : ?>

		<div class="activity-comments">

			<?php bp_activity_comments(); ?>

			<?php bp_nouveau_activity_comment_form(); ?>

		</div>

	<?php endif; ?>

	<?php bp_nouveau_activity_hook( 'after', 'entry_comments' ); ?>

</li>

<?php
bp_nouveau_activity_hook( 'after', 'entry' );
