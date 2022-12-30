
<html>
<head>
	<meta http-equiv="Content-Type" content='text/html; charset=utf-8'>
	<link rel="stylesheet" href="themes/<?php echo $PARAMETERS['themes']['current_theme']; ?>/descrizione_luogo_dettagliata.css" TYPE='text/css'>
</head>
</html>

<?php
require '../ref_header.inc.php';
require '../footer.inc.php';

session_start();

echo $_SESSION['descrizione_luogo']['descrizione_dettagliata'];

?>