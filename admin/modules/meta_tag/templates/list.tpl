<div style='text-align: right;'>
  <table style="width:100%">
    <tr>
      <td>
        <img src="{#imgDir#}ico-dodaj.gif" class="icon" alt="dodaj" onclick="location.href='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=add'" />
      </td>
    </tr>
  </table>
</div>
<table class="list" style='width: 100%;' border='0' id='lista' cellspacing='0' cellpadding='0'>
  <thead>
    <tr>
      <td style='text-align: right; width: 5%; padding-right:5px;'>Lp.</td>
<td style="text-align: left; width: 22%;"><a id="meta_titleSort" href="javascript:changeSort('meta_title')" title="Sortowanie po meta title">meta title</a></td>
<td style="text-align: left; width: 22%;"><a id="meta_keywordsSort" href="javascript:changeSort('meta_keywords')" title="Sortowanie po meta keywords">meta keywords</a></td>
<td style="text-align: left; width: 22%;"><a id="meta_descriptionSort" href="javascript:changeSort('meta_description')" title="Sortowanie po meta description">meta description</a></td>
<td style="text-align: left; width: 22%;"><a id="meta_robotsSort" href="javascript:changeSort('meta_robots')" title="Sortowanie po meta robots">meta robots</a></td>
      <td style='text-align: center; width: 5%;'></td>
    </tr>
  </thead>
  <tbody id="dataTable">
  </tbody>
  <tr style="height:1px;"><td colspan="6"><img src="css/img/1px.gif" height="1px" /></td></tr>
<thead>
  <tr>
    <td colspan="6" style="padding-left:10px;padding-right:10px;">
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