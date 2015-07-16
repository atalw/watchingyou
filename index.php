<html>
    <head>
    	<title></title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="js/typed.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <!-- Google analytics -->
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-64809003-1', 'auto');
          ga('send', 'pageview');
        </script>        
        <script>
            $.get("http://ipinfo.io", function (response) {
                $(function(){
                    var weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                    var dayOfWeekIndex = (new Date()).getDay();
                    var dayOfWeek = weekdays[dayOfWeekIndex];
                    var nextDayOfWeek = weekdays[dayOfWeekIndex+2];
                    var dayOfWeekPastIndex = Math.floor(weekdays.length * Math.random());
                    var dayOfWeekPast;
                    var hourOfDay = new Date().getHours();
                    var timeOfDay;
                    // choose day of week other than current one
                    if (dayOfWeekPastIndex == dayOfWeekIndex) {
                      dayOfWeekPast = weekdays[(dayOfWeekPastIndex + 1) % weekdays.length];
                    } else {
                      dayOfWeekPast = weekdays[dayOfWeekPastIndex];
                    }
                    // assign time of day to the hour
                    if ((hourOfDay >= 4) && (hourOfDay <= 11)) {
                      timeOfDay = "morning";
                    } else if ((hourOfDay >= 12) && (hourOfDay <= 16)) {
                      timeOfDay = "afternoon";
                    } else { 
                      timeOfDay = "evening";
                    }
                    $("#creep").typed({
                        strings: ["^1000Hello.^4000<br>I have been watching you.^4000<br>I know who you are.^2000<br>I know where you live.^4000<br>I can see you through your camera.^4000<br>Don't believe me?^4000<br>How's " + response.city + "?^4000<br>Haha.^500 It's " + dayOfWeek + " " + timeOfDay +"...^500<br>On "+ nextDayOfWeek + ", 2 days from now, somebody will knock on your door.^2000<br>DO NOT OPEN.^4000<br>You are not safe anymore.^3000", "^500Good Luck."],
                        typeSpeed: 30,
                        backSpeed: -5,
                        loop: false,
                        loopCount: false,
                    });
                });
                $(document).ready(function() {
                    setTimeout(function() {
                        $('#home').append('<a href="http://atalwar.com">HOME</a>');
                    }, 70000);
                });
            }, "jsonp");
        </script>
    </head>

    <body>
        <div id="container">
            <span id="creep"></span>
            <span id="home"></span>
        </div>        
    </body>
	<?php
		include('ip2locationlite.class.php');
		date_default_timezone_set("Asia/Kolkata");
		$ipLite = new ip2Location_lite;
		$ipLite->setKey('9a708afa852312e3d79f5ee0da1ca96941590abe9e4df8a133d18c155418d419');
		$f = fopen("website.log", "a");
		$dateToday = date("d/m/Y h:i:s");
		$ipAddr = $_SERVER['REMOTE_ADDR'];
		$str = $dateToday . "\n";
		fwrite($f, $str);
		$location = $ipLite->getCity($ipAddr);
		if(!empty($location)  && is_array($location)) {
			foreach($location as $field => $val) {
				if(strcmp($field, "ipAddress") == 0) {
					$data = $field . ' : ' . $val . "\n";
					fwrite($f, $data);
				}
				if(strcmp($field, "cityName") == 0) {
					$data = $field . ' : ' . $val . "\n";
					fwrite($f, $data . "\n\n");
				}
						if(strcmp($field, "countryName") == 0) {
							$data = $field . ' : ' . $val . "\n";
							fwrite($f, $data);
						}
					}
				}
			?>
</html>
