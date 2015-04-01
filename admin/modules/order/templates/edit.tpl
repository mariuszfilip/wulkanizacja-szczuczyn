  {include file="main/templates/errors.tpl"}
<form name='editform' enctype='multipart/form-data' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$data.id}">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
<tr>
  <td class='lewa' style='width:15%;'>Usługa:</td>
  <td class='prawa' style='width:85%;'>
    {$service.name}
  </td>
</tr><tr>
  <td class='lewa' style='width:15%;'>Imię i nazwisko:</td>
  <td class='prawa' style='width:85%;'>
    {$data.name}
  </td>
</tr>
<tr>
  <td class='lewa'>Adres: </td>
  <td class='prawa'>
    {$data.address}
  </td>
</tr>
<tr>
  <td class='lewa' style='width:15%;'>E-mail:</td>
  <td class='prawa' style='width:85%;'>
   <a href="mailto:{$data.email}">{$data.email}</a>
  </td>
</tr>
<tr>
  <td class='lewa' style='width:15%;'>Telefon:</td>
  <td class='prawa' style='width:85%;'>
    {$data.phone}
  </td>
</tr>
<tr>
  <td class='lewa'>Uwagi klienta: </td>
  <td class='prawa'>
    {$data.comment}
  </td>
</tr>
<tr>
  <td class='lewa'>Wiadomość dla klienta: </td>
  <td class='prawa'>
    <!-- textarea -->
    <textarea class="form-textarea" {if $data.active eq Y}disabled="disabled"{/if} cols="60" style="height:100px;" name="data[message]">{$data.message}</textarea>
  </td>
</tr>
<tr>
  <td class='lewa' style='width:15%;'>Kwota przedpłaty:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" {if $data.active eq Y}disabled="disabled"{/if} name="data[price]" value="{$data.price}" style="width: 50px; text-align:right" /> $  &nbsp; <span style="color: #8A8A8A;">[ cena całkowita usługi: {$service.price} $ ]</span>
  </td>
</tr>

{*<!--tr>
  <td class='lewa'>Status: </td>
  <td class='prawa'>
    {if $data.active eq 'N' || $data.active eq ''}
    <input type='radio' name='data[active]' value='N' id='status0' checked='checked' />
    {else}
    <input type='radio' name='data[active]' value='N' id='status0' />
    {/if}
    <label for='status0'>niewysłano</label>
    {if $data.active eq 'Y'}
    <input type='radio' name='data[active]' value='Y' id='status1' checked='checked' />
    {else}
    <input type='radio' name='data[active]' value='Y' id='status1' />
    {/if}
    <label for='status1'>wysłano</label>
  </td>
</tr-->*}

<!-- submit edycji rekordu -->
<tr>
  <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
  	<img src='{#imgDir#}ico-anuluj.gif' onclick='location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}"' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />    
    <input type='hidden' name='confirms' value='1' />
    {if $data.active neq Y}
    <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
    {/if}
    <input type='hidden' name='data[id]' value='{$data.id}' />
  	<img src='{#imgDir#}ico-usun.gif' onclick='if(confirm("Jeśli chcesz usunać kliknij [OK]\nJeśli nie [Anuluj]"))location.href="index.php?{$mainParameterName}={$mainParameterValue}&amp;act=del&amp;id={$data.id}"' onmouseover="this.src='{#imgDir#}ico-usun-over.gif'" onmouseout="this.src='{#imgDir#}ico-usun.gif'" class='icon' />
  </td>
</tr></table>
</form>