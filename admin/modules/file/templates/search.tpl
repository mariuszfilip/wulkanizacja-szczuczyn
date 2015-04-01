<table class="search_list"  style='width: {if !$smarty.session.show_search[$mainParameterValue]}125px{else}100%{/if}; ' id='search_list' cellspacing='0' cellpadding='0'>
<thead>
  <tr>
    <th style='text-align: left; width: 100%;padding-left:10px;'><a href="javascript:;" onclick="change_search('{$mainParameterValue}');">Wyszukiwarka <img src="./img/{if !$smarty.session.show_search[$mainParameterValue]}un{/if}visible.png" style="margin-bottom:-5px;" id="search_img" /></a></th>
  </tr>
</thead>
</table>
<div id="search_body" class="search_body" {if !$smarty.session.show_search[$mainParameterValue]}style="display:none;"{/if}><form action='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}' name='search_{$mainParameterValue}' method='post'>
<table border='0'  cellspacing='0' cellpadding='1'>

  <tr class='even' style="height:51px;">
    <td align='left' valign='middle' style='width:25%; padding-left:15px;'>
      <b>Nazwa</b><br>
      <input type='text' size='20' name='s_{$mainParameterValue}[name]' value='{$s_file.name|escape|stripslashes}' class='form-text'>
    </td>
    <td align='left' valign='middle' style='width:25%;'>
      <b>Nazwa pliku:</b><br>
      <input type='text' size='20' name='s_{$mainParameterValue}[file_name]' value='{$s_file.file_name|escape|stripslashes}' class='form-text'>
    </td>
    <td align='center' valign='middle'>
      <input type='submit' value='szukaj' name='search_{$mainParameterValue}' class='form-button' style='color: green; margin-top:10px;' />
    </td>
  </tr>
</table>
</form>
</div>