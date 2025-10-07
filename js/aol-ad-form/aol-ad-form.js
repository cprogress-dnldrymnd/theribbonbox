if ($(".aol-md-2").length > 0){
    $(".aol-md-2").append('<button class="fusion-button button btn btn-info btn-block aol-clear-button">View All</button>');
}

$(".aol-clear-button").click(function(e){
    e.preventDefault();

    $("#aol_ad_form [name='category']").val("");
    $("#aol_ad_form [name='type']").val("");
    $("#aol_ad_form [name='location']").val("");
    $("#aol_ad_form [name='aol_seach_keyword']").val("");

    $(".aol-filter-button").click();
});