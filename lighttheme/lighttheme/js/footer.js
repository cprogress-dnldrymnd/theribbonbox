const giveawayPopupDelay = 30 * 1000; // 30 seconds
$(document).ready(function() {

    //localStorage.removeItem("hidegiveawayDate", "true");
    //localStorage.removeItem("hidesubscribeDate", "true");

    var hidegiveawayDate = localStorage.getItem("hidegiveawayDate");
    var hidesubscribeDate = localStorage.getItem("hidesubscribeDate");
    var showSubscribe = localStorage.getItem("showsubscribe");

    //localStorage.removeItem("hidegiveaway", "true");
    //localStorage.removeItem("showsubscribe", "true");

    var a = new Date();
    var c = new Date(hidegiveawayDate);
    var e = new Date(hidesubscribeDate);

    // Get the success param
    // var searchParams = new URLSearchParams(window.location.search);
    // var success= searchParams.has('succes');

    if(a > c){
        setTimeout(function() {
            $("#giveaway-pop-outer").css("display", "block");
        }, giveawayPopupDelay);
    }

    // if(a > e){
    //   setTimeout(function() {
    //       $("#subscribe-outer").css("display", "block");
    //   }, 7000);
    // }

    if(showSubscribe){
        $("#subscribe-outer").css("display", "block");
        localStorage.removeItem("showsubscribe", "true");
    }

    $("#form7 .button-submit").click(function(){
        //localStorage.setItem("showsubscribe", "true");
    });

    $("#menu-footermenu li a," +
        "#menu-footermenu-1 li a," +
        "#menu-footermenu-3 li a," +
        "#menu-footermenu-2 li a").each(function(){
        if ($(this).html() == "Subscribe"){
            $(this).addClass("sub-pop-btn");
        }
    });

    //$("#sub-pop-btn").on("click", function(e){
    $(document).on("click",".sub-pop-btn", function(e){
        e.preventDefault();
        $("#subscribe-outer").css("display", "block");
    });

    $(".subscribe-outer-close").click(function (){
        $("#subscribe-outer").css("display", "none");
        localStorage.removeItem("showsubscribe", "true");
    });

    $(".giveaway-outer-close").click(function (){
        $("#giveaway-pop-outer").css("display", "none");
        var date = new Date();
        date.setDate(date.getDate() + 1);
        localStorage.setItem("hidegiveawayDate", date);
    });

    $(".subscribe-outer-close").click(function () {
        $("#subscribe-outer").css("display", "none");
        //localStorage.removeItem("showsubscribe", "true");
        var date = new Date();
        date.setDate(date.getDate() + 1);
        localStorage.setItem("hidesubscribeDate", date);
    });

    // show popup after 7ms if !hidesubscribeDate
    var hidesubscribeDate = localStorage.getItem("hidesubscribeDate");
    if (!hidesubscribeDate) {
        setTimeout(function() {
            $("#subscribe-outer").css("display", "block");
        }, 7 * 1000);
    }
});