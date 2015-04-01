  {include file="main/templates/errors.tpl"}
    {include file="payment/templates/search.tpl"}
<div style='text-align: right;'>
  <table style="width:100%">
    <tr>
      <td><div style="width:22px; height:22px;">&nbsp;</div>
        {*<!--img src="{#imgDir#}ico-dodaj.gif" class="icon" alt="dodaj" onclick="location.href='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=add'" /-->*}
      </td>
    </tr>
  </table>
</div>
<table class="list" style='width: 100%;' border='0' id='lista' cellspacing='0' cellpadding='0'>
  <thead>
    <tr>
      <td style='text-align: center; width: 5%; padding-right:5px;'>Lp.</td>
<td style="text-align: left; width: 18%;"><a id="txn_idSort" href="javascript:changeSort('txn_id')" title="Sortowanie po Identyfikator transakcji">Identyfikator transakcji</a></td>
<td style="text-align: left; width: 18%;"><a id="payer_emailSort" href="javascript:changeSort('payer_email')" title="Sortowanie po Paipal ID">Paypal ID</a></td>
<td style="text-align: right; width: 18%;"><a id="mc_gross_1Sort" href="javascript:changeSort('mc_gross_1')" title="Sortowanie po Kwota">Kwota</a></td>
<td style="text-align: center; width: 18%;"><a id="addedSort" href="javascript:changeSort('added')" title="Sortowanie po Data transakcji">Data transakcji</a></td>
<td style="text-align: center; width: 18%;"><a id="activeSort" href="javascript:changeSort('active')" title="Sortowanie po Status">Status</a></td>
      <td style='text-align: center; width: 5%;'></td>
    </tr>
  </thead>
  <tbody id="dataTable">
  </tbody>
  <tr style="height:1px;"><td colspan="7"><img src="css/img/1px.gif" height="1px" /></td></tr>
<thead>
  <tr>
    <td colspan="7" style="padding-left:10px;padding-right:10px;">
      <span id="dataStats" style="float: left; font-weight: bold;"></span>
	  <span id="dataPages" style="float: left; width: 60%; text-align: center;"></span>
      <span style="float: right">
        <a id="btnFirst" style="margin-right:7px;" href="javascript:changePage(-currentPage)" title="Pierwsza strona">&laquo;&laquo;</a>
        <a id="btnPrev" style="margin-right:7px;" href="javascript:changePage(-1)" title="Poprzednia strona">&laquo;</a>
        <a id="btnNext" style="margin-right:7px;" href="javascript:changePage(1)" title="Następna strona">&raquo;</a>
        <a id="btnLast" href="javascript:changePage(maxPage-currentPage-1)" title="Ostatnia strona">&raquo;&raquo;</a>
      </span>
    </td>
  </tr>
</thead>
</table>