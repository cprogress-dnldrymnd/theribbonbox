<?php
echo "<!-- index-portfolio-services.php -->";

$parent = "";
$p_ttl = get_the_title('','',false);
//echo $p_ttl;
if (the_title('','',false) == "Portfolio"){
    echo do_shortcode("[portfolio_filter_list]");
} else{

    $rtn = do_shortcode("[portfolio_filter_list category='".$p_ttl."']");

    if ($rtn != ""){
        if ($p_ttl != "Services"){
            echo "<h3>".$p_ttl ." Projects</h3>";
            echo $rtn;
        } else{
            echo "<h3>".$p_ttl ."</h3>";
            echo $rtn;
        }

    }
}

//echo do_shortcode("[portfolio_filter_list]");