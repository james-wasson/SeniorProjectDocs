$().ready(function() {
  // this function finds all the elements who could be a dropdown and listens for aria expanded
  // then changes the caret for that element
  var targets = $('.dropdown-toggle');
  var observer = new MutationObserver(function(m) {
    if(m[0]['attributeName'] == "aria-expanded") {
      var t = targets.filter("[aria-expanded=true]");
      t.find('.fa-caret-down').removeClass('fa-caret-down').addClass('fa-caret-up');
      var f = targets.filter("[aria-expanded=false]");
      f.find('.fa-caret-up').removeClass('fa-caret-up').addClass('fa-caret-down');
    }  
  });
  for (var i = 0; i < targets.length; i++)
    observer.observe(targets[i], { attributes: true });
  
  $(".dropdownButton").click(function() {
    var target = $(this).attr('data-toggle');
    if ($("#"+target).is(":visible")) {
      $("#"+target)
      .css('opacity', 1)
      .slideUp(2000)
      .animate(
        { opacity: 0 },
        { queue: false, duration: 1800 }
      );
      $(this).find(".fa-caret-up").removeClass("fa-caret-up").addClass("fa-caret-down");
    } else {
      $("#"+target)
      .css('opacity', 0)
      .slideDown(1800)
      .animate(
        { opacity: 1 },
        { queue: false, duration: 2000 }
      );
      $(this).find(".fa-caret-down").removeClass("fa-caret-down").addClass("fa-caret-up");
    }
  });

});