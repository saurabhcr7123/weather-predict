<?php
    $cityname = "";
    $weather = "";
	$err = "";
	
	if($_GET['city'])
	{	
	    $cityname = $_GET['city'];
        $urlcontent = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($cityname)."&appid=0a853620226e1605bcd4ff193fca2407");       //available in json format
        $weatherarray = json_decode($urlcontent, true );        //true flag to return data in an array
		if($weatherarray['cod'] == 200)
		{
			$weather .= "The weather in ".$cityname." is '".$weatherarray['weather'][0]['description']."'.<br> ";
			$temp = $weatherarray['main']['temp'] - 273;
			$weather .= "The temperature is : ".intval($temp)."&deg;C and the wind speed is ".$weatherarray['wind']['speed']."m/s.";
		}
		else
		{
			$err .= "Please enter a legit city!";
		}
    }
?>

<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

		<style type="text/css">
			@font-face
			{
				font-family: "PTSans";
				src: url("PTSansreg.ttf");
			}
			body
			{
				text-align : center;
				background-image: url("img2.jpg");
				background-repeat: no-repeat;
				font-family: "PTSans";
			}
			.container
			{
				text-align: center;
				margin-top:200px;
				width: 500px;
			}
			#name
			{
				text-align: center;
				font-size: 12px;
			}
		</style>
		<title>Home - Weather</title>
	</head>
	<body>

		<div class="container">
			<h1 class="text-white"><b>What's the weather?</b></h1>
			<p class="lead text-white">Enter the city name!</p>
				<form>
					<input type="search" name="city" class="form-control" placeholder="Eg. Pune, Munich, London" value="<?php echo $cityname; ?>">
					<br>
					<button type="submit" class="btn btn-primary">Search</button>
				</form>
				<br>
			<div id="answer">
                <?php
                if ($weather)
                {
                    echo '<p><div class="alert alert-success" role="alert">'.$weather.'</div></p>';
                } 
                else if($err)
                {
                    echo '<div class="alert alert-danger" role="alert">'.$err.'</div>';
                }
                ?>
            </div>
		</div>		
		<p id="name" class="text-white">&copy;Advait Pathak</p>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>