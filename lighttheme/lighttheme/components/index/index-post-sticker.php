<?php
echo "<!-- index-post-sticker.php -->";

if ($post_sticker =="Trending Wellbeing"){
    $currentcat = 1159;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Trending</span><br>Wellbeing</p></div>';
}
if ($post_sticker =="Trending Fertility"){
    $currentcat = 1164;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Trending</span><br>Fertility</p></div>';
}
if ($post_sticker =="Trending Pregnancy"){
    $currentcat = 1165;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Trending</span><br>Pregnancy</p></div>';
}
if ($post_sticker =="Trending Parenting"){
    $currentcat = 1163;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Trending</span><br>Parenting</p></div>';
}
if ($post_sticker =="Latest Wellbeing"){
    $currentcat = 1159;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Latest</span><br>Wellbeing</p></div>';
}
if ($post_sticker =="Latest Fertility"){
    $currentcat = 1164;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Latest</span><br>Fertility</p></div>';
}
if ($post_sticker =="Latest Pregnancy"){
    $currentcat = 1165;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Latest</span><br>Pregnancy</p></div>';
}
if ($post_sticker =="Latest Parenting"){
    $currentcat = 1163;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Latest</span><br>Parenting</p></div>';
}
if ($post_sticker =="Handpicked Wellbeing"){
    $currentcat = 1159;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Handpicked</span><br>Wellbeing</p></div>';
}
if ($post_sticker =="Handpicked Fertility"){
    $currentcat = 1164;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Handpicked</span><br>Fertility</p></div>';
}
if ($post_sticker =="Handpicked Pregnancy"){
    $currentcat = 1165;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Handpicked</span><br>Pregnancy</p></div>';
}
if ($post_sticker =="Handpicked Parenting"){
    $currentcat = 1163;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Handpicked</span><br>Parenting</p></div>';
}
if ($post_sticker =="Editor’s Choice Wellbeing"){
    $currentcat = 1159;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Editor’s Choice</span><br>Wellbeing</p></div>';
}
if ($post_sticker =="Editor’s Choice Fertility"){
    $currentcat = 1164;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Editor’s Choice</span><br>Fertility</p></div>';
}
if ($post_sticker =="Editor’s Choice Pregnancy"){
    $currentcat = 1165;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Editor’s Choice</span><br>Pregnancy</p></div>';
}
if ($post_sticker =="Editor’s Choice Parenting"){
    $currentcat = 1163;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Editor’s Choice</span><br>Parenting</p></div>';
}
if ($post_sticker =="Spotlight Experts"){
    //NO
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Spotlight</span><br>Experts</p></div>';
}
if ($post_sticker =="Wellbeing Expert"){
    $currentcat = 1159;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Wellbeing</span><br>Expert</p></div>';
}
if ($post_sticker =="Fertility Expert"){
    $currentcat = 1164;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Fertility</span><br>Expert</p></div>';
}
if ($post_sticker =="Pregnancy Expert"){
    $currentcat = 1165;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Pregnancy</span><br>Expert</p></div>';
}
if ($post_sticker =="Parenting Expert"){
    $currentcat = 1163;
    $termIdVal = 'term_' . $currentcat;
    $bcolour = "#F77D66";
    if (!empty(get_field("category_colour", $termIdVal))){
        $bcolour = get_field("category_colour", $termIdVal);
    }
    $border = 'style="border-top: 5px solid '.$bcolour.';"';
    $addBorder = 'border-top: 5px solid '.$bcolour.';';
    $hexRGB = $bcolour;
    if(hexdec(substr($hexRGB,0,2))+hexdec(substr($hexRGB,2,2))+hexdec(substr($hexRGB,4,2))> 100){
    }else{
        $ad = 'class="light-text"';
        $addd = "light-text";
    }
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Parenting</span><br>Expert</p></div>';
}
if ($post_sticker =="Featured Expert"){
    //NO
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Featured</span><br>Expert</p></div>';
}
if ($post_sticker =="Featured Video"){
    //NO
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Featured</span><br>Video</p></div>';
}
if ($post_sticker =="Featured Giveaway"){
    //NO
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Featured</span><br>Giveaway</p></div>';
}
if ($post_sticker =="Featured Podcast"){
    //NO
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Featured</span><br>Podcast</p></div>';
}