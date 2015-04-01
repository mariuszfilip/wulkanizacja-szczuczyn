<table class="search_list"  style='width: {if !$smarty.session.show_search[$mainParameterValue]}125px{else}100%{/if}; ' id='search_list' cellspacing='0' cellpadding='0'>
<thead>
  <tr>
    <th style='text-align: left; width: 100%;padding-left:10px;'><a href="javascript:;" onclick="change_search('{$mainParameterValue}');">Wyszukiwarka <img src="./img/{if !$smarty.session.show_search[$mainParameterValue]}un{/if}visible.png" style="margin-bottom:-5px;" id="search_img" /></a></th>
  </tr>
</thead>
</table>
<div id="search_body" class="search_body" {if !$smarty.session.show_search[$mainParameterValue]}style="display:none;"{/if}>
<form action='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}' method='post' style="margin-bottom:4px;">
<table border='0' cellspacing='0' cellpadding='0'>
  <tr class='even'>
    <td align='left' valign='middle' style='padding:5px;'>
    <b>ID transakcji</b><br>
   <input type='text' size='16' name='s_{$mainParameterValue}[txn_id]' value='{$s_payment.txn_id}' class='form-text'>
    </td>
    
    <td align='left' valign='middle' style='padding:5px;'>
    <b>Paypal ID</b><br>
    <input type='text' size='16' name='s_{$mainParameterValue}[payer_email]' value='{$s_payment.payer_email}' class='form-text'>
    </td>

    <td align='left' valign='middle' style='padding:5px;'>
      <b>Kwota od</b><br>
      <input type='text' size='6' name='s_{$mainParameterValue}[price_from]' value='{$s_payment.price_from}' class='form-text'> $
    </td>

    <td align='left' valign='middle' style='padding:5px;'>
      <b>Kwota do</b><br>
      <input type='text' size='6' name='s_{$mainParameterValue}[price_to]' value='{$s_payment.price_to}' class='form-text'> $
    </td>
    
    
    <td align='left' valign='middle' style='padding-left:3px;'>
      <b>Data transakcji od</b><br>
      
       <input type='text' class='form-text' maxlength="10" name='s_{$mainParameterValue}[date_from]' value="{$s_payment.date_from}" readonly='readonly' id='dataarea' style='width: 60px;' /><img src='css/img/calendar_low.gif' id='trigger' class='cal-button' alt='wybierz date' title='wybierz date' /> <img src="css/img/gumka.png" alt="wyczysc" id="eraser" title="wyczysc" class="gumka" />
    {literal}
            <script type="text/javascript">
            Calendar.setup(
              {
                  inputField  : "dataarea",
                  button      : "trigger",
                  eraser      : "eraser"
              }
            );
            </script>
          {/literal}
    </td>
    <td align='left' valign='middle' style='padding-left:3px;'>
      <b>Data transakcji do</b><br>
<input type='text' class='form-text' maxlength="10" name='s_{$mainParameterValue}[date_to]' value="{$s_payment.date_to}" readonly='readonly' id='dataarea2' style='width: 60px;' /><img src='css/img/calendar_low.gif' id='trigger2' class='cal-button' alt='wybierz date' title='wybierz date' /> <img src="css/img/gumka.png" alt="wyczysc" id="eraser2" title="wyczysc" class="gumka" />

            {literal}<script type="text/javascript">
            Calendar.setup(
              {
                  inputField  : "dataarea2",
                  button      : "trigger2" ,
                  eraser      : "eraser2"
              }
            );
            </script>{/literal}

    </td> 
    
    <td align='left' valign='middle' style='padding:5px;'>
      <b>Status</b><br>
      <select class="form-select" name="s_{$mainParameterValue}[payed]" style="width:98px">
        <option value="">bez znaczenia</option>
        <option value="1" {if $s_payment.payed eq '1'}selected="selected"{/if}>w trakcie</option>
        <option value="2" {if $s_payment.payed eq '2'}selected="selected"{/if}>oplacono</option>
        <option value="3" {if $s_payment.payed eq '3'}selected="selected"{/if}>zaksiegowano</option>
      </select>
    </td>       

    <td align='center' valign='middle' style='padding:5px;'>
      <input type='submit' value='szukaj' name='search_{$mainParameterValue}' class='form-button' />
    </td>
  </tr>


</table>
</form>
</div>