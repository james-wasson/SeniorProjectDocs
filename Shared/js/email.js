$().ready(function() {
  $('#sendEmail').submit(function(e) {
    e.preventDefault()
    var msg = $("#emailBody").val();
    var sbj = $("#emailSubject").val();
    $('#sendEmail input[type=submit]').attr( "disabled" , true);
    $('#sendEmail').css('opacity', '0.5');
    $('#emailLoading').fadeIn(1000);
    $.ajax({
      type: "GET",
      url: "./sendEmail.php",
      data: {
        emailMsg: msg,
        emailSubject: sbj
      },
    }).done(function(data) {
      var msg = $("#emailBody").val("");
      var sbj = $("#emailSubject").val("");
      $('#sendEmail input[type=submit]').attr("disabled", false);
      toastr.success(data, "<h3 style='margin:0;padding:0;padding-left:10px;'>Success</h3>");
    })
    .fail(function(data) {
      console.log(data);
      toastr.error(data.responseText, "<h3 style='margin:0;padding:0;padding-left:10px;'>Error</h3>");
    })
    .always(function() {
      $('#sendEmail input[type=submit]').attr( "disabled" , false);
      $('#sendEmail').css('opacity', '1');
      $('#emailLoading').fadeOut(1000);
    });
  })
});
