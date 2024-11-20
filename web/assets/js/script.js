$(document).ready(function () {

  $(document).on("click", ".toggle-btn", function () {

    $("#sidebar").toggleClass("expand");

    if ($("#sidebar").hasClass("expand")) {
      $("#sol").removeClass("d-none");
      $("#rep").removeClass("d-none");
      $("#usu").removeClass("d-none");
      $("#logonav").addClass("d-none");
      $("#sidebar").addClass("sideScroll");
    } else {
      $("#sol").addClass("d-none");
      $("#rep").addClass("d-none");
      $("#usu").addClass("d-none");
      $("#logonav").removeClass("d-none");
      $("#sidebar").removeClass("sideScroll");

    }
  });

  

});

