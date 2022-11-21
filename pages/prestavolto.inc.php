<?php

require 'vocabulary/'.$PARAMETERS['languages']['set'].'.vocabulary.php';
$query = "SELECT url_img_chat, nome, cognome, prestavolto FROM personaggio ORDER BY nome ASC";
$result = gdrcd_query($query, 'result');
?>

<!--<div class="page_title">
 <h2>ANAGRAFE E PRESTAVOLTI</h2>
</div>
<div style="text-align: center;font-size: 1em;">
In questa pagina troverai l'elenco dei pg, dei loro avatar e dei loro prestavolti.<br/>
Controlla se nella lista c'è il prestavolto che vorresti utilizzare, nel caso sei pregato di cambiarlo per non generare un "doppio".<br/>
Per segnalare il tuo prestavolto, dalla tua scheda clicca su "modifica", inserisci nome e cognome del prestavolto nella terza casella e salva il tutto.<br/>
Grazie!<br/><br/>-->

<!--CODICE HDY-->
<div id="maincontent">
	<div class="output">
			
<div class="page_title">
<p align="center"><img src="imgs/prestavolti.png" alt="Lista Prestavolti" /></p>
</div>

<!---LISTA PRESTAVOLTI-->
<div style="text-align: center;font-size: 1em; width:600px; text-align:justify; margin:auto;">
In questa pagina troverai l'elenco dei pg, dei loro avatar e dei loro prestavolti in modo utile e veloce.<br/>
Fai una ricerca nel form sottostante mettendo o il nome o il cognome o la saga da cui è preso il pv che hai scelto e nel caso non sia presente, <u>comunicare la richiesta nel topic <em>"Richieste e modifiche prestavolti"</em> in <em>Forum</em></u>.<br/>
Se approvato dallo staff, il nome del tuo pg verrà associato al nome del pv in questo stesso elenco.<br/>
<br/>
<strong>Si ricorda che:</strong>
<ul style="margin-left:15px;">
<li>Il pv scelto <strong>deve</strong> appartenere al mondo Manga / Anime / Otome-Games / Manhwa.</li>
<li>Sono consentiti <strong>Original Characters</strong>, purchè rispecchino lo stile Manga / Anime / Otome-Games / Manwha.</li>
<li>Il patrocinio del proprio PV verrà perso dopo <strong>2 mesi</strong> di assenza ingiustificata.</li>
<li><strong>Non sono consentiti "doppi" pv</strong>, a meno che i due pg non siano gemelli o sosia <em>(quest'informazione è da comunicare allo staff)</em>.</li>
</ul>
<br/>
<br/><br/>
</div>


<div class="elenco_record_gioco" style="width:98%; text-align:center;">

<div style="font-size: 1em; width:50%; text-align:justify; margin:auto;"> <!--10%-->
 <form action="" method="post" onsubmit="return false";>  <!-- HDY: <form action="" method="post"> -->
 <input id="filtro" type="search" name="q" value=""/> <!-- HDY: type="text" name="search"--> 
  

<div class='form_submit' style="margin-left: 95%; margin-top: -28px; margin-bottom: 40px;">
  <!-- <input name="submit_search" type="submit" value="Cerca" class="form_submit" /> --> <!--180%-->
   <input name="submit_search" onclick="cerca()" type="submit" value="Cerca" class="form_submit" style="width:80px;"/> </div>
      <!-- <div class='form_submit' style="margin-left: 95%; margin-top: -28px; margin-bottom: 40px;">
           <input name="submit_search" type="submit" onclick="location.reload()" value="Reset" class="form_submit" style="width:80px;"> </div> -->
   </form>
</div>


<?php
$testScript = "
    function cerca() {
        let filtroCerca = document.getElementById('filtro').value;
        console.log(filtroCerca);
        let pvTab = document.getElementsByTagName('tr');
        let resultTable = document.getElementById('result_table');
        
        for (let i = 0; i < pvTab.length; i++) {
        console.log(i + ' ' + pvTab[i].innerText);
        let pvValue = pvTab[i].innerText.split('\\n', 5);
        pvTab[i].style.display = '';
        }
    
        for (let i = 0; i < pvTab.length; i++) {
            console.log(i + ' ' + pvTab[i].innerText);
            let pvValue = pvTab[i].innerText.split('\\n', 5);
            if (pvValue[4].toLowerCase() == 'pv: ' + filtroCerca.toLowerCase()) {
                // visualizzo l'elemento cercato
                pvTab[i].style.display = 'none';
                resultTable.innerHTML = pvTab[i].innerHTML;
                // console.log('ho nascosto qualcosa!');
            } else {
                pvTab[i].style.display = 'none';
                // console.log('non ho nascosto nulla!');
                }
        }
    }";

echo "<script type=" . '"text/javascript"' . ">" .
    $testScript .
    "</script>"; ?>


<div class="elenco_record_gioco"> <!--style="display:none" NASCONDE IL LISTONE FISSO DI PV-->
<div id="result_table">
</div>
  <?php   
  while($row=gdrcd_query($result, 'fetch')){ ?>

        <div>
          <table style="margin-left:auto; margin-right:auto;">
        <!-- <tr style="display:none"> -->
        <tr class="pv" style="display:none">
            <td style="width: auto;">
              <img src="<?php echo gdrcd_bbcoder(gdrcd_filter('out',$row['url_img_chat'])); ?>" style="width: 65px;height: 65px;" />
            </td>
            <td style="width: 50%;">
              <div style="font-size: 1.2em; color: #dadada;">
                <a href="main.php?page=scheda&pg=<?php echo gdrcd_filter('out',$row['nome']);?>">
                <?php echo gdrcd_filter('out',$row['nome']).' '.gdrcd_filter('out',$row['cognome']); ?>
                </a>
              <br/>
              <a href="main.php?page=messages_center&newmessage=yes&reply_dest=<?php echo gdrcd_filter('url',$record['nome']); ?>" class="link_invia_messaggio">
              <?php if (empty($PARAMETERS['names']['private_message']['image_file2'])===FALSE){ ?>
                       <img class="presenti_ico2" src="imgs/icons/mail_write.png" alt="E-Mail" href="main.php?page=messages_center&newmessage=yes&reply_dest=<?php echo gdrcd_filter('url',$record['nome']); ?>"/>
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
    


   <!-- <div class="link_back">
      <a href="main.php?page=uffici">Torna ai Servizi</a>
    </div>
</div></div>
	</div> -->

<!--<script type="text/javascript" src="/includes/corefunctions.js"></script>

<script type="text/javascript">
var tooltip_offsetX = 20;
var tooltip_offsetY = 20;
</script>
<script type="text/javascript" src="/includes/tooltip.js"></script>


<script type="text/javascript" src="/includes/changetitle.js"></script>


<script type="text/javascript" src="/includes/popupchoise.js"></script>-->
