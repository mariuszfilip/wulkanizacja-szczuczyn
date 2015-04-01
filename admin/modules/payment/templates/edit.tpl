  {include file="main/templates/errors.tpl"}
<form name='editform' enctype='multipart/form-data' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$data.id}">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
<tr>
  <td class='lewa' style='width:15%;'>Zamówienie:</td>
  <td class='prawa' style='width:85%;'>
    <a onclick="this.target='_blank'" href="./?mod=order&act=edit&id={$data.id_order}">pokaż zamówienie</a>
  </td>
</tr><!-- wybierz jedna fomre zapisu -->
<tr>
  <td class='lewa'>Kwota: </td>
  <td class='prawa'>
    {$data.mc_gross_1} $
  </td>
</tr>

<tr>
  <td class='lewa'>ID transakcji: </td>
  <td class='prawa'>
    {$data.txn_id}
  </td>
</tr>

<tr>
  <td class='lewa' style='width:15%;'>Paypal ID:</td>
  <td class='prawa' style='width:85%;'>
    {$data.payer_email}
  </td>
</tr><tr>
  <td class='lewa'>Status: </td>
  <td class='prawa'>
    
    <input type='radio' name='data[active]' value='1' id='status1' {if !$data.active || $data.active eq 1}checked='checked'{/if} /> <label for='status1'>w trakcie</label>
    
    <input type='radio' name='data[active]' value='2' id='status2' {if $data.active eq 2}checked='checked'{/if} /> <label for='status2'>opłacono</label>
    
    <input type='radio' name='data[active]' value='3' id='status3' {if $data.active eq 3}checked='checked'{/if} /> <label for='status3'>zaksięgowano</label>
  </td>
</tr>
<!-- submit edycji rekordu -->
<tr>
  <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
  	<img src='{#imgDir#}ico-anuluj.gif' onclick='location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}"' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />
    <input type='hidden' name='confirms' value='1' />
    <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
    <input type='hidden' name='data[id]' value='{$data.id}' />
  	<img src='{#imgDir#}ico-usun.gif' onclick='if(confirm("Jeśli chcesz usunać kliknij [OK]\nJeśli nie [Anuluj]"))location.href="index.php?{$mainParameterName}={$mainParameterValue}&amp;act=del&amp;id={$data.id}"' onmouseover="this.src='{#imgDir#}ico-usun-over.gif'" onmouseout="this.src='{#imgDir#}ico-usun.gif'" class='icon' />
  </td>
</tr></table>
</form>