{include file="main/templates/errors.tpl"}
<form name='editform' method="post" action="index.php?{$mainParameterName}={$mainParameterValue}&amp;act=add">
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
  <tr>
    <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
    	<img src='{#imgDir#}ico-anuluj.gif' onclick='location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}"' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />
      <input type='hidden' name='confirms' value='1' />
      <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
    </td>
  </tr>
</table>
</form>
