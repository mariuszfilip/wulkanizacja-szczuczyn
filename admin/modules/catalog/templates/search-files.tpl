<form action='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}' name='search_{$mainParameterValue}' method='post'>
<table class="list" style='width: 100%;' border='0' id='lista' cellspacing='1' cellpadding='1'>
<thead>
  <tr>
    <th style='text-align: left; width: 100%;padding-left:10px;' colspan='4'>Wyszukiwarka</th>
  </tr>
</thead>
  <tr class='even'>
    <td align='left' valign='middle' style='width:25%;'>
      <b>Nazwa</b><br>
      <input type='text' size='20' name='s_{$mainParameterValue}[name]' value='{$s_exhibit.name}' class='form-text'>
    </td>
    <td align='left' valign='middle' style='width:25%;'>
      <b>Data rozpoczęcia</b><br>
      <input type='text' class='form-text' maxlength="10" name='s_{$mainParameterValue}[date_from]' value="{$s_exhibit.date_from}" readonly='readonly' id='dataarea' style='width: 117px;' />
      <input type="image" src='css/img/cal-ico.jpg' id='trigger' class='cal-ico' alt='wybierz datę' title='wybierz datę' />
          {literal}
            <script type="text/javascript">
            Calendar.setup(
              {
                  inputField  : "dataarea",         // ID of the input field
                  button      : "trigger"           // ID of the button
              }
            );
            </script>
          {/literal}
          &nbsp;
      <img src="css/img/cal-erase.gif" alt="wyczyść" onclick='document.getElementById("dataarea").value="";' style="cursor: pointer; position: relative; top: 1px;" align="top">
    </td>
    <td align='left' valign='middle' style='width:25%;'>
      <b>Data zakończenia</b><br>
      <input type='text' class='form-text' maxlength="10" name='s_{$mainParameterValue}[date_to]' value="{$s_exhibit.date_to}" readonly='readonly' id='dataarea' style='width: 117px;' />
      <input type="image" src='css/img/cal-ico.jpg' id='trigger' class='cal-ico' alt='wybierz datę' title='wybierz datę' />
          {literal}
            <script type="text/javascript">
            Calendar.setup(
              {
                  inputField  : "dataarea",         // ID of the input field
                  button      : "trigger"           // ID of the button
              }
            );
            </script>
          {/literal}
          &nbsp;
      <img src="css/img/cal-erase.gif" alt="wyczyść" onclick='document.getElementById("dataarea").value="";' style="cursor: pointer; position: relative; top: 1px;" align="top">
    </td>
    <td align='center' valign='middle'>
      <input type='submit' value='szukaj' name='search_{$mainParameterValue}' class='form-button' style='color: green;' />
    </td>
  </tr>
</table>
</form>