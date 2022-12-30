<div class="pagina_uffici">

	<div class="page_title">
		<div style="margin-top: 15px; margin-bottom: 20px"><img src="/imgs/servizi.png"></div>
	</div>

	<div class="page_body">

		<?php /* Generazione automatica del menu del gioco */
		foreach ($PARAMETERS['office'] as $link_menu) {

			if (
				(empty($link_menu['url']) === FALSE) &&
				(empty($link_menu['text']) === FALSE) &&
				(isset($link_menu['access_level']) === TRUE) &&
				($link_menu['access_level'] <= $_SESSION['permessi'])
			) {
				echo '<div class="link_menu_gestione">';
				if (empty($link_menu['image_file']) === FALSE) {
					echo '<img src="themes/' . $PARAMETERS['themes']['current_theme'] . '/imgs' . $link_menu['image_file'] . '" />';
				}
				echo '<a href="' . $link_menu['url'] . '">' . gdrcd_filter('out', $link_menu['text']) . '</a></div>';
			} //if
		
		} //foreach
		?>

	</div><!-- page_body -->
</div><!-- Pagina -->

<?php /*HELP: Il menu viene generato automaticamente attingendo dalle informazioni contenute in config.inc.php. La versione supporta link testuali ed immagini e può essere modificata direttamente nel file config.ing.php, impostando url di destinazione, testo e selezionado le immagini. Se il link è un'immagine il testo viene interpretato automaticamente come testo alternativo all'immagine. Per realizzare un menu di altro tipo suggeriamo di commentare o cancellare il contenuto di questa pagina e sostituirlo con il codice del nuovo menu. */?>