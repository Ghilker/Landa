<head>
  <link rel="stylesheet" type="text/css" href="../themes/<?php echo $PARAMETERS['themes']['current_theme']; ?>/descrizione_luogo_dettagliata.css">
</head>
<?php
session_start();
echo $_SESSION['descrizione_luogo']['descrizione_dettagliata'];?>

