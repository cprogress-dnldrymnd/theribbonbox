<?php


function register_my_menu()
{
    register_nav_menu('header-menu', __('Header Menu'));
}
add_action('init', 'register_my_menu');

function register_my_menus()
{
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu'),
            'community-menu' => __('Community Menu'),
            'extra-menu' => __('Extra Menu')
        )
    );
}
add_action('init', 'register_my_menus');


add_action('after_setup_theme', 'trb_register_nav_menus');
function trb_register_nav_menus()
{
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'your-text-domain'),
        'footer' => __('Footer Menu', 'your-text-domain')
    ));
}


add_filter('nav_menu_link_attributes', 'trb_av_menu_link_attributes', 10, 3);
/*
 * Filters the HTML attributes applied to a menu item's anchor element.
 */
function trb_av_menu_link_attributes($atts, $item, $args)
{
    $id = $item->object_id;
    $title = $item->title;
    //set_trb_message("$id: '$title'");

    if ($item->menu_item_parent == 0) {
        $object_id = $item->object_id;
        $atts['pageId'] = $object_id;
    } else {
        $parent_menu_item_id = $item->menu_item_parent;
        $object_id = get_post_meta($parent_menu_item_id, '_menu_item_object_id', true);
        $atts['pageId'] = $object_id;
    }

    $cat_args = array(
        'orderby' => 'name',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key'     => 'page_category',
                'value'   =>  $object_id,
                'compare' => 'LIKE'
            )
        ),
        'post_status' => 'publish',
    );

    $categories = get_categories($cat_args);


    $category_id = $categories[0]->term_id;
    $atts['categoryId'] = $category_id;
    $atts['xxxxx'] = 'dsdsds';


    if ($title == 'Watch & Listen' || $id == "22822" || $title === '') {
        $atts['post_type'] = "videos/podcasts";
        $atts['cus_post'] = "1";
    } // Watch & Listen OR

    else if (
        $title == 'Videos'
        || $title == 'Wellbeing Videos'
        || $title == 'Fertility Videos'
        || $title == 'Pregnancy Videos'
        || $title == 'Parenting Videos'

    ) {
        $atts['post_type'] = "videos/podcasts";
        $atts['cus_post'] = "1";
    } else if (
        $title == 'The Ribbon Box Podcast'
        || ($title == 'Wellbeing' && $id == '23883')
        || ($title == 'Fertility' && $id == '23885')
        || ($title == 'Pregnancy' && $id == '23887')
        || ($title == 'Parenting' && $id == '23889')
    ) {
        $atts['post_type'] = "videos/podcasts";
        $atts['cus_post'] = "1";
    } else if (
        $title == 'All Experts'
        || $title == 'Experts'
        || ($title == 'Wellbeing' && $id == '22812')
        || ($title == 'Fertility' && $id == '22814')
        || ($title == 'Pregnancy' && $id == '22816')
        || ($title == 'Parenting' && $id == '22818')
        || ($title == 'Match With an Expert')
    ) {
        $atts['post_type'] = "expert_profiles";
        $atts['cus_post'] = "1";
    }  else if ($title == 'Discounts') {
        $atts['post_type'] = "offer-items/giveaway-items/events";
        $atts['cus_post'] = "1";
    } else if ($title == 'Events') {
        $atts['post_type'] = "offer-items/giveaway-items/events";
        $atts['cus_post'] = "1";
    } else {
        $atts['post_type'] = "post";
    }

    return $atts;
}
/*
22620: Wellbeing
24548: All Wellbeing
22623: Exercise
22625: Food & Nutrition
22627: Healthy Body
22629: Healthy Mind
22631: Sex & Relationships
22633: Skincare & Haircare
22635: Travel

22659: Fertility
24549: All Fertility
22661: Donor Conception
22663: Health & Nutrition
22665: Preservation
22667: Signs & Symptoms
22669: Testing
22670: Holistic Support
22674: Causes & Treatment
22676: LGBTQ+
22678: Male Fertility
22680: Miscarriage & Recurrent Pregnancy Loss
22682: Natural Conception
22684: Solo Parenting
22686: Surrogacy
23686: Celebrity Stories

22702: Pregnancy
24550: All Pregnancy
22704: A Dad’s Guide to Pregnancy
22707: Baby Names
22709: Birth & Delivery
22711: Due Date Calculator
22713: Postpartum
22715: Health & Nutrition
22717: Loss & Miscarriage
22719: Symptoms
22721: Preparing for a Baby
22733: Surrogacy Pregnancy
22735: Week by Week
22737: First Trimester (weeks 1-12)
22739: Second Trimester (weeks 13-26)
22741: Third Trimester (weeks 27-birth)

22749: Parenting
24551: All Parenting
22751: Ages & Stages
22753: Newborn & Baby
22755: Breastfeeding
22759: Child
22761: Pre-Teen
22763: Teen
22765: Adult & Empty Nest
22767: Activities with Kids
22769: Adoption & Fostering
22771: Child Health & Nutrition
22773: Child Loss & Grief
22775: Divorce & Separation
22777: Donor-Conceived Children
22779: Family Finances
22781: School & Education
22785: Special Needs
22787: Surrogacy-Conceived Children

22808: Experts
27091: All Experts
22812: Wellbeing
22814: Fertility
22816: Pregnancy
22818: Parenting
22820: Match With an Expert

22822: Watch & Listen
27090: All Videos And Podcasts
22826: The Ribbon Box Podcast
23883: Wellbeing
23885: Fertility
23887: Pregnancy
23889: Parenting
22828: Videos
22830: Wellbeing Videos
22832: Fertility Videos
22834: Pregnancy Videos
22836: Parenting Videos

23831: Win
22840: Giveaways
22842: Discounts
22844: Events

22885: Community
2223: About

// Footer menu
2223: About / Contact
23869: Advertise
23866: Subscribe
22885: Login
2257: Terms & Conditions
2424: Privacy Policy
*/