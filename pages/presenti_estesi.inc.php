<!-- Box presenti-->
<div class="pagina_presenti_estesa">

	<div class="page_title">
		<!--<h2><?php echo gdrcd_filter('out', $MESSAGE['interface']['logged_users']['page_title']); ?></h2>-->
		<div style="margin-top: 15px; margin-bottom: 20px"><img src="/imgs/connessi.png"></div>
	</div>

	<!DOCTYPE html>
	<html>

	<head>
		<title>Toggle Example</title>
	</head>

	<body>
		<form id="form">
			<input type="hidden" name="staff" value="true">
			<button type="submit">Toggle</button>
		</form>

		<?php
		$staff = false;

		if (isset($_GET['staff'])) {
			$staff = !$staff;
		}

		$_SESSION['staff'] = $staff;

		if ($staff) { ?>
			<p>The staff variable is true</p>
			<?php } else { ?>
			<p>The staff variable is false</p>
			<?php } ?>

		<script>
			var form = document.getElementById('form');

			form.addEventListener('submit', function (event) {
				event.preventDefault();
	  
	  <?php $staff = !$staff; ?>
	  
	  <?php $_SESSION['staff'] = $staff; ?>
	  
	  <?php if ($staff) {
	  echo ("Test");
	  } ?>
	});
		</script>
	</body>

	</html>


	<!--CODICE ORIGINALE-->
	<div class="presenti_estesi">
		<?php


		/* * Abilitazione tooltip
		 * @author Blancks
		 */
		if ($PARAMETERS['mode']['user_online_state'] == 'ON')
			echo '<div id="descriptionLoc"></div>';


		//Carico la lista presenti.
		/* * Fix della query per includere l'uso dell'orario di uscita per capire istantaneamente quando il pg non è più connesso
		 * @author Blancks
		 */
		$query = "SELECT personaggio.nome, personaggio.cognome, personaggio.permessi, personaggio.sesso, personaggio.id_razza, razza.sing_m, razza.sing_f, razza.icon, personaggio.disponibile, personaggio.online_status, personaggio.is_invisible, personaggio.ultima_mappa, personaggio.ultimo_luogo, personaggio.posizione, personaggio.ora_entrata, personaggio.ora_uscita, personaggio.ultimo_refresh, mappa.stanza_apparente, mappa.nome as luogo, mappa_click.nome as mappa FROM personaggio LEFT JOIN mappa ON personaggio.ultimo_luogo = mappa.id LEFT JOIN mappa_click ON personaggio.ultima_mappa = mappa_click.id_click LEFT JOIN razza ON personaggio.id_razza = razza.id_razza WHERE personaggio.ora_entrata > personaggio.ora_uscita AND DATE_ADD(personaggio.ultimo_refresh, INTERVAL 4 MINUTE) > NOW() ORDER BY personaggio.is_invisible, personaggio.ultima_mappa, personaggio.ultimo_luogo, personaggio.nome";
		$result = gdrcd_query($query, 'result');

		echo '<ul class="elenco_presenti">';
		$ultimo_luogo_corrente = '';
		$mappa_corrente = '';


		$mostra_solo_staff = false;
		if (isset($_POST['sort_by_staff_form'])) {
			echo ("Staff");
			$mostra_solo_staff = !$mostra_solo_staff;
		}

		echo '<table style="text-align: center; vertical-align: middle; margin-left: auto; margin-right: auto;"><tbody>';
		while ($record = gdrcd_query($result, 'fetch')) {


			if ($staff && $record['permessi'] < 4) {
				continue;
			}

			echo '<tr><th colspan="8" style="min-width: 597px; margin-left:auto; margin-right:auto;">';
			//Stampo il nome del luogo	
			if ($record['is_invisible'] == 1) {
				$luogo_corrente = $MESSAGE['status_pg']['invisible'][1];

			} else {
				if ($record['mappa'] != $mappa_corrente) {
					$mappa_corrente = $record['mappa'];
					echo '<li class="mappa">' . gdrcd_filter('out', $mappa_corrente) . '</li>';
				} //if
		
				if (empty($record['stanza_apparente'])) {
					$luogo_corrente = $record['luogo'];

				} else {
					$luogo_corrente = $record['stanza_apparente'];
				} //else
		
			}


			//Stampo il nome del luogo solo per il primo PG che vi e' posizionato
			if (empty($luogo_corrente) === TRUE) {
				#echo 'ok';
				/*if ($record['mappa']>=0){
				$luogo_corrente = $PARAMETERS['names']['maps_location'];
				} else {
				$luogo_corrente = $PARAMETERS['names']['base_location'];
				}//else*/
				if ($ultimo_luogo_corrente != $luogo_corrente) {
					$ultimo_luogo_corrente = $luogo_corrente;
					echo '<li class="luogo">' . gdrcd_filter('out', $luogo_corrente) . '</li>';
				} //if
			} else if ($ultimo_luogo_corrente != $luogo_corrente) {
				$ultimo_luogo_corrente = $luogo_corrente;
				if ($record['is_invisible'] == 0) {

					if (($PARAMETERS['mode']['mapwise_links'] == 'OFF')) { #||($record['ultima_mappa']==$_SESSION['mappa'])
		
						echo '<li class="luogo"><a href="main.php?dir=' . $record['ultimo_luogo'] . '&map_id=' . $record['ultima_mappa'] . '">' . gdrcd_filter('out', $luogo_corrente) . '</a></li>';
					} else {
						echo '<li class="luogo">' . gdrcd_filter('out', $luogo_corrente) . '</li>';
					}
				} else {
					echo '<li class="luogo">' . gdrcd_filter('out', $luogo_corrente) . '</li>';
				} //else
			} //if
		
			echo '</th></tr>';

			/* * Parametro di personalizzazione di uno stato online via tooltip
			 * @author Blancks
			 */
			$online_state = '';

			if ($PARAMETERS['mode']['user_online_state'] == 'ON' && !empty($record['online_status']) && $record['online_status'] != NULL) {
				$record['online_status'] = trim(nl2br(gdrcd_filter('in', $record['online_status'])));
				$record['online_status'] = strtr($record['online_status'], array("\n\r" => '', "\n" => '', "\r" => '', '"' => '&quot;'));

				$online_state = 'onmouseover="show_desc(event, \'' . $record['online_status'] . '\');" onmouseout="hide_desc();""';
			}

			//Stampo il PG <<<<< COMMENTO INUTILE!
		
			echo '<tr><td style="padding-left:15px; padding-right:15px; background-color: rgba(99, 109, 135, 0.15);">';

			//1 Icona stato di disponibilità. E' sensibile se la riga che sto stampando corrisponde all'utente loggato.
			$change_disp = ($record['disponibile'] + 1) % 3;
			echo '<img class="presenti_ico" src="imgs/icons/disponibile' . $record['disponibile'] . '.png" alt="' . gdrcd_filter('out', $MESSAGE['status_pg']['availability'][$record['disponibile']]) . '" title="' . gdrcd_filter('out', $MESSAGE['status_pg']['availability'][$record['disponibile']]) . '" />';
			echo '</td><td style="padding-left:15px; padding-right:15px; background-color: rgba(99, 109, 135, 0.15);">';

			// 2 Icona della razza pg
			if ($record['icon'] == '') {
				$record['icon'] = 'standard_razza.png';
			}
			echo '<img class="presenti_ico" src="themes/' . $PARAMETERS['themes']['current_theme'] . '/imgs/races2/' . $record['icon'] . '" alt="' . gdrcd_filter('out', $record['sing_' . $record['sesso']]) . '" title="' . gdrcd_filter('out', $record['sing_' . $record['sesso']]) . '" />';
			echo '</td><td style="padding-left:5px; padding-right:5px; background-color: rgba(99, 109, 135, 0.15);">';

			// 3 
			// mouseover status
			// Nome del personaggio
			// Livello di accesso del PG (utente, master, admin, gestore)
			echo '<li class="presente"' . $online_state . '>';
			switch ($record['permessi']) {
				case USER:
					$alt_permessi = '';
					break;
				case CAPORAZZA:
					$alt_permessi = $PARAMETERS['names']['race']['lead'];
					break;
				case GUIDA:
					$alt_permessi = $PARAMETERS['names']['guida']['sing'];
					break;
				case CAPOGILDA:
					$alt_permessi = $PARAMETERS['names']['guild_name']['lead'];
					break;
				case MASTER:
					$alt_permessi = $PARAMETERS['names']['master']['sing'];
					break;
				case MODERATORE:
					$alt_permessi = $PARAMETERS['names']['moderator']['sing'];
					break;
				case ADMIN:
					$alt_permessi = $PARAMETERS['names']['admin']['sing'];
					break;
				case GESTORE:
					$alt_permessi = $PARAMETERS['names']['administrator']['sing'];
					break;
			} //else
		
			echo '<img class="presenti_ico" src="imgs/icons/permessi' . $record['permessi'] . '.png" alt="' . gdrcd_filter('out', $alt_permessi) . '" title="' . gdrcd_filter('out', $alt_permessi) . '" />';
			// Nome pg e link alla sua scheda
			echo ' <a href="main.php?page=scheda&pg=' . $record['nome'] . '" class="link_sheet gender_' . $record['sesso'] . '">' . gdrcd_filter('out', $record['nome']);
			if (empty($record['cognome']) === FALSE) {
				echo ' ' . gdrcd_filter('out', $record['cognome']);
			}
			echo '</a> ';
			echo '</li>';
			echo '</td><td style="padding-left:15px; padding-right:15px; background-color: rgba(99, 109, 135, 0.15);">';

			// 4 TeOrIa GeNdEr111!!!unouno!Noncielodicono!
			//Icona del genere del pg
			echo '<img class="presenti_ico" src="imgs/icons/testamini' . $record['sesso'] . '2.png" alt="' . gdrcd_filter('out', $MESSAGE['status_pg']['gender'][$record['sesso']]) . '" title="' . gdrcd_filter('out', $MESSAGE['status_pg']['gender'][$record['sesso']]) . '" />';

			// 5 TODO 
			$lavoro = "L";
			$gilda = "G";
			echo '<td style="padding-left:15px; padding-right:15px; background-color: rgba(99, 109, 135, 0.15);">' . $lavoro . '</td>'; /* Placeholder per icona del Lavoro */

			// 6 TODO 
			echo '<td style="padding-left:15px; padding-right:15px; background-color: rgba(99, 109, 135, 0.15);">' . $gilda . '</td>'; /* Placeholder per icona della Gilda */

			// 7 Missiva
			//Iconcina del messaggio cliccabile
			?>
			<td style="padding-left:15px; padding-right:15px; background-color: rgba(99, 109, 135, 0.15);"><a
					href="main.php?page=messages_center&newmessage=yes&reply_dest=('messaggi', 'Messaggi', 'popup.php?page=messages_center&newmessage=yes&reply_dest=<?= gdrcd_filter('url', $record['nome']) ?>">
					<img src="imgs/icons/mail_write.png" height="15px" " title=" Invia una missiva"></a></td>
			<?php

			// 8 Entrata, uscita PG
			//Controllo da quanto il pg e' loggato
			echo '<td style="padding-left:15px; padding-right:15px; background-color: rgba(99, 109, 135, 0.15);">';
			$activity = gdrcd_check_time($record['ora_entrata']);
			//Se e' loggato da meno di 2 minuti
			if ($activity <= 2) {
				//Lo segnalo come appena entrato
				echo '<img class="presenti_ico" src="imgs/icons/enter.png" alt="' . gdrcd_filter('out', $MESSAGE['status_pg']['enter']) . '" title="' . gdrcd_filter('out', $MESSAGE['status_pg']['enter']) . '" />';
			} else {
				//Altrimenti, se si e' sloggato da piu' di 2 minuti lo segnalo come uscito
				$activity = gdrcd_check_time($record['ultimo_refresh']);
				if ($activity > 3) {
					echo '<img class="presenti_ico" src="imgs/icons/exit.png" alt="' . gdrcd_filter('out', $MESSAGE['status_pg']['exit']) . '" title="' . gdrcd_filter('out', $MESSAGE['status_pg']['exit']) . '" />';
				} else {
					//Altrimenti e' semplicemente loggato
					echo '<img class="presenti_ico" src="imgs/icons/blank.png" alt="' . gdrcd_filter('out', $MESSAGE['status_pg']['logged']) . '" title="' . gdrcd_filter('out', $MESSAGE['status_pg']['logged']) . '" />';
				} //else
			} //else
			echo '</td></tr>';
			//Nome pg e link alla sua scheda (con scritta cliccabile)
			//echo '<a href="main.php?page=messages_center&newmessage=yes&reply_dest='.$record['nome'].'" class="link_sheet">MP</a> ';   
		} //while
		
		gdrcd_query($result, 'free');

		echo '</tbody></table></ul>';
		?>
	</div>

</div>
</div>

<!-- Chiudura finestra del gioco -->