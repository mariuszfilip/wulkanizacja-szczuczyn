<form action='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=files&amp;id={$smarty.get.id}' name='search_{$mainParameterValue}' method='post'>
<table class="list" style='width: 100%;' border='0' id='slista' cellspacing='0' cellpadding='1'>
<thead>
  <tr>
    <th style='text-align: left; width: 100%;padding-left:10px;' colspan='3'>Wyszukiwarka</th>
  </tr>
</thead>
  <tr class='even' valign="middle">
    <td align='left' style='width:33%; padding:7px;'>
      <b>Nazwa</b><br />
      <input type='text' size='20' name='s_file[name]' value='{$s_file.name|escape|stripslashes}' class='form-text'>
    </td>
    
    <td align='left' valign='middle' style='width:33%; padding:7px;'>
      <b>Plik</b><br />
      <input type='text' size='20' name='s_file[file_name]' value='{$s_file.file_name|escape|stripslashes}' class='form-text'>
    </td>
    
    <td align="right" style="padding-right:15px;">
      <input type='submit' value='szukaj' name='search_file' class='form-button' />
    </td>
  </tr>
</table>
</form>