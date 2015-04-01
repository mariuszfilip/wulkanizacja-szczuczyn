{config_load file="smarty.conf" section="admin"}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title>{$smarty.const.SITE_NAME}</title>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<link rel='stylesheet' type='text/css' href='{#cssDir#}style.css' />
	<link rel='stylesheet' type='text/css' href='{#cssDir#}lytebox.css' />
    <link rel="shortcut icon" href="css/img/fav.ico" />
    <meta name="robots" content="noindex,nofollow"> 
	<style type="text/css">@import url(css/calendar-blue.css);</style>

 <script type="text/javascript" src="js/jquery.js"></script>
 <script type="text/javascript">
     jQuery.noConflict();
  </script>
  
  <script type="text/javascript" src="../lib/ckeditor/ckeditor.js"></script>
   
  <script type="text/javascript" src="js/jqueryblockui.js"></script>
  <script type="text/javascript" src="js/scripts.js"></script>
  <script type="text/javascript" src="js/advajax.js"></script>
  <script type="text/javascript" src="js/dataTable.js"></script>
  <script type='text/javascript' src='js/tigra_tables.js'></script>
  {if $page_tree_drag_and_drop}
  {include file="page/templates/drag_drop_header.tpl"}
  {elseif $catalog_tree_drag_and_drop}
  {include file="catalog/templates/drag_drop_header.tpl"}
  {else}
  <script type="text/javascript" src="js/prototype.js"></script>
  <script type="text/javascript" src="js/scriptaculous.js?load=effects,slider"></script>
  {/if}
  
  {if $smarty.get.mod eq 'operator' || $smarty.get.mod eq 'gallery' || $smarty.get.mod eq 'ankieta' || $smarty.get.mod eq 'file'}
	<link rel='stylesheet' type='text/css' href='css/drag-drop-tree.css' />

  {/if}  

  {if $smarty.server.PHP_SELF|explode:"/" neq 'popup.php'}<script type="text/javascript" src="js/lytebox.js"></script>{/if}

  <script type="text/javascript" src="js/calendar.js"></script>
  <script type='text/javascript' src='js/swfobject.js'></script>

  {php}
if($_SESSION['sort'][$_GET['mod']]){
$aktywna = explode(" ", $_SESSION['sort'][$_GET['mod']]);
echo '<script type="text/javascript">
function sortowanie_sesji(){
if( $("'.$aktywna[0].'" + "Sort") ){
  //$("'.$aktywna[0].'" + "Sort").style.fontWeight = "bold";
	$("'.$aktywna[0].'" + "Sort").up("td").className="sort";
  currentSort = "'.$aktywna[0].'";
  currentSortOrder = "'.$aktywna[1].'";
}
if("'.$aktywna[1].'" == "ASC" && $("'.$aktywna[0].'" + "Sort")) $("'.$aktywna[0].'" + "Sort").className = "ASC";
else if("'.$aktywna[1].'" == "DESC" && $("'.$aktywna[0].'" + "Sort")) $("'.$aktywna[0].'" + "Sort").className = "DESC";
}
</script>';
}else{
echo '<script type="text/javascript">function sortowanie_sesji(){return true;}</script>';
}
{/php}
<script type="text/ecmascript">
 {if $smarty.get.iframe_name && $smarty.get.iframe_id}
 	var iframe_name='{$smarty.get.iframe_name}';
	var iframe_id='{$smarty.get.iframe_id}';
 {else}
 	var iframe_name='';
	var iframe_id='';
 {/if}

 {literal}
 function OnLoadDynamicData(){
 	if($("dataStats")) {
		initDynamicTable('{/literal}{$smarty.get.mod}{literal}');
		sortowanie_sesji();
	}
 } 
 {/literal}
</script>

</head>
<body onload="OnLoadDynamicData();">
{firefox_detect}
{if !$firefox}
<div class="firefox_close"><a href="javascript:;" title="zamknij to ostrzeżenie" onclick="hide_firefox();">x</a></div>
<div class="firefox firefox_div"><img src="css/img/firefox.png" alt="" style="vertical-align:middle; margin:0 15px 0 0;" />
  Niektóre funkcje panelu nie są obsługiwane przez tą przeglądarkę. Zaleca się korzystanie z przeglądarki Mozilla Firefox. 
  Kliknij <a href="http://www.mozilla-europe.org/pl/firefox/" style="color:#3594bf; text-decoration:none;" target="_blank">tutaj</a> aby ją pobrać.
</div>
{/if}

<div id="loader_js" style="text-align:center; display:none; vertical-align:middle; z-index:99999; opacity: 0.60; position:absolute; left:50%; top:50%; width:75px; height:66px; background: url(css/img/sns_logo.png); background-repeat:no-repeat; cursor:wait;"><img style="padding-top:28px;" src="css/img/ajax-loader.gif" /></div>
<div id="all_page">
<div class="header">
	<h2 onclick="document.location.href='{$smarty.const.SITE_ADDRESS}'" style="cursor:pointer">{$smarty.const.SITE_NAME}</h2>
  <h2 class="przejdz"><a href="../">przejdź do strony</a></h2>
  <h3><a href='#' target='_blank'><img width="90px" height="30px" src="css/img/inselis.png" alt="Inselis - Mariusz Filipkowski" /></a></h3>
</div>

<table border='0' cellspacing='0' cellpadding='0' align='center' valign='top' style='width:99%;'>
	<tr>
		<td class='content'>