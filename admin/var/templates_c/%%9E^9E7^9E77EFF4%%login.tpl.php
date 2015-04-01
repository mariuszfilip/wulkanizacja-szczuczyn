<?php /* Smarty version 2.6.18, created on 2013-08-20 22:13:09
         compiled from authentication/templates/login.tpl */ ?>
<?php if ($_SESSION['error'] != ''): ?>
  <div class='message'><?php echo $_SESSION['error']; ?>
</div>
<?php endif; ?>
<table border='0' cellspacing='0' cellpadding='0'>
	<tr>
		<td class='separator'>&nbsp;</td>
		<td style='vertical-align:middle;'>
			<table border='0' cellspacing='0' cellpadding='0' style='width: 500px;' class="logowanie">
				<tr>
					<td style='text-align: center;'>
						<table border='0' cellspacing='0' cellpadding='0'>
						<?php if ($this->_tpl_vars['info'] != ''): ?>
						 <tr>
						   <td colspan="2" style="font-size: 14px;font-weight: bold;color: #696969;padding-bottom: 4px;"><?php echo $this->_tpl_vars['info']; ?>
</td>
						 </tr>
						 <?php endif; ?>
							<tr>
              	<td colspan="2" align="center" class="login_head">
                	Logowanie do panelu administracyjnego
                </td>
              </tr>             
             
							<tr>
              	<td style='text-align:left; color: #696969;' width="50%">
									<img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
login-keys.jpg' alt='' />
								</td>
              
             	 <td width="50%" align="right">
								<table border='0' cellspacing='0' cellpadding='0' style='width: 194px;'>
									<tr><td style='text-align: left;'>
                    <?php if ($_SESSION['login_error'] != ''): ?>
				              <span style="color:red;font-size:12px;"><?php echo $_SESSION['login_error']; ?>
</span>
                    <?php endif; ?>

										<form action='<?php echo $_SERVER['PHP_SELF']; ?>
' method='post'>
											<div style='width: 160px; text-align: left;'>
                        <p><span style='font-weight: bold; color:#797979;'>Login:</span></p>
                        <p><input type='text' name='login' id='login' class='form-text' style='width: 100%;' /></p>
                        <br style="line-height:5px;" />
                        <p><span style='font-weight: bold; color:#797979;'>Hasło:</span></p>
                        <p><input type='password' name='password' class='form-text' style='width: 100%;' /></p>
                        <br style="line-height:5px;"/>
                        <p><input type="hidden" name="login_confirm" value="1" /></p>
                        <p><input type='submit' value='zaloguj się' class='login_ok' /></p>
                        </form>
                                                <script type="text/javascript">
							$("login").focus();
						</script>
											</div>
									</td></tr>
								</table>
							</td></tr>           
						</table>
					</td>
				</tr>
                  <tr>
                  	<td style="padding:20px 0 0 0;">
										Aby korzystać z możliwości systemu należy się zalogować. <br />
                    Jeśli nie posiadasz swojego konta skontaktuj się z administratorem.                    
                  	</td>
                  </tr>           
			</table>
		</td>
	</tr>
</table>