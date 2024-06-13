var isToggled = false;
$("#toggleSidebar").on("click", function() {
    isToggled = !isToggled;
    if (isToggled) {
        $("#main-sidebar").addClass('sidebar-collapse');
        $("#main-content-wrapper").addClass('content-collapsed');
    } else {
        $("#main-sidebar").removeClass('sidebar-collapse');
        $("#main-content-wrapper").removeClass('content-collapsed');
    }
});

$("#closeSidebar").on("click", function() {
    $("#main-sidebar").css('left', '-250px');
});

$("#openSidebar").on("click", function() {
    $("#main-sidebar").css('left', '0');
});