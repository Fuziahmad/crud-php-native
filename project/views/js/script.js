$(document).ready(function() {
    $("#button-toggle").click(function() {
    $("#sidebar").toggleClass("active-sidebar");
    $("#main-content").toggleClass("active-main-content");
    });
    });