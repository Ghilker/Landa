<?php
/* * Pagina di layout.
	* E' selezionabile come layout principale per il proprio gdr semplicemente da config.inc.php
	* Contiene il css che viene richiamato separatamente come file esterno e il markup
	*
	* Il layout è a piena compatibilità con i browser.
	* La scelta di inserire qui il css ad esso destinato è per limitarne la modifica da parte dell'utente
	* consentendogli di personalizzare tutto il resto senza rovinare la compatibilità cross browser
	*
	* @author Blancks
*/
if (isset($_GET['css']))
{
	header('Content-Type:text/css; charset=utf-8');


?>@charset "utf-8";

body{
margin: 0;
padding: 0;
border: 0;
overflow: hidden;
height: 100%; 
max-height: 100%; 
}

#framecontentRight{
position: absolute;
top: 0;
bottom: 0; 
right: 0;
width: 210px; /*Width of frame div*/
height: 100%;
overflow: hidden; /*Disable scrollbars. Set to "scroll" to enable*/
}

#maincontent{
position: fixed;
top: 0;
left: 0;
right: 210px; /*Set right value to WidthOfFrameDiv*/
bottom: 0;
overflow: auto; 
}

.innertube{
margin: 15px; /*Margins for inner DIV inside each DIV (to provide padding)*/
}

* html body{ /*IE6 hack*/
padding: 10px 210px 10px 0; /*Set value to (0 WidthOfFrameDiv 0 0)*/
}

* html #maincontent{ /*IE6 hack*/
height: 100%; 
width: 100%; 
}


<?php

}else
{


	if($PARAMETERS['right_column']['activate'] == 'ON')
	{
	
?>
<!-- Colonna destra -->
<div id="framecontentRight">
	<div class="innertube">

		<div class="colonne_sx">
		<?php 		 
				foreach($PARAMETERS['right_column']['box'] as $box)
				{
					echo '<div class="'.$box['class'].'">';
				
					gdrcd_load_modules('pages/'.$box['page'].'.inc.php', $box);
				
					echo '</div>';
				}
			
		?>
		</div>

	</div>
</div>
<?php

	}

?>

<div id="maincontent">
	<div class="output">
			<?php gdrcd_load_modules('pages/'.$strInnerPage); ?>
	</div>
</div>

<?php

}

?>