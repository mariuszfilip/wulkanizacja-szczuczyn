{include file="main/templates/errors.tpl"}
<div class='naglowek'>Edycja konta pocztowego</div>
<form name='editform' enctype='multipart/form-data' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$data.id}">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
<tr>
  <td class='lewa' style='width:15%;'>E-mail:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" id="data_mail" name="data[mail]" value="{$data.mail|escape}" onkeyup="testMail(jQuery('#test_mail').val())" style="width: 330px;" />
  </td>
</tr>
<tr>
  <td class='lewa' style='width:15%;'>Serwer SMTP:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text"  type="text" id="data_host" name="data[host]" value="{$data.host|escape}" onkeyup="testMail(jQuery('#test_mail').val())" style="width: 330px;" />
  </td>
</tr>
<tr>
  <td class='lewa' style='width:15%;'>Login:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" id="data_user" name="data[user]" value="{$data.user|escape}" onkeyup="testMail(jQuery('#test_mail').val())" style="width: 330px;" />
  </td>
</tr>
<tr>
  <td class='lewa' style='width:15%;'>Hasło:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="password" autocomplete="off" id="data_pass" name="data[pass]" value="{$data.pass|escape}" onkeyup="testMail(jQuery('#test_mail').val())" style="width: 330px;" />
  </td>
</tr>

<tr>
  <td class='lewa'>Serwer wymaga autoryzacji: </td>
  <td class='prawa'>
  <input type='radio' name='data[smtpauth]' value='Y' id='smtpauth1' onkeyup="testMail(jQuery('#test_mail').val())" onchange="testMail(jQuery('#test_mail').val())" {if $data.smtpauth eq 'Y'}checked='checked'{/if} />
  <label for='smtpauth1'>Tak</label>
    
    <input type='radio' name='data[smtpauth]' value='N' id='smtpauth0' onkeyup="testMail(jQuery('#test_mail').val())" onchange="testMail(jQuery('#test_mail').val())"  {if $data.smtpauth eq 'N' || $data.smtpauth eq '' || !$data.smtpauth}checked='checked'{/if} />
    <label for='smtpauth0'>Nie</label>

  </td>
</tr>

<!-- submit edycji rekordu -->
<tr>
  <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
  	<img src='{#imgDir#}ico-anuluj.gif' onclick='location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}"' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />
    <input type='hidden' name='confirms' value='1' />
    <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
    <input type='hidden' name='data[id]' value='{$data.id}' />
  	<img src='{#imgDir#}ico-usun.gif' onclick='if(confirm("Jeśli chcesz usunać kliknij [OK]\nJeśli nie [Anuluj]"))location.href="index.php?{$mainParameterName}={$mainParameterValue}&amp;act=del&amp;id={$data.id}"' onmouseover="this.src='{#imgDir#}ico-usun-over.gif'" onmouseout="this.src='{#imgDir#}ico-usun.gif'" class='icon' />
  </td>
</tr>

<tr>
  <td class='lewa' style='width:15%;' colspan="2">
  <div style="border:#999 solid 1px; -moz-border-radius:0 4px 4px 4px; -webkit-border-radius:0 4px 4px 4px; border-radius:0 4px 4px 4px; margin-top:3px; width:537px; min-height:46px;"><div style="border:#999 solid 1px; border-bottom-color:#F8F8F8; background-color:#F8F8F8; -moz-border-radius:4px 4px 0 0; -webkit-border-radius:4px 4px 0 0; border-radius:4px 4px 0 0; height:13px; margin-top:-17px; margin-left:-1px; width:114px; text-align:center; color:#0A9CD9; font-weight:bold; padding-top:2px;">Testowanie konta</div> <input type="button" value="Wyślij maila testowego na adres:" id="smtp_test_button" onclick="this.blur(); sendMail();" class="form-button unactive_button" style="margin-top:9px; margin-bottom:9px;"/> <input class="form-text" type="text" id="test_mail" value="" style="width: 300px; height:19px; vertical-align: middle; font-size:14px;" onkeyup="testMail(this.value)" onchange="testMail(this.value)" /><div id="smtp_loader" style="display:none; width:100%; height:100%; color:#25B7F5; font-size:10px; line-height:.8; text-align:center;"><img src="img/ajax-loader-blue.gif" style="margin-top:10px;" alt="wysyłanie..." /><br />wysyłanie w toku...</div></div>
  </td>
</tr>
</table>
</form>{literal}
<script type="text/javascript">
	function testMail(mail_adderess){
		if(false == /^[A-Za-z0-9._%-]+@[A-Za-z0-9._%-]+\.[A-Za-z0-9._%-]{2,4}$/.test( mail_adderess ) || !jQuery("#data_mail").val() || !jQuery("#data_host").val() || !jQuery("#data_user").val() || !jQuery("#data_pass").val()){			
			jQuery("#smtp_test_button").addClass("unactive_button");
			return false;
		}else{
			jQuery("#smtp_test_button").removeClass("unactive_button");
			return false;
		}
	}
	
	function sendMail(){		
		if (jQuery("#smtp_test_button").attr("class").indexOf("unactive_button") >=0){
			return false;
		}else{			
			jQuery("#smtp_test_button").hide();
			jQuery("#test_mail").hide();
			jQuery("#smtp_loader").show();
			realSendMail();
			return false;
		}
	}
	
	function realSendMail(){
		advAJAX.post({
    		url: 'ajax.php?mod=smtp_account&act=ajax_test_mail',
			parameters : {
    			mail 		: jQuery("#data_mail").val(),
    			host 		: jQuery("#data_host").val(),
				user 		: jQuery("#data_user").val(),
				pass 		: jQuery("#data_pass").val(),
				smtpauth 	: jQuery("#smtpauth1").attr('checked'),
				s_to 		: jQuery("#test_mail").val()
    		},
			onSuccess : function(obj) {
				jQuery("#smtp_loader").html(obj.responseText);
      		},
			onError : function(obj) {
				jQuery("#smtp_loader").css({'color':'red'});
				jQuery("#smtp_loader").html("<br /><br />Error: " + obj.status);
			}
  		});
	}
</script>{/literal}