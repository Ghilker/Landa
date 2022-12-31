<div class="pagina_info_location">
    <?php /* HELP: Il box delle informazioni carica l'immagine del luogo corrente, lo stato e la descrizione. Genera, inoltre, il meteo */


    $result = gdrcd_query("SELECT mappa.nome, mappa.descrizione, mappa.descrizione_dettagliata, mappa.stato, mappa.immagine, mappa.stanza_apparente, mappa.scadenza, mappa_click.meteo FROM  mappa_click LEFT JOIN mappa ON mappa_click.id_click = mappa.id_mappa WHERE id = " . $_SESSION['luogo'] . "", 'result');
    $record_exists = gdrcd_query($result, 'num_rows');
    $record = gdrcd_query($result, 'fetch');

    /* * Fix: quando non si � in una mappa visualizza il nome della chat
     * Quando si � in una mappa si visualizza il nome della mappa
     * @author Blancks
     */
    if (empty($record['nome'])) {
        $nome_mappa = gdrcd_query("SELECT nome FROM mappa_click WHERE id_click = " . (int) $_SESSION['mappa']);
        $nome_luogo = $nome_mappa['nome'];

    } else {
        $nome_luogo = $record['nome'];
    }
    $_SESSION['descrizione_luogo'] = $record;

    ?>
    <div class="page_title_info">
        <div class="page_title_info_testo">
            <h2>
                <marquee onmouseover="this.stop()" onmouseout="this.start()" direction="left" scrollamount="3"
                    class="stato_luogo">&nbsp;
                    <?php
                    echo '<a href="#" onclick="window.open(\'../pages/pagina_descrizione_luogo.php\', \'Descrizione Luogo\', \'height=500,width=500\');" style="color: #031127;">' . gdrcd_filter('out', $nome_luogo) . '</a>';
                    ?>
                </marquee>
            </h2>
        </div>
    </div>

    <div class="page_body">


        <?php

        if ($record_exists > 0 || $_SESSION['luogo'] == -1) {

            gdrcd_query($result, 'free');

            ?>


            <!--Nome luogo-->
            <?php
            if (empty($record['nome']) === FALSE) {
                $nome_luogo = $record['nome'];
            } elseif ($_SESSION['mappa'] >= 0) {
                $nome_luogo = $PARAMETERS['names']['maps_location'];
            } else {
                $nome_luogo = $PARAMETERS['names']['base_location'];
            }
            ?>

            <!--Immagine/descrizione -->
            <div class="info_image">
                <?php
                if (empty($record['immagine']) === FALSE) {
                    $immagine_luogo = $record['immagine'];
                } else {
                    $immagine_luogo = 'standard_luogo.png';
                }
                ?>
                <img src="themes/<?php echo gdrcd_filter('out', $PARAMETERS['themes']['current_theme']); ?>/imgs/locations/<?php echo $immagine_luogo ?>"
                    class="immagine_luogo" alt="<?php echo gdrcd_filter('out', $record['descrizione']); ?>"
                    title="<?php echo gdrcd_filter('out', $record['descrizione']); ?>">
            </div>
            <?php if ((isset($record['stato']) === TRUE) || (isset($record['descrizione']) === TRUE)) {

            echo '<div class="box_stato_luogo"><div class="box_stato_luogo_marquee"><marquee onmouseover="this.stop()" onmouseout="this.start()" direction="left" scrollamount="3" class="stato_luogo">&nbsp;' . $MESSAGE['interface']['maps']['Status'] . ': ' . gdrcd_filter('out', $record['stato']) . ' -  ' . gdrcd_filter('out', $record['descrizione']) . '</marquee></div></div>';
        } else {
            echo '<div class="box_stato_luogo">&nbsp;</div>';
        } ?>


            <?php
            if ($PARAMETERS['mode']['auto_meteo'] == 'ON') {

                /* Meteo */
                $ore = date("H");
                $minuti = date("M");

                $mese = date("m");
                $giorno = date("j");
                $caso = ((floor($giorno / 3)) % 2) + 1;

                /*	* Bug FIX: corretta l'assegnazione della $minima
                 * @author Blancks
                 */
                switch ($mese) {
                    case 1:
                        $minima = $PARAMETERS['date']['base_temperature'] + 0;
                        break;
                    case 2:
                        $minima = $PARAMETERS['date']['base_temperature'] + 4;
                        break;
                    case 3:
                        $minima = $PARAMETERS['date']['base_temperature'] + 8;
                        break;
                    case 4:
                        $minima = $PARAMETERS['date']['base_temperature'] + 14;
                        break;
                    case 5:
                        $minima = $PARAMETERS['date']['base_temperature'] + 20;
                        break;
                    case 6:
                        $minima = $PARAMETERS['date']['base_temperature'] + 28;
                        break;
                    case 7:
                        $minima = $PARAMETERS['date']['base_temperature'] + 30;
                        break;
                    case 8:
                        $minima = $PARAMETERS['date']['base_temperature'] + 28;
                        break;
                    case 9:
                        $minima = $PARAMETERS['date']['base_temperature'] + 20;
                        break;
                    case 10:
                        $minima = $PARAMETERS['date']['base_temperature'] + 14;
                        break;
                    case 11:
                        $minima = $PARAMETERS['date']['base_temperature'] + 8;
                        break;
                    case 12:
                        $minima = $PARAMETERS['date']['base_temperature'] + 0;
                        break;
                }

                /*	* Fine fix */

                if ($ore < 14) {
                    $gradi = $minima + (floor($ore / 3) * $caso);
                } else {
                    $gradi = $minima + (4 * $caso) - ((floor($ore / 3) * $caso)) + (3 * $caso);
                }

                $caso = ($giorno + ($ore / 4)) % 12;
                switch ($caso) {
                    case 0:
                        $meteo_cond = $MESSAGE['interface']['meteo']['status'][0];
                        break;
                    case 1:
                        $meteo_cond = $MESSAGE['interface']['meteo']['status'][0];
                        break;
                    case 2:
                        $meteo_cond = $MESSAGE['interface']['meteo']['status'][1];
                        break;
                    case 3:
                        $meteo_cond = $MESSAGE['interface']['meteo']['status'][2];
                        break;
                    case 4:
                        if ($minima < 4) {
                            $meteo_cond = $MESSAGE['interface']['meteo']['status'][4];
                        } else {
                            $meteo_cond = $MESSAGE['interface']['meteo']['status'][3];
                        }
                        break;
                    case 5:
                        $meteo_cond = $MESSAGE['interface']['meteo']['status'][1];
                        break;
                    case 6:
                        $meteo_cond = $MESSAGE['interface']['meteo']['status'][0];
                        break;
                    case 7:
                        $meteo_cond = $MESSAGE['interface']['meteo']['status'][1];
                        break;
                    case 8:
                        if ($minima < 4) {
                            $meteo_cond = $MESSAGE['interface']['meteo']['status'][4];
                        } else {
                            $meteo_cond = $MESSAGE['interface']['meteo']['status'][3];
                        }
                        break;
                    case 9:
                        $meteo_cond = $MESSAGE['interface']['meteo']['status'][2];
                        break;
                    case 10:
                        $meteo_cond = $MESSAGE['interface']['meteo']['status'][0];
                        break;
                    case 11:
                        $meteo_cond = $MESSAGE['interface']['meteo']['status'][0];
                        break;
                }
                $meteo = $meteo_cond . ""; //.Tempo();
            } else {
                $meteo = gdrcd_filter('out', $record['meteo']);
            }


            ?>

            <?php if (empty($meteo) === FALSE) { ?>
                <div class="titoli">
                    <img src="imgs/meteo.png" alt="meteo">
                </div>
                <div class="sfondo">
                    <div class="meteo_date">
                        <?php echo date('d') . '/' . date('m') . '/' . (date('Y') + $PARAMETERS['date']['offset']); ?>
                    </div>

                    <div class="inline">
                        <div class="meteo">
                            <script>
                                var meteotooltip = '<?php echo $meteo; ?>';
                                /* Estrapoliamo nome dell'immagine corrente */
                                var clima = "";
                                for (i = 21; meteotooltip.charAt(i) != '.'; i++) {
                                    if (i == 21)
                                        clima += meteotooltip.charAt(i).toUpperCase();
                                    else
                                        clima += meteotooltip.charAt(i);
                                }
                                /* Aggiungiamo attributo "title" al meteo */
                                meteotooltip = meteotooltip.split('>').join(' ');
                                meteotooltip += 'title="' + clima + '">';
                                document.write(meteotooltip);
                            </script>
                            <!--?php echo $meteo;?-->
                        </div>
                        <?php } ?>

                    <div class="gradi">
                        <?php echo $gradi . "&deg;C "; ?>
                        <p style="margin: 1px; padding: 1px;">
                        </p>
                    </div>

                    <iframe src="../imgs/fasilunari/fasiluna1.htm" frameborder="0" scrolling="no" height="45" width="45"
                        style="display: inline">
                    </iframe>
                    <p
                        style="text-align:center; width: 90px; margin:-22px 0px 0px 50px; position: absolute; padding:0px; color: #0A1228; font-style: italic; font-size: 10px; font-weight: bold;">
                        <!--CODICE VENTO-->

                        <?php
                        // Mantiene il valore di 'oldH' anche dopo il refresh
                        session_set_cookie_params(3600, "/");
                        session_start();
                        // ora di riferimento
                        $_SESSION['oldH'] = 0;

                        /* ora corrente */
                        $currentH = date("H");
                        /* giorno corrente, serve per generare il random seed */
                        $giorno = date("j");

                        /* Randomizza in base alle percentuali di incidenza. */
                        $_SESSION['winds'] = array("Calma", "Bava di Vento", "Brezza Leggera", "Vento Moderato", "Vento Forte", "Burrasca", "Uragano");

                        /*
                        Calma 10% [0 .. 9]
                        Bava di Vento 23% [10 .. 32]
                        Brezza Leggera 25% [33 .. 57]
                        Vento Moderato 25% [58 .. 82]
                        Vento Forte 10% [83 .. 92]
                        Burrasca 5% [93 .. 97]
                        Uragano 2% [98 .. 99]
                        */

                        /*
                         * Se sono passate tante ore quante specificate nella variabile
                         * $ore_cambio_vento, viene generato un nuovo vento casuale.
                         **/
                        if ($currentH == 0) {
                            $currentH == 24;
                        }
                        $ore_cambio_vento = 1;
                        if ($currentH - $_SESSION['oldH'] >= $ore_cambio_vento) {
                            /* ...imposto il random seed  e genero il numero casuale tra 0 e 99*/
                            if ($currentH == 24) {
                                $currentH == 0;
                            }
                            mt_srand($giorno + $currentH);
                            $r = mt_rand(0, 99);
                            $_SESSION['oldH'] = $currentH;
                        } else {
                            echo "Errore nella generazione del vento" . "<br>";
                            //  echo ""."";
                        }
                        if (($r >= 0) && ($r <= 9)) {
                            $_SESSION['wind'] = $_SESSION['winds'][0];
                        } elseif (($r >= 10) && ($r <= 32)) {
                            $_SESSION['wind'] = $_SESSION['winds'][1];
                        } elseif (($r >= 33) && ($r <= 57)) {
                            $_SESSION['wind'] = $_SESSION['winds'][2];
                        } elseif (($r >= 58) && ($r <= 82)) {
                            $_SESSION['wind'] = $_SESSION['winds'][3];
                        } elseif (($r >= 83) && ($r <= 92)) {
                            $_SESSION['wind'] = $_SESSION['winds'][4];
                        } elseif (($r >= 93) && ($r <= 97)) {
                            $_SESSION['wind'] = $_SESSION['winds'][5];
                        } elseif (($r >= 98) && ($r < 100)) {
                            $_SESSION['wind'] = $_SESSION['winds'][6];
                        }

                        echo $_SESSION['wind'];

                        ?>

                        <!--FINE CODICE VENTO-->

                    </p>
                </div>
            </div>
        </div>

        <?php } else {
            echo '<div class="error">' . gdrcd_filter('out', $MESSAGE['error']['location_doesnt_exist']) . '</div>';
        } ?>

</div><!-- page_body -->

</div><!-- Pagina -->