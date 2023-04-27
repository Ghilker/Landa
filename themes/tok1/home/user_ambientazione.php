<div class="user_ambientazione">
	<!--<div class="page_title"><h2><?php echo gdrcd_filter('out', $MESSAGE['interface']['plot']['page_name']); ?></h2></div>-->
	<div style="margin-top: 15px; margin-bottom: 20px"><img src="/imgs/ambientazione.png"></div>

	<div class="page_body">
		<?php /*HELP: */

		$query1 = "SELECT capitolo, titolo FROM ambientazione ORDER BY capitolo";
		$result1 = gdrcd_query($query1, 'result');

		foreach ($result1 as $result1) {
			$value = $result1['capitolo'];
			$name = $result1['titolo'];
			echo "<button id = button$value> $name </button>";
		}

		$query2 = "SELECT capitolo, titolo FROM ambientazione ORDER BY capitolo";
		$result2 = gdrcd_query($query2, 'result');

		$query = "SELECT capitolo, titolo, testo FROM ambientazione ORDER BY capitolo";
		$result = gdrcd_query($query, 'result'); ?>

		<script>
			<?php
			foreach ($result2 as $result2) {
				echo "document.getElementById('button" . $result2['capitolo'] . "').addEventListener('click', function() {";
				echo "  document.getElementById('id" . $result2['capitolo'] . "').scrollIntoView({behavior: 'smooth'});";
				echo "});";
			}
			;
			?>
		</script>

		<div class="panels_box">
			<div class="elenco_record_gioco">
				<table>
					<?php while ($row = gdrcd_query($result, 'fetch')) {
					$value = $row['capitolo'] ?>
						<tr>
							<td class="casella_titolo">
								<?php echo "<div id = id$value></div>" ?>
								<div class="elementi_elenco">
									<?php echo gdrcd_filter('out', $row['capitolo']); ?>
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
						<tr>
							<td colspan="2" class="torna_all_indice">
								<button onclick="location.reload()">Torna Su</button>
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