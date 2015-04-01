<table class="search_list"  style='width: {if !$smarty.session.show_search[$mainParameterValue]}125px{else}100%{/if}; ' id='search_list' cellspacing='0' cellpadding='0'>
<thead>
  <tr>
    <th style='text-align: left; width: 100%;padding-left:10px;'><a href="javascript:;" onclick="change_search('{$mainParameterValue}');">Wyszukiwarka <img src="./img/{if !$smarty.session.show_search[$mainParameterValue]}un{/if}visible.png" style="margin-bottom:-5px;" id="search_img" /></a></th>
  </tr>
</thead>
</table>
<div id="search_body" class="search_body" {if !$smarty.session.show_search[$mainParameterValue]}style="display:none;"{/if}>
<form action='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}' method='post'>
<table border='0' cellspacing='0' cellpadding='0'>

  <tr class='even'>
    <td align='left' valign='middle' style='padding:5px;'>
    <b>Kategoria</b><br>
   <input type='text' size='20' name='s_{$mainParameterValue}[catalog_name]' value='{$s_service.catalog_name|escape|stripslashes}' class='form-text'>
    </td>
    
    <td align='left' valign='middle' style='padding:5px;'>
    <b>Nazwa</b><br>
    <input type='text' size='20' name='s_{$mainParameterValue}[name]' value='{$s_service.name|escape|stripslashes}' class='form-text'>
    </td>

    <td align='left' valign='middle' style='padding:5px;'>
      <b>Cena od</b><br>
      <input type='text' size='10' name='s_{$mainParameterValue}[price_from]' value='{$s_service.price_from}' class='form-text'> $
    </td>

    <td align='left' valign='middle' style='padding:5px;'>
      <b>Cena do</b><br>
      <input type='text' size='10' name='s_{$mainParameterValue}[price_to]' value='{$s_service.price_to}' class='form-text'> $
    </td>

    <td align='left' valign='middle' style='padding:5px;'>
      <b>Status</b><br>
      <select class="form-select" name="s_{$mainParameterValue}[active]" style="width:98px">
        <option value="">bez znaczenia</option>
        <option value="Y" {if $s_service.active eq 'Y'}selected="selected"{/if}>aktywny</option>
        <option value="N" {if $s_service.active eq 'N'}selected="selected"{/if}>nieaktywny</option>
      </select>
    </td>
    <td align='center' valign='middle' style='padding:5px;'>
      <input type='submit' value='szukaj' name='search_{$mainParameterValue}' class='form-button' />
    </td>
  </tr>


</table>
</form>
</div>