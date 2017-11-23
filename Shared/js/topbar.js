$().ready(function() {
  $("#side-topbar li").hover(function() {
    $(this).addClass("active");
  }, function() {
    $(this).removeClass("active");
  });
})