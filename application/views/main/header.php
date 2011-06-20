<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>TEST APP</title>
    <link rel="stylesheet" href="<?=base_url();?>styles/style.css" type="text/css" media="screen" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
    <script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script>
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId   : 'fbapp id goes here',
          session : 'fb session variable goes here', // don't refetch the session when PHP already has it
          status  : true, // check login status
          cookie  : true, // enable cookies to allow the server to access the session
          xfbml   : true  // parse XFBML
        });

        // whenever the user logs in, we refresh the page
        FB.Event.subscribe('auth.login', function() {
          window.location.reload();
        });
      };

      (function() {
        var e = document.createElement('script');
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>

    <script>
	$(document).ready(function() {
	$("a[rel]").overlay();
	});
	</script>
  </head>
  <body>
