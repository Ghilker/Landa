<div class="pagina_iscrizione">
   <div class="page_title">
      <h2>
         <?php echo gdrcd_filter('out', $MESSAGE['register']['page_name']); ?>
      </h2>
   </div>
   <div class="page_body">

      <?php /*** Fase 0 ****/
      if (isset($_POST['fase']) === FALSE) { ?>

         <div class="panels_box">
            <!-- condizioni d'uso -->
            <div class="disclaimer_iscrizione">
               <?php echo gdrcd_filter('out', $MESSAGE['register']['disclaimer']); ?>
            </div>
            <div class="disclaimer_iscrizione">
               <?php echo gdrcd_filter('out', $MESSAGE['register']['rules_read']); ?>
            </div>
            <div class="cosi">
               <!-- Accetto le condizioni -->
               <div class="form_gioco">
                  <form action="<?php echo $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['QUERY_STRING']; ?>" method="post">
                     <div class="form_submit">
                        <input type="hidden" name="fase" value="1" />
                        <input type="submit"
                           value="<?php echo gdrcd_filter('out', $MESSAGE['register']['forms']['accept']); ?>"
                           style="background-image: url('https://talesofkangei.altervista.org/themes/tok1/imgs/accettoedichiaro.png'); background-size: 239px 20px; height: 22px; width: 241px;" />
                     </div>
                  </form>
               </div>
            </div>
            <div class="cosi2">
               <!-- Non accetto le condizioni -->
               <div class="form_gioco">
                  <form action="index.php" method="post">
                     <div class="form_submit">
                        <input type="submit"
                           value="<?php echo gdrcd_filter('out', $MESSAGE['register']['forms']['refuse']); ?>"
                           style="background-image: url('https://talesofkangei.altervista.org/themes/tok1/imgs/rifiuto.png'); background-size: 71px 20px; height: 22px; width: 73px;" />
                     </div>
                  </form>
               </div>
            </div>
         </div>

      <?php } ?>



      <?php /*** Fase 1 ****/
      if (gdrcd_filter('get', $_POST['fase']) == 1) { ?>

         <div class="panels_box">
            <div class="form_gioco">
               <form action="<?php echo $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['QUERY_STRING']; ?>" method="post">
                  <!-- EMail -->
                  <div class="form_label">
                     <?php echo gdrcd_filter('out', $MESSAGE['register']['fields']['email']); ?>
                  </div>
                  <div class="form_field">
                     <input name="email" value="<?php echo gdrcd_filter('email', $_POST['email']); ?>" />
                  </div>
                  <div class="form_info">
                     <?php echo gdrcd_filter('out', $MESSAGE['register']['fields']['email_info']); ?>
                  </div>
                  <!-- Nome PG -->
                  <div class="form_label">
                     <?php echo gdrcd_filter('out', $MESSAGE['register']['fields']['name']); ?>
                  </div>
                  <div class="form_field">
                     <input name="nome" value="<?php echo gdrcd_filter('out', $_POST['nome']); ?>" />
                  </div>
                  <div class="form_info">
                     <?php echo gdrcd_filter('out', $MESSAGE['register']['fields']['name_info']); ?>
                  </div>
                  <!-- Cognome PG -->
                  <div class="form_label">
                     <?php echo gdrcd_filter('out', $MESSAGE['register']['fields']['lastname']); ?>
                  </div>
                  <div class="form_field">
                     <input name="cognome" value="<?php echo gdrcd_filter('out', $_POST['cognome']); ?>" />
                  </div>
                  <div class="form_info">
                     <?php echo gdrcd_filter('out', $MESSAGE['register']['fields']['name_info']); ?>
                  </div>
                  <!-- Genere -->
                  <div class="form_label">
                     <?php echo gdrcd_filter('out', $MESSAGE['register']['fields']['gender']); ?>
                  </div>
                  <div class="form_field">
                     <select name="genere">
                        <option value="m" <?php if (gdrcd_filter('get', $_POST['genere']) == 'm') {
                           echo 'SELECTED';
                        } ?>>
                           <?php echo gdrcd_filter('out', $MESSAGE['register']['fields']['gender_m']); ?>
                        </option>
                        <option value="f" <?php if (gdrcd_filter('get', $_POST['genere']) == 'f') {
                           echo 'SELECTED';
                        } ?>>
                           <?php echo gdrcd_filter('out', $MESSAGE['register']['fields']['gender_f']); ?>
                        </option>
                     </select>
                  </div>
                  <!-- Razza -->
                  <div class="form_label">
                     <?php echo gdrcd_filter('out', $PARAMETERS['names']['race']['sing'] . ' ' . $MESSAGE['register']['fields']['race']); ?>
                  </div>
                  <?php $result = gdrcd_query("SELECT id_razza, nome_razza FROM razza WHERE iscrizione=1 ORDER BY nome_razza", 'result'); ?>
                  <div class="form_field">
                     <select name="razza">
                        <?php while ($row = gdrcd_query($result, 'fetch')) { ?>
                           <option value="<?php echo $row['id_razza']; ?>" <?php if (gdrcd_filter('get', $_POST['razza']) == $row['id_razza']) {
                                 echo 'SELECTED';
                              } ?>>
                              <?php echo gdrcd_filter('out', $row['nome_razza']); ?>
                           </option>
                        <?php } ?>
                     </select>
                  </div>
                  <?php if ($PARAMETERS['mode']['racialinfo'] == 'ON') { ?>
                     <div class="form_info">
                        <a href="ambientazione.php?page=user_razze" target="_new">
                           <?php echo gdrcd_filter('out', $MESSAGE['register']['fields']['race_info']); ?>
                        </a>
                     </div>
                  <?php } ?>
                  <div class="tutticosi">
                     <!-- Invio -->
                     <div class="form_submit">
                        <input type="hidden" name="fase" value="2" />
                        <input type="submit"
                           value="<?php echo gdrcd_filter('out', $MESSAGE['register']['forms']['next']); ?>"
                           style="background-image: url('https://talesofkangei.altervista.org/themes/tok1/imgs/registra.png'); background-size: 71px 20px; height: 22px; width: 73px;" />
                     </div>

                  </div>
               </form>
               <div class="form_gioco">
                  <form action="index.php" method="post">
                     <div class="form_submit">
                        <input type="submit"
                           value="<?php echo gdrcd_filter('out', $MESSAGE['register']['forms']['abort']); ?>"
                           style="background-image: url('https://talesofkangei.altervista.org/themes/tok1/imgs/annulla.png'); background-size: 71px 20px; height: 22px; width: 73px; margin-left: 50px" />
                     </div>
                  </form>
               </div>
            </div>
         </div>

      <?php } ?>



      <?php /**** Fase 2 *****/
      if (gdrcd_filter('get', $_POST['fase']) == 2) {

         $ok = TRUE; ?>

         <div class="panels_box">
            <!-- controllo -->
            <!-- ok/form precompilato -->

            <?php //controlli validità
               $result = gdrcd_query("SELECT email FROM personaggio WHERE email='" . gdrcd_filter('in', $_POST['email']) . "' LIMIT 1", 'result');

               if (gdrcd_query($result, 'num_rows') > 0) {
                  gdrcd_query($result, 'free');
                  $ok = FALSE;
                  echo '<div class="error">' . gdrcd_filter('out', $MESSAGE['register']['error']['email_taken']) . '</div>';
               }

               if ((gdrcd_filter('get', $_POST['email']) == '') || (strpos(gdrcd_filter('get', $_POST['email']), '@') == FALSE) || (strpos(gdrcd_filter('get', $_POST['email']), '.') == FALSE)) {
                  $ok = FALSE;
                  echo '<div class="error">' . gdrcd_filter('out', $MESSAGE['register']['error']['email_needed']) . '</div>';
               }


               $result = gdrcd_query("SELECT nome FROM personaggio WHERE nome='" . gdrcd_capital_letter(gdrcd_filter('get', $_POST['nome'])) . "' LIMIT 1", 'result');

               if (gdrcd_query($result, 'num_rows') > 0) {
                  gdrcd_query($result, 'free');
                  $ok = FALSE;
                  echo '<div class="error">' . gdrcd_filter('out', $MESSAGE['register']['error']['name_taken']) . '</div>';
               }

               if ($ok == FALSE) { ?>
               <div class="form_gioco">
                  <form action="<?php echo $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['QUERY_STRING']; ?>" method="post">
                     <div class="form_submit">
                        <input type="hidden" name="fase" value="1" />
                        <input type="hidden" name="email" value="<?php echo gdrcd_filter('out', $_POST['email']) ?>" />
                        <input type="hidden" name="nome" value="<?php echo gdrcd_filter('out', $_POST['nome']) ?>" />
                        <input type="hidden" name="cognome" value="<?php echo gdrcd_filter('out', $_POST['cognome']) ?>" />
                        <input type="hidden" name="genere" value="<?php echo gdrcd_filter('out', $_POST['genere']) ?>" />
                        <input type="hidden" name="razza" value="<?php echo gdrcd_filter('num', $_POST['razza']) ?>" />
                        <input type="submit"
                           value="<?php echo gdrcd_filter('out', $MESSAGE['register']['forms']['try_again']); ?>" />
                     </div>
                  </form>
               </div>
            <?php } else {
                  if ($_POST['genere'] == 'm') {
                     $r_gen = 'm';
                  } else {
                     $r_gen = 'f';
                  }
                  $razza = gdrcd_query("SELECT sing_" . gdrcd_filter('in', $r_gen) . " AS nome_razza FROM razza WHERE id_razza = " . (0 + gdrcd_filter('num', $_POST['razza'])) . " LIMIT 1"); ?>
               <div class="elenco_gioco">
                  <table>
                     <tr>
                        <td class='casella_titolo'>
                           <div class='titoli_elenco'>
                              <?php echo gdrcd_filter('out', $MESSAGE['register']['summary']) ?>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td class='casella_elemento'>
                           <div class='elementi_elenco'>
                              <?php echo gdrcd_filter('out', $_POST['email']) ?>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td class='casella_elemento'>
                           <div class='elementi_elenco'>
                              <?php echo gdrcd_filter('out', $_POST['nome']) ?>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td class='casella_elemento'>
                           <div class='elementi_elenco'>
                              <?php echo gdrcd_filter('out', $_POST['cognome']) ?>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td class='casella_elemento'>
                           <div class='elementi_elenco'>
                              <?php echo gdrcd_filter('out', $_POST['genere']) ?>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td class='casella_elemento'>
                           <div class='elementi_elenco'>
                              <?php echo gdrcd_filter('out', $razza['nome_razza']) . '&nbsp;' ?>
                           </div>
                        </td>
                     </tr>
                  </table>
               </div>
               <div class="form_gioco">
                  <div class="tutticosi">
                     <form action="<?php echo $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['QUERY_STRING']; ?>" method="post">
                        <div class="form_submit">
                           <input type="hidden" name="fase" value="3" />
                           <input type="hidden" name="email" value="<?php echo gdrcd_filter('out', $_POST['email']) ?>" />
                           <input type="hidden" name="nome" value="<?php echo gdrcd_filter('out', $_POST['nome']) ?>" />
                           <input type="hidden" name="cognome" value="<?php echo gdrcd_filter('out', $_POST['cognome']) ?>" />
                           <input type="hidden" name="genere" value="<?php echo gdrcd_filter('out', $_POST['genere']) ?>" />
                           <input type="hidden" name="razza" value="<?php echo gdrcd_filter('num', $_POST['razza']) ?>" />
                           <input type="submit"
                              value="<?php echo gdrcd_filter('out', $MESSAGE['register']['forms']['ok']); ?>"
                              style="background-image: url('https://talesofkangei.altervista.org/themes/tok1/imgs/conferma.png'); background-size: 77px 22px; height: 24px; width: 79px; margin-left: 50px" />
                        </div>
                     </form>
                     <form action="<?php echo $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['QUERY_STRING']; ?>" method="post">
                        <div class="form_submit">
                           <input type="hidden" name="fase" value="1" />
                           <input type="hidden" name="email" value="<?php echo gdrcd_filter('out', $_POST['email']) ?>" />
                           <input type="hidden" name="nome" value="<?php echo gdrcd_filter('out', $_POST['nome']) ?>" />
                           <input type="hidden" name="cognome" value="<?php echo gdrcd_filter('out', $_POST['cognome']) ?>" />
                           <input type="hidden" name="genere" value="<?php echo gdrcd_filter('out', $_POST['genere']) ?>" />
                           <input type="hidden" name="razza" value="<?php echo gdrcd_filter('num', $_POST['razza']) ?>" />
                           <input type="submit"
                              value="<?php echo gdrcd_filter('out', $MESSAGE['register']['forms']['back']); ?>"
                              style="background-image: url('https://talesofkangei.altervista.org/themes/tok1/imgs/annulla.png'); background-size: 71px 20px; height: 22px; width: 73px; margin-left: 50px" />
                        </div>
                     </form>
                  </div>
               </div>
            <?php } ?>
         </div>

      <?php } ?>



      <?php /**** Fase 3 *****/
      if ($_POST['fase'] == 3) {

         $pass = gdrcd_genera_pass();
         /* * Se deve scattare l'avviso di cambio password fin dall'iscrizione non segno cambiamenti
          * @author Blancks
          */
         $lastpasschange_field = "";
         $lastpasschange_value = "";

         /* * Se NON deve scattare l'avviso di cambio password fin dall'iscrizione aggiorno la data di ultimo cambio ad ora
          * @author Blancks
          */
         if ($PARAMETERS['mode']['alert_password_change'] == 'ON' && $PARAMETERS['settings']['alert_password_change']['alert_from_signup'] == 'OFF') {
            $lastpasschange_field = ", ultimo_cambiopass";
            $lastpasschange_value = ", NOW()";
         }


         gdrcd_query("INSERT INTO personaggio (nome, cognome, pass, data_iscrizione, email, sesso, id_razza, prestavolto, salute, salute_max, soldi, esperienza $lastpasschange_field) VALUES ('" . trim(gdrcd_capital_letter(gdrcd_filter('in', $_POST['nome']))) . "', '" . trim(gdrcd_filter('in', $_POST['cognome'])) . "', '" . gdrcd_encript($pass) . "', NOW(), '" . gdrcd_filter('in', $_POST['email']) . "', '" . gdrcd_filter('in', $_POST['genere']) . "', " . gdrcd_filter('num', $_POST['razza']) . ", '" . trim(gdrcd_filter('in', $_POST['prestavolto'])) . "', " . gdrcd_filter('num', $PARAMETERS['settings']['max_hp']) . ", " . gdrcd_filter('num', $PARAMETERS['settings']['max_hp']) . ", " . gdrcd_filter('num', $PARAMETERS['settings']['first_money']) . ", " . gdrcd_filter('num', $PARAMETERS['settings']['first_px']) . " $lastpasschange_value)");

         if ($PARAMETERS['mode']['emailconfirmation'] == 'ON') {
            echo '<div class="page_title"><h2>' . gdrcd_filter('out', $MESSAGE['register']['welcome']['message']['ok']) . '</h2></div>';
            echo '<div class="panels_box"><div class="welcome_message">' . gdrcd_filter('out', $MESSAGE['register']['welcome']['message'][0]) . ' <b>' . gdrcd_filter('out', $PARAMETERS['info']['site_name']) . '</b> ' . gdrcd_filter('out', $MESSAGE['register']['welcome']['message'][1]) . '</div><div class="welcome_message">&nbsp;</div><div class="username">' . gdrcd_filter('out', $MESSAGE['register']['welcome']['message'][3]) . ' <b>' . gdrcd_filter('get', $_POST['email']) . '</b></div>';

            $text = $MESSAGE['register']['welcome']['message'][0] . ' ' . $PARAMETERS['info']['site_name'] . "\n\n " . $MESSAGE['register']['welcome']['message'][1] . "\n     " . $MESSAGE['register']['welcome']['message'][2] . "\n\n    " . $MESSAGE['register']['welcome']['message']['user'] . ' ' . gdrcd_filter('get', $_POST['nome']) . "\n" . $MESSAGE['register']['welcome']['message']['pass'] . ' ' . $pass . "\n\n    " . $PARAMETERS['info']['webmaster_name'];

            $subject = $PARAMETERS['info']['site_name'] . ' - Registrazione di ' . gdrcd_filter('get', $_POST['nome']) . ' ' . gdrcd_filter('get', $_POST['cognome']);

            mail(gdrcd_filter('get', $_POST['email']), $subject, $text, 'From: ' . gdrcd_filter('out', $PARAMETERS['info']['webmaster_email']));
         } else {

            echo '<div class="page_title"><h2>' . gdrcd_filter('out', $MESSAGE['register']['welcome']['message']['ok']) . '</h2></div>';
            echo '<div class="panels_box"><div class="welcome_message">' . gdrcd_filter('out', $MESSAGE['register']['welcome']['message'][0]) . ' <b>' . gdrcd_filter('out', $PARAMETERS['info']['site_name']) . '</b> ' . gdrcd_filter('out', $MESSAGE['register']['welcome']['message'][1]) . '</div><div class="welcome_message">' . gdrcd_filter('out', $MESSAGE['register']['welcome']['message'][2]) . '</div><div class="username">' . gdrcd_filter('out', $MESSAGE['register']['welcome']['message']['user']) . ' <b>' . gdrcd_filter('get', $_POST['nome']) . '</b></div><div class="username">' . gdrcd_filter('out', $MESSAGE['register']['welcome']['message']['pass']) . ' <b>' . $pass . '</b></div></div>';

         }

         $welcome_message = $MESSAGE['register']['welcome']['message'][4];
         gdrcd_query("INSERT INTO messaggi (mittente, destinatario, spedito, testo) VALUES ('" . gdrcd_filter('out', $PARAMETERS['info']['webmaster_name']) . "', '" . gdrcd_filter('get', $_POST['nome']) . "', NOW(), '" . $welcome_message . "')");

         ?>


         <!-- welcome message -->
         <!-- random pass -->
         <!-- invio mail -->
         <!-- inserimento -->

      </div>

      <!-- Torna alla home -->
      <div class="link_back">
         <a href="index.php">
            <?php echo gdrcd_filter('out', $MESSAGE['register']['welcome']['back'] . ' ' . gdrcd_filter('out', strtolower($PARAMETERS['info']['homepage_name']))); ?>
         </a>
      </div>


   <?php } ?>




   <!-- Chiudura finestra iscizione -->
</div>
</div>