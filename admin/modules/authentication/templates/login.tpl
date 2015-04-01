{if $smarty.session.error ne ''}
  <div class='message'>{$smarty.session.error}</div>
{/if}
<table border='0' cellspacing='0' cellpadding='0'>
	<tr>
		<td class='separator'>&nbsp;</td>
		<td style='vertical-align:middle;'>
			<table border='0' cellspacing='0' cellpadding='0' style='width: 500px;' class="logowanie">
				<tr>
					<td style='text-align: center;'>
						<table border='0' cellspacing='0' cellpadding='0'>
						{if $info ne ''}
						 <tr>
						   <td colspan="2" style="font-size: 14px;font-weight: bold;color: #696969;padding-bottom: 4px;">{$info}</td>
						 </tr>
						 {/if}
							<tr>
              	<td colspan="2" align="center" class="login_head">
                	Logowanie do panelu administracyjnego
                </td>
              </tr>             
             
							<tr>
              	<td style='text-align:left; color: #696969;' width="50%">
									<img src='{#imgDir#}login-keys.jpg' alt='' />
								</td>
              
             	 <td width="50%" align="right">
								<table border='0' cellspacing='0' cellpadding='0' style='width: 194px;'>
									<tr><td style='text-align: left;'>
                    {if $smarty.session.login_error ne '' }
				              <span style="color:red;font-size:12px;">{$smarty.session.login_error}</span>
                    {/if}

										<form action='{$smarty.server.PHP_SELF}' method='post'>
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
                        {*
                        <input type='button' value='przypomnij hasło' class='form-button' onclick="location.href='{$smarty.server.PHP_SELF}?{$mainParameterName}=remind'" />
                        *}
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