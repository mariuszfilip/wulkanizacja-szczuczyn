<form action='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&act=gallerys&id={$id_exhibit}' name='search_{$mainParameterValue}' method='post'>  
<table class="list" style='width: 100%;' border='0' id='lista' cellspacing='1' cellpadding='1'>
<thead>
  <tr>
    <th style='text-align: left; width: 100%;padding-left:10px;' colspan='2'>Wyszukiwarka</th>
  </tr>
</thead>
  <tr class='even'>
    <td align='left' valign='middle' style='width:45%;'>
      <b>Nazwa</b><br>
      <input type='text' size='20' name='s_{$mainParameterValue}[name]' value='{$s_gallery.name}' class='form-text'>
    </td>
    <td align='center' valign='middle'>
      <input type='submit' value='szukaj' name='search_{$mainParameterValue}' class='form-button' style='color: green;' />
    </td>
  </tr>
</table>
</form>  