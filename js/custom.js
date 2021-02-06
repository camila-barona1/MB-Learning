$(document).ready(function () {
  $("#sidebarCollapse").on("click", function () {
    $("#sidebar").toggleClass("active");
    $(this).toggleClass("active");
  });

  $(function () {
    $("#playlist li").on("click", function () {
      $("#videroarea").attr({
        src: $(this).attr("movieurl"),
      });
    });
    $("#videroarea").attr({
      src: $("#playlist li").eq(0).attr("movieurl"),
    });
  });
});
