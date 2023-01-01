<div class="servizi_abilita">
	<!--<div class="page_title"><h2><?php echo gdrcd_filter('out', $MESSAGE['interface']['basic_rules']['page_name']); ?></h2></div>-->
	<div style="margin-top: 15px; margin-bottom: 20px"><img src="/imgs/regolamento.png"></div>

	<div class="page_body">
		<?php /*HELP: */

		$query1 = "SELECT articolo, titolo FROM regolamento_base ORDER BY articolo";
		$result1 = gdrcd_query($query1, 'result');

		foreach($result1 as $result1){
			$value = $result1['articolo'];
			$name = $result1['titolo'];
			echo "<button id = button$value> $name </button>";
		}


		$query = "SELECT articolo, titolo, testo FROM regolamento_base ORDER BY articolo";
		$result = gdrcd_query($query, 'result');
		?>

		<div class="panels_box">
			<div class="elenco_record_gioco">
				<table>
					<?php while ($row = gdrcd_query($result, 'fetch')) { ?>
						<tr>
							<td class="casella_titolo">
								<div class="elementi_elenco">
									<?php echo gdrcd_filter('out', $row['articolo']); ?>)
								</div>
							</td>
							<td class="casella_titolo">
								<div class="elementi_elenco">
									<?php echo gdrcd_filter('out', $row['titolo']); ?>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="casella_elemento">
								<div class="elementi_elenco">
									<?php echo gdrcd_bbcoder(gdrcd_filter('out', $row['testo'])); ?>
								</div>
							</td>
						</tr>

						<!-- TORNA ALL'INDICE-->
						<tr>
							<td colspan="2" class="torna_all_indice">
								<?php echo '<a href="https://provalice.altervista.org/main.php?page=user_regolamento_base#:~:text=1)-,Istruzioni%20per%20l%27uso,-INDICE%3A%0A%0A1">' . " Torna all'inizio </a><br>" ?>
							</td>
						</tr>
						<!--FINE-->

						<?php } //while 
						
						gdrcd_query($result, 'free');
						?>
				</table>

			</div><!--elenco_record_gioco-->
		</div><!--panels_box-->

	</div>
</div><!-- Box principale -->