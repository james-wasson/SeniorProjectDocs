$().ready(function () {
  var link = "./shen/shen-resume.pdf";
  var options = {
    fallbackLink: "<p>Your browser does not support pdf viewing.</p><p><a href='"+link+"'>Click here to download my Resume.</a></p>",
    height: "80vh",
    pdfOpenParams: { view: 'FitV'},
    width: "80%"
  };
  PDFObject.embed(link, "#shenResumePDF", options);
})
