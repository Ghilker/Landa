<head>
	<link rel='stylesheet' href='themes/<?php echo $PARAMETERS['themes']['current_theme']; ?>/main.css' TYPE='text/css'>
</head>

<?php
require '../ref_header.inc.php';
require '../footer.inc.php';



// Get the array from the query parameter
session_start();

echo $_SESSION['descrizione_luogo']['descrizione_dettagliata'];

?>