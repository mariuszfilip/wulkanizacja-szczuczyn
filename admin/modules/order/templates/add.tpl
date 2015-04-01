  {include file="main/templates/errors.tpl"}
<form name='editform' enctype='multipart/form-data' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=add">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
<tr>
  <td class='lewa' style='width:15%;'>Usługa:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[id_service]" value="{$data.id_service}" style="width: 330px;" />
  </td>
</tr><tr>
  <td class='lewa' style='width:15%;'>Imię i nazwisko:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[name]" value="{$data.name}" style="width: 330px;" />
  </td>
</tr><tr>
  <td class='lewa' style='width:15%;'>Adres:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[address]" value="{$data.address}" style="width: 330px;" />
  </td>
</tr><tr>
  <td class='lewa' style='width:15%;'>E-mail:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[email]" value="{$data.email}" style="width: 330px;" />
  </td>
</tr><tr>
  <td class='lewa' style='width:15%;'>Telefon:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[phone]" value="{$data.phone}" style="width: 330px;" />
  </td>
</tr><tr>
  <td class='lewa' style='width:15%;'>Uwagi:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[comment]" value="{$data.comment}" style="width: 330px;" />
  </td>
</tr><tr>
  <td class='lewa' style='width:15%;'>Wiadomość:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[message]" value="{$data.message}" style="width: 330px;" />
  </td>
</tr><tr>
  <td class='lewa'>Status: </td>
  <td class='prawa'>
    {if $data.active eq 'N' || $data.active eq ''}
    <input type='radio' name='data[active]' value='N' id='status0' checked='checked' />
    {else}
    <input type='radio' name='data[active]' value='N' id='status0' />
    {/if}
    <label for='status0'>nieaktywny</label>
    {if $data.active eq 'Y'}
    <input type='radio' name='data[active]' value='Y' id='status1' checked='checked' />
    {else}
    <input type='radio' name='data[active]' value='Y' id='status1' />
    {/if}
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
</tr></table>
</form>