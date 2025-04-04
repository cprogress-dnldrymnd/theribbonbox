<?php
echo "<!-- index-portfolio-list.php -->";

$portfolio_logo = get_field("portfolio_logo", get_the_ID());

echo '<div class="side-part-info no-bdr">';

if (!empty($portfolio_logo)){
    echo '<img class="side-logo" src="' . $portfolio_logo . '" alt="'.$pdf_download_1_title.'" />';
}

$term =get_the_terms( get_the_ID(), 'portfolio_categories');
//print_r($term);
//$term_id = $term->term_id;
$names  = wp_list_pluck( $term, 'term_id' );

$output = implode( ', ', $names );
//echo $output;

if (count($names) > 0){
    echo '<h3>Related Projects</h3>';

    echo do_shortcode("[related_portfolio_filter_list category='".$output."' current_id='".get_the_ID()."']");
    //print_r($names);
}


echo '</div>';


/*$portfolio_logo = get_field("portfolio_logo", get_the_ID());
$pdf_download_1_title = get_field("pdf_download_1_title", get_the_ID());
$pdf_download_1_image = get_field("pdf_download_1_image", get_the_ID());
$pdf_download_1 = get_field("pdf_download_1", get_the_ID());

$pdf_download_2_title = get_field("pdf_download_2_title", get_the_ID());
$pdf_download_2_image = get_field("pdf_download_2_image", get_the_ID());
$pdf_download_2 = get_field("pdf_download_2", get_the_ID());

$pdf_download_3_title = get_field("pdf_download_3_title", get_the_ID());
$pdf_download_3_image = get_field("pdf_download_3_image", get_the_ID());
$pdf_download_3 = get_field("pdf_download_3", get_the_ID());

$pdf_download_4_title = get_field("pdf_download_4_title", get_the_ID());
$pdf_download_4_image = get_field("pdf_download_4_image", get_the_ID());
$pdf_download_4 = get_field("pdf_download_4", get_the_ID());

$pdf_download_5_title = get_field("pdf_download_5_title", get_the_ID());
$pdf_download_5_image = get_field("pdf_download_5_image", get_the_ID());
$pdf_download_5 = get_field("pdf_download_5", get_the_ID());

  echo '<div class="side-part-info no-bdr">';
  if (!empty($portfolio_logo)){
    echo '<img src="' . $portfolio_logo . '" alt="'.$pdf_download_1_title.'" />';
  }
  echo '<div class="awards-cta-inner1 btn-download1">';
if (!empty($pdf_download_1_title) && !empty($pdf_download_1) && !empty($pdf_download_1_image)){

  echo '<a target="_blank" href="'.$pdf_download_1.'" title="Download '.$pdf_download_1_title.' PDF"><table class="dl-table"><tr><td><div class="dl-img" style="background:url('.$pdf_download_1_image.');"><img src="/wp-content/themes/lighttheme/images/icons/square-png.png"></div></td><td>'.$pdf_download_1_title.'</td></tr></table><div class="download-overlay"></div></a>';
}
if (!empty($pdf_download_2_title) && !empty($pdf_download_2) && !empty($pdf_download_2_image)){

  echo '<a target="_blank" href="'.$pdf_download_2.'" title="Download '.$pdf_download_2_title.' PDF"><table class="dl-table"><tr><td><div class="dl-img" style="background:url('.$pdf_download_2_image.');"><img src="/wp-content/themes/lighttheme/images/icons/square-png.png"></div></td><td>'.$pdf_download_2_title.'</td></tr></table><div class="download-overlay"></div></a>';
}
if (!empty($pdf_download_3_title) && !empty($pdf_download_3) && !empty($pdf_download_3_image)){

  echo '<a target="_blank" href="'.$pdf_download_3.'" title="Download '.$pdf_download_3_title.' PDF"><table class="dl-table"><tr><td><div class="dl-img" style="background:url('.$pdf_download_3_image.');"><img src="/wp-content/themes/lighttheme/images/icons/square-png.png"></div></td><td>'.$pdf_download_3_title.'</td></tr></table><div class="download-overlay"></div></a>';
}
if (!empty($pdf_download_4_title) && !empty($pdf_download_4) && !empty($pdf_download_4_image)){

  echo '<a target="_blank" href="'.$pdf_download_4.'" title="Download '.$pdf_download_4_title.' PDF"><table class="dl-table"><tr><td><div class="dl-img" style="background:url('.$pdf_download_4_image.');"><img src="/wp-content/themes/lighttheme/images/icons/square-png.png"></div></td><td>'.$pdf_download_4_title.'</td></tr></table><div class="download-overlay"></div></a>';
}
if (!empty($pdf_download_5_title) && !empty($pdf_download_5) && !empty($pdf_download_5_image)){

  echo '<a target="_blank" href="'.$pdf_download_5.'" title="Download '.$pdf_download_5_title.' PDF"><table class="dl-table"><tr><td><div class="dl-img" style="background:url('.$pdf_download_5_image.');"><img src="/wp-content/themes/lighttheme/images/icons/square-png.png"></div></td><td>'.$pdf_download_5_title.'</td></tr></table><div class="download-overlay"></div></a>';
}
echo '</div></div>';

*/

?>

    <style type="text/css">
        #menu-mainmenu > li:nth-child(3) > a{
            background: #0088a5 !important;
            color: #fff !important;
        }
    </style>

<?php