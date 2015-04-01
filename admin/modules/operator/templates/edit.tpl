{include file="main/templates/errors.tpl"}
<form name='editform' method="post" action="index.php?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$data.id}">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
  <tr>
    <td class='lewa'>Imię: </td>
    <td class='prawa'>
      <input class="form-text" type="text" id='name' name="data[name]" value='{$data.name|escape}' style='width: 330px;' />
    </td>
  </tr>

  <tr>
    <td class='lewa' style='width:10%;'>Nazwisko: </td>
    <td class='prawa' style='width:85%;'>
      <input class="form-text" type="text" id="surname" name="data[surname]" value="{$data.surname|escape}" style="width: 330px;" />
    </td>
  </tr>

  <tr>
    <td class='lewa'>Email (login): </td>
    <td class='prawa'>
      <input class="form-text" type="text" id='login' name="data[email]" value='{$data.email|escape}' style='width: 330px;' />
    </td>
  </tr>
  <tr>
    <td class='lewa'>Hasło: </td>
    <td class='prawa'>
      <input class="form-text" type="password" autocomplete="off" id='password' name="data[password]" value='{$data.password|escape}' style='width: 330px;' />
    </td>
  </tr>
  <tr>
    <td class='lewa'>Status:</td>
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

 {if $modules_o.dane}
 <tr><td colspan="2">&nbsp;</td></tr>

 <tr>
    <td class='lewa'>Uprawnienia: </td>
    <td class='prawa'>
		<table align="left" cellspacing="0" class="small_list" style="width:380px">
        <thead>
        <tr><th style="padding-left:6px;">Moduł</th><th align="center">Typ dostępu</th></tr>
        </thead>
        <tbody>
{foreach name=outer item=modul from=$modules_o}
  {foreach key=key item=item from=$modul}
  {if $item.name}<tr align="left" class='odd'>
	<td style="padding-left:6px; width:160px" align="left">
{$item.name}:</td>
    <td align="center">
    <input name="data[m][{$item.id_module}][view]" id="{$item.id_module}view"  type="checkbox" class="checkbox" value="1"  {if $item.view eq 1}checked="checked"{/if} onchange="if(this.checked==false){literal}{{/literal} 
     jQuery('#{$item.id_module}edit').attr('checked', '');
     jQuery('#{$item.id_module}del').attr('checked', '');
     jQuery('label[for=\'{$item.id_module}edit\']').removeClass('label_checked');
     jQuery('label[for=\'{$item.id_module}del\']').removeClass('label_checked');
    {literal}}{/literal}" /><label for="{$item.id_module}view" class="label">podgląd</label>
    
    <input name="data[m][{$item.id_module}][edit]" id="{$item.id_module}edit" type="checkbox" class="checkbox" value="1" {if $item.edit eq 1}checked="checked"{/if} onchange="if(this.checked==true) {literal}{{/literal} 
    jQuery('#{$item.id_module}view').attr('checked', 'checked');
    jQuery('label[for=\'{$item.id_module}view\']').addClass('label_checked');
    {literal}}else{{/literal} 
    jQuery('#{$item.id_module}del').attr('checked', '');
    jQuery('label[for=\'{$item.id_module}del\']').removeClass('label_checked');
    {literal}}{/literal}"/><label for="{$item.id_module}edit" class="label">edycja</label>
    
   <input name="data[m][{$item.id_module}][del]" id="{$item.id_module}del" type="checkbox" class="checkbox" value="1" {if $item.del eq 1}checked="checked"{/if} onchange="if(this.checked==true){literal}{{/literal} 
    jQuery('#{$item.id_module}edit').attr('checked', 'checked');
    jQuery('#{$item.id_module}view').attr('checked', 'checked');
    jQuery('label[for=\'{$item.id_module}edit\']').addClass('label_checked');
    jQuery('label[for=\'{$item.id_module}view\']').addClass('label_checked');
    {literal}}{/literal}"/><label for="{$item.id_module}del" class="label">usunięcie</label>
    <input type="hidden" name="data[m][{$item.id_module}][contr]" / value="1"></td>
</tr>
   {/if}
  {/foreach}
{/foreach}
</tbody>
      </table>
    </td>
  </tr>
  {/if}
  
  <tr><td colspan="2">&nbsp;</td></tr>
  
  
  <tr>
    <td class='lewa'>Data dadania: </td>
    <td class='prawa'>
      {$data.added}
    </td>
  </tr>
  <tr>
    <td class='lewa'>Data modyfikacji: </td>
    <td class='prawa'>
      {$data.modified}
    </td>
  </tr>
  <tr>
    <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
    	<img src='{#imgDir#}ico-anuluj.gif' onclick='location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}"' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />
      <input type='hidden' name='confirms' value='1' />
      <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
      <input type='hidden' name='data[id]' value='{$data.id}' />
    	<img src='{#imgDir#}ico-usun.gif' onclick='if(confirm("Jeśli chcesz usunać kliknij [OK]\nJeśli nie [Anuluj]"))location.href="index.php?{$mainParameterName}={$mainParameterValue}&amp;act=del&amp;id={$data.id}"' onmouseover="this.src='{#imgDir#}ico-usun-over.gif'" onmouseout="this.src='{#imgDir#}ico-usun.gif'" class='icon' />
    </td>
  </tr>
</table>
</form>