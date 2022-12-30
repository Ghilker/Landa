<?php
/**
 * Begin patch by eLDiabolo ed Eriannen
 *	01/09/2012
 *   	
 * Effettuato modifiche per adattamento a gdrcd 5.2 by Eriannen
 *   20/08/2013
 * modificato div class per la pagina per renderla visibile
 * e aggiunto title page con messaggio vocabolario
 **/
?> <div class="page_title" style="margin-top: 6px">
	<img src="/imgs/news.png" alt="news" style="margin-left: 18px">
</div>
<div class="pagina_news_info">



	<?php /*HELP: */
	/**
	 * End patch by eLDiabolo ed Eriannen
	 **/


	$query = "SELECT data, titolo, testo FROM news ORDER BY data";
	$result = gdrcd_query($query, 'result'); ?>
	<div class="panels_box">
		<div class="news_box">
			<?php while ($row = gdrcd_query($result, 'fetch')) { ?>

				<div class="panels_box">
					<?php
					/*
					*	Patch by eLDiabolo ed Eriannen
					* 01/09/2012
					* se non si vuol utilizzare nessuna icona accanto ad ogni titolo di news per questo box
					* sostituire la riga sottostante
					<img src="../imgs/icons/news2.gif">
					con la la seguente:
					<!--img src="../imgs/icons/news2.gif"-->
					e vice versa per renderla nuovamente visibile una volta creata l'icona e posizionata secondo istruzioni.
					***/
					?>
					<div class="news_titolo"><img src="imgs/icons/newsicon.png" height="15px" width="15px">
						<?php echo gdrcd_bbcoder(gdrcd_filter('out', $row['titolo'])); ?>
					</div>
					<?php echo gdrcd_bbcoder(gdrcd_filter('out', $row['testo'])); ?>
				</div>
				<?php } //while ?>
		</div><!--elenco_record_gioco-->
	</div><!--panels_box-->

</div>