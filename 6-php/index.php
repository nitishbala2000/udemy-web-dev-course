
<?php
	function urlExists($url) {
			
			$file_headers = @get_headers($url);
			if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
				$exists = false;
			}
			else {
				$exists = true;
			}
			
		return $exists;
	}
	
	function get_weather($city) {
		
		$url = "https://www.weather-forecast.com/locations/".$city."/forecasts/latest";
		if (!urlExists($url)) {
			return "not-a-city";
		}
		$contents = file_get_contents($url);	
		$search_string1 = '"phrase">';
		$search_string2 = '</span>';
		$pos1 = strpos($contents, $search_string1) + strlen($search_string1);
		$pos2 = strpos($contents, $search_string2, $pos1);
		return substr($contents, $pos1, $pos2 - $pos1);
		
	}
	
	if ($_POST) {
		$city = $_POST["city"];
		$weather = get_weather($city);
	}

	
?>

<html lang="en">

 
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
    <title>Weather Site</title>
	
	<style type="text/css">
		
		body {
			margin : 0px;
			padding : 0px;
			background : url(weather-image.jpg);
			background-size : cover;
		}
		
		.container {
			width : 90%;
			margin : auto;
			margin-top : 100px;
		}
		
		.jumbotron {
			background-color : transparent;
		}
		
		.centered {
			text-align : center;
		}
		
		#btnp {
			margin-top : 20px;
		}
		
		.hidden {
			display : none;
		}
		
		
	
	</style>
  </head>
  
  
  <body>

	
	
	<div class="container">
	
		<div class="jumbotron">
			<h1 class="display-4 centered">What's the weather</h1>
			<p class="lead centered">Enter the name of a city</p>
		  
			<form method="post">
				
				<input name="city" id="city" class="form-control" type="text" placeholder="Enter city here">
				
				<p class="centered" id="btnp"><button type="button" class="btn btn-primary">Submit</button></p>
		  
			</form>
			
			<div id="error-div" class="alert alert-danger hidden" role="alert">
				
			</div>
			
			<div id="success-div" class="alert alert-success hidden" role="alert">
				
			</div>
		  
		</div>
		
	</div>
	
	<script type="text/javascript">
		var city = "<?php echo $city; ?>"
		var weather = "<?php echo $weather; ?>";
		
		if (weather) {
			$("#city").val(city);
			if (weather == "not-a-city") {
				$("#error-div").removeClass("hidden");
				$("#error-div").html(city + " is not a city");
				$("#success-div").addClass("hidden");
				
			} else {
				$("#error-div").addClass("hidden");
				$("#success-div").removeClass("hidden");
				$("#success-div").html(weather);
			}
	
			
		}
		
		$("button").click(function() {
			var city = $("#city").val().toLowerCase();
			
			city = city.split(/[ ]+/);
			city = city.join("-");
			
			$("#city").val(city);
			$("form").submit();
		})
	
	</script>
    

  </body>
    
</html>






