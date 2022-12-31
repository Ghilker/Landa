<div class="user_razze">
	<!--<div class="page_title"><h2><?php echo gdrcd_filter('out', $MESSAGE['interface']['user']['races']['page_name'] . ' ' . strtolower($PARAMETERS['names']['race']['plur'])); ?></h2></div>-->
	<div style="margin-top: 15px; margin-bottom: 20px"><img src="/imgs/elenco_razze.png"></div>

	<div class="page_body">
		<?php /*HELP: */


		$query1 = "SELECT nome_razza, sing_m, sing_f, descrizione, url_site, immagine, icon  FROM razza WHERE visibile = 1 ORDER BY nome_razza";
		$result1 = gdrcd_query($query1, 'result');?>
		<div class="panels_box">
			<div class="elenco_record_gioco">
				<?php 
				foreach($result1 as $row){
					$value = $row['nome_razza'];
					echo "<button> $value </button>";
				}
				$query = "SELECT nome_razza, sing_m, sing_f, descrizione, url_site, immagine, icon  FROM razza WHERE visibile = 1 ORDER BY nome_razza";
				$result = gdrcd_query($query, 'result');?>
				?>
				<table>
					<?php while ($row = gdrcd_query($result, 'fetch')) { ?>
						<tr>
							<td colspan="2" class="casella_titolo">
								<div class="elementi_elenco">
									<img class="razza_icon"
										src="themes/<?php echo $PARAMETERS['themes']['current_theme'] ?>/imgs/races/<?php echo $row['immagine']; ?>" />
									<?php if (empty($row['url_site']) === TRUE) {
									echo $row['nome_razza'] . ' (' . $row['sing_m'] . ', ' . $row['sing_f'] . ')';
								} else {
									echo '<a href="http://' . $row['url_site'] . '">' . gdrcd_filter('out', $row['nome_razza']) . '</a> (' . gdrcd_filter('out', $row['sing_m']) . ', ' . gdrcd_filter('out', $row['sing_f']) . ')';
								} ?>
									<img class="razza_icon"
										src="themes/<?php echo $PARAMETERS['themes']['current_theme'] ?>/imgs/races/<?php echo $row['immagine']; ?>" />
								</div>
							</td>
						</tr>
						<tr>
							<td class="casella_razza_immagine">
								<div class="elementi_elenco">
									<?php if (empty($row['immagine']) === TRUE) {
									echo '&nbsp;';
								} else { ?>
										<!--<img class="razza_immagine" -->
										<!--     src="themes/<?php echo $PARAMETERS['themes']['current_theme'] ?>/imgs/races/<?php echo $row['immagine']; ?>" /> -->

										<?php } ?>
								</div>
							</td>
							<td class="casella_elemento">
								<div class="elementi_elenco">
									<?php echo gdrcd_bbcoder(gdrcd_filter('out', $row['descrizione'])); ?>
								</div>

							</td>
						</tr>
						<?php } //while 
						
						gdrcd_query($result, 'free');
						?>
				</table>
			</div><!--elenco_record_gioco-->
		</div><!--panels_box-->

	</div>
</div><!-- Box principale -->