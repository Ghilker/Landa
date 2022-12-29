<?php include('../ref_header.inc.php'); /*Header comune*/ ?>

<!-- Box presenti-->

<div class="titolo_presenti">
  <img src="https://provalice.altervista.org/imgs/presenti.png" alt="presenti">
  <!--<div style="margin-top: 15px; margin-bottom: 20px"><img src="/imgs/presenti.png"></div>-->
</div>

<div class="pagina_presenti">



<?php
//Refresh presenza.
if (isset($_REQUEST['disponibile'])===TRUE){
   $query = "UPDATE personaggio SET ultimo_refresh = NOW(), disponibile=".gdrcd_filter('num',$_REQUEST['disponibile'])."  WHERE nome = '".gdrcd_filter('in',$_SESSION['login'])."'";
} elseif (isset($_REQUEST['invisibile'])&&($_SESSION['permessi']>=MASTER)){
   $query = "UPDATE personaggio SET ultimo_refresh = NOW(), is_invisible=".gdrcd_filter('num',$_REQUEST['invisibile'])."  WHERE nome = '".gdrcd_filter('in',$_SESSION['login'])."'";
} else {
   $query = "UPDATE personaggio SET ultimo_refresh = NOW() WHERE nome = '".gdrcd_filter('in',$_SESSION['login'])."'";
}

gdrcd_query($query);

echo '<div class="elenco_presenti">';

// Conteggio i presenti.
$record = gdrcd_query("SELECT COUNT(*) AS numero FROM personaggio WHERE (personaggio.ora_entrata > personaggio.ora_uscita AND DATE_ADD(personaggio.ultimo_refresh, INTERVAL 4 MINUTE) > NOW())");

//numero utenti presenti.
echo '<div class="link_presenti"><a href="../main.php?page=presenti_estesi" target="_top">';
if ($record['numero']==1){
	echo '<div class="utenti"><h2>'.$record['numero'].' '.gdrcd_filter('out',$PARAMETERS['names']['users_name']['sing']).' '.gdrcd_filter('out',$MESSAGE['interface']['logged_users']['sing']).'</h2></div>';
} else {
    echo '<div class="utenti"><h2 class="presenti_title">'.$record['numero'].' '.gdrcd_filter('out',$PARAMETERS['names']['users_name']['plur']).' '.gdrcd_filter('out',$MESSAGE['interface']['logged_users']['plur']).'</h2></div>';
}
echo '</a></div>';

//Carico la lista presenti (Entrati).
$query = "SELECT personaggio.nome, personaggio.permessi, personaggio.sesso, personaggio.id_razza, razza.sing_m, razza.sing_f, razza.icon, personaggio.disponibile, personaggio.is_invisible FROM personaggio LEFT JOIN razza ON personaggio.id_razza = razza.id_razza WHERE DATE_ADD(personaggio.ora_entrata, INTERVAL 2 MINUTE) > NOW() ORDER BY personaggio.ora_entrata, personaggio.nome";
$result = gdrcd_query($query, 'result');

echo '<div class="luogo">'.$MESSAGE['interface']['logged_users']['logged_in'].'</li>';

while ($record = gdrcd_query($result, 'fetch')){
    //Stampo il PG
	echo '<div class="presente">';
	  switch ($record['permessi']){
		  case USER: $alt_permessi = ''; break;
                 case CAPORAZZA: $alt_permessi = $PARAMETERS['names']['race']['lead']; break;
		  case GUIDA: $alt_permessi = $PARAMETERS['names']['guida']['sing']; break;
                 case CAPOGILDA: $alt_permessi = $PARAMETERS['names']['guild_name']['lead']; break;
 		  case MASTER: $alt_permessi =  $PARAMETERS['names']['master']['sing']; break;
		  case MODERATORE: $alt_permessi =  $PARAMETERS['names']['moderator']['sing']; break;
                 case ADMIN: $alt_permessi = $PARAMETERS['names']['admin']['sing']; break;
		  case GESTORE: $alt_permessi = $PARAMETERS['names']['administrator']['sing']; break;
      }
	  //Livello di accesso del PG (utente, master, admin, superuser)
	  echo '<img class="presenti_ico" src="../imgs/icons/permessi'.$record['permessi'].'.png" alt="'.gdrcd_filter('out',$alt_permessi).'" title="'.gdrcd_filter('out',$alt_permessi).'" />';
	  //Icona stato di disponibilità. E' sensibile se la riga che sto stampando corrisponde all'utente loggato.
	  $change_disp=($record['disponibile']+1)%3;
	  if ($record['nome']==$_SESSION['login']){
		  //se c'e' stato un cambio di permessi aggiorno
          if ($record['permessi']!=$_SESSION['permessi']){$_SESSION['permessi']=$record['permessi'];}
		  echo '<a href="presenti.inc.php?disponibile='.$change_disp.'" class="link_sheet">';
	  }
	  echo '<img class="presenti_ico" src="../imgs/icons/disponibile'.$record['disponibile'].'.png" alt="'.gdrcd_filter('out',$MESSAGE['status_pg']['availability'][$record['disponibile']]).'" title="'.gdrcd_filter('out',$MESSAGE['status_pg']['availability'][$record['disponibile']]).'" />';
      if ($record['nome']==$_SESSION['login']){ echo '</a>';}
	  //Icona della razza pg
	  if($record['icon']==''){$record['icon']='standard_razza.png';}
	  echo '<img class="presenti_ico" src="../themes/'.$PARAMETERS['themes']['current_theme'].'/imgs/races/'.$record['icon'].'" alt="'.gdrcd_filter('out',$record['sing_'.$record['sesso']]).'" title="'.gdrcd_filter('out',$record['sing_'.$record['sesso']]).'" />';
	  //Icona del genere del pg
	  echo '<img class="presenti_ico" src="../imgs/icons/testamini'.$record['sesso'].'.png" alt="'.gdrcd_filter('out',$MESSAGE['status_pg']['gender'][$record['sesso']]).'" title="'.gdrcd_filter('out',$MESSAGE['status_pg']['gender'][$record['sesso']]).'" />';
	  //Nome pg e link alla sua scheda
	  echo ' <a href="../main.php?page=scheda&pg='.gdrcd_filter('url',$record['nome']).'" class="link_sheet" target="_top">'.gdrcd_filter('out',$record['nome']);
	  if (empty($record['cognome'])===FALSE){echo ' '.gdrcd_filter('out',$record['cognome']);}
      echo '</a> ';
	  //Comando visibile/invisibile
	  if(($_SESSION['permessi']>=MASTER) && ($record['nome']==$_SESSION['login'])){
	    if($record['is_invisible']==1){$next=0;} else {$next=1;}
		echo '<a href="presenti.inc.php?invisibile='.$next.'"><img class="presenti_ico" src="../imgs/icons/vis'.$record['is_invisible'].'.png" alt="'.gdrcd_filter('out',$MESSAGE['status_pg']['invisible'][$record['is_invisible']]).'" title="'.gdrcd_filter('out',$MESSAGE['status_pg']['invisible'][$record['is_invisible']]).'" /></a>';
	  }
	echo '</div>';
}//while

gdrcd_query($result, 'free');


//Carico la lista presenti (Usciti).
/* * Fix della query per includere l'uso dell'orario di uscita per capire istantaneamente quando un pg fa logout
	* @author Blancks
*/
$query = "SELECT personaggio.nome, personaggio.permessi, personaggio.sesso, personaggio.id_razza, razza.sing_m, razza.sing_f, razza.icon, personaggio.disponibile, personaggio.is_invisible FROM personaggio LEFT JOIN razza ON personaggio.id_razza = razza.id_razza WHERE (personaggio.ora_uscita > personaggio.ora_entrata AND DATE_ADD(personaggio.ora_uscita, INTERVAL 1 MINUTE) > NOW()) OR (personaggio.ora_uscita < personaggio.ora_entrata AND DATE_ADD(personaggio.ultimo_refresh, INTERVAL 4 MINUTE) > NOW() AND DATE_ADD(personaggio.ultimo_refresh, INTERVAL 3 MINUTE) < NOW()) ORDER BY personaggio.ultimo_refresh, personaggio.nome";
$result = gdrcd_query($query, 'result');

echo '<div class="luogo">'.$MESSAGE['interface']['logged_users']['logged_out'].'</div>';

while ($record = gdrcd_query($result, 'fetch')){
    //Stampo il PG
	echo '<div class="presente">';
	  switch ($record['permessi']){
		  case USER: $alt_permessi = ''; break;
                 case CAPORAZZA: $alt_permessi = $PARAMETERS['names']['race']['lead']; break;
                  case GUIDA: $alt_permessi = $PARAMETERS['names']['guida']['sing']; break;
		  case CAPOGILDA: $alt_permessi = $PARAMETERS['names']['guild_name']['lead']; break;
 		  case MASTER: $alt_permessi =  $PARAMETERS['names']['master']['sing']; break;
 case MODERATORE: $alt_permessi =  $PARAMETERS['names']['moderator']['sing']; break;
                 case ADMIN: $alt_permessi = $PARAMETERS['names']['admin']['sing']; break;
		  case GESTORE: $alt_permessi = $PARAMETERS['names']['administrator']['sing']; break;
      }
	  //Livello di accesso del PG (utente, master, admin, superuser)
	  echo '<img class="presenti_ico" src="../imgs/icons/permessi'.$record['permessi'].'.png" alt="'.gdrcd_filter('out',$alt_permessi).'" title="'.gdrcd_filter('out',$alt_permessi).'" />';
	  //Icona stato di disponibilità. E' sensibile se la riga che sto stampando corrisponde all'utente loggato.
	  $change_disp=($record['disponibile']+1)%3;
	  if ($record['nome']==$_SESSION['login']){
		  //se c'e' stato un cambio di permessi aggiorno
          if ($record['permessi']!=$_SESSION['permessi']){$_SESSION['permessi']=$record['permessi'];}
		  echo '<a href="presenti.inc.php?disponibile='.$change_disp.'" class="link_sheet">';
	  }
	  echo '<img class="presenti_ico" src="../imgs/icons/disponibile'.$record['disponibile'].'.png" alt="'.gdrcd_filter('out',$MESSAGE['status_pg']['availability'][$record['disponibile']]).'" title="'.gdrcd_filter('out',$MESSAGE['status_pg']['availability'][$record['disponibile']]).'" />';
      if ($record['nome']==$_SESSION['login']){ echo '</a>';}
	  //Icona della razza pg
	  if($record['icon']==''){$record['icon']='standard_razza.png';}
	  echo '<img class="presenti_ico" src="../themes/'.$PARAMETERS['themes']['current_theme'].'/imgs/races/'.$record['icon'].'" alt="'.gdrcd_filter('out',$record['sing_'.$record['sesso']]).'" title="'.gdrcd_filter('out',$record['sing_'.$record['sesso']]).'" />';
	  //Icona del genere del pg
	  echo '<img class="presenti_ico" src="../imgs/icons/testamini'.$record['sesso'].'.png" alt="'.gdrcd_filter('out',$MESSAGE['status_pg']['gender'][$record['sesso']]).'" title="'.gdrcd_filter('out',$MESSAGE['status_pg']['gender'][$record['sesso']]).'" />';
	  //Nome pg e link alla sua scheda
	  echo ' <a href="../main.php?page=scheda&pg='.gdrcd_filter('in',$record['nome']).'" class="link_sheet" target="_top">'.gdrcd_filter('out',$record['nome']);
	  if (empty($record['cognome'])===FALSE){echo ' '.gdrcd_filter('out',$record['cognome']);}
      echo '</a> ';
	  //Comando visibile/invisibile
	  if(($_SESSION['permessi']>=MASTER) && ($record['nome']==$_SESSION['login'])){
	    if($record['is_invisible']==1){$next=0;} else {$next=1;}
		echo '<a href="presenti.inc.php?invisibile='.$next.'"><img class="presenti_ico" src="../imgs/icons/vis'.$record['is_invisible'].'.png" alt="'.gdrcd_filter('out',$MESSAGE['status_pg']['invisible'][$record['is_invisible']]).'" title="'.gdrcd_filter('out',$MESSAGE['status_pg']['invisible'][$record['is_invisible']]).'" /></a>';
	  }
	echo '</div>';
}//while

gdrcd_query($result, 'free');

//Carico la lista presenti (In luogo).
/* * Fix della query per includere l'uso dell'orario di uscita per capire istantaneamente quando il pg non è più connesso
	* @author Blancks
*/
$query = "SELECT personaggio.nome, personaggio.permessi, personaggio.sesso, personaggio.id_razza, razza.sing_m, razza.sing_f, razza.icon, personaggio.disponibile, personaggio.is_invisible, mappa.stanza_apparente, mappa.nome as luogo FROM personaggio LEFT JOIN mappa ON personaggio.ultimo_luogo = mappa.id LEFT JOIN razza ON personaggio.id_razza = razza.id_razza WHERE (personaggio.ora_entrata > personaggio.ora_uscita AND DATE_ADD(personaggio.ultimo_refresh, INTERVAL 4 MINUTE) > NOW()) AND personaggio.ultimo_luogo = ".$_SESSION['luogo']." AND personaggio.ultima_mappa= ".$_SESSION['mappa']." ORDER BY personaggio.is_invisible, personaggio.ultimo_luogo, personaggio.nome";
$result = gdrcd_query($query, 'result');

$ultimo_luogo_corrente='';
while ($record = gdrcd_query($result, 'fetch')){


	if (empty ($record['stanza_apparente'])===TRUE){$luogo_corrente = $record['luogo'];}
	else {$luogo_corrente = $record['stanza_apparente'];}

	if (empty($luogo_corrente)===TRUE){
	   if ($record['mappa']>=0){
		    $luogo_corrente = $PARAMETERS['names']['maps_location'];}
	   else{$luogo_corrente = $PARAMETERS['names']['base_location'];}
	}
	if ($ultimo_luogo_corrente!=$luogo_corrente){
	      $ultimo_luogo_corrente=$luogo_corrente;
	      echo '<div class="luogo">'.gdrcd_filter('out',$luogo_corrente).'</li>';
	} //if

	//Stampo il PG
	if(($record['is_invisible']==0)||($record['nome']==$_SESSION['login'])){
	echo '<div class="presente">';

	  switch ($record['permessi']){
		  case USER: $alt_permessi = ''; break;
                 case CAPORAZZA: $alt_permessi = $PARAMETERS['names']['race']['lead']; break;  
                  case GUIDA: $alt_permessi = $PARAMETERS['names']['guida']['sing']; break;
		  case CAPOGILDA: $alt_permessi = $PARAMETERS['names']['guild_name']['lead']; break;
 		  case MASTER: $alt_permessi =  $PARAMETERS['names']['master']['sing']; break;
 case MODERATORE: $alt_permessi =  $PARAMETERS['names']['moderator']['sing']; break;
                 case ADMIN: $alt_permessi = $PARAMETERS['names']['admin']['sing']; break;
		  case GESTORE: $alt_permessi = $PARAMETERS['names']['administrator']['sing']; break;
      }

	  //Livello di accesso del PG (utente, master, admin, superuser)
	  echo '<img class="presenti_ico" src="../imgs/icons/permessi'.$record['permessi'].'.png" alt="'.gdrcd_filter('out',$alt_permessi).'" title="'.gdrcd_filter('out',$alt_permessi).'" />';

	  //Icona stato di disponibilità. E' sensibile se la riga che sto stampando corrisponde all'utente loggato.
	  $change_disp=($record['disponibile']+1)%3;
	  if ($record['nome']==$_SESSION['login']){
		  //se c'e' stato un cambio di permessi aggiorno
          if ($record['permessi']!=$_SESSION['permessi']){$_SESSION['permessi']=$record['permessi'];}
		  echo '<a href="presenti.inc.php?disponibile='.$change_disp.'" class="link_sheet">';
	  }
	  echo '<img class="presenti_ico" src="../imgs/icons/disponibile'.$record['disponibile'].'.png" alt="'.gdrcd_filter('out',$MESSAGE['status_pg']['availability'][$record['disponibile']]).'" title="'.gdrcd_filter('out',$MESSAGE['status_pg']['availability'][$record['disponibile']]).'" />';
      if ($record['nome']==$_SESSION['login']){ echo '</a>';}

	  //Icona della razza pg
	  if($record['icon']==''){$record['icon']='standard_razza.png';}
	  echo '<img class="presenti_ico" src="../themes/'.$PARAMETERS['themes']['current_theme'].'/imgs/races/'.$record['icon'].'" alt="'.gdrcd_filter('out',$record['sing_'.$record['sesso']]).'" title="'.gdrcd_filter('out',$record['sing_'.$record['sesso']]).'" />';

	  //Icona del genere del pg
	  echo '<img class="presenti_ico" src="../imgs/icons/testamini'.$record['sesso'].'.png" alt="'.gdrcd_filter('out',$MESSAGE['status_pg']['gender'][$record['sesso']]).'" title="'.gdrcd_filter('out',$MESSAGE['status_pg']['gender'][$record['sesso']]).'" />';

	  //Nome pg e link alla sua scheda
	  echo ' <a href="../main.php?page=scheda&pg='.$record['nome'].'" class="link_sheet" target="_top">'.gdrcd_filter('out',$record['nome']);
	  if (empty($record['cognome'])===FALSE){echo ' '.gdrcd_filter('out',$record['cognome']);}
      echo '</a> ';

	  //Comando visibile/invisibile
	  if(($_SESSION['permessi']>=MASTER) && ($record['nome']==$_SESSION['login'])){
	    if($record['is_invisible']==1){$next=0;} else {$next=1;}
		echo '<a href="presenti.inc.php?invisibile='.$next.'"><img class="presenti_ico" src="../imgs/icons/vis'.$record['is_invisible'].'.png" alt="'.gdrcd_filter('out',$MESSAGE['status_pg']['invisible'][$record['is_invisible']]).'" title="'.gdrcd_filter('out',$MESSAGE['status_pg']['invisible'][$record['is_invisible']]).'" /></a>';
	  }

	echo '</div>';}
}//while

gdrcd_query($result, 'free');


echo '</div>';


?>

  </div>

<!-- Chiudura finestra del gioco -->

<?php include('../footer.inc.php');  /*Footer comune*/?>
