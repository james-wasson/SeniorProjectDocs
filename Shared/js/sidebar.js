$().ready(function() {
  // scrolls out the logo if page scrolls down
  var testOpacity;
  var scrollLogo = function() {
    testOpacity = ($(this).scrollTop() - $('#topbar').height())/100;
    if (testOpacity <= 0) $('.sidebar-brand').css({opacity: '0'});
    else if (testOpacity >= 1) $('.sidebar-brand').css({opacity: '1'});
    else $('.sidebar-brand').css({opacity: testOpacity});
  }
  $(window).scroll(scrollLogo);
  scrollLogo();
  
  // keeps content from overrunning the sidebar
  var checkWindow = function(){
    if(($( window ).width() * .15) < 200) {
      $('#content').css({ 'left': '200px' })
      $('#content').css({ 'width': (($( window ).width() - 200))+'px' })
    } else {
      $('#content').css({ 'left': '15vw' })
      $('#content').css({ 'width': '84vw' })
    }
  }
  $(window).resize(checkWindow);
  checkWindow();
});
