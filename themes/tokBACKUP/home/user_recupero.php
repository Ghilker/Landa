<?php 
/* * Skin Advanced
	* Markup e procedure della homepage
	* @author Blancks
*/
	
?><div id="homepage">
<div class="login_form_recupero">
<div class="side_modules" style="background-color: transparent; text-align: center;">
<?php	if (empty($RP_response)){ ?>
					<strong><?php echo gdrcd_filter('out',$MESSAGE['homepage']['forms']['forgot']);?></strong>
					
					<div class="pass_rec">
						<form action="index.php" method="post">
							<div>
								<span class="form_label"><label for="passrecovery"><?php echo $MESSAGE['homepage']['forms']['email'];?></label></span>
								<input type="text" id="passrecovery" name="email" />
							</div>
							<input type="submit" value="<?php echo $MESSAGE['homepage']['forms']['new_pass'];?>" />
						</form>
					</div>
<?php	}else{ ?>
					<div class="pass_rec">
						<?php echo $RP_response; ?>
					</div>
<?php	} ?>
				</div>
				</div>
                </div>
				

			
