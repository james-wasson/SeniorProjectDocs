
function scrollToPageId(id) {
  $("html, body").stop(true).animate({ scrollTop: $('#'+id).offset().top }, 1000);
}
