<?php

require 'vocabulary/'.$PARAMETERS['languages']['set'].'.vocabulary.php';
$query = "SELECT url_img_chat, nome, cognome, prestavolto FROM personaggio ORDER BY nome ASC";
$result = gdrcd_query($query, 'result');
?>

<div class="page_title">
 <h2>ANAGRAFE E PRESTAVOLTI</h2>
</div>
<div style="text-align: center;font-size: 1em;">
In questa pagina troverai l'elenco dei pg, dei loro avatar e dei loro prestavolti.<br/>
Controlla se nella lista c'è il prestavolto che vorresti utilizzare, nel caso sei pregato di cambiarlo per non generare un "doppio".<br/>
Per segnalare il tuo prestavolto, dalla tua scheda clicca su "modifica", inserisci nome e cognome del prestavolto nella terza casella e salva il tutto.<br/>
Grazie!<br/><br/>

<div class="elenco_record_gioco">
  <?php while($row=gdrcd_query($result, 'fetch')){ ?>

        <div>
          <table style="margin-left:auto; margin-right:auto;">
          <tr>
            <td style="width: auto;">
              <img src="<?php echo gdrcd_bbcoder(gdrcd_filter('out',$row['url_img_chat'])); ?>" style="width: 65px;height: 65px;" />
            </td>
            <td style="width: 50%;">
              <div style="font-size: 1.2em; color: #dadada;">
                <a href="popup.php?page=scheda&pg=<?php echo gdrcd_filter('out',$row['nome']);?>">
                <?php echo gdrcd_filter('out',$row['nome']).' '.gdrcd_filter('out',$row['cognome']); ?>
                </a>
              <br/>
              <a href="popup.php?page=messages_center&newmessage=yes&reply_dest=<?php echo gdrcd_filter('url',$record['nome']); ?>" class="link_invia_messaggio">
              <?php if (empty($PARAMETERS['names']['private_message']['image_file2'])===FALSE){ ?>
                       <img class="presenti_ico2" src="imgs/icons/mail_new3.png" alt="E-Mail" href="popup.php?page=messages_center&newmessage=yes&reply_dest=<?php echo gdrcd_filter('url',$record['nome']); ?>"/>
            <?php } else {
                   echo gdrcd_filter('out',$MESSAGE['interface']['sheet']['send_message_to']['send']).' '.gdrcd_filter('out', strtolower($PARAMETERS['names']['private_message']['sing'])).' '.gdrcd_filter('out',$MESSAGE['interface']['sheet']['send_message_to']['to']).' '.gdrcd_filter('out',$record['nome']);
                 }?></a>
              <br/>
                <div style="font-size: 1em;">
              pv: <u style="color: #CC9933; text-transform: capitalize;"><?php echo gdrcd_bbcoder(gdrcd_filter('out',$row['prestavolto'])); ?></u>
                </div>
            </div>
            </td>
          </tr>
          </table>
        <br/>
        </div>
    <?php
  }//while
    ?>
    <div class="link_back">
      <a href="popup.php?page=utenti">TORNA AL MENU UTENTE</a>
    </div>
</div></div>
