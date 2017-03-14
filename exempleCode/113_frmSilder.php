<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Version Mobile</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
		<link rel="stylesheet" href="jquery/jquery.mobile-1.4.0.min.css" />
		<script src="jquery/jquery-1.11.0.min.js"></script>
		<script src="jquery/jquery.mobile-1.4.0.min.js"></script>
	</head>

	<body>

		<div data-role="page">
			<div data-role="header">
				<h1>Test des sliders</h1>
			</div><!-- /header -->
			<div data-role="content">

                <div data-role="fieldcontain">
					<label for="slider">Slider:</label>
					<input name="slider" id="slider" value="50" min="0" max="100" type="range" readonly/ >
                </div>
                <div data-role="fieldcontain">
	 				<div data-role="rangeslider">
	        			<label for="range-1a">Rangeslider:</label>
	        			<input name="range-1a" id="range-1a" min="0" max="100" value="40" type="range" readonly />
	        			<label for="range-1b">Rangeslider:</label>
	        			<input name="range-1b" id="range-1b" min="0" max="100" value="80" type="range" readonly />
	   		 		</div>
	   			</div>

			</div><!-- /content -->
			<div data-role="footer">
				<h4>&copy; 2016 EstranSup </h4>
			</div><!-- /footer -->
		</div><!-- /page -->

	</body>

</html>
