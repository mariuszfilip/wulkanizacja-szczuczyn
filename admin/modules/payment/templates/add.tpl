  {include file="main/templates/errors.tpl"}
<form name='editform' enctype='multipart/form-data' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=add">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
<tr>
  <td class='lewa' style='width:15%;'>Zamówienie:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[id_order]" value="{$data.id_order}" style="width: 330px;" />
  </td>
</tr><tr>
  <td class='lewa' style='width:15%;'>Identyfikator transakcji:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[txn_id]" value="{$data.txn_id}" style="width: 330px;" />
  </td>
</tr><tr>
  <td class='lewa' style='width:15%;'>Paipal ID:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[receiver_email]" value="{$data.receiver_email}" style="width: 330px;" />
  </td>
</tr>
<tr>
  <td class='lewa'>Status:</td>
  <td class='prawa'>   
    <input type='radio' name='data[active]' value='N' id='status0'  {if $data.active eq 'N' || $data.active eq ''}checked='checked'{/if} />    
    <label for='status0'>nieaktywny</label>
    
    <input type='radio' name='data[active]' value='Y' id='status1' {if $data.active eq 'Y'}checked='checked'{/if} />
    <label for='status1'>aktywny</label>
  </td>
</tr>
<!-- submit dodawania rekordu -->
<tr>
  <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
  	<img src='{#imgDir#}ico-anuluj.gif' onclick='location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}"' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />
    <input type='hidden' name='confirms' value='1' />
    <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
  </td>
</tr>
</table>
</form>