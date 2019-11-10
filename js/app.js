$(document).ready(function(){

  $(".sidebar-dropdown > a").click(function() {
  $(".sidebar-submenu").slideUp(200);
  if (
    $(this)
      .parent()
      .hasClass("active")
  ) {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .parent()
      .removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .next(".sidebar-submenu")
      .slideDown(200);
    $(this)
      .parent()
      .addClass("active");
  }
});

$("#close-sidebar").click(function() {
  $(".page-wrapper").removeClass("toggled");
});

$("#show-sidebar").click(function() {
  $(".page-wrapper").addClass("toggled");
});


$('.menu-toggle > a').on('click', function (e) {
	e.preventDefault();
	$('#responsive-nav').toggleClass('active');
});
	
$('.fu').on('click', function (e) {
	e.stopPropagation();
});

});


