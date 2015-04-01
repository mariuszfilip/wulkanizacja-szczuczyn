  {include file="main/templates/errors.tpl"}
  {include file="order/templates/search.tpl"}
  
<div style='text-align: right;'>
  <table style="width:100%;">
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
<td style="text-align: left; width: 10%;"><a id="serviceSort" href="javascript:changeSort('service')" title="Sortowanie po Usługa">Usługa</a></td>
<td style="text-align: left; width: 10%;"><a id="order.nameSort" href="javascript:changeSort('order.name')" title="Sortowanie po Imię i nazwisko">Imię i nazwisko</a></td>

<td style="text-align: left; width: 10%;"><a id="emailSort" href="javascript:changeSort('email')" title="Sortowanie po E-mail">E-mail</a></td>
<td style="text-align: left; width: 10%;"><a id="phoneSort" href="javascript:changeSort('phone')" title="Sortowanie po Telefon">Telefon</a></td>

<td style="text-align: right; width: 10%;"><a id="`order`.`price`Sort" href="javascript:changeSort('`order`.`price`')" title="Sortowanie po kwocie przedpłaty">Przedpłata</a></td>

<td style="text-align: right; width: 10%;"><a id="`service`.`price`Sort" href="javascript:changeSort('`service`.`price`')" title="Sortowanie po faktycznej cenie usługi">Cena całkowita</a></td>

<td style="text-align: center; width: 10%;"><a id="`order`.`added`Sort" href="javascript:changeSort('`order`.`added`')" title="Sortowanie po dacie złożenia zamówienia">Dodano</a></td>

<td style="text-align: center; width: 10%;"><a id="`order`.`active`Sort" href="javascript:changeSort('`order`.`active`')" title="Sortowanie po statusie zamówienia">Status</a></td>

<td style="text-align: center; width: 10%;"><a id="payedSort" href="javascript:changeSort('payed')" title="Sortowanie po statusie płatności">Opłacono</a></td>


      <td style='text-align: center; width: 5%;'></td>
    </tr>
  </thead>
  <tbody id="dataTable">
  </tbody>
  <tr style="height:1px;"><td colspan="11"><img src="css/img/1px.gif" height="1px" /></td></tr>
<thead>
  <tr>
    <td colspan="11" style="padding-left:10px;padding-right:10px;">
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