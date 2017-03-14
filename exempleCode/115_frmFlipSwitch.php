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
				<h1>Test des flip switchs</h1>
			</div><!-- /header -->
			<div data-role="content">

				<div data-role="fieldcontain">
				    <label for="flip-1">Flips witch:</label>
				    <select id="flip-1" name="flip-1" data-role="slider">
				        <option value="off">Off</option>
				        <option value="on">On</option>
				    </select>
               	</div>
               	<div data-role="fieldcontain">
				    <label for="flip-3">Mini flip switch:</label>
				    <select name="flip-3" id="flip-3" data-role="slider" data-mini="true">
				        <option value="off">Off</option>
				        <option value="on">On</option>
				    </select>
				</div>

			</div><!-- /content -->
			<div data-role="footer">
				<h4>&copy; 2016 EstranSup </h4>
			</div><!-- /footer -->
		</div><!-- /page -->

	</body>

</html>
