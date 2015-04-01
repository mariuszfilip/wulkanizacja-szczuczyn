<table class="search_list"  style='width: {if !$smarty.session.show_search[$mainParameterValue]}125px{else}100%{/if}; ' id='search_list' cellspacing='0' cellpadding='0'>
<thead>
  <tr>
    <th style='text-align: left; width: 100%;padding-left:10px;'><a href="javascript:;" onclick="change_search('{$mainParameterValue}');">Wyszukiwarka <img src="./img/{if !$smarty.session.show_search[$mainParameterValue]}un{/if}visible.png" style="margin-bottom:-5px;" id="search_img" /></a></th>
  </tr>
</thead>
</table>
<div id="search_body" class="search_body" {if !$smarty.session.show_search[$mainParameterValue]}style="display:none;"{/if}>
<form action='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}' method='post' style="margin-bottom:4px;">
<table cellspacing='0' cellpadding='0'>
  <tr class='even'>
    <td align='left' valign='middle' style='padding:5px;'>
    <b>Usługa</b><br>
   <input type='text' size='18' name='s_{$mainParameterValue}[service]' value='{$s_order.service|escape|stripslashes}' class='form-text'>
    </td>
    
    <td align='left' valign='middle' style='padding:5px;'>
    <b>Imię i nazwisko</b><br>
   <input type='text' size='18' name='s_{$mainParameterValue}[name]' value='{$s_order.name|escape|stripslashes}' class='form-text'>
    </td>
    
    <td align='left' valign='middle' style='padding:5px;'>
    <b>Email</b><br>
    <input type='text' size='18' name='s_{$mainParameterValue}[email]' value='{$s_order.email|escape|stripslashes}' class='form-text'>
    </td>
    
    <td align='left' valign='middle' style='padding:5px;' colspan="2">
    <b>Telefon</b><br>
    <input type='text' size='18' name='s_{$mainParameterValue}[phone]' value='{$s_order.phone|escape|stripslashes}' class='form-text'>
    </td>
    
    </tr>
    
    <tr>

    <td align='left' valign='middle' style='padding:5px;'>
      <b>Przedpłata</b><br>
      od: <input type='text' size='4' name='s_{$mainParameterValue}[order_price_from]' value='{$s_order.order_price_from}' class='form-text'> $

      do: <input type='text' size='4' name='s_{$mainParameterValue}[order_price_to]' value='{$s_order.order_price_to}' class='form-text'> $
    </td>
    
    
    <td align='left' valign='middle' style='padding:5px;'>
      <b>Cena</b><br>
      od: <input type='text' size='4' name='s_{$mainParameterValue}[price_from]' value='{$s_order.price_from}' class='form-text'> $

      do: <input type='text' size='4' name='s_{$mainParameterValue}[price_to]' value='{$s_order.price_to}' class='form-text'> $
    </td>

    <td align='left' valign='middle' style='padding:5px;'>
      <b>Status</b><br>
      <select class="form-select" name="s_{$mainParameterValue}[active]" style="width:98px">
        <option value="">bez znaczenia</option>
        <option value="Y" {if $s_order.active eq 'Y'}selected="selected"{/if}>wysłano</option>
        <option value="N" {if $s_order.active eq 'N'}selected="selected"{/if}>niewysłano</option>
      </select>
    </td>
    
    
    <td align='left' valign='middle' style='padding:5px;'>
      <b>Opłacono</b><br>
      <select class="form-select" name="s_{$mainParameterValue}[payed]" style="width:98px">
        <option value="">bez znaczenia</option>
        <option value="1" {if $s_order.payed eq '1'}selected="selected"{/if}>w trakcie</option>
        <option value="2" {if $s_order.payed eq '2'}selected="selected"{/if}>opłacono</option>
        <option value="3" {if $s_order.payed eq '3'}selected="selected"{/if}>zaksięgowano</option>
      </select>
    </td>
    
    
    
    <td align='center' valign='middle' style='padding:5px;'>
      <input type='submit' value='szukaj' name='search_{$mainParameterValue}' class='form-button' />
    </td>
  </tr>


</table>
</form>
</div>