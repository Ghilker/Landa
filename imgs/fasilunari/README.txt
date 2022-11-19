Patch per aggiungere la fase lunare nella tua land, per gdrcd 5.2 nel mio caso ma vale per qualsiasi sito.
Nell'iframe appare lam tabella con la luna nella fase attuale reale, con la datazione "Età della luna = giorni 26 dal Novilunio" dipende dal GIORNO CHE LA INSERITE. 
Potete cambiare le scritte nel file fasiluna.js.

Naturalmente è gradito lasciare i riferimenti del copyright dell'autore nei file Grazie :)

istruzioni:

1° Carica la cartella "FASILUNARI" nella directory del GDRCD 5.2 o altro programma.


2° nel  file main.css aggiungi la class div.luna dove preferisci

div.luna{
    position: center;
    height: 100px;        /* Altezza IFRAME Sx */
    width: 180px;
	color:#fff;
  background:url("SE VUOI METTERE UN'IMMAGINE DI SFONDO NELL'IFRAME");
	-moz-border-radius:5px;		/* Bordi arrotondati */
	-webkit-border-radius:5px;
	-khtml-border-radius: 5px;
	border-radius:5px;
}


3° inserisci il codice iframe 

</div class="luna">
<div><br>
<iframe src ="../CARTELLASITO/fasilunari/fasiluna1.htm" frameborder="0" scrolling="no" height="95" width="180" style="border-radius: 10px; -webkit-border-radius:10px; -moz-border-radius:10px">
</iframe>
</div>


dove vuoi fare apparire la fase lunare, io l'ho inserita sotto il meteo riga 165 nel mio file info_location.inc.php subito dopo 
<div class="meteo">
<?php echo $meteo;?>

