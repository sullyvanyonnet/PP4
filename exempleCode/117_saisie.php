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
				<h1>Test des saisies</h1>
			</div><!-- /header -->
			<div data-role="content">

				<div data-role="fieldcontain">
					<label for="time">Heure</label>
					<input type="time" name="time" />
				</div>

				<div data-role="fieldcontain">
					<label for="datetime">Date et heure</label>
					<input type="datetime" name="datetime" />
				</div>

				<div data-role="fieldcontain">
					<label for="date">Date</label>
					<input type="date" name="date" />
				</div>

				<div data-role="fieldcontain">
					<label for="month">Mois</label>
					<input type="month" name="month" />
				</div>

				<div data-role="fieldcontain">
					<label for="tel">Téléphone</label>
					<input type="tel" name="tel" value="" id=”tel” />
				</div>

				<div data-role="fieldcontain">
					<label for="text">Texte placeholder</label>
					<input type="text" name="text" value="" id=”text” placeholder="Text"/>
				</div>

				<div data-role="fieldcontain">
					<label for="number">Nombre</label>
					<input type="number" name="number" value="" id=”number” />
				</div>

				<div data-role="fieldcontain">
					<label for="email">Email</label>
					<input type="email" name="email" value="" id="email" />
				</div>

				<div data-role="fieldcontain">
					<label for="url">URL</label>
					<input type="url" name="url" value="" id="url" />
				</div>

				<div data-role="fieldcontain">
					<label for="search">Recherche</label>
					<input type="search" name="search" value="" id="search" />
				</div>

				<div data-role="fieldcontain">
					<label for="textarea">Text area</label>
					<textarea cols="40" rows="8" name="textarea" id="textarea"></textarea>
				</div>

			</div><!-- /content -->
			<div data-role="footer">
				<h4>&copy; 2016 EstranSup </h4>
			</div><!-- /footer -->
		</div><!-- /page -->

	</body>

</html>
