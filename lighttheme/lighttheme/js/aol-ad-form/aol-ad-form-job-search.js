$(function(){

    let url = new URL(window.location.href);

    if (window.location.href.indexOf("#aol_ad_form") < 0){
        let searchParams = new URLSearchParams(url.search);
        //console.log(searchParams.get('k'));  // outputs "m2-m3-m4-m5"

        var category = searchParams.get('c');
        var types = searchParams.get('t');
        var location = searchParams.get('l');
        var keyword = searchParams.get('k');



        if (category != null || types != null || location != null || keyword != null){
            $("#aol_ad_form [name='category']").val(category);
            $("#aol_ad_form [name='type']").val(types);
            $("#aol_ad_form [name='location']").val(location);
            $("#aol_ad_form [name='aol_seach_keyword']").val(keyword);
            $(".aol-filter-button").click();
        }
    }

});

