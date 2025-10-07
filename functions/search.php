<?php
/*
add_action('pre_get_posts', 'my_make_search_exact', 10);
function my_make_search_exact($query){
    if(!is_admin() && $query->is_main_query() && $query->is_search) :
        //echo "<h1 style='display:none;' class='is-searching...'>YES,.,,,</h1>";
        $query->set('exact', true);
        $query->set('sentence', true);
        return $query;
    endif;
}
*/