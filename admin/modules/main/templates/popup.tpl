{config_load file="smarty.conf" section="admin"}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title>{$smarty.const.SITE_NAME}</title>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<link rel='stylesheet' type='text/css' href='{#cssDir#}style.css' />
	<link rel='stylesheet' type='text/css' href='{#cssDir#}lytebox.css' />
	<style type="text/css">@import url(css/calendar-blue.css);</style>
	<style type="text/css">

</style>
 <script type="text/javascript" src="js/jquery.js"></script>
 <script type="text/javascript">
     jQuery.noConflict();
  </script>
  <script type="text/javascript" src="js/scripts.js"></script>
  <script type="text/javascript" src="js/advajax.js"></script>
  <script type="text/javascript" src="js/dataTable.js"></script>
  <script type='text/javascript' src='js/tigra_tables.js'></script>
  <script type="text/javascript" src="js/prototype.js"></script>
  <script type="text/javascript" src="js/scriptaculous.js?load=effects"></script>

  {if $smarty.server.PHP_SELF|explode:"/" neq 'popup.php'}<script type="text/javascript" src="js/lytebox.js"></script>{/if}


  <script type="text/javascript" src="js/calendar.js"></script>
  <script type="text/javascript" src="js/calendar-mypl.js"></script>
  <script type="text/javascript" src="js/calendar-setup.js"></script>
  {*<!-- <script type="text/javascript" src="js/jquery.js"></script>
 <script type="text/javascript" src="js/dataQuestionTable.js"></script>-->*}
  {php}
if($_SESSION['sort'][$_GET['mod']]){
$aktywna = explode(" ", $_SESSION['sort'][$_GET['mod']]);
echo '<script type="text/javascript">
function sortowanie_sesji(){
if( $("'.$aktywna[0].'" + "Sort") ){
  $("'.$aktywna[0].'" + "Sort").style.fontWeight = "bold";
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
<body onload="OnLoadDynamicData();" style="background:#FFF">
<div id="loader_js" style="text-align:center; display:none; vertical-align:middle; z-index:99999; opacity: 0.45; position:absolute; left:50%; top:50%; width:75px; height:66px; background: url(css/img/sns_logo.png); background-repeat:no-repeat;"><img style="padding-top:28px;" src="css/img/ajax-loader.gif" /></div>

<table id="popup_table" border='0' cellspacing='0' cellpadding='0' class="zawartosc" style='width:98%; margin-left:1%;
border:#CDCDCE 1px solid;;'>
	<tr>
		<td style='vertical-align: top;width: 100%'>
		{*include file="main/templates/popup-menu-top.tpl"*}
		{*include file="main/templates/errors.tpl"*}
			<table border='0' cellspacing='0' cellpadding='0' style='width: 100%;'>
				<tr>
					<td class='box-content' style='text-align: center;'>
					 {if $moduletpl ne ''}
					   {include file=$moduletpl}
					 {/if}
					 {if isset($debug) && $debug == true}
					   {include file="main/templates/debug.tpl"}
					 {/if}
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
{literal}
<script type="text/javascript">
	<!--
	if (document.getElementById('lista') != null) {
		tigra_tables('lista', 1, 0, '#fefefe', '#f5f5f5', '#ecffbf', '#e5e5e5');
	}
	
	if (document.getElementById('lista2') != null) {
		tigra_tables('lista2', 1, 0, '#fefefe', '#f5f5f5', '#ecffbf', '#e5e5e5');
	}
	// -->
</script>
{/literal}
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="js/pngfix.js"></script>
<![endif]-->

</body>
</html>
{*literal}
<script>
<!--
var popup_table = document.getElementById("popup_table");
margin_h = 140;
margin_w = 28;

if (parseInt(navigator.appVersion)>3) {
 if (navigator.appName=="Netscape") {
  winW = window.innerWidth;
  winH = window.innerHeight;
 }
 if (navigator.appName.indexOf("Microsoft")!=-1) {
  winW = document.body.offsetWidth;
  winH = document.body.offsetHeight;
 }
}

if( (popup_table.offsetHeight + margin_h)<screen.height && (popup_table.offsetWidth + margin_w)<screen.width ){
	window.resizeTo(popup_table.offsetWidth + margin_w, popup_table.offsetHeight + margin_h);
	self.moveTo( (screen.width-winW)/2, (screen.height-winH)/2 );
}
// -->
</script>
{/literal*}