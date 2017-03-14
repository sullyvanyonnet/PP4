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
				<h1>Test des boutons radio</h1>
			</div><!-- /header -->
			<div data-role="content">
				<div data-role="fieldcontain">
					<fieldset data-role="controlgroup">
						<legend>Choisir un langage informatique :</legend>
							<input type="radio" name="radio-choix-1" id="radio-choix-1" value="choix-1" />
							<label for="radio-choix-1">PHP</label>
							<input type="radio" name="radio-choix-1" id="radio-choix-2" value="choix-2" />
							<label for="radio-choix-2">C++</label>
							<input type="radio" name="radio-choix-1" id="radio-choix-3" value="choix-3" />
							<label for="radio-choix-3">C#</label>
							<input type="radio" name="radio-choix-1" id="radio-choix-4" value="choix-4" checked="checked" />
							<label for="radio-choix-4">JAVA</label>
					</fieldset>
				</div>
				<div data-role="fieldcontain">
					<fieldset data-role="controlgroup" data-mini="true">
						<legend>Le m&ecirc;me en mini :</legend>
							<input type="radio" name="radio-choix-2" id="radio-choix-1" value="choix-1" checked="checked" />
							<label for="radio-choix-1">PHP</label>
							<input type="radio" name="radio-choix-2" id="radio-choix-2" value="choix-2" />
							<label for="radio-choix-2">C++</label>
							<input type="radio" name="radio-choix-2" id="radio-choix-3" value="choix-3" />
							<label for="radio-choix-3">C#</label>
							<input type="radio" name="radio-choix-2" id="radio-choix-4" value="choix-4" />
							<label for="radio-choix-4">JAVA</label>
					</fieldset>
				</div>
			</div><!-- /content -->
			<div data-role="footer">
				<h4>&copy; 2016 EstranSup </h4>
			</div><!-- /footer -->
		</div><!-- /page -->

	</body>

</html>
