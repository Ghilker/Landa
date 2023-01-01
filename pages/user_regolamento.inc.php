<div class="servizi_abilita">
	<!--<div class="page_title"><h2><?php echo gdrcd_filter('out', $MESSAGE['interface']['rules']['page_name']); ?></h2></div>-->
	<div style="margin-top: 15px; margin-bottom: 20px"><img src="/imgs/regolamento.png"></div>

	<div class="page_body">
		<!--ELENCO CLICCABILE-->
		<div>
			<p style="font-size:14px;">Indice</p>
			<br>
			1. <a
				href="https://provalice.altervista.org/main.php?page=user_regolamento#:~:text=1)-,Istruzioni%20per%20l%27uso,-INDICE%3A%0A%0A1">
				Istruzioni per l'uso </a><br>
			2. <a
				href="https://provalice.altervista.org/main.php?page=user_regolamento#:~:text=2)-,Regolamento,-INDICE%3A%0A%0A1">
				Regolamento </a><br>
			3. <a
				href="https://provalice.altervista.org/main.php?page=user_regolamento#:~:text=3)-,Skills%20speciali,-SKILLS%20SPECIALI%0A%0ALe">
				Skills speciali </a><br>
			4. <a
				href="https://provalice.altervista.org/main.php?page=user_regolamento#:~:text=4)-,Lavori%20e%20Mestieri,-LAVORI%20E%20MESTIERI">
				Lavori e Mestieri </a><br>
			5. <a
				href="https://provalice.altervista.org/main.php?page=user_regolamento#:~:text=5)-,Gli%20Allineamenti,-GLI%20ALLINEAMENTI%0AL%E2%80%99allineamento">
				Gli Allineamenti </a><br>
			6. <a
				href="https://provalice.altervista.org/main.php?page=user_regolamento#:~:text=6)-,Informazioni%20utili,-PARAMETRI%20VARI%20E">
				Informazioni utili </a><br>
		</div>
		<?php /*HELP: */


		$query = "SELECT articolo, titolo, testo FROM regolamento ORDER BY articolo";
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
								<?php echo '<a href="https://provalice.altervista.org/main.php?page=user_regolamento#:~:text=1)-,Istruzioni%20per%20l%27uso,-INDICE%3A%0A%0A1">' . " Torna all'inizio </a><br>" ?>
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