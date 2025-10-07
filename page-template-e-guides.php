<?php
/*-----------------------------------------------------------------------------------*/
/* Template Name: E-Guides 
/* Template Post Type: page
/*-----------------------------------------------------------------------------------*/
?>
<?php get_header() ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<section class="e-guides-hero">
    <div class="container">
        <h1>E-Guides</h1>
    </div>
</section>

<section class="two-columns section-padding">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <h2 class="mb-4">
                    <?php the_field('heading') ?>
                </h2>
                <div class="description-box">
                    <?php the_field('description') ?>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="image-box">
                    <img src="<?= wp_get_attachment_image_url(get_field('image'), 'large') ?>"
                        alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$count = 3;
$slides = '<div class="group d-flex align-items-center">';
for ($x = 1; $x <= 4; $x++) {
    $text = get_field("text_$x");
    if ($text) {
        $slides .= "<div class='slide'>";
        $slides .= $text;
        $slides .= "</div>";
    }
}
$slides .= "</div>";

?>
<section class="slider-section">
    <div class="carousel d-flex align-items-center carousel-logo-slider">
        <?= $slides ?>
        <?= $slides ?>
    </div>
</section>

<?php
$prouducts = get_posts(array(
    'post_type' => 'product',
    'numberposts' => -1,
	 'tax_query'      => array(
        array(
            'taxonomy' => 'product_cat', // The slug of your custom taxonomy
            'field'    => 'term_id',           // The field to match the terms by (can be 'term_id', 'name', or 'slug')
            'terms'    => array( 1682 ), // An array of the term slugs to exclude
            'operator' => 'NOT IN',         // The operator to use for the query
        ),
    ),
));

$terms = get_terms(array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => true,
));
?>
<section class="e-guides-archive ajax-loading section-padding" id="e-guides">
    <input type="hidden" id="post_type" name="post-type" value="product">
    <div class="container">
        <div class="search row g-4 justify-content-between">
            <div class="col-12 col-lg-auto">
                <h2><i>Browse</i><br> Our E-Guides</h2>
            </div>
            <div class="col">
                <div class="search-box">
                    <select name="product_cat" id="product_cat">
                        <option value="">Filter by</option>
                        <?php foreach ($terms as $term) { ?>
							<?php if($term->term_id != 1682) { ?>
                            <option value="<?= $term->term_id ?>"> <?= $term->name ?> </option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                    <input type="text" name="s" id="search" class="input-style" placeholder="SEARCH e-guides">
                </div>
            </div>
        </div>
        <div class="results-holder">
            <div class="loading-results p-5 text-center"> <svg class="spin" xmlns="http://www.w3.org/2000/svg" id="Group_27" data-name="Group 27" width="123" height="123" viewBox="0 0 123 123">
                    <g id="Ellipse_2" data-name="Ellipse 2" fill="none" stroke="#034146" stroke-width="2">
                        <circle cx="61.5" cy="61.5" r="61.5" stroke="none"></circle>
                        <circle cx="61.5" cy="61.5" r="60.5" fill="none"></circle>
                    </g>
                    <circle id="Ellipse_8" data-name="Ellipse 8" cx="6.5" cy="6.5" r="6.5" transform="translate(30 55)" fill="none" stroke="#034146" stroke-width="3"></circle>
                    <circle id="Ellipse_9" data-name="Ellipse 9" cx="6.5" cy="6.5" r="6.5" transform="translate(55 55)" fill="none" stroke="#034146" stroke-width="3"></circle>
                    <circle id="Ellipse_10" data-name="Ellipse 10" cx="6.5" cy="6.5" r="6.5" transform="translate(80 55)" fill="none" stroke="#034146" stroke-width="3"></circle>
                </svg></div>
            <div id="results">
                <div class="swiper swiper-post-slider">
                    <div class="row g-4 swiper-wrapper">
                        <?php foreach ($prouducts as $p) { ?>
                            <div class="col-lg-6 swiper-slide">
                                <?= do_shortcode('[e_guides_post id=' . $p->ID . ']') ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </div>
    </div>
</section>

<?= do_shortcode('[display_followus]') ?>
<?php get_footer() ?>