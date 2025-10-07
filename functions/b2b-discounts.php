<?php

add_shortcode('b2b_discounts', 'b2b_discounts');
function b2b_discounts() {
    $cPage = "";

    if (!empty($attr["page"])){ $cPage = $attr["page"]; }

    $exclude_post_ids = get_excluded_b2b_posts();
    $recent_posts = wp_get_recent_posts(array(
        'post_type'=> 'offer-items',
        'numberposts' => 7, // Number of recent posts thumbnails to display
        'orderby' => 'date',
        'order' => 'desc',
        'post_status' => 'publish', // Show only the published posts
        //'exclude' => $exclude_post_ids
        'meta_key'        => 'b2b_content',
        'meta_value'      => '1',
    ));

    $cnt = 0;

    $rtn = "";

    if ($cPage == ""){
        $rtn .= '<div class="expert-outer"><div class="expert-entry">';
    } else{
        $rtn .= '<div class="expert-outer"><div class="expert-entry">';
    }

    foreach($recent_posts as $post) {
      $p_img = get_the_post_thumbnail_url($post['ID'], 'thumbnail');
      $phone = get_field("phone", $post['ID']);
      $email = get_field("email", $post['ID']);
      $facebook = get_field("facebook", $post['ID']);
      $twitter = get_field("twitter", $post['ID']);
      $linkedin = get_field("linkedin", $post['ID']);
      $ward = get_field("ward", $post['ID']);
      $position = get_field("position", $post['ID']);
      $speciality = get_field("speciality", $post['ID']);

      $categories = get_the_category($post["ID"]);
      // $currentcat = $categories[0]->cat_ID;
      // $currentcatname = $categories[0]->cat_name;

      // $cat_p = get_ancestors( $categories[0]->term_id, 'category' );

      // $termIdVal = 'term_' . $currentcat;

      // if (count($cat_p) > 0){
      //     $termIdVal = 'term_' . $cat_p[0];
      // }

      $bcolour = "#F77D66";

      // if (!empty(get_field("category_colour", $termIdVal))){
      //     $bcolour = get_field("category_colour", $termIdVal);
      // }

      $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
      $addBorder = 'border-top: 5px solid ' . $bcolour . ';';

      $style = "";

      if (!has_post_thumbnail($post['ID'])) {
        $style = 'style="';
        //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
        $iUrl = get_field("post_large_image", $post['ID']);
        $style .= $iUrl;
        $style .= '); background-size:cover; background-position:center;  ' . $addBorder . '"';

      } else {
        $style = 'style="';
        //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
        $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], 'full'));
        $style .= $iUrl;
        $style .= '); background-size:cover; background-position:center;  ' . $addBorder . '"';
      }

      $ex_txt = "";

      $select_competition_date = get_field("offer_expiry_date", $post["ID"]);
      $apply__code = get_field("apply__code", $post["ID"]);
      $website_link = get_field("website_link", $post["ID"]);
      $link = get_permalink($post['ID']);
      $website_link = get_field("website_link", $post["ID"]);
      $new_tab = "";
      if (!empty($website_link)) {
        $link = $website_link;
        $new_tab = "target='_blank'";
      }

      if (!empty($select_competition_date)):
        $today = date("Y-m-d");
        $date = $select_competition_date;
        $time = strtotime($date);
        $newformat = date('Y-m-d', $time);
        $displayformat = date('d-m-Y', $time);
        $displayformatB = date('j M Y', $time);

        $date_txt = "Giveaway Closed: ";

        $live_post = false;

        if ($newformat > $today) {
          $date_txt = "Giveaway Open: ";
          $live_post = true;
        }

        $btn_text = "Buy Now";
        if (!$live_post) {
          $btn_text = "Offer Closed";
        }

        if (!empty($offer_expired_text)):
          $date_txt = $offer_expired_text . " ";
        endif;

        $ex_txt = '<h3 class="date-giveaways">ENTRIES CLOSE ' . $displayformatB . '</h3>';
      endif;

      include get_template_directory() . '/components/posts/discount-carousel.php';

      $displayformatB = date('j M Y', $time);

      $rtn .= '
        <h3 class="date-giveaways">OFFER CLOSE ' . $displayformatB . '</h3>
          <a ' . $new_tab . ' href="' . $link . '">
            <div class="blog-btns">
                <a ' . $new_tab . ' href="' . $link . '">' . $btn_text . '</a>
            </div>
            <hr>
            ' . ($apply__code ? '<h3 style="text-transform:unset; font-weight:500 !important;">Use code <strong>' . $apply__code . '</strong> at checkout</h3>' : '') . '
          </div>
          <div class="listen-btns">
            <a data-code="' . $apply__code . '" ' . $new_tab . ' class="copy-discount" href="' . $link . '">Buy With Discount</a>
          </div>
        </div>
      </div>';

      //$rtn .= '
      //  <div class="offer">
      //    <h3 class="date-giveaways">OFFER CLOSE ' . $displayformatB . '</h3>
      //    <a ' . $new_tab . ' href="' . $link . '">
      //      <div class="blog-btns">
      //          <span ' . $new_tab . ' href="' . $link . '">' . $btn_text . '</span>
      //      </div>
      //      <hr>
      //      <h3 style="text-transform:unset; font-weight:500 !important;">Use code <strong>' . $apply__code . '</strong> at checkout</h3>
      //    </a>
      //    <div class="listen-btns">
      //      <a data-code="' . $apply__code . '" ' . $new_tab . ' class="copy-discount" href="' . $link . '">Buy With Discount</a>
      //    </div>
      //  </div>';
    }
    wp_reset_query();


    $rtn .= '</div></div>';
    $rtn .= "<script type='text/javascript'>
      $(document).ready(function(){
        if ($('.main-content-outer').length > 0){
          $('.expert-entry').slick({
            centerMode: true,
            centerPadding: '60px',
            slidesToShow: 3,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
              {
                breakpoint: 900,
                settings: {
                  centerMode: true,
                  centerPadding: '150px',
                  slidesToShow: 1
                }
              },
              {
                breakpoint: 600,
                settings: {
                  centerMode: true,
                  centerPadding: '40px',
                  slidesToShow: 1
                }
              }
            ]
          });
        }
      });
    </script>"; 

  return $rtn;
}