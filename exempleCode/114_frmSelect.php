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
				<h1>Test des selects</h1>
			</div><!-- /header -->
			<div data-role="content">

				<div data-role="fieldcontain">
					<label for="select-choice-a" class="select">Choisissez une couleur:</label>
					<select name="select-choice-a" id="select-choice-a" data-native-menu="false">
	    				<option>Couleur ?</option>
	    				<option value="blue">Bleu</option>
	    				<option value="white">Blanc</option>
	    				<option value="green">Vert</option>
	    				<option value="red">Rouge</option>
					</select>
				</div>

				<div data-role="fieldcontain">
					<label for="select-choice-b" class="select">Mode natif:</label>
					<select name="select-choice-b" id="select-choice-b">
						<option value="blue">Bleu</option>
	    				<option value="white">Blanc</option>
	    				<option value="green">Vert</option>
	    				<option value="red">Rouge</option>
					</select>
				</div>
			</div><!-- /content -->
			<div data-role="footer">
				<h4>&copy; 2016 EstranSup </h4>
			</div><!-- /footer -->
		</div><!-- /page -->

	</body>

</html>
