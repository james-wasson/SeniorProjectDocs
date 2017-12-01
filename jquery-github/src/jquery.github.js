// -- Github Repository --------------------------------------------------------
var RECENT_COMMITS = 0;
function GithubRepo( repo ) {
  
	this.description = repo.result_data.description;
	this.forks = repo.result_data.forks_count;
	this.name = repo.result_data.name;
	this.open_issues = repo.result_data.open_issues;
	this.pushed_at = repo.result_data.pushed_at;
	this.url = repo.result_data.url;
	this.stargazers = repo.result_data.stargazers_count;
  this.commits = repo.result_commits.map(function (x) {
    return {
      "name": x.commit.author.name,
      "date": x.commit.author.date,
      "message": x.commit.message,
      "url": x.commit.url
    }
  });
}

// Parses HTML template
GithubRepo.prototype.toHTML = function () {
	this.pushed_at = this._parsePushedDate( this.pushed_at ),
	this.url  = this._parseURL( this.url );
  var that = this;
  var returnStr = "<div class='github-box'>" +
			"<div class='github-box-header'>" +
				"<h3>" +
					"View On Git: <a href='" + this.url + "'>" + this.name + "</a>" +
				"</h3>" +
				"<div class='github-stats'>" +
					"<a class='repo-stars' title='Stars' data-icon='7' href='" + this.url + "/stargazers'>" + this.stargazers + "</a>" +
					"<a class='repo-forks' title='Forks' data-icon='f' href='" + this.url + "/network'>" + this.forks + "</a>" +
					"<a class='repo-issues' title='Issues' data-icon='i' href='" + this.url + "/issues'>" + this.open_issues + "</a>" +
				"</div>" +
			"</div>" +
			"<div class='github-box-content'>" +
				"<p>" + this.description + " &mdash; <a href='" + this.url + "#readme'>Read More</a></p>" +
			"</div>" +
			"<div class='github-box-download' style='overflow: auto;'>" +
				"<p class='repo-update'>Latest commit to <strong>master</strong> on " + this.pushed_at + "</p>" +
				"<a class='repo-download' title='Download as zip' data-icon='w' href='" + this.url + "/zipball/master'></a>" +
        "<div class='recent-commits' style='font-size: 60%; width: 100%;'>" +
          "<p style='border-bottom: 1px solid darkgrey; width: 100%;'>Last " + RECENT_COMMITS + " Commits</p>";
  console.log(this)
  this.commits.forEach(function (c, i, obj) {
    c.date = that._parsePushedDate( c.date ),
    c.url = that._parseURL( c.url );
    returnStr += "<div class='row' style='width: 100%; pointer:cursor;'>" + 
      "<a style='width:100%;' href='" + c.url + "'>" +
      "<div class='col-md-6' style='overflow:hidden; max-height: 20px; line-height: 20px;'>Message: " +  c.message +"</div>" +
      "<div class='col-md-3' style='overflow:hidden; max-height: 20px; line-height: 20px;'>User: " +  c.name +"</div>" +
      "<div class='col-md-3' style='overflow:hidden; max-height: 20px; line-height: 20px;'>date: " +  c.date +"</div>" +
      "</a>" + 
      "</div>";
  });
    returnStr += "</div>" +
			"</div>" +
		"</div>";
    return $(returnStr);
};

// Parses pushed_at with date format
GithubRepo.prototype._parsePushedDate = function ( pushed_at ) {
	var date = new Date( pushed_at );

	return date.getDate() + "/" + ( date.getMonth() + 1 ) + "/" + date.getFullYear();
};

// Parses URL to be friendly
GithubRepo.prototype._parseURL = function ( url ) {
	return url.replace( "api.", "" ).replace( "repos/", "" ).replace("git/", "");
};

// -- Github Plugin ------------------------------------------------------------

function Github( element, options ) {
	var defaults = {
				iconStars:  true,
				iconForks:  true,
				iconIssues: false,
        recentCommits: 10
			};

	this.element    = element;
	this.$container = $( element );
	this.repo       = this.$container.attr( "data-repo" );

	this.options = $.extend( {}, defaults, options ) ;

	this._defaults = defaults;

	this.init();
	this.displayIcons();
}

// Initializer
Github.prototype.init = function () {
	this.requestData( this.repo );
};

// Display or hide icons
Github.prototype.displayIcons = function () {
	var options = this.options,
			$iconStars = $( ".repo-stars" ),
			$iconForks = $( ".repo-forks" ),
			$iconIssues = $( ".repo-issues" ),
      $numRecentCommits = $( ".recent-commits" );

	$iconStars.css( "display", options.iconStars ? "inline-block" : "none" );
	$iconForks.css( "display", options.iconForks ? "inline-block" : "none" );
	$iconIssues.css( "display", options.iconIssues ? "inline-block" : "none" );
  $numRecentCommits.css( "display", options.recentCommits > 0 ? "inline-block" : "none" );
  if (options.recentCommits > 0) RECENT_COMMITS = options.recentCommits 
};

// Request repositories from Github
Github.prototype.requestData = function ( repo ) {
	var that = this;
  var username = "james-wasson";
  var pass = "bf573c5dfbbd0ab5e439bad30ee268311e4fc39c";
  var auth = "Authorization: Basic " +  window.btoa(username + ':' + pass);
	$.ajax({
		url: "https://api.github.com/repos/" + repo,
		dataType: "jsonp",
		success: function( results ) {
			var result_data = results.data,
				isFailling = results.meta.status >= 400 && result_data.message;

			if ( isFailling ) {
				that.handleErrorRequest( result_data );
				return;
			}
      if (that.options.recentCommits > 0) {
        $.ajax({
          url: "https://api.github.com/repos/" + repo + "/commits?per_page=" + that.options.recentCommits,
          dataType: "jsonp",
          success: function( results ) {
            var result_commits = results.data,
              isFailling = results.meta.status >= 400 && result_data.message;

            if ( isFailling ) {
              that.handleErrorRequest(result_commits);
              return;
            }

            that.handleSuccessfulRequest({ "result_data": result_data, "result_commits": result_commits });
          }
        });
      } else {
        that.handleSuccessfulRequest({ "result_data": result_data, "result_commits": [] });
      }
		}
	});
  
};

// Handle Errors requests
Github.prototype.handleErrorRequest = function ( data ) {
  console.log("here")
	console.warn( data.message );
  $('.projects .fallback').fadeIn(1000);
  $('.profects .github-box').hide();
	return;
};

// Handle Successful request
Github.prototype.handleSuccessfulRequest = function ( data ) {
	this.applyTemplate( data );
};

// Apply results to HTML template
Github.prototype.applyTemplate = function ( repo ) {
	var githubRepo = new GithubRepo( repo ),
		$widget = githubRepo.toHTML();

	$widget.appendTo( this.$container );
  var pos = $('.github-box-download').offset().top - $(".github-box").offset().top;
  $(".github-box-download").innerHeight($(".github-box").innerHeight() - pos)
};

// -- Attach plugin to jQuery's prototype --------------------------------------

;( function ( $, window, undefined ) {

	$.fn.github = function ( options ) {
		return this.each(function () {
			if ( !$( this ).data( "plugin_github" ) ) {
				$( this ).data( "plugin_github", new Github( this, options ) );
			}
		});
	};

}( window.jQuery || window.Zepto, window ) );
