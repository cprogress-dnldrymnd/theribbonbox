<?php

add_shortcode('expert_list', 'expert_list_function');
function expert_list_function($attr)
{

    $categoryid = '';
    $spotlight = "";

    if (!empty($attr["categoryid"])) {
        $categoryid = $attr["categoryid"];
    }
    if (!empty($attr["spotlight"])) {
        $spotlight = $attr["spotlight"];
    }


    $cnt = 0;

    $rtn = "";

    $isPage = false;
    if (!empty($attr["page"])) {
        $isPage = true;
    }

    $title = "";
    if (!empty($attr["title"])) {
        $title = $attr["title"];
    }



    $recent_posts;

    if (!empty($categoryid)) {

        //firstly, load data for your child category
        $child = get_category($categoryid);

        //from your child category, grab parent ID
        $parent = $child->parent;

        //load object for parent category
        $parent_name = get_category($parent);

        if (!empty($parent_name->parent)) {
            $parent = $parent_name->parent;
            $parent_name = get_category($parent_name->parent);
        }

        //grab a category name
        $parent_name = $parent_name->name ?? null;

        if (!empty($parent)) {
            $categoryid = $parent;

            $title = $parent_name . " Experts";
        }



        if (!empty($attr["spotlight"])) {
            $recent_posts = wp_get_recent_posts(array(
                'post_type' => 'expert_profiles',
                'numberposts' => 100000, // Number of recent posts thumbnails to display
                'orderby' => 'id',
                'order' => 'ASC',
                'post_status' => 'publish', // Show only the published posts
                'category'         => $categoryid,
                'meta_query' => array(
                    array(
                        'key'     => 'featured_expert',
                        'value'   => 'Yes',
                        'compare' => 'LIKE'
                    )
                ),
            ));
        } else {
            $recent_posts = wp_get_recent_posts(array(
                'post_type' => 'expert_profiles',
                'numberposts' => 100000, // Number of recent posts thumbnails to display
                'orderby' => 'id',
                'order' => 'ASC',
                'post_status' => 'publish', // Show only the published posts
                'category'         => $categoryid,
                /*'meta_query' => array(
                    array(
                        'key'     => 'featured_expert',
                        'value'   => 'Yes',
                        'compare' => 'LIKE'
                    )),*/
            ));
        }
    } else {

        $recent_posts = wp_get_recent_posts(array(
            'post_type' => 'expert_profiles',
            'numberposts' => 100000, // Number of recent posts thumbnails to display
            'orderby' => 'id',
            'order' => 'ASC',
            'post_status' => 'publish', // Show only the published posts
            'meta_query' => array(
                array(
                    'key'     => 'featured_expert',
                    'value'   => 'Yes',
                    'compare' => 'LIKE'
                )
            ),
        ));
    }







    if (!empty($attr["title"])) {
        $rtn .= '<div class="expert-outer">';
        $rtn .= '<div class="experts-naviagtion">';
        $rtn .= '<h2>' . $title . '</h2>';
        $rtn .= '<div class="swiper-navigation"> <div class="swiper-button-prev-experts"><svg xmlns="http://www.w3.org/2000/svg" id="Component_3_1" data-name="Component 3 – 1" width="53" height="53" viewBox="0 0 53 53"> <g id="Group_42" data-name="Group 42" transform="translate(924 4312) rotate(180)"> <g id="Ellipse_2" data-name="Ellipse 2" transform="translate(871 4259)" fill="none" stroke="#ffdbd1" stroke-width="1"> <circle cx="26.5" cy="26.5" r="26.5" stroke="none" /> <circle cx="26.5" cy="26.5" r="26" fill="none" /> </g> <path id="Path_28" data-name="Path 28" d="M4756.17,1529.5l12.3,12.3-12.3,12.3" transform="translate(-3862.67 2743.696)" fill="#ffdbd1" /> </g> </svg> </div> <div class="swiper-button-next-experts"><svg xmlns="http://www.w3.org/2000/svg" width="53" height="53" viewBox="0 0 53 53"> <g id="Group_41" data-name="Group 41" transform="translate(-871 -4259)"> <g id="Ellipse_2" data-name="Ellipse 2" transform="translate(871 4259)" fill="none" stroke="#ffdbd1" stroke-width="1"> <circle cx="26.5" cy="26.5" r="26.5" stroke="none" /> <circle cx="26.5" cy="26.5" r="26" fill="none" /> </g> <path id="Path_28" data-name="Path 28" d="M4756.17,1529.5l12.3,12.3-12.3,12.3" transform="translate(-3862.67 2743.696)" fill="#ffdbd1" /> </g> </svg> </div> </div>';
        $rtn .= '</div>';
        $rtn .= '<div class="expert-entry">';
    } else {
        if ($isPage) {
            $rtn .= '<div class="expert-outer"><div class="expert-entry">';
        } else {
            $rtn .= '<div class="expert-outer"><h2>Wellbeing & Fertility Experts</h2><div class="expert-entry">';
        }
    }

    $rtn .= '<div class="swiper swiper-experts">';
    $rtn .= '<div class="swiper-wrapper">';




    foreach ($recent_posts as $post) :
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
        $currentcat = $categories[0]->cat_ID;
        $currentcatname = $categories[0]->cat_name;
        $currentcatslug = $categories[0]->slug;

        $cat_p = get_ancestors($categories[0]->term_id, 'category');

        if (!empty($categoryid)) {
            $term1 = get_term_by('id', $categoryid, 'category');
            $currentcat = $categoryid;
            $currentcatname = $term1->name;
            $currentcatslug = $term1->slug;
            //$termIdVal = 'term_' . $categoryid;
            //$categories = get_category($termIdVal);
            $cat_p = get_ancestors($categoryid, 'category');
        }

        $termIdVal = 'term_' . $currentcat;

        if (count($cat_p) > 0) {
            $termIdVal = 'term_' . $cat_p[0];
        }


        $bcolour = "#F77D66";

        if (!empty(get_field("category_colour", $termIdVal))) {
            $bcolour = get_field("category_colour", $termIdVal);
        }

        $border = 'style="position:relative; border-top: 5px solid ' . $bcolour . ';"';
        $addBorder = 'border-top: 5px solid ' . $bcolour . ';';

        ////

        /* $bcolour = "#F77D66";

         if (!empty(get_field("category_colour", $currentcat))){
             $bcolour = get_field("category_colour", $currentcat);
         }

         $border = 'style="position:relative; border-top: 5px solid '.$bcolour.';"';
         $addBorder = 'border-top: 5px solid '.$bcolour.';';

         */

        $socials = '';

        if (!empty($phone)) {
            $socials .= '<a href="tel:' . $phone . '"><img src="/wp-content/themes/lighttheme/images/icons/phone.png"></a>';
        }
        if (!empty($email)) {
            $socials .= '<a href="mailto:' . $email . '"><img src="/wp-content/themes/lighttheme/images/icons/email.png"></a>';
        }
        if (!empty($facebook)) {
            $socials .= '<a target="_blank" href="' . $facebook . '"><img src="/wp-content/themes/lighttheme/images/icons/facebook-dark.png"></a>';
        }
        if (!empty($twitter)) {
            $socials .= '<a target="_blank" href="' . $twitter . '"><img src="/wp-content/themes/lighttheme/images/icons/twitter-dark.png"></a>';
        }
        if (!empty($linkedin)) {
            $socials .= '<a target="_blank" href="' . $linkedin . '"><img src="/wp-content/themes/lighttheme/images/icons/linkedin-dark.png"></a>';
        }

        $style = "";

        $partner_inner_banner = get_field("partner_inner_banner", $post['ID']);

        if (!has_post_thumbnail($post['ID'])) {
            if (!empty($partner_inner_banner)) {
                $image = get_field("partner_inner_banner", $post['ID']);
                $size = 'large';
                $img_url = $image['sizes'][$size];
                $style = 'style="';
                //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');

                $iUrl = $img_url;
                $style .= $iUrl;
                $style .= '); background-size:cover; background-position:center; ' . $addBorder . '"';
            }
        } else {
            $style = 'style="';
            //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
            $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], 'full'));
            $style .= $iUrl;
            $style .= '); background-size:cover; background-position:center;  ' . $addBorder . '"';
        }





        $featured_podcast = get_field("promo_podcast", $post['ID']);
        $featured_video = get_field("featured_podcast_video", $post['ID']);
        $featured_giveaway = get_field("featured", $post['ID']);
        $featured_expert = get_field("featured_expert", $post['ID']);

        $featured_cur = "";
        if ($bcolour == "#034146") {
            $ad = 'class="light-text"';
            $addd = "light-text";
        } else {
            $ad = "";
            $addd = "";
        }

        if (!empty($featured_expert)) {
            $featured_cur = '<div class="featured-sign spotlight-sign" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Spotlight</span> Experts</p></div>';
        }

        $post_sticker = get_field("post_sticker", $post["ID"]);

        if (!empty($post_sticker)) {
            if ($post_sticker == "Trending Wellbeing") {
                $currentcat = 1159;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }

                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }

                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Trending</span> Wellbeing</p></div>';
            }
            if ($post_sticker == "Trending Fertility") {
                $currentcat = 1164;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }

                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Trending</span> Fertility</p></div>';
            }
            if ($post_sticker == "Trending Pregnancy") {
                $currentcat = 1165;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }

                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Trending</span> Pregnancy</p></div>';
            }
            if ($post_sticker == "Trending Parenting") {
                $currentcat = 1163;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Trending</span> Parenting</p></div>';
            }
            if ($post_sticker == "Latest Wellbeing") {
                $currentcat = 1159;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Latest</span> Wellbeing</p></div>';
            }
            if ($post_sticker == "Latest Fertility") {
                $currentcat = 1164;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Latest</span> Fertility</p></div>';
            }
            if ($post_sticker == "Latest Pregnancy") {
                $currentcat = 1165;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Latest</span> Pregnancy</p></div>';
            }
            if ($post_sticker == "Latest Parenting") {
                $currentcat = 1163;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Latest</span> Parenting</p></div>';
            }
            if ($post_sticker == "Handpicked Wellbeing") {
                $currentcat = 1159;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Handpicked</span> Wellbeing</p></div>';
            }
            if ($post_sticker == "Handpicked Fertility") {
                $currentcat = 1164;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Handpicked</span> Fertility</p></div>';
            }
            if ($post_sticker == "Handpicked Pregnancy") {
                $currentcat = 1165;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Handpicked</span> Pregnancy</p></div>';
            }
            if ($post_sticker == "Handpicked Parenting") {
                $currentcat = 1163;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Handpicked</span> Parenting</p></div>';
            }
            if ($post_sticker == "Editor’s Choice Wellbeing") {
                $currentcat = 1159;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Editor’s Choice</span> Wellbeing</p></div>';
            }
            if ($post_sticker == "Editor’s Choice Fertility") {
                $currentcat = 1164;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Editor’s Choice</span> Fertility</p></div>';
            }
            if ($post_sticker == "Editor’s Choice Pregnancy") {
                $currentcat = 1165;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Editor’s Choice</span> Pregnancy</p></div>';
            }
            if ($post_sticker == "Editor’s Choice Parenting") {
                $currentcat = 1163;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Editor’s Choice</span> Parenting</p></div>';
            }
            if ($post_sticker == "Spotlight Experts") {
                //NO
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Spotlight</span> Experts</p></div>';
            }
            if ($post_sticker == "Wellbeing Expert") {
                $currentcat = 1159;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Wellbeing</span> Expert</p></div>';
            }
            if ($post_sticker == "Fertility Expert") {
                $currentcat = 1164;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Fertility</span> Expert</p></div>';
            }
            if ($post_sticker == "Pregnancy Expert") {
                $currentcat = 1165;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Pregnancy</span> Expert</p></div>';
            }
            if ($post_sticker == "Parenting Expert") {
                $currentcat = 1163;
                $termIdVal = 'term_' . $currentcat;
                $bcolour = "#F77D66";
                if (!empty(get_field("category_colour", $termIdVal))) {
                    $bcolour = get_field("category_colour", $termIdVal);
                }
                $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
                $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
                $hexRGB = $bcolour;
                if ($bcolour != "#034146") {
                    $ad = '';
                    $addd = "";
                } else {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                }
                if ($bcolour == "#034146") {
                    $ad = 'class="light-text"';
                    $addd = "light-text";
                } else {
                    $ad = "";
                    $addd = "";
                }
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Parenting</span> Expert</p></div>';
            }
            if ($bcolour == "#034146") {
                $ad = 'class="light-text"';
                $addd = "light-text";
            } else {
                $ad = "";
                $addd = "";
            }
            if ($post_sticker == "Featured Expert") {
                //NO
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Featured</span> Expert</p></div>';
            }
            if ($post_sticker == "Featured Video") {
                //NO
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Featured</span> Video</p></div>';
            }
            if ($post_sticker == "Featured Giveaway") {
                //NO
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Featured</span> Giveaway</p></div>';
            }
            if ($post_sticker == "Featured Podcast") {
                //NO
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Featured</span> Podcast</p></div>';
            }
        }

        include get_template_directory() . '/components/posts/expert-carousel-item.php';

        // $rtn .= '<div class="expert-summary" style="position:relative;">';
        // $rtn .= '<div '.$style.'>';
        // $rtn .= $featured_cur;
        // $rtn .= '<a href="'.get_permalink($post['ID']).'" title="Read more about '. $post['post_title'] .'...">';
        // $rtn .= '<img src="/wp-content/themes/lighttheme/images/a_squ_trans.png">';
        // $rtn .= '</a>';
        // $rtn .= '</div>';


        $rtn .= '<div class="expert-text">';
        $rtn .= '<div class="expert-inner">';
        if ($isPage) {
            $rtn .= '<h3>' . $currentcatname . '</h3>';
        }
        $rtn .= '<h2>' . $post['post_title'] . '</h2>';
        if (!empty($speciality)) {
            $rtn .= '<p>' . $speciality . '</p>';
        }
        if (!empty($position)) {
            $rtn .= '<p>' . $position . '</p>';
        }
        if (!empty($ward)) {
            $rtn .= '<p>' . $ward . '</p>';
        }
        if (!empty($socials)) {
            $rtn .= '<div class="people-socials">';
            $rtn .= $socials;
            $rtn .= '</div>';
        }
        if (!empty(get_the_excerpt($post['ID']))) {
            $rtn .= '<p>' . get_the_excerpt($post['ID']) . '</p>';
        }
        if (!$isPage) {
            $rtn .= '<h3>' . $currentcatname . '</h3>';
        }
        $rtn .= '<a class="button-expert" href="' . get_permalink($post['ID']) . '" title="Read more about ' . $post['post_title'] .  '...">MEET YOUR EXPERTS</a></div>';
        $rtn .= '</div></div>';

        $rtn .= '</div>';

    endforeach;
    wp_reset_query();


    $rtn .= '</div></div>';
    $rtn .= '</div>';
    $rtn .= '<div class="swiper-pagination experts-swiper-pagination"></div>';
    $rtn .= '</div>';

    $slick_responsive_settings = "[
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
    ]";

    if ($isPage) {
        $rtn .= '
<script type="text/javascript">
    var swiper = new Swiper(".swiper-experts", {
                slidesPerView: 3,
                spaceBetween: 40,
                pagination: {
                    el: ".experts-swiper-pagination",
                    clickable: true,
                },
                 navigation: {
        nextEl: ".swiper-button-next-experts",
        prevEl: ".swiper-button-prev-experts",
      },
       breakpoints: {
        640: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        1024: {
          slidesPerView: 5,
          spaceBetween: 40,
        },
            });
</script>
        ';
    } else {

        $rtn .= "
<script type='text/javascript'>
    $(document).ready(function(){
        if ($('.main-content-outer').length > 0){
            $('.expert-entry').slick({
                centerMode: true,
                centerPadding: '60px',
                slidesToShow: 3,
                autoplay: true,
                autoplaySpeed: 2000,
                responsive: " . $slick_responsive_settings . "
            });
        }
    });
</script>
";
    }

    return $rtn;
}
