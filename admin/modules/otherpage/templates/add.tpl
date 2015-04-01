  {include file="main/templates/errors.tpl"}
<form name='editform' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=add">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
  <tr>
    <td class='lewa'>Nazwa:</td>
    <td class='prawa'>
      <input class="form-text" type="text" id='name' name="data[name]" value='{$data.name|escape}' style='width: 400px;' />
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