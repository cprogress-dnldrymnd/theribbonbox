var cln = $(".ad-apply-form-overlay").clone();
$(".ad-apply-form-overlay").remove();
$("#fouc").prepend(cln);

$(".ad-apply-btn").click(function(e){
    e.preventDefault();
    $(".ad-apply-form-overlay").css("display", "");
});

$(".ad-apply-btn-close").click(function(e){
    e.preventDefault();
    $(".ad-apply-form-overlay").css("display", "none");
});