<?php 
/* * Skin Advanced
	* Markup e procedure della homepage
	* @author Blancks
*/
	
?><div id="mainhome">

	<div id="site_width">

		<div id="header2">
			<div class="login_form">
				<form action="login.php" id="do_login" method="post"<?php if ($PARAMETERS['mode']['popup_choise']=='ON'){ echo ' onsubmit="check_login(); return false;"'; } ?>>
					<div>
						
						<input type="text" id="username" name="login1" />
					</div>
					<div>
						
						<input type="password" id="password" name="pass1" />
					</div>
<?php 	if ($PARAMETERS['mode']['popup_choise']=='ON'){ ?>
				
<?php	}	?>
<div style="position: absolute; float: left; margin-top: 7px;">
<a href="index.php?page=index&content=user_recupero" style="font-size: 12px; margin-left:18px; position: relative;"><i>Recupero Password</i></a></div>
					<input type="submit" value="<?php echo $MESSAGE['homepage']['forms']['login'];?>" />
				</form>
			</div>
			
			<h1><a href="index.php"><?php echo $MESSAGE['homepage']['main_content']['site_title']; ?></a></h1>
		</div>


		<div id="content">
        	<div class="social">
            <a href="index.php?page=index&content=iscrizione" style="padding-top: 4px"><img src="http://talesofkangei.altervista.org/themes/tok1/imgs/twitter.png" height="30"></a></div>
	
			<div class="content_body">
			
<?php

		if (file_exists('themes/'. $PARAMETERS['themes']['current_theme'] .'/home/' . $content . '.php'))
				include 'themes/'. $PARAMETERS['themes']['current_theme'] .'/home/' . $content . '.php';


?>
			
			</div>
           
			
			<br class="blank" />
            
	<div class="sidecontent">
    <ul>
     <li><a href="index.php?page=index&content=iscrizione" style="padding-top: 4px"><img src="https://virtualredlifegdr.altervista.org/themes/tok1/imgs/iscrizione.png" height="30" onMouseOver="this.src='https://virtualredlifegdr.altervista.org/themes/tok1/imgs/iscrizione2.png'"
onMouseOut="this.src='https://virtualredlifegdr.altervista.org/themes/tok1/imgs/iscrizione.png'"></a></li>
     <li><a href="index.php?page=index&content=user_regolamento_base"><img src="https://virtualredlifegdr.altervista.org/themes/tok1/imgs/regolamento.png" height="27" onMouseOver="this.src='https://virtualredlifegdr.altervista.org/themes/tok1/imgs/regolamento2.png'"
onMouseOut="this.src='https://virtualredlifegdr.altervista.org/themes/tok1/imgs/regolamento.png'"></a></li>
     <li><a href="index.php?page=index&content=user_ambientazione"><img src="https://virtualredlifegdr.altervista.org/themes/tok1/imgs/ambientazione.png" height="27" onMouseOver="this.src='https://virtualredlifegdr.altervista.org/themes/tok1/imgs/ambientazione2.png'"
onMouseOut="this.src='https://virtualredlifegdr.altervista.org/themes/tok1/imgs/ambientazione.png'"></a></li>
     <li><a href="index.php?page=index&content=user_razze"><img src="https://virtualredlifegdr.altervista.org/themes/tok1/imgs/razze.png" height="27" onMouseOver="this.src='https://virtualredlifegdr.altervista.org/themes/tok1/imgs/razze2.png'"
onMouseOut="this.src='https://virtualredlifegdr.altervista.org/themes/tok1/imgs/razze.png'"></a></li>
    </ul>
    </div>
 
  </div>
 
 
  

 </div>
<div id="footer">
 
   <div>
    <p><?php echo gdrcd_filter('out',$PARAMETERS['info']['site_name']), ' - ', gdrcd_filter('out',$MESSAGE['homepage']['info']['webm']), ': ', gdrcd_filter('out',$PARAMETERS['info']['webmaster_name']), ' - ', gdrcd_filter('out',$MESSAGE['homepage']['info']['dbadmin']),': ', gdrcd_filter('out', $PARAMETERS['info']['dbadmin_name']) ,' - ', gdrcd_filter('out',$MESSAGE['homepage']['info']['email']), ': <a href="mailto:', gdrcd_filter('out',$PARAMETERS['info']['webmaster_email']), '">', gdrcd_filter('out',$PARAMETERS['info']['webmaster_email']), '</a>.'; ?> <?php echo CREDITS, ' ', LICENCE ?></p>
   </div>
   
  </div>
</div>