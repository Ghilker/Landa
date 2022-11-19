<?php session_start();


    //Includio i parametri, la configurazione, la lingua e le funzioni
	require 'config.inc.php';
	require 'includes/functions.inc.php';
	require 'vocabulary/'.$PARAMETERS['languages']['set'].'.vocabulary.php';

	//Eseguo la connessione al database
	$handleDBConnection = gdrcd_connect();


	/* * Aggiorno l'ora di uscita del pg
		* @author Blancks
	*/
	gdrcd_query("UPDATE personaggio SET ora_uscita = NOW() WHERE nome='" . gdrcd_filter('in',$_SESSION['login']) . "'");



?>
<html>
<head>
   <meta http-equiv="Content-Type" content='text/html; charset=utf-8'>
   <link rel="stylesheet" href="themes/<?php echo $PARAMETERS['themes']['current_theme'];?>/main.css" TYPE='text/css'>
   <link rel="shortcut icon" href="favicon.ico" />
</head>
<body class="logout_body">

<div class="logout_box">
<div class="nome_logout"><?php echo gdrcd_filter('out', $_SESSION['login']).' '; ?></div>
<span class="logout_text">
	<?php echo gdrcd_filter('out',$MESSAGE['logout']['confirmation']);?><br><br>
    <?php echo gdrcd_filter('out',$MESSAGE['logout']['logbackin']).' '; ?>
	<a href="index.php"><u>Homepage</u></a>.
</span><br><b><span class="logout_text"><?php echo gdrcd_filter('out',$MESSAGE['logout']['greeting']); ?></span></b>
</div>

</body>
</html>
<?php


	/*Chiudo la connessione al database*/
	gdrcd_close_connection($handleDBConnection);


	/* * Per ottimizzare le risorse impiegate le liberiamo dopo che non ne abbiamo più bisogno
		* @author Blancks
	*/
	unset($MESSAGE);
	unset($PARAMETERS);


   session_unset();
   session_destroy();
?>