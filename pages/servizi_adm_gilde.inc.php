<?php /*HELP: */ 


?>

<div class="pagina_servizi_adm_gilde">


<!-- Titolo della pagina -->
<div class="page_title">
   <!--<h2><?php echo gdrcd_filter('out',$MESSAGE['interface']['adm_guilds']['page_name'].' '.strtolower($PARAMETERS['names']['guild_name']['plur'])); ?></h2>-->
   <div style="margin-top: 15px; margin-bottom: 20px"><img src="/imgs/amm_gilde.png"></div>
</div>


<!-- Box principale -->
<div class="page_body">

<?php /*Elenco lavori*/
if(isset($_POST['op'])===FALSE){ ?> 
         
		
	<div class="form_gioco">
	
				
		<?php /*Seleziono i ruoli su cui l'account ha competenza*/
		
		if ($_SESSION['permessi']>=ADMIN){
            $people="SELECT nome, cognome FROM personaggio  WHERE permessi > -1 ORDER BY nome";
		    $query="SELECT ruolo.id_ruolo, ruolo.nome_ruolo, gilda.nome FROM ruolo LEFT JOIN gilda ON ruolo.gilda = gilda.id_gilda ORDER BY gilda.nome, ruolo.capo DESC, ruolo.stipendio DESC, ruolo.nome_ruolo";
		    $members="SELECT clgpersonaggioruolo.personaggio, clgpersonaggioruolo.id_ruolo, ruolo.nome_ruolo FROM clgpersonaggioruolo JOIN ruolo ON clgpersonaggioruolo.id_ruolo=ruolo.id_ruolo ORDER BY ruolo.gilda DESC, ruolo.stipendio DESC";
		} else if ($_SESSION['permessi']>=CAPOGILDA){
			$people="SELECT nome, cognome FROM personaggio  WHERE permessi > -1 ORDER BY nome";
			$query="SELECT ruolo.id_ruolo, ruolo.nome_ruolo, gilda.nome FROM ruolo JOIN gilda ON ruolo.gilda = gilda.id_gilda WHERE ruolo.gilda IN (SELECT ruolo.gilda FROM clgpersonaggioruolo JOIN ruolo ON clgpersonaggioruolo.id_ruolo = ruolo.id_ruolo WHERE clgpersonaggioruolo.personaggio= '".$_SESSION['login']."' AND ruolo.gilda>-1) ORDER BY gilda.nome, ruolo.capo DESC, ruolo.stipendio DESC, ruolo.nome_ruolo";
		    $members="SELECT clgpersonaggioruolo.personaggio, clgpersonaggioruolo.id_ruolo, ruolo.nome_ruolo FROM clgpersonaggioruolo JOIN ruolo ON clgpersonaggioruolo.id_ruolo=ruolo.id_ruolo WHERE ruolo.gilda IN (SELECT ruolo.gilda FROM clgpersonaggioruolo JOIN ruolo ON clgpersonaggioruolo.id_ruolo = ruolo.id_ruolo WHERE clgpersonaggioruolo.personaggio= '".$_SESSION['login']."' AND ruolo.gilda>-1)  OR ruolo.gilda=-1  ORDER BY ruolo.gilda DESC, ruolo.stipendio DESC";
		} else {
			$people="SELECT nome, cognome FROM personaggio  WHERE permessi > -1 ORDER BY nome";
			$query="SELECT ruolo.id_ruolo, ruolo.nome_ruolo, gilda.nome FROM ruolo JOIN gilda ON ruolo.gilda = gilda.id_gilda WHERE ruolo.gilda IN (SELECT ruolo.gilda FROM clgpersonaggioruolo JOIN ruolo ON clgpersonaggioruolo.id_ruolo = ruolo.id_ruolo WHERE clgpersonaggioruolo.personaggio= '".$_SESSION['login']."' AND ruolo.gilda>-1 AND ruolo.capo=1) ORDER BY gilda.nome, ruolo.capo DESC, ruolo.stipendio DESC, ruolo.nome_ruolo";
			$members="SELECT clgpersonaggioruolo.personaggio, clgpersonaggioruolo.id_ruolo, ruolo.nome_ruolo, ruolo.gilda FROM clgpersonaggioruolo JOIN ruolo ON clgpersonaggioruolo.id_ruolo=ruolo.id_ruolo WHERE ruolo.gilda IN (SELECT ruolo.gilda FROM clgpersonaggioruolo JOIN ruolo ON clgpersonaggioruolo.id_ruolo = ruolo.id_ruolo WHERE clgpersonaggioruolo.personaggio= '".$_SESSION['login']."' AND ruolo.gilda>-1 AND capo=1) OR ruolo.gilda=-1 ORDER BY ruolo.gilda DESC, ruolo.stipendio DESC";
		}
		$result=gdrcd_query($query, 'result');
		$people_result=gdrcd_query($people, 'result');
        $members_result=gdrcd_query($members, 'result');
	    /*Se non c'e' titolo per gestire una gilda*/
		if (gdrcd_query($result, 'num_rows')==0){ 
			echo '<div class="warning">'.$MESSAGE['interface']['adm_guilds']['no_adm'].' '.strtolower($PARAMETERS['names']['guild_name']['sing']).'</div>';
		}  else { ?>
        
		<form action="main.php?page=servizi_adm_gilde" 
	          method="post" >
		  <div class="form_label">
		      <?php echo $MESSAGE['interface']['adm_guilds']['new_member'].' '.strtolower($PARAMETERS['names']['guild_name']['members']); ?>
		  </div>
		  <div class="form_element">
		  <select name="ruolo">
		  <?php 
		   while ($row=gdrcd_query($result, 'fetch')){ ?>
              <option value="<?php echo $row['id_ruolo'].'-'.$row['nome_ruolo']; ?>">
			     <?php echo $row['nome_ruolo']; ?> 
				 (<?php if ($row['nome']!='') {
			              echo $row['nome'];
						} else { echo $MESSAGE['interface']['adm_guilds']['freelance']; } ?>)
		      </option>
		  <?php } 
		  
				gdrcd_query($result, 'free');
		  ?>
		  </select>
          <select name="nome">
		  <?php 
		   while ($row=gdrcd_query($people_result, 'fetch')){ ?>
              <option value="<?php echo $row['nome']; ?>">
			     <?php echo $row['nome'].' '.$row['cognome']; ?> 
		      </option>
		  <?php } 
		  
				gdrcd_query($people_result, 'free');
		  ?>
		  </select>
		  </div>
		  <div class="form_submit">
		  <input type="hidden"
		         name="op"
				 value="hire" />
		  <input type="submit"
		         name="submit"
				 value="<?php echo $MESSAGE['interface']['adm_guilds']['hire']; ?>" />
		  </div>
        </form>
		
		<form action="main.php?page=servizi_adm_gilde" 
	          method="post" >
		  <div class="form_label">
		      <?php echo $MESSAGE['interface']['adm_guilds']['fire_member'].' '.strtolower($PARAMETERS['names']['guild_name']['members']); ?>
		  </div>
		  <div class="form_element">
		  <select name="ruolo">
		  <?php 
		   $echoed_null_row=FALSE;
		   while ($row=gdrcd_query($members_result, 'fetch')){ 
			   if (($echoed_null_row===FALSE) && ($row['gilda']==-1)){
			      echo '<option value="" disabled>-------</option>';
				  $echoed_null_row=TRUE;
			   }
			   ?>
              <option value="<?php echo $row['personaggio']."-".$row['id_ruolo']."-".$row['nome_ruolo']; ?>">
			     <?php echo $row['personaggio']." (".$row['nome_ruolo'].")"; ?> 
		      </option>
		  <?php } 
		  
				gdrcd_query($members_result, 'free');
		  ?>
		  </select>
		  </div>
		  <div class="form_submit">
		  <input type="hidden"
		         name="op"
				 value="fire" />
		  <input type="submit"
		         name="submit"
				 value="<?php echo $MESSAGE['interface']['adm_guilds']['fire']; ?>" />
		  </div>
        </form>
		
		<?php }//else 
		
		$affiliazioni="SELECT ruolo.nome_ruolo, gilda.nome, ruolo.id_ruolo FROM ruolo LEFT JOIN gilda ON gilda.id_gilda = ruolo.gilda WHERE ruolo.id_ruolo IN (SELECT id_ruolo FROM clgpersonaggioruolo WHERE personaggio = '".$_SESSION['login']."' AND scadenza < NOW()) ";
		$affiliazioni_result = gdrcd_query($affiliazioni, 'result');
		
		?>
		<?php 
			 if(gdrcd_query($affiliazioni_result, 'num_rows')>0){
		?>
		<form action="" 
	          method="" >
		  <div class="form_label">
		      <?php echo $MESSAGE['interface']['adm_guilds']['quit'];  ?>
		  </div>
		</form>
		
		<?php  while ($row=gdrcd_query($affiliazioni_result, 'fetch')){ ?>
		
        <form action="main.php?page=servizi_adm_gilde" 
	          method="post" >
		  <div style="float: left; width: 70%">
		       <?php echo $row['nome_ruolo']; if(empty($row['nome'])===FALSE){echo ' ('.$row['nome'].') ';}  ?>
		  </div>
		  <div class="form_submit">
		  <input type="hidden"
		         name="ruolo"
				 value="<?php echo $_SESSION['login']."-".$row['id_ruolo']."-".$row['nome_ruolo']; ?>" />
		  <input type="hidden"
		         name="op"
				 value="fire" />
		  <input type="submit"
		         name="submit"
				 value="<?php echo $MESSAGE['interface']['adm_guilds']['quit']; ?>" />
		  </div>
        </form>
		<?php }//while 
		
		
				gdrcd_query($affiliazioni_result, 'free');
		?>
		<?php } ?>

	</div>
		
	<div class="link_back">
      <a href="main.php?page=servizi_adm_gilde"><?php echo gdrcd_filter('out',$MESSAGE['interface']['adm_guids']['back']); ?></a>
    </div> 
   
	<?php } //if 
	
?>

<?php /*Affiliazione*/
    if(gdrcd_filter('get',$_POST['op'])=='hire'){ 
		/*Controllo il numero di affiliazioni correnti del personaggio*/
		$jobs=gdrcd_query("SELECT COUNT(*) FROM clgpersonaggioruolo WHERE personaggio = '".gdrcd_filter('in',$_POST['nome'])."'");
		
		/*Se il personaggio ha raggiunto il limite*/
		if ($jobs['COUNT(*)']>=$PARAMETERS['settings']['guilds_limit']){
		  echo '<div class="warning">'.gdrcd_filter('out',$_POST['nome'].' '.$MESSAGE['interface']['adm_guilds']['cannot_hire']).'</div>';   
		} else {
          /*Opero l'affiliazione*/
     	  $subject = explode('-',gdrcd_filter('in',$_POST['ruolo']));
		  gdrcd_query("INSERT INTO clgpersonaggioruolo  (personaggio, id_ruolo, scadenza, descrizione) VALUES ('".gdrcd_filter('in',$_POST['nome'])."', ".$subject[0].", NOW(), 'Entra in gilda')");

          /*Confermo l'operazione*/
		  echo '<div class="warning">'.gdrcd_filter('out',$MESSAGE['interface']['adm_guilds']['ok_hire']).'</div>';   
		  /*Registro l'operazione*/
		  gdrcd_query("INSERT INTO log (nome_interessato, autore, data_evento, codice_evento ,descrizione_evento) VALUES ('".gdrcd_filter('in',$_POST['nome'])."', '".$_SESSION['login']."', NOW(), ".NUOVOLAVORO.", '".gdrcd_filter('out',$subject[1])."')");

		  /*Avviso l'utente*/
		  if ($_SESSION['login']!=$_POST['nome']){
		     gdrcd_query("INSERT INTO messaggi (mittente, destinatario, spedito, testo) VALUES ('".$_SESSION['login']."', '".gdrcd_filter('in',$_POST['nome'])."', NOW(), '".gdrcd_filter('in',$MESSAGE['interface']['adm-guilds']['message_body']['hire'].' '.$subject[1])."')");
		  }

	    }//else ?>

	 <div class="panels_link">
       <a href="main.php?page=servizi_adm_gilde"><?php echo gdrcd_filter('out',$MESSAGE['interface']['adm_guilds']['back']); ?></a>
     </div>
	
<?php } ?>

<?php /*Espulsione*/
    if($_POST['op']=='fire'){ 
		$subject = explode('-',gdrcd_filter('in',$_POST['ruolo']));
		gdrcd_query("DELETE FROM clgpersonaggioruolo WHERE personaggio='".$subject[0]."' AND id_ruolo = ".gdrcd_filter('num',$subject[1])." LIMIT 1");

        /*Confermo l'operazione*/
		echo '<div class="warning">'.gdrcd_filter('out',$MESSAGE['interface']['adm_guilds']['ok_fire']).'</div>';   
		/*Registro l'operazione*/
		gdrcd_query("INSERT INTO log (nome_interessato, autore, data_evento, codice_evento ,descrizione_evento) VALUES ('".$subject[0]."', '".$_SESSION['login']."', NOW(), ".DIMISSIONE.", '".gdrcd_filter('out',$subject[2])."')");

		/*Avviso l'utente*/
		if ($_SESSION['login']!=$subject[0]){
		   gdrcd_query("INSERT INTO messaggi (mittente, destinatario, spedito, testo) VALUES ('".$_SESSION['login']."', '".$subject[0]."', NOW(), '".gdrcd_filter('in',$MESSAGE['interface']['adm-guilds']['message_body']['fire'].' '.$subject[2])."')");
		}

?>

	 <div class="panels_link">
       <a href="main.php?page=servizi_adm_gilde"><?php echo gdrcd_filter('out',$MESSAGE['interface']['adm_guilds']['back']); ?></a>
     </div>
	
<?php } ?>



</div>


</div><!-- Box principale -->

