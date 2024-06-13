function setheaderbackground(){
    if($(window).scrollTop() > 10) {
        $(".desktop-header").addClass("bg-white shadow-sm");
        $('#page-up-button').addClass('reveal');
    } else {
        //remove the background property so it comes transparent again (defined in your css)
       $(".desktop-header").removeClass("bg-white shadow-sm");
       $('#page-up-button').removeClass('reveal');
    }
}
$(window).on("scroll", function() {
    setheaderbackground();
});

$(document).ready(function() {
    setheaderbackground();
});

function pageGoUp() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}