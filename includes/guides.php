<?php
add_action('wp_ajax_nopriv_buy_now_ajax', 'buy_now_ajax'); // for not logged in users
add_action('wp_ajax_buy_now_ajax', 'buy_now_ajax');
function buy_now_ajax()
{
	$buy_now_id = $_POST['buy_now_id'];
	if ($buy_now_id) {
		global $woocommerce;
		$woocommerce->cart->empty_cart();
		$woocommerce->cart->add_to_cart($buy_now_id);
	}
	die();
}

add_action('wp_ajax_nopriv_e_guides_ajax', 'e_guides_ajax'); // for not logged in users
add_action('wp_ajax_e_guides_ajax', 'e_guides_ajax');
function e_guides_ajax()
{
	$s = isset($_POST['s']) ? $_POST['s'] : false;
	$post_type = isset($_POST['post_type']) ? $_POST['post_type'] : false;
	$product_cat = isset($_POST['product_cat']) ? $_POST['product_cat'] : false;
	$posts_per_page = isset($_POST['posts_per_page']) ? $posts_per_page : 4;



	$args['post_status'] = 'publish';
	$args['post_type'] = $post_type;
	$args['posts_per_page'] = $posts_per_page;

	if ($product_cat) {
		$args['tax_query'][] = array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'term_id',
				'terms' => $product_cat,
			),
		);
	}

	if ($s) {
		$args['s'] = $s;
	}

	$the_query = new WP_Query($args);

	echo '<div class="swiper swiper-post-slider">';
	echo '<div class="row g-4 swiper-wrapper">';
	if ($the_query->have_posts()) {
		while ($the_query->have_posts()) {
			$the_query->the_post();
			echo '<div class="col-lg-6 swiper-slide">';
			echo do_shortcode('[e_guides_post id=' . get_the_ID() . ']');
			echo '</div>';
		}
	} else {
		echo '<div class="col-lg-6">';
		echo "<h2>No results found for $s</h2>";
		echo '</div>';
	}
	echo '</div>';
	echo '<div class="swiper-pagination"></div>';
	echo '</div>';

	wp_reset_postdata();

	/*
	if ($data_val['has_pagination'] == true || $data_val['has_pagination'] == 'true') {
		echo _pagination(true, $the_query, array(
			'url' => $data_val['url'],
			'posts_per_page' => $query_val['posts_per_page'],
			's' => $query_val['s'],
		));
	}*/

	die();
}


function e_guides_post($atts)
{
	ob_start();
	extract(
		shortcode_atts(
			array(
				'id' => '',
			),
			$atts
		)
	);
	$product = wc_get_product($id);
	$terms = get_the_terms($id, 'product_cat');
?>
	<div class="column-holder e-guide-box">
		<div class="image-box">
			<div class="category row">
				<?php foreach ($terms as $term) { ?>
					<?php
					$category_colour = get_field('category_colour', $term);
					?>
					<div class="col-auto <?= $term->slug ?>" style="--color: <?= $category_colour ?>"> <span><?= $term->name ?></span> </div>
				<?php } ?>
			</div>
			<a href="<?= get_permalink($id) ?>">
				<img src="<?= get_the_post_thumbnail_url($id, 'large') ?>" alt="">

			</a>
		</div>
		<div class="content-box position-relative">
			<div class="price">
				<span> <i>Only</i><br>
					<?= $product->get_price_html() ?></span>
			</div>
			<div class="top">
				<small>Trending Now</small>
				<a href="<?= get_permalink($id) ?>">
					<h3><?= $product->get_name() ?></h3>
				</a>
				<div class="excerpt">
					<?= wpautop($product->get_short_description()) ?>
				</div>
			</div>
			<div class="bottom d-flex justify-content-between position-relative">
				<?= create_item_socials_v2(get_permalink($id), get_the_title($id)); ?>

				<div class="row button-group g-3">
					<div class="col-auto button-box button-bordered">
						<a href="?add-to-cart=<?= $id ?>" data-quantity="1" class="add_to_cart_button ajax_add_to_cart" data-product_id="<?= $id ?>" data-product_sku="" aria-label="Add to basket: “<?= $p->post_title ?>”" rel="nofollow" data-success_message="“<?= $p->post_title ?>” has been added to your cart">
							Add to basket
							<span class="spinner"></span>
						</a>
					</div>
					<div class="col-auto button-box button-accent">
						<a href="#" class="buy-now-trigger" buy_now_id="<?= $id ?>">buy now
							<span class="spinner"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	return ob_get_clean();
}

