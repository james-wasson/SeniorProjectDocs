$().ready(function() {
  $(".takeRoomRow").each(function(key, value) {
    var $parent = $(value).parent();
    var $greedy = $(value);
    var pos = $greedy.position().top - $parent.position().top;
    $greedy.height($parent.height() - pos);
    $greedy.children().height("inherit");
  });
});