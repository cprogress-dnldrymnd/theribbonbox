<?php

/**
 * This whole file is just for the [blog_filter] shortcode.
 *
 * Used by large listing pages like the Home page and [/fertility](https://theribbonbox.com/fertility).
 *
 * There are approximately 55 templates contained in this file. (search for ' . $format . ')
 */

add_shortcode('blog_filter', 'blog_filter_function');
function blog_filter_function($attr)
{
    if (current_user_can('administrator')) {
        //new-func
        $homepage_array = '';
        $rtn = "";
        $term_id = 0;
        $categoryid = "";
        $limit = 500;
        $curtotal = 0;
        $format = "";
        $post_type = "";
        $design = "";
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        if (
            preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $useragent)
            || preg_match(
                '/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',
                substr($useragent, 0, 4)
            )
        ) {

            $large_image = "medium";
            $medium_image = "thumbnail";
        }

        $attributes_str = json_encode($attr);

        if (!empty($attr["categoryid"])) {
            $categoryid = $attr["categoryid"];
        }
        if (!empty($attr["limit"])) {
            $limit = $attr["limit"];
        }
        if (!empty($attr["format"])) {
            $format = $attr["format"];
        }
        if (!empty($attr["post_type"])) {
            $post_type = $attr["post_type"];
        }
        if (!empty($attr["curtotal"])) {
            $curtotal = $attr["curtotal"];
        }
        if (!empty($attr["design"])) {
            $design = $attr["design"];
        }
        if (!empty($attr["add_ad"])) {
            $add_ad = $attr["add_ad"];
        }
        if (!empty($attr["orderby"])) {
            $orderby = $attr["orderby"];
        }
        if (!empty($attr["id_list"])) {
            $id_list = $attr["id_list"];
            $id_list = explode(',', $id_list);
        }
        if (!empty($attr["pod_layout"])) {
            $pod_layout = $attr["pod_layout"];
        }
        if (!empty($attr["func"])) {
            $func = $attr["func"];
        }

        if (!empty($attr["home"])) {
            $home = true;
        }
        if (isset($_SESSION['homepage_array'])) {
            $homepage_array = $_SESSION['homepage_array'];

            if (empty($homepage_array) && !empty($attr["exclude"])) {
                $homepage_array = $attr["exclude"];
            }
        }
        $globalCategoryName = "";
        if (!empty($categoryid)) {
            $category = get_category($categoryid);
            //$currentcat = $categories[0]->cat_ID;
            $globalCategoryName = $category->name;
        }

        $exClass = "";

        $recent_posts = null;

        $excluded_posts_IDs = get_excluded_b2b_posts();
        if (!empty($id_list) > 0) {
            $post_types = explode('/', $post_type);
            $recent_posts = wp_get_recent_posts(array(
                'numberposts' => $limit,
                'post_status' => 'publish',
                'post_type' => $post_types,
                'orderby' => 'post__in',
                'post__in' => $id_list,
                'exclude' => $excluded_posts_IDs,
            ));
        } else {
            if (!empty($categoryid)) {
                if ($home) {
                    if (is_string($homepage_array)) {
                        $excludeids = explode(',', $homepage_array);
                        $recent_posts = wp_get_recent_posts(array(
                            'numberposts' => $limit,
                            'orderby'     => $orderby,
                            'order'       => 'desc',
                            'post_status' => 'publish',
                            'category'    => $categoryid,
                            'offset'      => $curtotal,
                            'exclude'     => array_merge($excludeids, $excluded_posts_IDs),
                        ));
                    }
                } else {
                    $recent_posts = wp_get_recent_posts(array(
                        'numberposts' => $limit,
                        'orderby'     => $orderby,
                        'order'       => 'desc',
                        'post_status' => 'publish',
                        'category'    => $categoryid,
                        'offset'      => $curtotal,
                        'exclude'     => $excluded_posts_IDs,
                    ));
                }
            } else {
                if ($home) {
                    $excludeids = explode(',', $homepage_array);
                    $recent_posts = wp_get_recent_posts(array(
                        'numberposts' => $limit,
                        'orderby'     => $orderby,
                        'order'       => 'desc',
                        'post_status' => 'publish',
                        'offset'      => $curtotal,
                        'exclude'     => array_merge($excludeids, $excluded_posts_IDs),
                    ));
                } else {
                    $recent_posts = wp_get_recent_posts(array(
                        'numberposts' => $limit,
                        'orderby'     => $orderby,
                        'order'       => 'desc',
                        'post_status' => 'publish',
                        'offset'      => $curtotal,
                        'exclude'     => $excluded_posts_IDs,
                    ));
                }
            }


            if ($format == "video") {
                $exClass = "vid-dark-green";
                if (!empty($categoryid)) {

                    $child = get_category($categoryid);
                    $parent = $child->parent;
                    $parent_name = get_category($parent);

                    if (!empty($parent_name->parent)) {
                        $parent = $parent_name->parent;
                        $parent_name = get_category($parent_name->parent);
                    }

                    if (!empty($parent)) {
                        $categoryid = $parent;
                    }

                    $recent_posts1 = wp_get_recent_posts(array(
                        'numberposts' => 1,
                        'post_type' => 'videos',
                        'orderby'           => 'rand',
                        //'order'             => 'desc',
                        'category'         => $categoryid,
                        'post_status' => 'publish',
                        'meta_query' => array(
                            array(
                                'key'     => 'featured_podcast_video',
                                'value'   => '1',
                                'compare' => '='
                            )
                        ),
                        'exclude' => $excluded_posts_IDs,
                    ));

                    $recent_posts2 = wp_get_recent_posts(array(
                        'numberposts' => $limit - 1,
                        'post_type' => 'podcasts',
                        'orderby'           => 'rand',
                        //'order'             => 'desc',
                        'category'         => $categoryid,
                        'post_status' => 'publish',
                        'meta_query' => array(
                            array(
                                'key'     => 'promo_podcast',
                                'value'   => '1',
                                'compare' => '='
                            )
                        ),
                        'exclude' => $excluded_posts_IDs,
                    ));

                    $recent_posts = array_merge($recent_posts1, $recent_posts2);
                } else {
                    $recent_posts1 = wp_get_recent_posts(array(
                        'numberposts' => 1,
                        'post_type' => 'videos',
                        'orderby'           => 'rand',
                        'post_status' => 'publish',
                        'meta_query' => array(
                            array(
                                'key'     => 'featured_podcast_video',
                                'value'   => '1',
                                'compare' => '='
                            )
                        ),
                        'exclude' => $excluded_posts_IDs,
                    ));
                    $recent_posts2 = wp_get_recent_posts(array(
                        'numberposts' => $limit - 1,
                        'post_type' => 'podcasts',
                        'orderby'           => 'rand',
                        //'order'             => 'desc',
                        'post_status' => 'publish',
                        'meta_query' => array(
                            array(
                                'key'     => 'promo_podcast',
                                'value'   => '1',
                                'compare' => '='
                            )
                        ),
                        'exclude' => $excluded_posts_IDs,
                    ));

                    $recent_posts = array_merge($recent_posts1, $recent_posts2);
                }
            }

            if ($post_type != "") {
                if (empty($categoryid)) {
                    $categoryid = null;
                }
                $post_types = explode('/', $post_type);

                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => $limit,
                    'post_status' => 'publish',
                    'orderby' => $orderby,
                    'cat' => $categoryid,
                    'post_type' => $post_types,
                    'order' => 'DESC',
                    'offset' => $curtotal,
                    'exclude' => $excluded_posts_IDs,
                ));
            }
        }

        if ($func == 'podcast-limit4') {
            $recent_posts1 = wp_get_recent_posts(array(
                'numberposts' => 1,
                'post_type' => 'podcasts',
                'orderby'           => 'date',
                'post_status' => 'publish',
                'meta_query' => array(
                    array(
                        'key'     => 'featured_category',
                        'value'   => 'fertility',
                        'compare' => 'LIKE'
                    )
                ),
                'exclude' => $excluded_posts_IDs,
            ));

            $recent_posts2 = wp_get_recent_posts(array(
                'numberposts' => 1,
                'post_type' => 'podcasts',
                'orderby'           => 'date',
                'post_status' => 'publish',
                'meta_query' => array(
                    array(
                        'key'     => 'featured_category',
                        'value'   => 'wellbeing',
                        'compare' => 'LIKE'
                    )
                ),
                'exclude' => $excluded_posts_IDs,
            ));

            $recent_posts3 = wp_get_recent_posts(array(
                'numberposts' => 1,
                'post_type' => 'podcasts',
                'orderby'           => 'date',
                'post_status' => 'publish',
                'meta_query' => array(
                    array(
                        'key'     => 'featured_category',
                        'value'   => 'pregnancy',
                        'compare' => 'LIKE'
                    )
                ),
                'exclude' => $excluded_posts_IDs,
            ));

            $recent_posts4 = wp_get_recent_posts(array(
                'numberposts' => 1,
                'post_type' => 'podcasts',
                'orderby'           => 'date',
                'post_status' => 'publish',
                'meta_query' => array(
                    array(
                        'key'     => 'featured_category',
                        'value'   => 'parenting',
                        'compare' => 'LIKE'
                    )
                ),
                'exclude' => $excluded_posts_IDs,
            ));

            $recent_posts = array_merge($recent_posts1, $recent_posts2, $recent_posts3, $recent_posts4);
        }

        $in_count = 0;
        $st_1 = false;
        $st_2 = false;
        $st_3 = false;
        $st_4 = false;
        $st_5 = false;

        $exp_count = 0;
        $vid_count = 0;
        $cat_count = 0;
        $giveaway_count = 0;

        $cnt = 0;

        $post_open_div = false;

        $rtn .= '<div class="blogs-loop ' . $exClass . '">';

        if ($post_type == "expert_profiles") {
            $rtn .= '<div class="experts-loop">';
        }


        if ($post_type == "podcasts" && empty($id_list) && empty($pod_layout)) {

            $pc_post_excerpt = get_the_excerpt(22826);

            if (!has_post_thumbnail(22826)) {
                $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
            } else {
                $style = 'style="background:url(';
                $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url(22826, $large_image));
                $style .= $iUrl;
                $style .= '); background-size:cover; background-position:center;"';;
            }
            include get_template_directory() . '/components/posts/tpl-1.php';

            if ($post_type == "podcasts" && empty($id_list)) {
                if (!empty($attr["categoryid"])) {

                    if ($func == 'podcast-limit4') {
                        $rtn .= "<h2 class='cate-h2-ph'>Explore by Category</h2>";
                    } else {
                        $rtn .= "<h2 class='cate-h2-ph'>More " . $globalCategoryName . " Podcasts" . $func . "</h2>";
                    }
                }
            }
        }

        // =================================================================================================================
        // The processing of the results
        // =================================================================================================================

        foreach ($recent_posts as $post) {
            $cnt++;

            $term = get_the_terms($post['ID'], '');
            $names  = wp_list_pluck($term, 'name');
            $this_post_type = get_post_type($post["ID"]);
            $cur_post_type = $this_post_type;

            $output = "";
            foreach ($names as $name) {
                $output .= '<span class="cat-tag">' . $name . '</span>';
            }

            if ($post_type == "expert_profiles" || $post_type == "videos" || $post_type == "podcasts" || $post_type == "videos/podcasts") {
                $img_url = "";
                //if ($post_type == "expert_profiles"){
                $partner_inner_banner = get_field("partner_inner_banner", $post['ID']);
                if (!has_post_thumbnail($post['ID']) && $cnt == 1) {
                    if (!empty($partner_inner_banner)) {
                        $image = get_field("partner_inner_banner", $post['ID']);
                        $size = $small_image;
                        $img_url = $image['sizes'][$size];
                    }
                } else {
                    $img_url = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], $large_image));
                }

                $style = 'style="background:url(';
                $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", $img_url);
                $style .= $iUrl;
                $style .= '); background-size:cover; background-position:center;"';;
            } else {
                if (!has_post_thumbnail($post['ID'])) {
                    $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
                } else {
                    $style = 'style="background:url(';
                    //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                    $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], $small_image));
                    $style .= $iUrl;
                    $style .= '); background-size:cover; background-position:center;"';;
                }
            }


            WPBMap::addAllMappedShortcodes();

            $text = wp_strip_all_tags(get_the_excerpt($post['ID']));


            $categories = get_the_category($post["ID"]);
            $currentcat = $categories[0]->cat_ID;
            $currentcatname = $categories[0]->cat_name;
            $currentcatslug = $categories[0]->slug;
            $cat_p = get_ancestors($categories[0]->term_id, 'category');

            if (!empty($categoryid) && $func != 'podcast-limit4') {
                $term1 = get_term_by('id', $categoryid, 'category');
                $currentcat = $categoryid;
                $currentcatname = $term1->name;
                $currentcatslug = $term1->slug;
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

            $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
            $addBorder = 'border-top: 5px solid ' . $bcolour . ';';

            $featured_podcast = get_field("promo_podcast", $post["ID"]);
            $featured_video = get_field("featured_podcast_video", $post["ID"]);
            $featured_giveaway = get_field("featured", $post["ID"]);
            $featured_expert = get_field("featured_expert", $post["ID"]);

            $featured_handpicked = get_field("handpicked", $post["ID"]);

            $post_type_simp = "";

            $more_text = "Read<br>More";
            $more_t_text = "Read More";

            $ad = "";
            $addd = "";
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

            if ($this_post_type == 'videos') {
                $post_type_simp = "Video";
                $more_text = "Watch<br>Now";
                $more_t_text = "Watch More";
            }
            if ($this_post_type == 'podcasts') {
                $post_type_simp = "Podcast";
                $more_text = "Listen<br>Now";
                $more_t_text = "Listen More";
            }
            if ($this_post_type == 'expert_profiles') {
                $post_type_simp = "Expert";
            }
            if ($this_post_type == 'offer-items') {
                $post_type_simp = "Offer";
            }
            if ($this_post_type == 'events') {
                $post_type_simp = "Event";
            }
            if ($this_post_type == 'giveaway-items') {
                $post_type_simp = "Giveaway";
            }
            if ($this_post_type == 'post') {
                $post_type_simp = "Article";
            }
            $featured_cur = "";

            if (!empty($featured_podcast) || !empty($featured_video) || !empty($featured_giveaway) || !empty($featured_expert)) {
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Featured</span><br>' . $post_type_simp . '</p></div>';
            }


            if (!empty($featured_handpicked)) {
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Handpicked</span><br>' . $currentcatname . '</p></div>';
            }

            $post_sticker = get_field("post_sticker", $post["ID"]);

            // =============================================================================================================
            // The setting of style variables
            // =============================================================================================================

            // A "post sticker" is the colourful circle with text that shows over the top-right of a post card
            if (!empty($post_sticker)) {
                if ($post_sticker == "Trending Wellbeing") {
                    $currentcat = 1159; // Wellbeing term id
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Trending</span><br>Wellbeing</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Trending</span><br>Fertility</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Trending</span><br>Pregnancy</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Trending</span><br>Parenting</p></div>';
                }
                if ($post_sticker == "Latest Wellbeing") {
                    $currentcat = 1159; // Wellbeing term id
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Latest</span><br>Wellbeing</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Latest</span><br>Fertility</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Latest</span><br>Pregnancy</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Latest</span><br>Parenting</p></div>';
                }
                if ($post_sticker == "Handpicked Wellbeing") {
                    $currentcat = 1159; // Wellbeing term id
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Handpicked</span><br>Wellbeing</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Handpicked</span><br>Fertility</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Handpicked</span><br>Pregnancy</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Handpicked</span><br>Parenting</p></div>';
                }
                if ($post_sticker == "Editor’s Choice Wellbeing") {
                    $currentcat = 1159; // Wellbeing term id
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Editor’s Choice</span><br>Wellbeing</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Editor’s Choice</span><br>Fertility</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Editor’s Choice</span><br>Pregnancy</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Editor’s Choice</span><br>Parenting</p></div>';
                }
                if ($post_sticker == "Spotlight Experts") {
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Spotlight</span><br>Experts</p></div>';
                }
                if ($post_sticker == "Wellbeing Expert") {
                    $currentcat = 1159; // Wellbeing term id
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Wellbeing</span><br>Expert</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Fertility</span><br>Expert</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Pregnancy</span><br>Expert</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Parenting</span><br>Expert</p></div>';
                }
                if ($post_sticker == "Featured Expert") {
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Featured</span><br>Expert</p></div>';
                }
                if ($post_sticker == "Featured Video") {
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Featured</span><br>Video</p></div>';
                }
                if ($post_sticker == "Featured Giveaway") {
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Featured</span><br>Giveaway</p></div>';
                }
                if ($post_sticker == "Featured Podcast") {
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Featured</span><br>Podcast</p></div>';
                }
            }


            $ext = '';


            if ($this_post_type == "videos") {
                $ext = '<img src="/wp-content/themes/lighttheme/images/vid-btn.png" class="vid-btn">';
            }
            if ($this_post_type == "podcasts") {
                $ext = '<img src="/wp-content/themes/lighttheme/images/pod-btn.png" class="vid-btn">';
            }


            $ex_txt = '';

            $live_post = false;

            if ($cur_post_type == "giveaway-items" || $cur_post_type == "events") {

                $select_competition_date = get_field("select_competition_date", $post["ID"]);

                if (!empty($select_competition_date)) {
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

                    if (!empty($offer_expired_text)):
                        $date_txt = $offer_expired_text . " ";
                    endif;


                    $ex_txt = '<h3 class="date-giveaways">CLOSING DATE ' . $displayformatB . '</h3>';
                }
            }

            if ($cur_post_type == "offer-items") {

                $offer_expired_text = get_field("offer-expired-text", $post["ID"]);
                $offer_expiry_date = get_field("offer_expiry_date", $post["ID"]);

                if (!empty($offer_expiry_date)):
                    $today = date("Y-m-d");
                    $date = $offer_expiry_date;
                    $time = strtotime($date);
                    $newformat = date('Y-m-d', $time);

                    $displayformatB = date('j M Y', $time);

                    $time = strtotime($date);
                    $newukformat = date('d-m-Y', $time);

                    $date_txt = "Offer Open: ";

                    $live_post = true;

                    if ($newformat < $today) {
                        $date_txt = "Offer Closed: ";
                        $live_post = false;
                    }

                    if (!empty($offer_expired_text)):
                        $date_txt = $offer_expired_text . " ";
                    endif;

                    $ex_txt = '<h3 class="date-giveaways">OFFER CLOSE ' . $displayformatB . '</h3>';
                endif;
            }

            // =====================================================================================================
            // The output (templates)
            // =====================================================================================================

            if ($format == "home-banner") {

                if ($cnt <= 0) {
                    echo 'No posts found for ' . $format;
                }
                if ($cnt == 1) {
                    if (!has_post_thumbnail($post['ID'])) {
                        $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
                    } else {
                        if (!empty(get_field("post_large_image", $post['ID']))) {
                            $style = 'style="background:url(';
                            $iUrl = get_field("post_large_image", $post['ID']);
                            //echo($iUrl);
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;color:blue;"';
                        } else {
                            $style = 'style="background:url(';
                            $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], $small_image));
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;"';
                        }
                    }
                    //include get_template_directory() . '/components/post-items/home-banner.php';
                    include get_template_directory() . '/components/posts/home-top-banner.php';
                }
            }
            if ($format == "post-page" && !empty($id_list)) {

                if (!$post_open_div) {
                    $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-1">';
                    $post_open_div = true;
                }
                $style = str_replace('style="', 'style="' . $addBorder, $style);

                if ($in_count % 2 == 0) {

                    $curposttypeval = get_post_type($post['ID']);

                    if ($curposttypeval == "offer-items" || $curposttypeval == "giveaway-items" || $curposttypeval == "events") {
                        if (!isset($adClas)) {
                            $adClas = '';
                        }

                        if ($curposttypeval == "giveaway-items") {
                            $style = 'style="background:url(';
                            $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';
                            include get_template_directory() . '/components/posts/giveaway-item-even.php';
                        } else if ($cur_post_type == "offer-items") {
                            $link = get_permalink($post['ID']);
                            $website_link = get_field("website_link", $post["ID"]);
                            $new_tab = "";
                            if (!empty($website_link)) {
                                $link = $website_link;
                                $new_tab = "target='_blank'";
                            }
                            $style = 'style="background:url(';
                            $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';
                            include get_template_directory() . '/components/posts/tpl-4.php';
                        } else if ($curposttypeval == "offer-items/giveaway-items/events") {
                            $style = 'style="background:url(';
                            $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';
                            include get_template_directory() . '/components/posts/tpl-5.php';
                        } else if ($curposttypeval == "events") {
                            $link = get_permalink($post['ID']);
                            $website_link = get_field("website_link", $post["ID"]);
                            $new_tab = "";
                            if (!empty($website_link)) {
                                $link = $website_link;
                                $new_tab = "target='_blank'";
                            }
                            $speakerName = "";
                            $speaker_name = get_field("speaker_name", $post["ID"]);
                            if (!empty($speaker_name)) {
                                $speakerName = '<p class="speaker-name">' . $speaker_name . '</p>';
                            }
                            include get_template_directory() . '/components/posts/tpl-6.php';
                        }

                        if ($curposttypeval == "offer-items") {
                            $btn_text = "Buy Now";
                            if (!$live_post) {
                                $btn_text = "Offer Closed";
                            }

                            $apply__code = get_field("apply__code", $post["ID"]);
                            $website_link = get_field("website_link", $post["ID"]);
                            if (!empty($apply__code)):
                                $link = get_permalink($post['ID']);
                                $new_tab = "";

                                if (!empty($website_link)) {
                                    $link = $website_link;
                                    $new_tab = "target='_blank'";
                                }

                                $rtn .= '<div class="blog-btns">
                                <a ' . $new_tab . ' href="' . $link . '">' . $btn_text . '</a>
                                </div>
                                <hr>';

                                if ($apply__code) {
                                    $rtn .= '<h3 style="text-transform:unset; font-weight:500 !important;">Use code <strong>' . $apply__code . '</strong> at checkout</h3>';
                                }
                                $rtn .= '<div class="listen-btns">
                                <a data-code="' . $apply__code . '" ' . $new_tab . ' class="copy-discount" href="' . $link . '">Buy With Discount</a>
                                </div>';
                            else:
                                $rtn .= '<div class="listen-btns">
                                <a ' . $new_tab . ' href="' . $link . '">Buy With Discount</a>
                                </div>';
                            endif;
                        } else if ($curposttypeval == "giveaway-items") {
                            $btn_text = "Enter Now";
                            if (!$live_post) {
                                $btn_text = "Giveaway Closed";
                            }

                            $rtn .= '<div class="blog-btns">
                            <a style="color:#000;" href="' . get_permalink($post['ID']) . '">' . $btn_text . '</a>
                            </div>';
                        } else if ($curposttypeval == "events") {

                            $link = get_permalink($post['ID']);
                            $new_tab = "";
                            $website_link = get_field("website_link", $post["ID"]);
                            if (!empty($website_link)) {
                                $link = $website_link;
                                $new_tab = "target='_blank'";
                            }

                            $btn_text = "Find Out More";


                            $rtn .= '<div class="blog-btns">
                            <a style="color:#000;" ' . $new_tab . ' href="' . $link . '">' . $btn_text . '</a>
                            </div>';
                        }

                        $rtn .= '</div>
                        </div>
                        <div class="end">
                        </div>
                        </div>';
                    } else {
                        if (! isset($attr["post_type"]) || $attr["post_type"] === "expert_profiles") {
                            $style = 'style="background:url(';
                            $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                            include get_template_directory() . '/components/posts/tpl-7.php';
                        } else {
                            $style = 'style="background:url(';
                            $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                            include get_template_directory() . '/components/posts/tpl-7.5.php';
                        }
                    }
                } else {
                    $curposttypeval = get_post_type($post['ID']);
                    if (!isset($adClas)) {
                        $adClas = '';
                    }
                    if (
                        $curposttypeval == "offer-items"
                        || $curposttypeval == "giveaway-items"
                        || $curposttypeval == "events"
                    ) {

                        if ($curposttypeval == "giveaway-items") {
                            $style = 'style="background:url(';
                            $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                            include get_template_directory() . '/components/posts/tpl-8.php';
                        } else if ($cur_post_type == "offer-items") {
                            $link = get_permalink($post['ID']);
                            $website_link = get_field("website_link", $post["ID"]);
                            $new_tab = "";
                            if (!empty($website_link)) {
                                $link = $website_link;
                                $new_tab = "target='_blank'";
                            }
                            $style = 'style="background:url(';
                            $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                            include get_template_directory() . '/components/posts/tpl-9.php';
                        } else if ($curposttypeval == "offer-items/giveaway-items/events") {
                            $style = 'style="background:url(';
                            $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                            include get_template_directory() . '/components/posts/tpl-10.php';
                        } else if ($curposttypeval == "events") {
                            $link = get_permalink($post['ID']);
                            $website_link = get_field("website_link", $post["ID"]);
                            $new_tab = "";
                            if (!empty($website_link)) {
                                $link = $website_link;
                                $new_tab = "target='_blank'";
                            }
                            $speakerName = "";
                            $speaker_name = get_field("speaker_name", $post["ID"]);
                            if (!empty($speaker_name)) {
                                $speakerName = '<p class="speaker-name">' . $speaker_name . '</p>';
                            }
                            include get_template_directory() . '/components/posts/tpl-11.php';
                        }

                        if ($curposttypeval == "offer-items") {
                            $btn_text = "Buy Now";
                            if (!$live_post) {
                                $btn_text = "Offer Closed";
                            }

                            $apply__code = get_field("apply__code", $post["ID"]);
                            $website_link = get_field("website_link", $post["ID"]);

                            if (!empty($apply__code)):
                                $link = get_permalink($post['ID']);
                                $new_tab = "";

                                if (!empty($website_link)) {
                                    $link = $website_link;
                                    $new_tab = "target='_blank'";
                                }

                                $rtn .= '<div class="blog-btns">
                                <a ' . $new_tab . ' href="' . $link . '">' . $btn_text . '</a>
                                </div>
                                <hr>';

                                if ($apply__code) {
                                    $rtn .= '<h3 style="text-transform:unset; font-weight:500 !important;">Use code <strong>' . $apply__code . '</strong> at checkout</h3>';
                                }
                                $rtn .= '<div class="listen-btns">
                                <a data-code="' . $apply__code . '" ' . $new_tab . ' class="copy-discount" href="' . $link . '">Buy With Discount</a>
                                </div>';
                            else:
                                $rtn .= '<div class="listen-btns">
                                <a ' . $new_tab . ' href="' . $link . '">Buy With Discount</a>
                                </div>';
                            endif;
                        } else if ($curposttypeval == "giveaway-items") {

                            $btn_text = "Enter Now";
                            if (!$live_post) {
                                $btn_text = "Giveaway Closed";
                            }

                            $rtn .= '<div class="blog-btns">
                            <a style="color:#000;" href="' . get_permalink($post['ID']) . '">' . $btn_text . '</a>
                            </div>';
                        } else if ($curposttypeval == "events") {

                            $link = get_permalink($post['ID']);
                            $new_tab = "";
                            $website_link = get_field("website_link", $post["ID"]);
                            if (!empty($website_link)) {
                                $link = $website_link;
                                $new_tab = "target='_blank'";
                            }

                            $btn_text = "Find Out More";


                            $rtn .= '<div class="blog-btns">
                            <a style="color:#000;" ' . $new_tab . ' href="' . $link . '">' . $btn_text . '</a>
                            </div>';
                        }

                        $rtn .= '</div>
                        </div>
                        <div class="end">
                        </div>
                        </div>';
                    } else {
                        if (! isset($attr["post_type"]) || $attr["post_type"] == "expert_profiles") {
                            $blkBg = "";
                            if (($in_count % 3) == 0) {
                                $blkBg = " style='background:#000;'";
                            }
                            include get_template_directory() . '/components/posts/tpl-12.php';
                        }
                    }
                }
            } else if ($format == "post-page" && empty($id_list)) {


                if (!empty($attr["post_type"]) && false) {
                    if (($cnt % 8) == 0) {
                        $rtn .= do_shortcode("[display_insider]");
                    }

                    if (($cnt % 20) == 0) {
                        $rtn .= do_shortcode("[display_followus]");
                    }

                    if (($cnt % 10) == 0 && $attr["post_type"] == "expert_profiles") {
                        $rtn .=  do_shortcode("[category_list page='experts']");
                    }

                    if (($cnt % 10) == 0 && $attr["post_type"] == "videos") {
                        $rtn .=  do_shortcode("[category_list page='videos']");
                    }
                }


                if ((! isset($attr["post_type"]) || $attr["post_type"] != "videos/podcasts")  && ($design == "full-vid-list" || $design == "full-pod-list")) {

                    if ($cnt == 1 && $curtotal == 0 && false) {

                        if (!has_post_thumbnail($post['ID'])) {
                            $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
                        } else {
                            if (!empty(get_field("post_large_image", $post['ID']))) {
                                $style = 'style="background:url(';
                                $iUrl = get_field("post_large_image", $post['ID']);
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;"';
                            } else {
                                $style = 'style="background:url(';
                                $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], $small_image));
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;"';
                            }
                        }

                        include get_template_directory() . '/components/posts/tpl-16.php';

                        if ($design == "full-vid-list" || $design == "full-pod-list") {
                            if ($design == "full-vid-list") {
                                $rtn .= "<h3 id='fil-list-header'>All " . $globalCategoryName . " Videos</h3>";
                            }
                            if ($design == "full-pod-list") {
                                $rtn .= "<h3 id='fil-list-header'>All " . $globalCategoryName . " Podcasts</h3>";
                            }
                        }
                    } else {

                        if ($cnt == 1 && $attr["post_type"] != "podcasts") {

                            include get_template_directory() . '/components/posts/tpl-17.php';
                        } else if (!empty($pod_layout) && $cnt == 1) {
                            if (!empty(get_field("partner_inner_banner", $post['ID']))) {
                                $image = get_field("partner_inner_banner", $post['ID']);
                                $size = $medium_image;
                                $partner_inner_banner = $image['url'];
                                $style = 'style="background:url(';
                                $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", $partner_inner_banner);
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;"';
                            }
                            include get_template_directory() . '/components/posts/tpl-18.php';

                            $podcast_iframe_code = get_field("podcast_iframe_code", $post['ID']);
                            if (!empty($podcast_iframe_code)) {
                                $rtn .= '
                                <br>&nbsp;<br>
                                <div class="podcast-iframe-outer">';
                                $rtn .= $podcast_iframe_code;
                                $rtn .= '</div>';
                            }
                            $rtn .= '</div>
                            </div>
                            </div>
                            </div>';
                            if ($post_type == "podcasts" && empty($id_list)) {
                                if (!empty($attr["categoryid"]) && empty($func)) {
                                    if ($func == 'podcast-limit4') {
                                        $rtn .= "<h2 class='cate-h2-ph'>Explore by Category</h2>";
                                    } else {
                                        $rtn .= "<h2 class='cate-h2-ph'>More " . $globalCategoryName . " Podcasts</h2>";
                                    }
                                }
                            }
                        } else {

                            if ($cnt == 2 && !empty($attr["categoryid"]) && $attr["post_type"] != "podcasts") {
                                $rtn .= "<h2 class='cate-h2-ph'>All " . $globalCategoryName . " Videos</h2>";
                            }

                            include get_template_directory() . '/components/posts/tpl-19.php';

                            if ($cur_post_type == "videos") {
                                $rtn .= '<div class="listen-btns">
                            <a href="' . get_permalink($post['ID']) . '">Watch Now</a>
                            </div>';
                            } else if ($cur_post_type == "podcasts") {
                                $rtn .= '<div class="listen-btns">
                            <a href="' . get_permalink($post['ID']) . '">Listen For Free</a>&nbsp;&nbsp;<a href="/community">SUBSCRIBE For Free</a>
                            </div><br>';
                            }
                            //$rtn .= create_item_socials(get_permalink($post['ID']), $post['post_title']);
                            $rtn .= '<h4>' . get_the_date('j M Y', $post["ID"]) . '</h4>' . create_item_socials(get_permalink($post['ID']), $post['post_title']) . '</div>
                            </div>
                            <div class="end">
                            </div>
                            </div>';
                        }
                    }
                } else if (
                    $cur_post_type == "giveaway-items"
                    || $cur_post_type == "offer-items"
                    || $cur_post_type == "offer-items/giveaway-items/events"
                    || $cur_post_type == "events"
                ) {

                    if ($cnt == 4 || $cnt == 9) {
                        $style_format = "";
                        if ($cnt == 4) {
                            $style_format = "event-giveaway-outer-light-bg";
                        }
                        if ($post_open_div) {
                            $rtn .= '</div>';
                        }
                        if ($cur_post_type == "events") {
                            $rtn .= do_shortcode("[get_giveaway_event post_type='" . $cur_post_type . "' style_format='" . $style_format . "']");
                        } else {
                            $rtn .= do_shortcode("[get_giveaway_event post_type='giveaway-items' style_format='" . $style_format . "']");
                        }
                        if ($post_open_div) {
                            $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-2">';
                        }
                    }

                    if (!has_post_thumbnail($post['ID'])) {
                        $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
                    } else {
                        $style = 'style="background:url(';
                        $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], $large_image));
                        $style .= $iUrl;
                        $style .= '); background-size:cover; background-position:center;"';;
                    }

                    if (!$post_open_div) {
                        $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-3">';
                        $post_open_div = true;
                    }

                    $adClas = "";

                    if (($cnt % 7) == 0 || ($cnt % 8) == 0) {
                        $adClas = "blog-nor-half";
                        if ($cnt % 2 == 0) {
                        } else {
                            $adClas = "blog-nor-half blog-nor-half-1";
                        }
                    }

                    if ($cur_post_type == "giveaway-items") {
                        $style = 'style="background:url(';
                        $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                        $style .= $iUrl;
                        $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';
                        include get_template_directory() . '/components/posts/tpl-20.php';
                    } else if ($cur_post_type == "offer-items") {
                        $link = get_permalink($post['ID']);
                        $website_link = get_field("website_link", $post["ID"]);
                        $new_tab = "";
                        if (!empty($website_link)) {
                            $link = $website_link;
                            $new_tab = "target='_blank'";
                        }
                        $style = 'style="background:url(';
                        $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                        $style .= $iUrl;
                        $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                        include get_template_directory() . '/components/posts/tpl-21.php';
                    } else if ($cur_post_type == "offer-items/giveaway-items/events") {
                        $style = 'style="background:url(';
                        $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                        $style .= $iUrl;
                        $style .= '); background-size:cover; background-position:center; height:100% !important;' . $addBorder . '"';

                        include get_template_directory() . '/components/posts/tpl-22.php';
                    } else if ($cur_post_type == "events") {
                        $link = get_permalink($post['ID']);
                        $website_link = get_field("website_link", $post["ID"]);
                        $new_tab = "";
                        if (!empty($website_link)) {
                            $link = $website_link;
                            $new_tab = "target='_blank'";
                        }
                        $speakerName = "";
                        $speaker_name = get_field("speaker_name", $post["ID"]);
                        if (!empty($speaker_name)) {
                            $speakerName = '<p class="speaker-name">' . $speaker_name . '</p>';
                        }

                        include get_template_directory() . '/components/posts/tpl-23.php';
                    }

                    if ($cur_post_type == "offer-items") {
                        $btn_text = "Buy Now";
                        if (!$live_post) {
                            $btn_text = "Offer Closed";
                        }

                        $apply__code = get_field("apply__code", $post["ID"]);
                        $website_link = get_field("website_link", $post["ID"]);
                        if (!empty($apply__code)):
                            $link = get_permalink($post['ID']);

                            $new_tab = "";

                            if (!empty($website_link)) {
                                $link = $website_link;
                                $new_tab = "target='_blank'";
                            }

                            $rtn .= '<div class="blog-btns">
                            <a ' . $new_tab . ' href="' . $link . '">' . $btn_text . '</a>
                            </div>
                            <hr>';

                            if ($apply__code) {
                                $rtn .= '<h3 style="text-transform:unset; font-weight:500 !important;">Use code <strong>' . $apply__code . '</strong> at checkout</h3>';
                            }
                            $rtn .= '<div class="listen-btns">
                            <a data-code="' . $apply__code . '" ' . $new_tab . ' class="copy-discount" href="' . $link . '">Buy With Discount</a>
                            </div>';
                        else:
                            $rtn .= '<div class="listen-btns">
                            <a ' . $new_tab . ' href="' . $link . '">Buy With Discount</a>
                            </div>';
                        endif;
                    } else if ($cur_post_type == "giveaway-items") {

                        $btn_text = "Enter Now";
                        if (!$live_post) {
                            $btn_text = "Giveaway Closed";
                        }

                        $rtn .= '<div class="blog-btns">
                        <a style="color:#000;" href="' . get_permalink($post['ID']) . '">' . $btn_text . '</a>
                        </div>';
                    } else if ($cur_post_type == "events") {

                        $link = get_permalink($post['ID']);
                        $new_tab = "";
                        $website_link = get_field("website_link", $post["ID"]);
                        if (!empty($website_link)) {
                            $link = $website_link;
                            $new_tab = "target='_blank'";
                        }

                        $btn_text = "Find Out More";


                        $rtn .= '<div class="blog-btns">
                        <a style="color:#000;" ' . $new_tab . ' href="' . $link . '">' . $btn_text . '</a>
                        </div>';
                    }

                    $rtn .= '
                    </div>
                    </div>
                    <div class="end">
                    </div>
                    </div>';
                } else {

                    if (
                        $cnt == 1
                        && (! isset($attr["post_type"])
                            || ($attr["post_type"] != "expert_profiles" && $attr["post_type"] != "podcasts"))
                        && $curtotal == 0
                    ) {

                        if (!has_post_thumbnail($post['ID'])) {
                            $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
                        } else {

                            if (!empty(get_field("post_large_image", $post['ID']))) {
                                $style = 'style="background:url(';
                                //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                                $iUrl = get_field("post_large_image", $post['ID']);
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;"';
                            } else {
                                $style = 'style="background:url(';
                                //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                                $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;"';
                            }
                        }

                        $img_url = "";
                        if ($post_type == "expert_profiles" || $post_type == "videos" || $post_type == "podcasts" || $post_type == "videos/podcasts") {
                            if (!empty(get_field("partner_inner_banner", $post['ID']))) {

                                $image = get_field("partner_inner_banner", $post['ID']);
                                $size = 'large';
                                $img_url = $image['url'];

                                $style = 'style="background:url(';
                                $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", $img_url);
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;"';;
                            }
                        }
                        include get_template_directory() . '/components/posts/tpl-24.php';
                    } else if (!empty($pod_layout) && $cnt == 1 && $curtotal == 0) {
                        if (!has_post_thumbnail($post['ID'])) {
                            $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
                        } else {

                            if (!empty(get_field("post_large_image", $post['ID']))) {
                                $style = 'style="background:url(';
                                $iUrl = get_field("post_large_image", $post['ID']);
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;"';
                            } else {
                                $style = 'style="background:url(';
                                $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;"';
                            }
                        }

                        $img_url = "";
                        if ($post_type == "expert_profiles" || $post_type == "videos" || $post_type == "podcasts" || $post_type == "videos/podcasts") {
                            if (!empty(get_field("partner_inner_banner", $post['ID']))) {

                                $image = get_field("partner_inner_banner", $post['ID']);
                                $size = 'large';
                                $img_url = $image['url'];

                                $style = 'style="background:url(';
                                $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", $img_url);
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;"';;
                            }
                        }

                        include get_template_directory() . '/components/posts/tpl-25.php';
                    } else {

                        if (!$post_open_div) {
                            $rtn .= '<div class="blogs-loop-inner trb-row blogs-loop-inner-4 md-padding  mw-1500 trb-px">';
                            $post_open_div = true;
                        }

                        $styles = [];

                        if ($attr["post_type"] == "videos/podcasts" || $attr["post_type"] == "videos") {
                            if (0 <= $in_count && $in_count <= 2) {
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                            } // 3 in a row, style 4
                            else if (3 <= $in_count && $in_count <= 4) {
                                $st_2 = true;
                                $st_1 = false;
                                $st_3 = false;
                                $st_4 = false;
                                $st_5 = false;
                            } // 2 in a row, style 2
                            else if (5 <= $in_count && $in_count <= 7) {
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                            } // 3 in a row, style 4
                            else if (8 <= $in_count && $in_count <= 9) {
                                $st_2 = true;
                                $st_1 = false;
                                $st_3 = false;
                                $st_4 = false;
                                $st_5 = false;
                            } // 2 in a row, style 2
                            else if (10 <= $in_count && $in_count <= 15) {
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                            } // 6 in a row, style 4
                            else if (16 <= $in_count && $in_count <= 17) {
                                $st_2 = true;
                                $st_1 = false;
                                $st_3 = false;
                                $st_4 = false;
                                $st_5 = false;
                            } else if (18 <= $in_count && $in_count <= 23) {
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                            } else if (24 <= $in_count && $in_count <= 29) {
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                            } else if (30 <= $in_count && $in_count <= 35) {
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                            } else if (36 <= $in_count && $in_count <= 41) {
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                            }
                        } else {
                            if (0 <= $in_count && $in_count <= 1) {
                                $st_1 = false;
                                $st_2 = true;
                                $st_3 = false;
                                $st_4 = false;
                                $st_5 = false;
                            } else if (2 <= $in_count && $in_count <= 4) {
                                $st_2 = false;
                                $st_1 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                            } else if (5 <= $in_count && $in_count <= 6) {
                                $st_3 = true;
                                $st_1 = false;
                                $st_2 = false;
                                $st_4 = false;
                                $st_5 = false;
                            } else if (7 <= $in_count && $in_count <= 8) {
                                $st_4 = false;
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = true;
                                $st_5 = false;
                            } else if (9 <= $in_count && $in_count <= 11) {
                                $st_4 = false;
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_5 = true;
                            } else {
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                                $in_count = 0;
                            }

                            if ($attr["post_type"] == "expert_profiles") {
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                            }
                        }
                        if ($st_1) {
                            $styles[] = '1';
                        }
                        if ($st_2) {
                            $styles[] = '2';
                        }
                        if ($st_3) {
                            $styles[] = '3';
                        }
                        if ($st_4) {
                            $styles[] = '4';
                        }
                        if ($st_5) {
                            $styles[] = '5';
                        }
                        $styles_str = implode('-', $styles);

                        $rtn .= '<--- ' . $in_count . ' --->';
                                                $rtn .= do_shortcode('[post_box id=' . $post["ID"] . ']');



                        if (! isset($attr["post_type"]) || ($attr["post_type"] != "expert_profiles" && $attr["post_type"] != "videos" && $attr["post_type"] != "videos/podcasts")) {
                            if ($in_count == 6) {
                                if ($post_open_div) {
                                    $rtn .= '</div>';
                                }
                                $rtn .= '<div class="blogs-loop-watch-listen">';
                                $rtn .= '<div class="mw-1500 trb-px">';
                                $rtn .= '<h2 class="hp-h2">Watch &amp; Listen</h2>';
                                $rtn .= '</div>';

                                $rtn .=  do_shortcode('[blog_filter format="video-half" post_type="videos" orderby="rand" limit="3" categoryid="' . $categoryid . '"]');
                                $rtn .= '</div>';
                                $vid_count++;
                            } else if ($in_count == 9) {
                                if (empty($post_type)) {
                                    $rtn .= do_shortcode("[display_followus]");
                                    $exp_count++;
                                    if ($post_open_div) {
                                        $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-5">';
                                    }
                                }
                                $cat_count++;
                            } else if ($in_count == 8 && !empty($add_ad)) {
                                if ($add_ad == "Yes") {
                                    $add_ad = "No";
                                    if ($post_open_div) {
                                        $rtn .= '</div>';
                                    }
                                    $rtn .= do_shortcode("[ad_list]");
                                    if ($post_open_div) {
                                        $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-6 ">';
                                    }
                                } else {
                                    $add_ad = "Yes";

                                    if (get_post_type($post['ID']) == 'post') {
                                        if ($post_open_div) {
                                            $rtn .= '</div>';
                                        }
                                        $rtn .= do_shortcode("[display_followus]");
                                        $exp_count++;
                                        if ($post_open_div) {
                                            $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-7">';
                                        }
                                    }
                                }
                            }
                        } else {

                            if ($in_count == 23) {
                                if ($post_open_div) {
                                    $rtn .= '</div>';
                                }
                                $rtn .= do_shortcode("[display_followus]");
                                if ($post_open_div) {
                                    $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-8">';
                                }
                            } else if ($in_count == 29) {
                                if ($post_open_div) {
                                    $rtn .= '</div>';
                                }
                                $rtn .= do_shortcode("[display_insider]");
                                if ($post_open_div) {
                                    $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-9">';
                                }
                            } else if ($in_count == 35) {
                                if ($post_open_div) {
                                    $rtn .= '</div>';
                                }
                                $rtn .= do_shortcode("[get_giveaway_event post_type='giveaway-items']");
                                if ($post_open_div) {
                                    $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-10">';
                                }
                            } else if ($in_count == 41) {
                                if ($add_ad == "Yes") {
                                    $add_ad = "No";
                                    if ($post_open_div) {
                                        $rtn .= '</div>';
                                    }
                                    $rtn .= do_shortcode("[ad_list]");
                                    if ($post_open_div) {
                                        $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-11">';
                                    }
                                } else {
                                    $add_ad = "Yes";
                                }
                            }
                        }

                        if ($vid_count == 1 && $curtotal == 0 && (! isset($attr["post_type"]) || $attr["post_type"] != "videos" && $attr["post_type"] != "videos/podcasts")) {
                            $vid_count++;

                            if ($post_open_div) {
                                $rtn .= '</div>';
                            }

                            $rtn .=   do_shortcode('[blog_filter format="video" limit="4" order="rand" categoryid="' . $categoryid . '"]');

                            if ($post_open_div) {
                                $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-12">';
                            }
                        }

                        if ($in_count == 1) {
                            $exp_count++;
                        }


                        if (
                            $exp_count == 1
                            && $curtotal == 0
                            && (! isset($attr["post_type"])
                                || ($attr["post_type"] != "expert_profiles"
                                    && $attr["post_type"] != "videos"
                                    && $attr["post_type"] != "videos/podcasts"))
                        ) {

                            if ($post_open_div) {
                                $rtn .= '</div>';
                            }

                            // $cat = get_top_level_term_by_post_id($post_id, 'category');
                            $cat = get_term_by('id', $categoryid, 'category');
                            $category_colour = get_field('category_colour', $cat) ? get_field('category_colour', $cat) : '#3B1527';
                            $category_text_color = get_field('category_text_color', $cat) ? get_field('category_text_color', $cat) : '#FFDBD1';
                            $exp_count++;
                            $rtn .=   '
                            <div ' . $categoryid . ' class="experts-page-cara tpl-2649" style="--bg-color: ' . $category_colour . '; --text-color: ' . $category_text_color . '">
                                <!--<h2>' . $exp_count . '</h2>-->
                                ' . do_shortcode("[expert_list page='1' title='" . $globalCategoryName . " Experts" . "' categoryid='" . $categoryid . "']") . '
                            </div>
                            <link rel="stylesheet" href="/wp-content/themes/lighttheme/stylesheet/slick.css">
                            <link rel="stylesheet" href="/wp-content/themes/lighttheme/stylesheet/slick-theme.css">
                            <script src="/wp-content/themes/lighttheme/js/slick.js"></script>';
                            if ($post_open_div) {
                                $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-13">';
                            }
                        }

                        if ($curtotal == 0 && $cat_count == 1) {
                            $cat_count++;
                            if ($attr["post_type"] == "expert_profiles") {
                                if ($post_open_div) {
                                    $rtn .= '</div>';
                                }
                                $rtn .= do_shortcode("[category_list page='experts']");
                                if ($post_open_div) {
                                    $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-14 ">';
                                }
                            } else if ($attr["post_type"] == "videos") {
                                if ($post_open_div) {
                                    $rtn .= '</div>';
                                }
                                $rtn .= do_shortcode("[category_list page='videos']");
                                if ($post_open_div) {
                                    $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-15">';
                                }
                            } else if ($attr["post_type"] == "podcasts") {
                                if ($post_open_div) {
                                    $rtn .= '</div>';
                                }
                                $rtn .= do_shortcode("[category_list page='podcasts']");
                                if ($post_open_div) {
                                    $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-16">';
                                }
                            }
                        }

                        if ($curtotal == 0 && $giveaway_count == 1 && ($cur_post_type == "giveaway-items" || $cur_post_type == "offer-items" || $cur_post_type == "offer-items/giveaway-items/events" || $cur_post_type == "events")) {

                            $giveaway_count++;
                            $style_format = "";
                            $pos_format = "giveaway-items";
                            if ($cnt == 4) {
                                $style_format = "event-giveaway-outer-light-bg";
                                $pos_format = "offer-items";
                            }
                            if ($post_open_div) {
                                $rtn .= '</div>';
                            }
                            $rtn .= do_shortcode("[giveaway_list page='1']");
                            $rtn .= do_shortcode("[get_giveaway_event post_type='" . $pos_format . "' style_format='" . $style_format . "']");
                            if ($post_open_div) {
                                $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-17">';
                            }
                        }


                        $in_count++;
                    }
                }
            }

            if ($format == "video-half") {

                if ($home) {
                    $cur_id = $post['ID'];
                    $homepage_array .= "," . $cur_id;
                }

                if (!$post_open_div) {
                    $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-18">';
                    $post_open_div = true;
                }
                $rtn .= '<!--- home-video-even  ---> ';
                $rtn .= do_shortcode('[post_box id=' . $post["ID"] . ' format="video"]');
            }

            if ($format == "normal") {

                if ($home) {
                    $cur_id = $post['ID'];
                    $homepage_array .= "," . $cur_id;
                }

                if (!$post_open_div) {
                    $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-19">';
                    $post_open_div = true;
                }

                if ($cnt % 2 == 0) {
                    //even
                    $style = str_replace('style="', 'style="' . $addBorder, $style);
                    include get_template_directory() . '/components/posts/tpl-43.php';
                } else {

                    $style = str_replace('style="', 'style="' . $addBorder, $style);
                    include get_template_directory() . '/components/posts/tpl-44.php';
                }
            }

            if ($format == "normal-2") {

                if ($home) {
                    $cur_id = $post['ID'];
                    $homepage_array .= "," . $cur_id;
                }

                if (!$post_open_div) {
                    $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-20">';
                    $post_open_div = true;
                }

                if ($cnt % 2 == 0) {
                    $style = str_replace('style="', 'style="' . $addBorder, $style);
                    $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                    $style .= $iUrl;

                    include get_template_directory() . '/components/posts/home-posts-even.php';
                } else {
                    $style = str_replace('style="', 'style="' . $addBorder, $style);
                    $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                    $style .= $iUrl;

                    include get_template_directory() . '/components/posts/home-posts-odd.php';
                }
            }

            if ($format == "normal-3") {

                if ($home) {
                    $cur_id = $post['ID'];
                    $homepage_array .= "," . $cur_id;
                }

                if (!$post_open_div) {
                    $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-23">';
                    $post_open_div = true;
                }

                if ($cnt % 2 == 0) {
                    //even
                    $style = str_replace('style="', 'style="' . $addBorder, $style);
                    $style = 'style="background:url(';
                    $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                    $style .= $iUrl;
                    $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                    include get_template_directory() . '/components/posts/tpl-47.php';
                } else {

                    $style = str_replace('style="', 'style="' . $addBorder, $style);
                    $style = 'style="background:url(';
                    $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                    $style .= $iUrl;
                    $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                    include get_template_directory() . '/components/posts/tpl-48.php';
                }
            }

            if ($format == "normal-4") {
                if ($home) {
                    $cur_id = $post['ID'];
                    $homepage_array .= "," . $cur_id;
                }

                if (!$post_open_div) {
                    $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px blogs-loop-inner-24">';
                    $post_open_div = true;
                }

                if ($cnt % 2 == 0) {
                    //even
                    $style = str_replace('style="', 'style="' . $addBorder, $style);
                    include get_template_directory() . '/components/posts/home-small-post-even.php';
                } else {

                    $blkBg = "";
                    if (($in_count % 3) == 0) {
                        $blkBg = " style='background:#000;'";
                    }

                    $style = str_replace('style="', 'style="' . $addBorder, $style);
                    include get_template_directory() . '/components/posts/home-small-post-odd.php';
                }
            }

            if ($format == "video") {
                if ($cnt == 1) {
                    $rtn .= '<!--- home-trending-video  ---> ';
                    $rtn .= do_shortcode('[post_box_trending_video id=' . $post["ID"] . ']');

                    $rtn .= '<div class="blogs-loop-inner trb-row md-padding  mw-1500 trb-px">';
                } else {
                    $rtn .= '<!--- home-small-podcasts  ---> ';
                    $rtn .= do_shortcode('[post_box id=' . $post["ID"] . ' format="podcast"]');
                }

                if ($cnt == $limit) {
                    $rtn .= '</div>';
                }
            }
        }



        wp_reset_query();

        if ($post_open_div) {
            $rtn .= '</div>';
        }

        if ($home) {
            $_SESSION['homepage_array'] = $homepage_array;

            $rtn .= '<span style="display:none;" id="homepage_array"  class="homepage_array" data-exclude="' . $homepage_array . '"></span>';
        }

        $rtn .= '<div class="end"></div>';
        if ($format == "video") {
            $rtn .= '<a class="white-a" href="/watch-listen">View all Podcast Episodes and Videos</a>';
        }

        if ($format == "post-page" && $design == "" && count($recent_posts) > 0 && !empty($limit) && empty($id_list)) {
            $rtn .= '<div class="loadingmoreOuter">
            <a id="loadMore" onclick="return false;" data-add_ad="' . $add_ad . '" data-posttype="' . $post_type . '" data-count="' . (intval($curtotal) + intval($limit)) . '" class="loadmore"></a>
            </div>';
        }
        if ($post_type == "expert_profiles") {
            $rtn .= '</div>';
        }
        $rtn .= '</div>';
        return $rtn;
        $add_ad = "";
        $pod_layout = "";
        $orderby = "date";
        $func = "";
        $home = false;
        $large_image = "full";
        $medium_image = "medium";
        $small_image = "thumbnail";
    } else {
        //old-func
        $homepage_array = '';

        $rtn = "";
        $term_id = 0;

        $categoryid = "";
        $limit = 500;
        $curtotal = 0;
        $format = "";
        $post_type = "";
        $design = "";
        $add_ad = "";
        $pod_layout = "";

        $orderby = "date";

        $func = "";

        $home = false;
        //$excludeids;

        $large_image = "full";
        $medium_image = "medium";
        $small_image = "thumbnail";

        $useragent = $_SERVER['HTTP_USER_AGENT'];
        if (
            preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $useragent)
            || preg_match(
                '/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',
                substr($useragent, 0, 4)
            )
        ) {

            $large_image = "medium";
            $medium_image = "thumbnail";
        }

        $attributes_str = json_encode($attr);
        //html comments remove by dd
        //echo "<!-- [blog-filter] attributes: $attributes_str -->";

        if (!empty($attr["categoryid"])) {
            $categoryid = $attr["categoryid"];
        }
        if (!empty($attr["limit"])) {
            $limit = $attr["limit"];
        }
        if (!empty($attr["format"])) {
            $format = $attr["format"];
        }
        if (!empty($attr["post_type"])) {
            $post_type = $attr["post_type"];
        }
        if (!empty($attr["curtotal"])) {
            $curtotal = $attr["curtotal"];
        }
        if (!empty($attr["design"])) {
            $design = $attr["design"];
        }
        if (!empty($attr["add_ad"])) {
            $add_ad = $attr["add_ad"];
        }
        if (!empty($attr["orderby"])) {
            $orderby = $attr["orderby"];
        }
        if (!empty($attr["id_list"])) {
            $id_list = $attr["id_list"];
            $id_list = explode(',', $id_list);
        }
        if (!empty($attr["pod_layout"])) {
            $pod_layout = $attr["pod_layout"];
        }
        if (!empty($attr["func"])) {
            $func = $attr["func"];
        }

        //echo "<!-- \$id_list: " . json_encode($id_list) . " -->";

        if (!empty($attr["home"])) {
            $home = true;
            //$excludeids = $homepage_array;
            //$ex_list = $homepage_array;
        }
        if (isset($_SESSION['homepage_array'])) {
            $homepage_array = $_SESSION['homepage_array'];

            if (empty($homepage_array) && !empty($attr["exclude"])) {
                $homepage_array = $attr["exclude"];
            }
        }

        $globalCategoryName = "";

        if (!empty($categoryid)) {
            $category = get_category($categoryid);
            //$currentcat = $categories[0]->cat_ID;
            $globalCategoryName = $category->name;
        }

        $exClass = "";

        $recent_posts = null;


        $excluded_posts_IDs = get_excluded_b2b_posts();
        //var_dump($excluded_posts_IDs);

        if (!empty($id_list) > 0) {

            $post_types = explode('/', $post_type);
            //html comments remove by dd
            //echo "<!-- \$post_types: " . json_encode($post_types) . " -->";

            $recent_posts = wp_get_recent_posts(array(
                'numberposts' => $limit,
                'post_status' => 'publish',
                //'orderby' => 'date',
                //'orderby' => 'rand',
                'post_type' => $post_types,
                //'order' => 'DESC',
                //'include' => $id_list
                'orderby' => 'post__in',
                'post__in' => $id_list,
                'exclude' => $excluded_posts_IDs,
            ));
        } else {

            if (!empty($categoryid)) {

                if ($home) {
                    if (is_string($homepage_array)) {
                        $excludeids = explode(',', $homepage_array);
                        //echo "<h1 style='display:none;'>".$homepage_array."</h1>";
                        $recent_posts = wp_get_recent_posts(array(
                            'numberposts' => $limit,
                            'orderby'     => $orderby,
                            'order'       => 'desc',
                            'post_status' => 'publish',
                            'category'    => $categoryid,
                            'offset'      => $curtotal,
                            'exclude'     => array_merge($excludeids, $excluded_posts_IDs),
                        ));
                    } else {
                        //show_message('Error: $homepage_array is empty');
                        var_dump($homepage_array);
                    }
                } else {
                    $recent_posts = wp_get_recent_posts(array(
                        'numberposts' => $limit,
                        'orderby'     => $orderby,
                        'order'       => 'desc',
                        'post_status' => 'publish',
                        'category'    => $categoryid,
                        'offset'      => $curtotal,
                        'exclude'     => $excluded_posts_IDs,
                    ));
                }
            } else {
                if ($home) {
                    $excludeids = explode(',', $homepage_array);
                    //echo "<h1 style='display:none;'>".$homepage_array."</h1>";
                    $recent_posts = wp_get_recent_posts(array(
                        'numberposts' => $limit,
                        'orderby'     => $orderby,
                        'order'       => 'desc',
                        //'category__not_in' => get_terms('category', array(
                        //'fields' => 'ids'
                        //)),
                        'post_status' => 'publish',
                        'offset'      => $curtotal,
                        'exclude'     => array_merge($excludeids, $excluded_posts_IDs),
                    ));
                } else {
                    $recent_posts = wp_get_recent_posts(array(
                        'numberposts' => $limit,
                        'orderby'     => $orderby,
                        'order'       => 'desc',
                        //'category__not_in' => get_terms('category', array(
                        //'fields' => 'ids'
                        //)),
                        'post_status' => 'publish',
                        'offset'      => $curtotal,
                        'exclude'     => $excluded_posts_IDs,
                    ));
                }
            }



            if ($format == "video") {
                $exClass = "vid-dark-green";
                /*
            if (!empty($categoryid)){
                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => $limit,
                    'post_type'=> array( 'videos', 'podcasts'),
                    'orderby'           => 'date',
                    'order'             => 'desc',
                    //'category__not_in' => get_terms('category', array(
                    //'fields' => 'ids'
                    //)),
                    'category'         => $categoryid,
                    'post_status' => 'publish'
                ));
            } else {
                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => $limit,
                    'post_type'=> array( 'videos', 'podcasts'),
                    'orderby'           => 'date',
                    'order'             => 'desc',
                    //'category__not_in' => get_terms('category', array(
                    //'fields' => 'ids'
                    //)),
                    'post_status' => 'publish'
                ));
            } */

                if (!empty($categoryid)) {

                    $child = get_category($categoryid);
                    $parent = $child->parent;
                    $parent_name = get_category($parent);

                    if (!empty($parent_name->parent)) {
                        $parent = $parent_name->parent;
                        $parent_name = get_category($parent_name->parent);
                    }

                    if (!empty($parent)) {
                        $categoryid = $parent;
                    }

                    $recent_posts1 = wp_get_recent_posts(array(
                        'numberposts' => 1,
                        'post_type' => 'videos',
                        'orderby'           => 'rand',
                        //'order'             => 'desc',
                        'category'         => $categoryid,
                        'post_status' => 'publish',
                        'meta_query' => array(
                            array(
                                'key'     => 'featured_podcast_video',
                                'value'   => '1',
                                'compare' => '='
                            )
                        ),
                        'exclude' => $excluded_posts_IDs,
                    ));

                    $recent_posts2 = wp_get_recent_posts(array(
                        'numberposts' => $limit - 1,
                        'post_type' => 'podcasts',
                        'orderby'           => 'rand',
                        //'order'             => 'desc',
                        'category'         => $categoryid,
                        'post_status' => 'publish',
                        'meta_query' => array(
                            array(
                                'key'     => 'promo_podcast',
                                'value'   => '1',
                                'compare' => '='
                            )
                        ),
                        'exclude' => $excluded_posts_IDs,
                    ));

                    $recent_posts = array_merge($recent_posts1, $recent_posts2);
                } else {
                    $recent_posts1 = wp_get_recent_posts(array(
                        'numberposts' => 1,
                        'post_type' => 'videos',
                        'orderby'           => 'rand',
                        //'order'             => 'desc',
                        'post_status' => 'publish',
                        'meta_query' => array(
                            array(
                                'key'     => 'featured_podcast_video',
                                'value'   => '1',
                                'compare' => '='
                            )
                        ),
                        'exclude' => $excluded_posts_IDs,
                    ));
                    $recent_posts2 = wp_get_recent_posts(array(
                        'numberposts' => $limit - 1,
                        'post_type' => 'podcasts',
                        'orderby'           => 'rand',
                        //'order'             => 'desc',
                        'post_status' => 'publish',
                        'meta_query' => array(
                            array(
                                'key'     => 'promo_podcast',
                                'value'   => '1',
                                'compare' => '='
                            )
                        ),
                        'exclude' => $excluded_posts_IDs,
                    ));

                    $recent_posts = array_merge($recent_posts1, $recent_posts2);
                }
            }

            if ($post_type != "") {
                if (empty($categoryid)) {
                    $categoryid = null;
                }

                $post_types = explode('/', $post_type);

                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => $limit,
                    'post_status' => 'publish',
                    'orderby' => $orderby,
                    //'orderby' => 'rand',
                    'cat' => $categoryid,
                    'post_type' => $post_types,
                    'order' => 'DESC',
                    'offset' => $curtotal,
                    'exclude' => $excluded_posts_IDs,
                ));
            }
        }

        if ($func == 'podcast-limit4') {
            $recent_posts1 = wp_get_recent_posts(array(
                'numberposts' => 1,
                'post_type' => 'podcasts',
                'orderby'           => 'date',
                //'order'             => 'desc',
                //'category'         => 1159, // Wellbeing term id
                'post_status' => 'publish',
                'meta_query' => array(
                    array(
                        'key'     => 'featured_category',
                        'value'   => 'fertility',
                        'compare' => 'LIKE'
                    )
                ),
                'exclude' => $excluded_posts_IDs,
            ));

            $recent_posts2 = wp_get_recent_posts(array(
                'numberposts' => 1,
                'post_type' => 'podcasts',
                'orderby'           => 'date',
                //'order'             => 'desc',
                //'category'         => 1164,
                'post_status' => 'publish',
                'meta_query' => array(
                    array(
                        'key'     => 'featured_category',
                        'value'   => 'wellbeing',
                        'compare' => 'LIKE'
                    )
                ),
                'exclude' => $excluded_posts_IDs,
            ));

            $recent_posts3 = wp_get_recent_posts(array(
                'numberposts' => 1,
                'post_type' => 'podcasts',
                'orderby'           => 'date',
                //'order'             => 'desc',
                //'category'         => 1165,
                'post_status' => 'publish',
                'meta_query' => array(
                    array(
                        'key'     => 'featured_category',
                        'value'   => 'pregnancy',
                        'compare' => 'LIKE'
                    )
                ),
                'exclude' => $excluded_posts_IDs,
            ));

            $recent_posts4 = wp_get_recent_posts(array(
                'numberposts' => 1,
                'post_type' => 'podcasts',
                'orderby'           => 'date',
                //'order'             => 'desc',
                //'category'         => 1163,
                'post_status' => 'publish',
                'meta_query' => array(
                    array(
                        'key'     => 'featured_category',
                        'value'   => 'parenting',
                        'compare' => 'LIKE'
                    )
                ),
                'exclude' => $excluded_posts_IDs,
            ));

            $recent_posts = array_merge($recent_posts1, $recent_posts2, $recent_posts3, $recent_posts4);
        }

        $in_count = 0;
        $st_1 = false;
        $st_2 = false;
        $st_3 = false;
        $st_4 = false;
        $st_5 = false;

        $exp_count = 0;
        $vid_count = 0;
        $cat_count = 0;
        $giveaway_count = 0;

        $cnt = 0;

        $post_open_div = false;

        //var_dump($recent_posts);

        $rtn .= '<div class="blogs-loop ' . $exClass . '">';

        if ($post_type == "expert_profiles") {
            $rtn .= '<div class="experts-loop">';
        }


        if ($post_type == "podcasts" && empty($id_list) && empty($pod_layout)) {

            $pc_post_excerpt = get_the_excerpt(22826);

            if (!has_post_thumbnail(22826)) {
                $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
            } else {
                $style = 'style="background:url(';
                //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url(22826, $large_image));
                $style .= $iUrl;
                $style .= '); background-size:cover; background-position:center;"';;
            }
            include get_template_directory() . '/components/posts/tpl-1.php';

            if ($post_type == "podcasts" && empty($id_list)) {
                if (!empty($attr["categoryid"])) {

                    if ($func == 'podcast-limit4') {
                        $rtn .= "<h2 class='cate-h2-ph'>Explore by Category</h2>";
                    } else {
                        $rtn .= "<h2 class='cate-h2-ph'>More " . $globalCategoryName . " Podcasts" . $func . "</h2>";
                    }
                }
            }
        }


        //var_dump(count($recent_posts));


















        // =================================================================================================================
        // The processing of the results
        // =================================================================================================================

        foreach ($recent_posts as $post) {
            //        $is_b2b_only_content = get_field('b2b_content', $post['ID']);
            //        //var_dump($is_b2b_only_content);
            //        //var_dump(is_b2b_page());
            //        if ($is_b2b_only_content && ! is_b2b_page()) {
            //          //var_dump("Cannot show post '" . $post["ID"] . "' on non-B2B page");
            //          continue;
            //        }
            //html comments remove by dd
            // echo '<!-- post id: ' . $post['ID'] . ' -->';
            $cnt++;

            //$port_logo = get_field("portfolio_logo", $post['ID']);
            $term = get_the_terms($post['ID'], '');
            $names  = wp_list_pluck($term, 'name');
            $this_post_type = get_post_type($post["ID"]);
            $cur_post_type = $this_post_type;

            $output = "";
            foreach ($names as $name) {
                $output .= '<span class="cat-tag">' . $name . '</span>';
            }

            if ($post_type == "expert_profiles" || $post_type == "videos" || $post_type == "podcasts" || $post_type == "videos/podcasts") {
                $img_url = "";
                //if ($post_type == "expert_profiles"){
                $partner_inner_banner = get_field("partner_inner_banner", $post['ID']);
                if (!has_post_thumbnail($post['ID']) && $cnt == 1) {
                    if (!empty($partner_inner_banner)) {
                        $image = get_field("partner_inner_banner", $post['ID']);
                        $size = $small_image;
                        $img_url = $image['sizes'][$size];
                    }
                } else {
                    $img_url = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], $large_image));
                }
                //}
                //if ($post_type == "offer-items"){ $img_url = get_field("partner_inner_banner", $post['ID']); }

                $style = 'style="background:url(';
                //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", $img_url);
                $style .= $iUrl;
                $style .= '); background-size:cover; background-position:center;"';;
            } else {
                if (!has_post_thumbnail($post['ID'])) {
                    $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
                } else {
                    $style = 'style="background:url(';
                    //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                    $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], $small_image));
                    $style .= $iUrl;
                    $style .= '); background-size:cover; background-position:center;"';;
                }
            }

            // remove once have images...
            //$style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';

            //$text = strip_shortcodes( $post['post_content'] );
            //$text = apply_filters( 'the_content', $text );
            //$text = str_replace(']]>', ']]&gt;', $text);
            //$excerpt_length = apply_filters( 'excerpt_length', 55 );
            //$excerpt_more = apply_filters( 'excerpt_more', ' ' . '&hellip;' );
            //$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
            WPBMap::addAllMappedShortcodes();

            $text = wp_strip_all_tags(get_the_excerpt($post['ID']));

            //$text = preg_replace( "/\\[&hellip;\\]/",'',$text);


            //$cat = get_post_meta( $post['ID'], 'rank_math_primary_category', true );


            $categories = get_the_category($post["ID"]);
            if ($home) {
                //$termIdVal = 'term_' . $categoryid;
                //$categories = get_category($termIdVal);
            }
            $currentcat = $categories[0]->cat_ID;
            $currentcatname = $categories[0]->cat_name;
            $currentcatslug = $categories[0]->slug;
            $cat_p = get_ancestors($categories[0]->term_id, 'category');

            if (!empty($categoryid) && $func != 'podcast-limit4') {
                $term1 = get_term_by('id', $categoryid, 'category');
                $currentcat = $categoryid;
                $currentcatname = $term1->name;
                $currentcatslug = $term1->slug;
                //$termIdVal = 'term_' . $categoryid;
                //$categories = get_category($termIdVal);
                $cat_p = get_ancestors($categoryid, 'category');
            }

            //$cat_p = get_ancestors( $categories[0]->term_id, 'category' );


            $termIdVal = 'term_' . $currentcat;

            if (count($cat_p) > 0) {
                $termIdVal = 'term_' . $cat_p[0];
            }


            $bcolour = "#F77D66";

            if (!empty(get_field("category_colour", $termIdVal))) {
                $bcolour = get_field("category_colour", $termIdVal);
            }

            $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
            $addBorder = 'border-top: 5px solid ' . $bcolour . ';';

            $featured_podcast = get_field("promo_podcast", $post["ID"]);
            $featured_video = get_field("featured_podcast_video", $post["ID"]);
            $featured_giveaway = get_field("featured", $post["ID"]);
            $featured_expert = get_field("featured_expert", $post["ID"]);

            $featured_handpicked = get_field("handpicked", $post["ID"]);

            $post_type_simp = "";

            $more_text = "Read<br>More";
            $more_t_text = "Read More";

            $ad = "";
            $addd = "";
            $hexRGB = $bcolour;
            if ($bcolour != "#034146") {
                $ad = '';
                $addd = "";
                //$ad = "bright color";
            } else {
                //$ad = "dark color";

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

            if ($this_post_type == 'videos') {
                $post_type_simp = "Video";
                $more_text = "Watch<br>Now";
                $more_t_text = "Watch More";
            }
            if ($this_post_type == 'podcasts') {
                $post_type_simp = "Podcast";
                $more_text = "Listen<br>Now";
                $more_t_text = "Listen More";
            }
            if ($this_post_type == 'expert_profiles') {
                $post_type_simp = "Expert";
            }
            if ($this_post_type == 'offer-items') {
                $post_type_simp = "Offer";
            }
            if ($this_post_type == 'events') {
                $post_type_simp = "Event";
            }
            if ($this_post_type == 'giveaway-items') {
                $post_type_simp = "Giveaway";
            }
            if ($this_post_type == 'post') {
                $post_type_simp = "Article";
            }


            $featured_cur = "";

            if (!empty($featured_podcast) || !empty($featured_video) || !empty($featured_giveaway) || !empty($featured_expert)) {
                //$featured_cur = '<div class="featured-sign" style="background:'.$bcolour.'e8;"><p class="light-text"><span>Featured<br>'.$post_type_simp.'</span></p></div>';
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Featured</span><br>' . $post_type_simp . '</p></div>';
            }


            if (!empty($featured_handpicked)) {
                //$featured_cur = '<div class="featured-sign" style="background:'.$bcolour.';"><p class="light-text"><span>Handpicked<br>'.$currentcatname.'</span></p></div>';
                $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Handpicked</span><br>' . $currentcatname . '</p></div>';
            }

            $post_sticker = get_field("post_sticker", $post["ID"]);











            // =============================================================================================================
            // The setting of style variables
            // =============================================================================================================

            // A "post sticker" is the colourful circle with text that shows over the top-right of a post card
            if (!empty($post_sticker)) {
                if ($post_sticker == "Trending Wellbeing") {
                    $currentcat = 1159; // Wellbeing term id
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Trending</span><br>Wellbeing</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Trending</span><br>Fertility</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Trending</span><br>Pregnancy</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Trending</span><br>Parenting</p></div>';
                }
                if ($post_sticker == "Latest Wellbeing") {
                    $currentcat = 1159; // Wellbeing term id
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Latest</span><br>Wellbeing</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Latest</span><br>Fertility</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Latest</span><br>Pregnancy</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Latest</span><br>Parenting</p></div>';
                }
                if ($post_sticker == "Handpicked Wellbeing") {
                    $currentcat = 1159; // Wellbeing term id
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Handpicked</span><br>Wellbeing</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Handpicked</span><br>Fertility</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Handpicked</span><br>Pregnancy</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Handpicked</span><br>Parenting</p></div>';
                }
                if ($post_sticker == "Editor’s Choice Wellbeing") {
                    $currentcat = 1159; // Wellbeing term id
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Editor’s Choice</span><br>Wellbeing</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Editor’s Choice</span><br>Fertility</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Editor’s Choice</span><br>Pregnancy</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Editor’s Choice</span><br>Parenting</p></div>';
                }
                if ($post_sticker == "Spotlight Experts") {
                    //NO
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Spotlight</span><br>Experts</p></div>';
                }
                if ($post_sticker == "Wellbeing Expert") {
                    $currentcat = 1159; // Wellbeing term id
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Wellbeing</span><br>Expert</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Fertility</span><br>Expert</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Pregnancy</span><br>Expert</p></div>';
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
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Parenting</span><br>Expert</p></div>';
                }
                if ($post_sticker == "Featured Expert") {
                    //NO
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Featured</span><br>Expert</p></div>';
                }
                if ($post_sticker == "Featured Video") {
                    //NO
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Featured</span><br>Video</p></div>';
                }
                if ($post_sticker == "Featured Giveaway") {
                    //NO
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Featured</span><br>Giveaway</p></div>';
                }
                if ($post_sticker == "Featured Podcast") {
                    //NO
                    $featured_cur =  '<div class="exprets-de-circle" style="background:' . $bcolour . 'e8;"><p ' . $ad . '><span>Featured</span><br>Podcast</p></div>';
                }
            }


            $ext = '';


            if ($this_post_type == "videos") {
                $ext = '<img src="/wp-content/themes/lighttheme/images/vid-btn.png" class="vid-btn">';
            }
            if ($this_post_type == "podcasts") {
                $ext = '<img src="/wp-content/themes/lighttheme/images/pod-btn.png" class="vid-btn">';
            }


            $ex_txt = '';

            $live_post = false;

            if ($cur_post_type == "giveaway-items" || $cur_post_type == "events") {

                $select_competition_date = get_field("select_competition_date", $post["ID"]);

                if (!empty($select_competition_date)) {
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

                    if (!empty($offer_expired_text)):
                        $date_txt = $offer_expired_text . " ";
                    endif;


                    //$ex_txt = '<h3>'.$date_txt.$displayformat . '</h3>';
                    $ex_txt = '<h3 class="date-giveaways">CLOSING DATE ' . $displayformatB . '</h3>';
                }
            }

            if ($cur_post_type == "offer-items") {

                $offer_expired_text = get_field("offer-expired-text", $post["ID"]);
                $offer_expiry_date = get_field("offer_expiry_date", $post["ID"]);

                if (!empty($offer_expiry_date)):
                    $today = date("Y-m-d");
                    $date = $offer_expiry_date;
                    $time = strtotime($date);
                    $newformat = date('Y-m-d', $time);

                    $displayformatB = date('j M Y', $time);

                    $time = strtotime($date);
                    $newukformat = date('d-m-Y', $time);

                    $date_txt = "Offer Open: ";

                    $live_post = true;

                    if ($newformat < $today) {
                        $date_txt = "Offer Closed: ";
                        $live_post = false;
                    }

                    if (!empty($offer_expired_text)):
                        $date_txt = $offer_expired_text . " ";
                    endif;


                    //$ex_txt = '<h3>'.$date_txt.$newukformat . ' '. $displayformatB .'</h3>';
                    $ex_txt = '<h3 class="date-giveaways">OFFER CLOSE ' . $displayformatB . '</h3>';
                endif;
            }



















            // =====================================================================================================
            // The output (templates)
            // =====================================================================================================


            if ($format == "home-banner") {
                //html comments remove by dd
                //echo '<!-- if ($format == "home-banner") -->';

                //html comments remove by dd
                //echo "<!-- Count: $cnt -->";
                if ($cnt <= 0) {
                    echo 'No posts found for ' . $format;
                }
                if ($cnt == 1) {
                    //html comments remove by dd
                    //echo '<!-- if ($cnt == 1) -->';

                    if (!has_post_thumbnail($post['ID'])) {
                        $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
                    } else {
                        if (!empty(get_field("post_large_image", $post['ID']))) {
                            $style = 'style="background:url(';
                            //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                            $iUrl = get_field("post_large_image", $post['ID']);
                            //echo($iUrl);
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;color:blue;"';
                        } else {
                            $style = 'style="background:url(';
                            //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                            $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], $small_image));
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;"';
                        }
                    }
                    //include get_template_directory() . '/components/post-items/home-banner.php';
                    include get_template_directory() . '/components/posts/home-top-banner.php';
                } else if ($cnt == 2) {
                    //html comments remove by dd
                    //echo '<!-- else if ($cnt == 2) -->';
                    //$style = str_replace('style="', 'style="'.$addBorder, $style);
                    // $rtn .= '<div class="blog-top-1">
                    //<div class="blog-l-text-out">
                    //<div class="blog-l-text">
                    //<h3>'.$currentcatname.'</h3>
                    //<h2>'.$post['post_title'].'</h2>
                    //<h4>'.get_the_date('j M Y', $post["ID"]).'</h4>
                    //<div class="blog-btns">
                    //<a href="'.get_permalink($post['ID']).'">'.$more_t_text.'</a>
                    //</div>
                    //</div>
                    //</div>
                    //<div class="blog-l-img-out">
                    //<div class="blog-l-img" '.$style.'><img src="/wp-content/themes/lighttheme/images/a_squ_trans.png">
                    //</div>
                    //</div>
                    //</div>';
                } else if ($cnt == 3) {
                    // $style = str_replace('style="', 'style="'.$addBorder, $style);
                    // $rtn .= '<div class="blog-top-2">
                    //<div class="blog-l-img" '.$style.'><img src="/wp-content/themes/lighttheme/images/a_squ_trans.png">
                    //</div>
                    //<div class="blog-l-text-out">
                    //<div class="blog-l-text">
                    //<h3>'.$currentcatname.'</h3>
                    //<h2>'.$post['post_title'].'</h2>
                    //<h4>'.get_the_date('j M Y', $post["ID"]).'</h4>
                    //<div class="blog-btns">
                    //<a href="'.get_permalink($post['ID']).'">'.$more_t_text.'</a>
                    //</div>
                    //</div>
                    //</div>
                    //</div>';
                } else {
                }
            }
            if ($format == "post-page" && !empty($id_list)) {
                //html comments remove by dd
                //echo '<!-- if ($format == "post-page" && !empty($id_list)) -->';
                /////EREEE

                if (!$post_open_div) {
                    $rtn .= '<div class="blogs-loop-inner">';
                    $post_open_div = true;
                }
                $style = str_replace('style="', 'style="' . $addBorder, $style);

                // If "in count?" is even
                if ($in_count % 2 == 0) {
                    //html comments remove by dd
                    //echo '<!-- if ($in_count % 2 == 0) -->';

                    $curposttypeval = get_post_type($post['ID']);
                    //html comments remove by dd
                    //echo "<!-- \$curposttypeval: $curposttypeval -->";
                    if ($curposttypeval == "offer-items" || $curposttypeval == "giveaway-items" || $curposttypeval == "events") {
                        if (!isset($adClas)) {
                            $adClas = '';
                        }

                        if ($curposttypeval == "giveaway-items") {
                            $style = 'style="background:url(';
                            $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';
                            include get_template_directory() . '/components/posts/giveaway-item-even.php';
                        } else if ($cur_post_type == "offer-items") {
                            $link = get_permalink($post['ID']);
                            $website_link = get_field("website_link", $post["ID"]);
                            $new_tab = "";
                            if (!empty($website_link)) {
                                $link = $website_link;
                                $new_tab = "target='_blank'";
                            }
                            $style = 'style="background:url(';
                            $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';
                            include get_template_directory() . '/components/posts/tpl-4.php';
                        } else if ($curposttypeval == "offer-items/giveaway-items/events") {
                            $style = 'style="background:url(';
                            $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';
                            include get_template_directory() . '/components/posts/tpl-5.php';
                        } else if ($curposttypeval == "events") {
                            $link = get_permalink($post['ID']);
                            $website_link = get_field("website_link", $post["ID"]);
                            $new_tab = "";
                            if (!empty($website_link)) {
                                $link = $website_link;
                                $new_tab = "target='_blank'";
                            }
                            $speakerName = "";
                            $speaker_name = get_field("speaker_name", $post["ID"]);
                            if (!empty($speaker_name)) {
                                $speakerName = '<p class="speaker-name">' . $speaker_name . '</p>';
                            }
                            include get_template_directory() . '/components/posts/tpl-6.php';
                        }

                        if ($curposttypeval == "offer-items") {
                            $btn_text = "Buy Now";
                            if (!$live_post) {
                                $btn_text = "Offer Closed";
                            }

                            $apply__code = get_field("apply__code", $post["ID"]);
                            $website_link = get_field("website_link", $post["ID"]);
                            if (!empty($apply__code)):
                                $link = get_permalink($post['ID']);
                                $new_tab = "";

                                if (!empty($website_link)) {
                                    $link = $website_link;
                                    $new_tab = "target='_blank'";
                                }

                                $rtn .= '<div class="blog-btns">
                                <a ' . $new_tab . ' href="' . $link . '">' . $btn_text . '</a>
                                </div>
                                <hr>';

                                if ($apply__code) {
                                    $rtn .= '<h3 style="text-transform:unset; font-weight:500 !important;">Use code <strong>' . $apply__code . '</strong> at checkout</h3>';
                                }
                                $rtn .= '<div class="listen-btns">
                                <a data-code="' . $apply__code . '" ' . $new_tab . ' class="copy-discount" href="' . $link . '">Buy With Discount</a>
                                </div>';
                            else:
                                $rtn .= '<div class="listen-btns">
                                <a ' . $new_tab . ' href="' . $link . '">Buy With Discount</a>
                                </div>';
                            endif;
                        } else if ($curposttypeval == "giveaway-items") {
                            $btn_text = "Enter Now";
                            if (!$live_post) {
                                $btn_text = "Giveaway Closed";
                            }

                            $rtn .= '<div class="blog-btns">
                            <a style="color:#000;" href="' . get_permalink($post['ID']) . '">' . $btn_text . '</a>
                            </div>';
                        } else if ($curposttypeval == "events") {

                            $link = get_permalink($post['ID']);
                            $new_tab = "";
                            $website_link = get_field("website_link", $post["ID"]);
                            if (!empty($website_link)) {
                                $link = $website_link;
                                $new_tab = "target='_blank'";
                            }

                            $btn_text = "Find Out More";


                            $rtn .= '<div class="blog-btns">
                            <a style="color:#000;" ' . $new_tab . ' href="' . $link . '">' . $btn_text . '</a>
                            </div>';
                        }

                        $rtn .= '</div>
                        </div>
                        <div class="end">
                        </div>
                        </div>';
                    } else {
                        if (!isset($attr["post_type"])) {
                            // Show error
                        }
                        if (! isset($attr["post_type"]) || $attr["post_type"] === "expert_profiles") {
                            $style = 'style="background:url(';
                            $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                            include get_template_directory() . '/components/posts/tpl-7.php';
                        }
                        /*// this code was making all other post types (including posts) show twice
                    // Because of the bad if-statement logic*/ else {
                            $style = 'style="background:url(';
                            $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                            include get_template_directory() . '/components/posts/tpl-7.5.php';
                        }
                    }
                } // if ($in_count % 2 != 0)
                else {
                    //html comments remove by dd
                    //echo '<!-- NOT if ($in_count % 2 == 0) -->';

                    $curposttypeval = get_post_type($post['ID']);
                    if (!isset($adClas)) {
                        $adClas = '';
                    }

                    if (
                        $curposttypeval == "offer-items"
                        || $curposttypeval == "giveaway-items"
                        || $curposttypeval == "events"
                    ) {

                        if ($curposttypeval == "giveaway-items") {
                            $style = 'style="background:url(';
                            $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                            include get_template_directory() . '/components/posts/tpl-8.php';
                        } else if ($cur_post_type == "offer-items") {
                            $link = get_permalink($post['ID']);
                            $website_link = get_field("website_link", $post["ID"]);
                            $new_tab = "";
                            if (!empty($website_link)) {
                                $link = $website_link;
                                $new_tab = "target='_blank'";
                            }
                            $style = 'style="background:url(';
                            $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                            include get_template_directory() . '/components/posts/tpl-9.php';
                        } else if ($curposttypeval == "offer-items/giveaway-items/events") {
                            $style = 'style="background:url(';
                            $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                            $style .= $iUrl;
                            $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                            include get_template_directory() . '/components/posts/tpl-10.php';
                        } else if ($curposttypeval == "events") {
                            $link = get_permalink($post['ID']);
                            $website_link = get_field("website_link", $post["ID"]);
                            $new_tab = "";
                            if (!empty($website_link)) {
                                $link = $website_link;
                                $new_tab = "target='_blank'";
                            }
                            $speakerName = "";
                            $speaker_name = get_field("speaker_name", $post["ID"]);
                            if (!empty($speaker_name)) {
                                $speakerName = '<p class="speaker-name">' . $speaker_name . '</p>';
                            }
                            include get_template_directory() . '/components/posts/tpl-11.php';
                        }

                        if ($curposttypeval == "offer-items") {
                            $btn_text = "Buy Now";
                            if (!$live_post) {
                                $btn_text = "Offer Closed";
                            }

                            $apply__code = get_field("apply__code", $post["ID"]);
                            $website_link = get_field("website_link", $post["ID"]);

                            if (!empty($apply__code)):
                                $link = get_permalink($post['ID']);
                                $new_tab = "";

                                if (!empty($website_link)) {
                                    $link = $website_link;
                                    $new_tab = "target='_blank'";
                                }

                                $rtn .= '<div class="blog-btns">
                                <a ' . $new_tab . ' href="' . $link . '">' . $btn_text . '</a>
                                </div>
                                <hr>';

                                if ($apply__code) {
                                    $rtn .= '<h3 style="text-transform:unset; font-weight:500 !important;">Use code <strong>' . $apply__code . '</strong> at checkout</h3>';
                                }
                                $rtn .= '<div class="listen-btns">
                                <a data-code="' . $apply__code . '" ' . $new_tab . ' class="copy-discount" href="' . $link . '">Buy With Discount</a>
                                </div>';
                            else:
                                $rtn .= '<div class="listen-btns">
                                <a ' . $new_tab . ' href="' . $link . '">Buy With Discount</a>
                                </div>';
                            endif;
                        } else if ($curposttypeval == "giveaway-items") {

                            $btn_text = "Enter Now";
                            if (!$live_post) {
                                $btn_text = "Giveaway Closed";
                            }

                            $rtn .= '<div class="blog-btns">
                            <a style="color:#000;" href="' . get_permalink($post['ID']) . '">' . $btn_text . '</a>
                            </div>';
                        } else if ($curposttypeval == "events") {

                            $link = get_permalink($post['ID']);
                            $new_tab = "";
                            $website_link = get_field("website_link", $post["ID"]);
                            if (!empty($website_link)) {
                                $link = $website_link;
                                $new_tab = "target='_blank'";
                            }

                            $btn_text = "Find Out More";


                            $rtn .= '<div class="blog-btns">
                            <a style="color:#000;" ' . $new_tab . ' href="' . $link . '">' . $btn_text . '</a>
                            </div>';
                        }

                        $rtn .= '</div>
                        </div>
                        <div class="end">
                        </div>
                        </div>';
                    } else {
                        if (! isset($attr["post_type"]) || $attr["post_type"] == "expert_profiles") {
                            $blkBg = "";
                            if (($in_count % 3) == 0) {
                                $blkBg = " style='background:#000;'";
                            }
                            include get_template_directory() . '/components/posts/tpl-12.php';
                        }
                        /*else {
                        $style = 'style="background:url(';
                        $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                        $style .= $iUrl;
                        $style .= '); background-size:cover; background-position:center;'.$addBorder.'"';
                        include get_template_directory() . '/components/posts/tpl-13.php';
                    }*/
                    }
                }
            } else if ($format == "post-page" && empty($id_list)) {
                //html comments remove by dd
                //echo '<!-- else if ($format == "post-page" && empty($id_list)) -->';

                if (!empty($attr["post_type"]) && false) {
                    //html comments remove by dd
                    //echo '<!-- if (!empty($attr["post_type"]) && false) -->';

                    // If the count is a multiple of 8
                    if (($cnt % 8) == 0) {
                        $rtn .= do_shortcode("[display_insider]");
                    }

                    if (($cnt % 20) == 0) {
                        $rtn .= do_shortcode("[display_followus]");
                    }

                    if (($cnt % 10) == 0 && $attr["post_type"] == "expert_profiles") {
                        $rtn .=  do_shortcode("[category_list page='experts']");
                    }

                    if (($cnt % 10) == 0 && $attr["post_type"] == "videos") {
                        $rtn .=  do_shortcode("[category_list page='videos']");
                    }
                }


                if ((! isset($attr["post_type"]) || $attr["post_type"] != "videos/podcasts")  && ($design == "full-vid-list" || $design == "full-pod-list")) {
                    //html comments remove by dd
                    //echo '<!-- if (isset($attr["post_type"]) && $attr["post_type"] != "videos/podcasts"  && ($design == "full-vid-list" || $design == "full-pod-list")) -->';

                    if ($cnt == 1 && $curtotal == 0 && false) {
                        //html comments remove by dd
                        //echo '<!-- if ($cnt == 1 && $curtotal == 0 && false) -->';

                        if (!has_post_thumbnail($post['ID'])) {
                            $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
                        } else {
                            if (!empty(get_field("post_large_image", $post['ID']))) {
                                $style = 'style="background:url(';
                                //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                                $iUrl = get_field("post_large_image", $post['ID']);
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;"';
                            } else {
                                $style = 'style="background:url(';
                                //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                                $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], $small_image));
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;"';
                            }
                        }

                        /*  if ($cur_post_type == "podcasts"){
                          //include get_template_directory() . '/components/posts/tpl-14.php';

                          include get_template_directory() . '/components/posts/tpl-15.php';

                      } else {
                    */

                        include get_template_directory() . '/components/posts/tpl-16.php';
                        //}

                        if ($design == "full-vid-list" || $design == "full-pod-list") {
                            if ($design == "full-vid-list") {
                                $rtn .= "<h3 id='fil-list-header'>All " . $globalCategoryName . " Videos</h3>";
                            }
                            if ($design == "full-pod-list") {
                                $rtn .= "<h3 id='fil-list-header'>All " . $globalCategoryName . " Podcasts</h3>";
                            }
                        }
                    } else {

                        if ($cnt == 1 && $attr["post_type"] != "podcasts") {
                            //html comments remove by dd
                            //echo '<!-- if ($cnt == 1 && $attr["post_type"] != "podcasts") -->';

                            include get_template_directory() . '/components/posts/tpl-17.php';
                        } else if (!empty($pod_layout) && $cnt == 1) {
                            //html comments remove by dd
                            //echo '<!-- else if (!empty($pod_layout) && $cnt == 1) -->';

                            if (!empty(get_field("partner_inner_banner", $post['ID']))) {
                                $image = get_field("partner_inner_banner", $post['ID']);
                                $size = $medium_image;
                                $partner_inner_banner = $image['url'];
                                $style = 'style="background:url(';
                                $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", $partner_inner_banner);
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;"';
                            }
                            include get_template_directory() . '/components/posts/tpl-18.php';

                            $podcast_iframe_code = get_field("podcast_iframe_code", $post['ID']);
                            if (!empty($podcast_iframe_code)) {
                                $rtn .= '
                                <br>&nbsp;<br>
                                <div class="podcast-iframe-outer">';
                                $rtn .= $podcast_iframe_code;
                                $rtn .= '</div>';
                            }
                            $rtn .= '</div>
                            </div>
                            </div>
                            </div>';
                            if ($post_type == "podcasts" && empty($id_list)) {
                                if (!empty($attr["categoryid"]) && empty($func)) {
                                    if ($func == 'podcast-limit4') {
                                        $rtn .= "<h2 class='cate-h2-ph'>Explore by Category</h2>";
                                    } else {
                                        $rtn .= "<h2 class='cate-h2-ph'>More " . $globalCategoryName . " Podcasts</h2>";
                                    }
                                }
                            }
                        } else {
                            ////html comments remove by dd
                            //echo '<!-- else -->';

                            if ($cnt == 2 && !empty($attr["categoryid"]) && $attr["post_type"] != "podcasts") {
                                $rtn .= "<h2 class='cate-h2-ph'>All " . $globalCategoryName . " Videos</h2>";
                            }

                            include get_template_directory() . '/components/posts/tpl-19.php';

                            if ($cur_post_type == "videos") {
                                $rtn .= '<div class="listen-btns">
                            <a href="' . get_permalink($post['ID']) . '">Watch Now</a>
                            </div>';
                            } else if ($cur_post_type == "podcasts") {
                                $rtn .= '<div class="listen-btns">
                            <a href="' . get_permalink($post['ID']) . '">Listen For Free</a>&nbsp;&nbsp;<a href="/community">SUBSCRIBE For Free</a>
                            </div><br>';
                            }
                            //$rtn .= create_item_socials(get_permalink($post['ID']), $post['post_title']);
                            $rtn .= '<h4>' . get_the_date('j M Y', $post["ID"]) . '</h4>' . create_item_socials(get_permalink($post['ID']), $post['post_title']) . '</div>
                            </div>
                            <div class="end">
                            </div>
                            </div>';
                        }
                    }
                } else if (
                    $cur_post_type == "giveaway-items"
                    || $cur_post_type == "offer-items"
                    || $cur_post_type == "offer-items/giveaway-items/events"
                    || $cur_post_type == "events"
                ) {
                    //html comments remove by dd
                    /*echo '<!-- else if ($cur_post_type == "giveaway-items"
                || $cur_post_type == "offer-items"
                || $cur_post_type == "offer-items/giveaway-items/events"
                || $cur_post_type == "events") -->';*/

                    //$rtn .= do_shortcode("[get_giveaway_event post_type='".$cur_post_type."' style_format='".$style_format."']");
                    if ($cnt == 4 || $cnt == 9) {
                        $style_format = "";
                        if ($cnt == 4) {
                            $style_format = "event-giveaway-outer-light-bg";
                        }
                        if ($post_open_div) {
                            $rtn .= '</div>';
                        }
                        if ($cur_post_type == "events") {
                            $rtn .= do_shortcode("[get_giveaway_event post_type='" . $cur_post_type . "' style_format='" . $style_format . "']");
                        } else {
                            $rtn .= do_shortcode("[get_giveaway_event post_type='giveaway-items' style_format='" . $style_format . "']");
                        }
                        //$rtn .= do_shortcode("[get_giveaway_event post_type='".$cur_post_type."' style_format='".$style_format."']");

                        if ($post_open_div) {
                            $rtn .= '<div class="blogs-loop-inner">';
                        }
                        //$rtn .= do_shortcode("[get_giveaway_event post_type='".$cur_post_type."' style_format='".$style_format."' post_id='".$post['ID']."']");
                    }

                    if (!has_post_thumbnail($post['ID'])) {
                        $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
                    } else {
                        $style = 'style="background:url(';
                        //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                        $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], $large_image));
                        $style .= $iUrl;
                        $style .= '); background-size:cover; background-position:center;"';;
                    }

                    if (!$post_open_div) {
                        $rtn .= '<div class="blogs-loop-inner">';
                        $post_open_div = true;
                    }

                    $adClas = "";
                    //if (($cnt % 7) == 0 || ($cnt % 7) == 0)
                    //if ($cnt == 7 || $cnt == 8)
                    if (($cnt % 7) == 0 || ($cnt % 8) == 0) {
                        $adClas = "blog-nor-half";
                        if ($cnt % 2 == 0) {
                        } else {
                            $adClas = "blog-nor-half blog-nor-half-1";
                        }
                    }

                    if ($cur_post_type == "giveaway-items") {
                        $style = 'style="background:url(';
                        $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                        $style .= $iUrl;
                        $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                        include get_template_directory() . '/components/posts/tpl-20.php';
                    } else if ($cur_post_type == "offer-items") {
                        $link = get_permalink($post['ID']);
                        $website_link = get_field("website_link", $post["ID"]);
                        $new_tab = "";
                        if (!empty($website_link)) {
                            $link = $website_link;
                            $new_tab = "target='_blank'";
                        }
                        $style = 'style="background:url(';
                        $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                        $style .= $iUrl;
                        $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                        include get_template_directory() . '/components/posts/tpl-21.php';
                    } else if ($cur_post_type == "offer-items/giveaway-items/events") {
                        $style = 'style="background:url(';
                        $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                        $style .= $iUrl;
                        $style .= '); background-size:cover; background-position:center; height:100% !important;' . $addBorder . '"';

                        include get_template_directory() . '/components/posts/tpl-22.php';
                    } else if ($cur_post_type == "events") {
                        $link = get_permalink($post['ID']);
                        $website_link = get_field("website_link", $post["ID"]);
                        $new_tab = "";
                        if (!empty($website_link)) {
                            $link = $website_link;
                            $new_tab = "target='_blank'";
                        }
                        $speakerName = "";
                        $speaker_name = get_field("speaker_name", $post["ID"]);
                        if (!empty($speaker_name)) {
                            $speakerName = '<p class="speaker-name">' . $speaker_name . '</p>';
                        }

                        include get_template_directory() . '/components/posts/tpl-23.php';
                    }

                    if ($cur_post_type == "offer-items") {
                        $btn_text = "Buy Now";
                        if (!$live_post) {
                            $btn_text = "Offer Closed";
                        }

                        $apply__code = get_field("apply__code", $post["ID"]);
                        $website_link = get_field("website_link", $post["ID"]);
                        if (!empty($apply__code)):
                            $link = get_permalink($post['ID']);

                            $new_tab = "";

                            if (!empty($website_link)) {
                                $link = $website_link;
                                $new_tab = "target='_blank'";
                            }

                            $rtn .= '<div class="blog-btns">
                            <a ' . $new_tab . ' href="' . $link . '">' . $btn_text . '</a>
                            </div>
                            <hr>';

                            if ($apply__code) {
                                $rtn .= '<h3 style="text-transform:unset; font-weight:500 !important;">Use code <strong>' . $apply__code . '</strong> at checkout</h3>';
                            }
                            $rtn .= '<div class="listen-btns">
                            <a data-code="' . $apply__code . '" ' . $new_tab . ' class="copy-discount" href="' . $link . '">Buy With Discount</a>
                            </div>';
                        else:
                            $rtn .= '<div class="listen-btns">
                            <a ' . $new_tab . ' href="' . $link . '">Buy With Discount</a>
                            </div>';
                        endif;
                    } else if ($cur_post_type == "giveaway-items") {

                        $btn_text = "Enter Now";
                        if (!$live_post) {
                            $btn_text = "Giveaway Closed";
                        }

                        $rtn .= '<div class="blog-btns">
                        <a style="color:#000;" href="' . get_permalink($post['ID']) . '">' . $btn_text . '</a>
                        </div>';
                    } else if ($cur_post_type == "events") {

                        $link = get_permalink($post['ID']);
                        $new_tab = "";
                        $website_link = get_field("website_link", $post["ID"]);
                        if (!empty($website_link)) {
                            $link = $website_link;
                            $new_tab = "target='_blank'";
                        }

                        $btn_text = "Find Out More";


                        $rtn .= '<div class="blog-btns">
                        <a style="color:#000;" ' . $new_tab . ' href="' . $link . '">' . $btn_text . '</a>
                        </div>';
                    }

                    $rtn .= '
                    </div>
                    </div>
                    <div class="end">
                    </div>
                    </div>';
                } else {
                    //html comments remove by dd
                    //echo '<!-- here 7623 -->';
                    //echo "<!-- \$cnt: $cnt -->";
                    //echo "<!-- \$attr[post_type]: " . ($attr["post_type"] ?? 'not defined') . " -->";
                    // echo "<!-- \$curtotal: $curtotal -->";

                    /*if ($cnt == 1 && $attr["post_type"] != "expert_profiles" && $attr["post_type"] != "podcasts" && $curtotal == 0){*/
                    if (
                        $cnt == 1
                        && (! isset($attr["post_type"])
                            || ($attr["post_type"] != "expert_profiles" && $attr["post_type"] != "podcasts"))
                        && $curtotal == 0
                    ) {
                        //html comments remove by dd
                        // echo '<!-- if ($cnt == 1 && isset($attr["post_type"]) && $attr["post_type"] != "expert_profiles" && $attr["post_type"] != "podcasts" && $curtotal == 0){ -->';

                        if (!has_post_thumbnail($post['ID'])) {
                            $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
                        } else {

                            if (!empty(get_field("post_large_image", $post['ID']))) {
                                $style = 'style="background:url(';
                                //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                                $iUrl = get_field("post_large_image", $post['ID']);
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;"';
                            } else {
                                $style = 'style="background:url(';
                                //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                                $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;"';
                            }
                        }

                        $img_url = "";
                        if ($post_type == "expert_profiles" || $post_type == "videos" || $post_type == "podcasts" || $post_type == "videos/podcasts") {
                            if (!empty(get_field("partner_inner_banner", $post['ID']))) {

                                $image = get_field("partner_inner_banner", $post['ID']);
                                $size = 'large';
                                $img_url = $image['url'];

                                //$img_url = get_field("partner_inner_banner", $post['ID']);
                                $style = 'style="background:url(';
                                //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                                $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", $img_url);
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;"';;
                            }
                        }
                        //if ($post_type == "offer-items"){ $img_url = get_field("partner_inner_banner", $post['ID']); }


                        // // Disabled because it was showing incorrectly on the /offers/giveaways/ page
                        include get_template_directory() . '/components/posts/tpl-24.php';
                    } else if (!empty($pod_layout) && $cnt == 1 && $curtotal == 0) {
                        //html comments remove by dd
                        //echo '<!-- else if (!empty($pod_layout) && $cnt == 1 && $curtotal == 0) -->';

                        if (!has_post_thumbnail($post['ID'])) {
                            $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
                        } else {

                            if (!empty(get_field("post_large_image", $post['ID']))) {
                                $style = 'style="background:url(';
                                //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                                $iUrl = get_field("post_large_image", $post['ID']);
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;"';
                            } else {
                                $style = 'style="background:url(';
                                //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                                $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;"';
                            }
                        }

                        $img_url = "";
                        if ($post_type == "expert_profiles" || $post_type == "videos" || $post_type == "podcasts" || $post_type == "videos/podcasts") {
                            if (!empty(get_field("partner_inner_banner", $post['ID']))) {

                                $image = get_field("partner_inner_banner", $post['ID']);
                                $size = 'large';
                                $img_url = $image['url'];

                                //$img_url = get_field("partner_inner_banner", $post['ID']);
                                $style = 'style="background:url(';
                                //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                                $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", $img_url);
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;"';;
                            }
                        }
                        //if ($post_type == "offer-items"){ $img_url = get_field("partner_inner_banner", $post['ID']); }

                        include get_template_directory() . '/components/posts/tpl-25.php';
                    } else {
                        /** Templates 26 - 41 */

                        /**
                         * Define "styles" (denoted by $st_# below)
                         * A "style" is the "layout" of the card (e.g. image, then heading, then other text).
                         *
                         * $in_count is the iteration (index) of the card within the section.
                         * E.g. card 0, card 1, card 2 (if it's a row of 3).
                         */

                        //// HERE  $in_count $st_1 = false; $st_2 = false; $st_3 = false; $st_4 = false;

                        //$in_count++;

                        if (!$post_open_div) {
                            $rtn .= '<div class="blogs-loop-inner">';
                            $post_open_div = true;
                        }

                        $styles = [];

                        /*   if (0 <= $in_count && $in_count <= 2){         $st_1 = false; $st_2 = false; $st_3 = false; $st_4 = true ; $st_5 = false;}
                    else if (3 <= $in_count && $in_count <= 4){         $st_2 = true ; $st_1 = false; $st_3 = false; $st_4 = false; $st_5 = false;}
                    else if (5 <= $in_count && $in_count <= 6){         $st_3 = true ; $st_1 = false; $st_2 = false; $st_4 = false; $st_5 = false;}
                    else if (7 <= $in_count && $in_count <= 9){         $st_4 = true ; $st_1 = false; $st_2 = false; $st_3 = false; $st_5 = false;}
                    else if (10 <= $in_count && $in_count <= 11){       $st_4 = false; $st_1 = false; $st_2 = false; $st_3 = false; $st_5 = true ;}
                    else {                                              $st_1 = false; $st_2 = false; $st_3 = false; $st_4 = true ; $st_5 = false; }
                    $in_count = 0;*/

                        if ($attr["post_type"] == "videos/podcasts" || $attr["post_type"] == "videos") { // ! isset($attr["post_type"]) ||
                            if (0 <= $in_count && $in_count <= 2) {
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                            } // 3 in a row, style 4
                            else if (3 <= $in_count && $in_count <= 4) {
                                $st_2 = true;
                                $st_1 = false;
                                $st_3 = false;
                                $st_4 = false;
                                $st_5 = false;
                            } // 2 in a row, style 2
                            else if (5 <= $in_count && $in_count <= 7) {
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                            } // 3 in a row, style 4
                            else if (8 <= $in_count && $in_count <= 9) {
                                $st_2 = true;
                                $st_1 = false;
                                $st_3 = false;
                                $st_4 = false;
                                $st_5 = false;
                            } // 2 in a row, style 2
                            else if (10 <= $in_count && $in_count <= 15) {
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                            } // 6 in a row, style 4
                            else if (16 <= $in_count && $in_count <= 17) {
                                $st_2 = true;
                                $st_1 = false;
                                $st_3 = false;
                                $st_4 = false;
                                $st_5 = false;
                            } else if (18 <= $in_count && $in_count <= 23) {
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                            } else if (24 <= $in_count && $in_count <= 29) {
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                            } else if (30 <= $in_count && $in_count <= 35) {
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                            } else if (36 <= $in_count && $in_count <= 41) {
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                            }
                            /*
                        else if (2 <= $in_count && $in_count <= 4){     $st_2 = false; $st_1 = false; $st_3 = false; $st_4 = true ; $st_5 = false;}
                        else if (5 <= $in_count && $in_count <= 6){     $st_3 = true ; $st_1 = false; $st_2 = false; $st_4 = false; $st_5 = false;}
                        else if (7 <= $in_count && $in_count <= 8){     $st_4 = false; $st_1 = false; $st_2 = false; $st_3 = true ; $st_5 = false;}
                        else if (10 <= $in_count && $in_count <= 11){   $st_4 = false; $st_1 = false; $st_2 = false; $st_3 = false; $st_5 = true ;}
                        else {                                          $st_1 = false; $st_2 = false; $st_3 = false; $st_4 = true ; $st_5 = false; }
                        $in_count = 0;*/
                        } else {
                            if (0 <= $in_count && $in_count <= 1) {
                                $st_1 = false;
                                $st_2 = true;
                                $st_3 = false;
                                $st_4 = false;
                                $st_5 = false;
                            } else if (2 <= $in_count && $in_count <= 4) {
                                $st_2 = false;
                                $st_1 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                            } else if (5 <= $in_count && $in_count <= 6) {
                                $st_3 = true;
                                $st_1 = false;
                                $st_2 = false;
                                $st_4 = false;
                                $st_5 = false;
                            } else if (7 <= $in_count && $in_count <= 8) {
                                $st_4 = false;
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = true;
                                $st_5 = false;
                            } else if (9 <= $in_count && $in_count <= 11) {
                                $st_4 = false;
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_5 = true;
                            } else {
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                                $in_count = 0;
                            }

                            if ($attr["post_type"] == "expert_profiles") {
                                $st_1 = false;
                                $st_2 = false;
                                $st_3 = false;
                                $st_4 = true;
                                $st_5 = false;
                            }
                        }
                        //$in_count = 0;

                        if ($st_1) {
                            $styles[] = '1';
                        }
                        if ($st_2) {
                            $styles[] = '2';
                        }
                        if ($st_3) {
                            $styles[] = '3';
                        }
                        if ($st_4) {
                            $styles[] = '4';
                        }
                        if ($st_5) {
                            $styles[] = '5';
                        }
                        $styles_str = implode('-', $styles);

                        //$rtn .= "<h2>here...</h2>";

                        if ($in_count % 2 == 0) {
                            //html comments remove by dd
                            //echo '<!-- if ($in_count % 2 == 0) ----- if even -->';

                            //even
                            $style = str_replace('style="', 'style="' . $addBorder, $style);
                            if ($st_1) {
                                if ($attr["post_type"] == "expert_profiles") {
                                    include get_template_directory() . '/components/posts/tpl-26.php';
                                } else {
                                    include get_template_directory() . '/components/posts/tpl-27.php';
                                }
                            }
                            if ($st_2) {
                                $style = 'style="background:url(';
                                $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                                if (! isset($attr["post_type"]) || $attr["post_type"] == "videos/podcasts") {
                                    include get_template_directory() . '/components/posts/tpl-28.php';
                                } else {
                                    include get_template_directory() . '/components/posts/tpl-29.php';
                                }
                            }
                            if ($st_3) {

                                $style = 'style="background:url(';
                                $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                                include get_template_directory() . '/components/posts/tpl-30.php';
                            }
                            if ($st_4) {
                                if (! isset($attr["post_type"]) || $attr["post_type"] == "expert_profiles") {
                                    include get_template_directory() . '/components/posts/tpl-31.php';
                                } else {
                                    include get_template_directory() . '/components/posts/tpl-32.php';
                                }
                            }
                            if ($st_5) {
                                $style = 'style="background:url(';
                                $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], $large_image));
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';
                                include get_template_directory() . '/components/posts/tpl-33.php';
                            }
                        } else {
                            //html comments remove by dd
                            // echo '<!-- NOT if ($in_count % 2 == 0) ----- if odd -->';

                            $style = str_replace('style="', 'style="' . $addBorder, $style);
                            if ($st_1) {
                                if ($attr["post_type"] == "expert_profiles") {
                                    $blkBg = "";
                                    if (($in_count % 3) == 0) {
                                        $blkBg = " style='background:#000;'";
                                    }
                                    include get_template_directory() . '/components/posts/tpl-34.php';
                                } else {
                                    include get_template_directory() . '/components/posts/tpl-35.php';
                                }
                            }
                            if ($st_2) {
                                $style = 'style="background:url(';
                                $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                                if (! isset($attr["post_type"]) || $attr["post_type"] == "videos/podcasts") {
                                    include get_template_directory() . '/components/posts/tpl-36.php';
                                } else {
                                    include get_template_directory() . '/components/posts/tpl-37.php';
                                }
                            }
                            if ($st_3) {
                                $style = 'style="background:url(';
                                $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                                include get_template_directory() . '/components/posts/tpl-38.php';
                            }
                            if ($st_4) {


                                if (! isset($attr["post_type"]) || $attr["post_type"] == "expert_profiles") {
                                    $blkBg = "";
                                    if (($in_count % 3) == 0) {
                                        $blkBg = " style='background:#000; display:none;'";
                                    }
                                    include get_template_directory() . '/components/posts/tpl-39.php';
                                } else {
                                    include get_template_directory() . '/components/posts/tpl-40.php';
                                }
                            }
                            if ($st_5) {
                                $style = 'style="background:url(';
                                $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                                $style .= $iUrl;
                                $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';
                                include get_template_directory() . '/components/posts/tpl-41.php';
                            }
                        }

                        if (! isset($attr["post_type"]) || ($attr["post_type"] != "expert_profiles" && $attr["post_type"] != "videos" && $attr["post_type"] != "videos/podcasts")) {
                            //html comments remove by dd
                            //echo '<!-- if (isset($attr["post_type"]) && $attr["post_type"] != "expert_profiles" && $attr["post_type"] != "videos" && $attr["post_type"] != "videos/podcasts") -->';

                            if ($in_count == 6) {
                                $rtn .= '<h2 class="hp-h2">Watch &amp; Listen</h2>';
                                $rtn .=  do_shortcode('[blog_filter format="video-half" post_type="videos" orderby="rand" limit="2" categoryid="' . $categoryid . '"]');
                                $vid_count++;
                            } else if ($in_count == 9) {
                                if (empty($post_type) || $attr["post_type"] == "videos" || $attr["post_type"] == "podcasts") {
                                    if ($post_open_div) {
                                        //$rtn .= '</div>';
                                    }
                                    //$rtn .= do_shortcode("[display_insider]");
                                    //$vid_count++;
                                    if ($post_open_div) {
                                        //$rtn .= '<div class="blogs-loop-inner">';
                                    }
                                }
                            } else if ($in_count == 6) {
                                $rtn .= '<br>';
                                $giveaway_count++;
                            } else if ($in_count == 9) {
                                $rtn .= '<br>';
                                if (empty($post_type)) {
                                    if ($post_open_div) {
                                        $rtn .= '</div>';
                                    }
                                    $rtn .= do_shortcode("[display_followus]");
                                    $exp_count++;
                                    if ($post_open_div) {
                                        $rtn .= '<div class="blogs-loop-inner">';
                                    }
                                }
                                $cat_count++;
                            } else if ($in_count == 8 && !empty($add_ad)) {
                                if ($add_ad == "Yes") {
                                    $add_ad = "No";
                                    //$rtn .= '<br>';
                                    if ($post_open_div) {
                                        $rtn .= '</div>';
                                    }
                                    $rtn .= do_shortcode("[ad_list]");
                                    if ($post_open_div) {
                                        $rtn .= '<div class="blogs-loop-inner">';
                                    }
                                } else {
                                    $add_ad = "Yes";

                                    if (get_post_type($post['ID']) == 'post') {
                                        if ($post_open_div) {
                                            $rtn .= '</div>';
                                        }
                                        $rtn .= do_shortcode("[display_followus]");
                                        $exp_count++;
                                        if ($post_open_div) {
                                            $rtn .= '<div class="blogs-loop-inner">';
                                        }
                                    }
                                }
                            }
                        } else {
                            //html comments remove by dd
                            // echo '<!-- NOT if (isset($attr["post_type"]) && $attr["post_type"] != "expert_profiles" && $attr["post_type"] != "videos" && $attr["post_type"] != "videos/podcasts") -->';

                            if ($in_count == 23) {
                                if ($post_open_div) {
                                    $rtn .= '</div>';
                                }
                                $rtn .= do_shortcode("[display_followus]");
                                if ($post_open_div) {
                                    $rtn .= '<div class="blogs-loop-inner">';
                                }
                            } else if ($in_count == 29) {
                                if ($post_open_div) {
                                    $rtn .= '</div>';
                                }
                                $rtn .= do_shortcode("[display_insider]");
                                if ($post_open_div) {
                                    $rtn .= '<div class="blogs-loop-inner">';
                                }
                            } else if ($in_count == 35) {
                                if ($post_open_div) {
                                    $rtn .= '</div>';
                                }
                                $rtn .= do_shortcode("[get_giveaway_event post_type='giveaway-items']");
                                if ($post_open_div) {
                                    $rtn .= '<div class="blogs-loop-inner">';
                                }
                            } else if ($in_count == 41) {
                                if ($add_ad == "Yes") {
                                    $add_ad = "No";
                                    //$rtn .= '<br>';
                                    if ($post_open_div) {
                                        $rtn .= '</div>';
                                    }
                                    $rtn .= do_shortcode("[ad_list]");
                                    if ($post_open_div) {
                                        $rtn .= '<div class="blogs-loop-inner">';
                                    }
                                } else {
                                    $add_ad = "Yes";
                                }
                            }
                        }

                        if ($vid_count == 1 && $curtotal == 0 && (! isset($attr["post_type"]) || $attr["post_type"] != "videos" && $attr["post_type"] != "videos/podcasts")) {
                            //html comments remove by dd
                            //echo '<!-- if ($vid_count == 1 && $curtotal == 0 && $attr["post_type"] != "videos" && $attr["post_type"] != "videos/podcasts") -->';

                            $vid_count++;

                            if ($post_open_div) {
                                $rtn .= '</div>';
                            }

                            $rtn .=   do_shortcode('[blog_filter format="video" limit="4" order="rand" categoryid="' . $categoryid . '"]');

                            if ($post_open_div) {
                                $rtn .= '<div class="blogs-loop-inner">';
                            }
                        }

                        if ($in_count == 1) {
                            $exp_count++;
                        }


                        if (
                            $exp_count == 1
                            && $curtotal == 0
                            && (! isset($attr["post_type"])
                                || ($attr["post_type"] != "expert_profiles"
                                    && $attr["post_type"] != "videos"
                                    && $attr["post_type"] != "videos/podcasts"))
                        ) {

                            if ($post_open_div) {
                                $rtn .= '</div>';
                            }

                            // $cat = get_top_level_term_by_post_id($post_id, 'category');
                            $cat = get_term_by('id', $categoryid, 'category');
                            $category_colour = get_field('category_colour', $cat) ? get_field('category_colour', $cat) : '#3B1527';
                            $category_text_color = get_field('category_text_color', $cat) ? get_field('category_text_color', $cat) : '#FFDBD1';
                            $exp_count++;
                            $rtn .=   '
                            <div ' . $categoryid . ' class="experts-page-cara tpl-2649" style="--bg-color: ' . $category_colour . '; --text-color: ' . $category_text_color . '">
                                <!--<h2>' . $exp_count . '</h2>-->
                                ' . do_shortcode("[expert_list page='1' title='" . $globalCategoryName . " Experts" . "' categoryid='" . $categoryid . "']") . '
                            </div>
                            <link rel="stylesheet" href="/wp-content/themes/lighttheme/stylesheet/slick.css">
                            <link rel="stylesheet" href="/wp-content/themes/lighttheme/stylesheet/slick-theme.css">
                            <script src="/wp-content/themes/lighttheme/js/slick.js"></script>';
                            if ($post_open_div) {
                                $rtn .= '<div class="blogs-loop-inner">';
                            }
                        }

                        if ($curtotal == 0 && $cat_count == 1) {
                            //html comments remove by dd
                            //echo '<!-- if ($curtotal == 0 && $cat_count == 1) -->';

                            $cat_count++;
                            if ($attr["post_type"] == "expert_profiles") {
                                if ($post_open_div) {
                                    $rtn .= '</div>';
                                }
                                $rtn .= do_shortcode("[category_list page='experts']");
                                if ($post_open_div) {
                                    $rtn .= '<div class="blogs-loop-inner">';
                                }
                            } else if ($attr["post_type"] == "videos") {
                                if ($post_open_div) {
                                    $rtn .= '</div>';
                                }
                                $rtn .= do_shortcode("[category_list page='videos']");
                                if ($post_open_div) {
                                    $rtn .= '<div class="blogs-loop-inner">';
                                }
                            } else if ($attr["post_type"] == "podcasts") {
                                if ($post_open_div) {
                                    $rtn .= '</div>';
                                }
                                $rtn .= do_shortcode("[category_list page='podcasts']");
                                if ($post_open_div) {
                                    $rtn .= '<div class="blogs-loop-inner">';
                                }
                            }
                        }

                        if ($curtotal == 0 && $giveaway_count == 1 && ($cur_post_type == "giveaway-items" || $cur_post_type == "offer-items" || $cur_post_type == "offer-items/giveaway-items/events" || $cur_post_type == "events")) {
                            //html comments remove by dd
                            //echo '<!-- if ($curtotal == 0 && $giveaway_count == 1 && ($cur_post_type == "giveaway-items" || $cur_post_type == "offer-items" || $cur_post_type == "offer-items/giveaway-items/events" || $cur_post_type == "events")) -->';

                            $giveaway_count++;
                            //if ($cnt == 4 || $cnt == 10){
                            $style_format = "";
                            $pos_format = "giveaway-items";
                            if ($cnt == 4) {
                                $style_format = "event-giveaway-outer-light-bg";
                                $pos_format = "offer-items";
                            }
                            if ($post_open_div) {
                                $rtn .= '</div>';
                            }
                            $rtn .= do_shortcode("[giveaway_list page='1']");
                            $rtn .= do_shortcode("[get_giveaway_event post_type='" . $pos_format . "' style_format='" . $style_format . "']");
                            if ($post_open_div) {
                                $rtn .= '<div class="blogs-loop-inner">';
                            }
                            //}
                        }


                        $in_count++;
                    }
                }
            }

            if ($format == "video-half") {
                //html comments remove by dd
                //echo '<!-- if ($format == "video-half") -->';

                if ($home) {
                    $cur_id = $post['ID'];
                    $homepage_array .= "," . $cur_id;
                }

                if (!$post_open_div) {
                    $rtn .= '<div class="blogs-loop-inner">';
                    $post_open_div = true;
                }

                $style = str_replace('style="', 'style="' . $addBorder, $style);
                $style = 'style="background:url(';
                $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                $style .= $iUrl;
                $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                include get_template_directory() . '/components/posts/home-video-even.php';
            }

            if ($format == "normal") {
                //html comments remove by dd
                // echo '<!-- if ($format == "normal") -->';

                if ($home) {
                    $cur_id = $post['ID'];
                    $homepage_array .= "," . $cur_id;
                }

                if (!$post_open_div) {
                    $rtn .= '<div class="blogs-loop-inner">';
                    $post_open_div = true;
                }

                if ($cnt % 2 == 0) {
                    //even
                    $style = str_replace('style="', 'style="' . $addBorder, $style);
                    include get_template_directory() . '/components/posts/tpl-43.php';
                } else {

                    $style = str_replace('style="', 'style="' . $addBorder, $style);
                    include get_template_directory() . '/components/posts/tpl-44.php';
                }
            }

            if ($format == "normal-2") {
                //html comments remove by dd
                //echo '<!-- if ($format == "normal-2") -->';

                if ($home) {
                    $cur_id = $post['ID'];
                    $homepage_array .= "," . $cur_id;
                }

                if (!$post_open_div) {
                    $rtn .= '<div class="blogs-loop-inner">';
                    $post_open_div = true;
                }

                // If $cnt is even
                if ($cnt % 2 == 0) {
                    //even
                    $style = str_replace('style="', 'style="' . $addBorder, $style);
                    //$style = 'style="background:url(';
                    $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                    $style .= $iUrl;
                    //$style .= '); background-size:cover; background-position:center;'.$addBorder.'"';

                    include get_template_directory() . '/components/posts/home-posts-even.php';
                }
                // If $cnt is odd
                else {
                    $style = str_replace('style="', 'style="' . $addBorder, $style);
                    //$style = 'style="background:url(';
                    $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                    $style .= $iUrl;
                    //$style .= '); background-size:cover; background-position:center;'.$addBorder.'"';

                    include get_template_directory() . '/components/posts/home-posts-odd.php';

                    // $rtn .= '<div class="blog-top-1">
                    //     <div class="blog-l-text-out">
                    //         <div class="blog-l-text">
                    //         <h3>'.$currentcatname.'</h3>
                    //         <a href="'.get_permalink($post['ID']).'">
                    //         <h2>'.$post['post_title'].'</h2>
                    //         </a>
                    //         <h4>'.get_the_date('j M Y', $post["ID"]).'</h4>
                    //         <div class="blog-btns">
                    //         <a href="'.get_permalink($post['ID']).'">'.$more_t_text.'</a>
                    //         </div>
                    //     </div>
                    // </div>
                    // <div class="blog-l-img-out">
                    //     <a href="'.get_permalink($post['ID']).'" >
                    //     <img class="blog-l-img" src="' . $iUrl .'" style="background-size:cover; background-position:center;">
                    //     <span class="bl-overlay">'.$more_text.'</span>
                    //     </img>
                    //     </a>
                    //     <a href="'.get_permalink($post['ID']).'">'.$ext.'
                    //     <img src="/wp-content/themes/lighttheme/images/a_squ_trans.png">
                    //     </a>
                    // </div>
                    // </div>';
                }
            }

            if ($format == "normal-3") {
                //html comments remove by dd
                //echo '<!-- if ($format == "normal-3") -->';

                if ($home) {
                    $cur_id = $post['ID'];
                    $homepage_array .= "," . $cur_id;
                }

                if (!$post_open_div) {
                    $rtn .= '<div class="blogs-loop-inner">';
                    $post_open_div = true;
                }

                if ($cnt % 2 == 0) {
                    //even
                    $style = str_replace('style="', 'style="' . $addBorder, $style);
                    $style = 'style="background:url(';
                    $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                    $style .= $iUrl;
                    $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                    include get_template_directory() . '/components/posts/tpl-47.php';
                } else {

                    $style = str_replace('style="', 'style="' . $addBorder, $style);
                    $style = 'style="background:url(';
                    $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                    $style .= $iUrl;
                    $style .= '); background-size:cover; background-position:center;' . $addBorder . '"';

                    include get_template_directory() . '/components/posts/tpl-48.php';
                }
            }

            if ($format == "normal-4") {
                //html comments remove by dd
                //echo '<!-- if ($format == "normal-4") -->';

                if ($home) {
                    $cur_id = $post['ID'];
                    $homepage_array .= "," . $cur_id;
                }

                if (!$post_open_div) {
                    $rtn .= '<div class="blogs-loop-inner">';
                    $post_open_div = true;
                }

                if ($cnt % 2 == 0) {
                    //even
                    $style = str_replace('style="', 'style="' . $addBorder, $style);
                    include get_template_directory() . '/components/posts/home-small-post-even.php';
                } else {

                    $blkBg = "";
                    if (($in_count % 3) == 0) {
                        $blkBg = " style='background:#000;'";
                    }

                    $style = str_replace('style="', 'style="' . $addBorder, $style);
                    include get_template_directory() . '/components/posts/home-small-post-odd.php';
                }
            }

            if ($format == "video") {
                //html comments remove by dd
                //echo '<!-- if ($format == "video") -->';
                if ($cnt == 1) {
                    //$style = str_replace('style="', 'style="'.$addBorder, $style);
                    $style = 'style="';
                    $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID']));
                    $style .= $iUrl;
                    $style .= ') background-size:cover; background-position:center;' . $addBorder . '"';
                    include get_template_directory() . '/components/posts/home-trending-video.php';
                } else {
                    $style = str_replace('style="', 'style="' . $addBorder, $style);
                    include get_template_directory() . '/components/posts/home-small-podcasts.php';
                }
            }
        }
        //html comments remove by dd
        // echo '<!-- bottom of blog-filter.php -->';

        wp_reset_query();

        if ($post_open_div) {
            $rtn .= '</div>';
        }

        //$homepage_array = $ex_list;

        if ($home) {
            $_SESSION['homepage_array'] = $homepage_array;

            $rtn .= '<span style="display:none;" id="homepage_array"  class="homepage_array" data-exclude="' . $homepage_array . '"></span>';
        }

        $rtn .= '<div class="end"></div>';
        if ($format == "video") {
            $rtn .= '<a class="white-a" href="/watch-listen">View all Podcast Episodes and Videos</a>';
        }

        // Loading more spinner
        if ($format == "post-page" && $design == "" && count($recent_posts) > 0 && !empty($limit) && empty($id_list)) {
            //$rtn .= '<h1>'.($curtotal + $limit).'</h1>';
            $rtn .= '<div class="loadingmoreOuter">
            <a id="loadMore" onclick="return false;" data-add_ad="' . $add_ad . '" data-posttype="' . $post_type . '" data-count="' . (intval($curtotal) + intval($limit)) . '" class="loadmore"></a>
            </div>';
        }


        if ($post_type == "expert_profiles") {
            $rtn .= '</div>';
        }

        $rtn .= '</div>';
        return $rtn;
    }
}
