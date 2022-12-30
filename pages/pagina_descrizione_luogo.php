<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		<link rel='stylesheet' href='themes/<?php echo $PARAMETERS['themes']['current_theme']; ?>/main.css' TYPE='text/css'>
		<link rel='shortcut icon' href='favicon.ico' />
	</head>

<?php
require '../ref_header.inc.php';
require '../footer.inc.php';



// Get the array from the query parameter
session_start();

echo $_SESSION['descrizione_luogo']['descrizione_dettagliata'];

?>