<?php /* Smarty version 2.6.18, created on 2013-08-20 22:04:36
         compiled from main/templates/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'main/templates/header.tpl', 1, false),array('function', 'firefox_detect', 'main/templates/header.tpl', 85, false),array('modifier', 'explode', 'main/templates/header.tpl', 40, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => "smarty.conf",'section' => 'admin'), $this);?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title><?php echo @SITE_NAME; ?>
</title>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<link rel='stylesheet' type='text/css' href='<?php echo $this->_config[0]['vars']['cssDir']; ?>
style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo $this->_config[0]['vars']['cssDir']; ?>
lytebox.css' />
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
  <?php if ($this->_tpl_vars['page_tree_drag_and_drop']): ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "page/templates/drag_drop_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <?php elseif ($this->_tpl_vars['catalog_tree_drag_and_drop']): ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "catalog/templates/drag_drop_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <?php else: ?>
  <script type="text/javascript" src="js/prototype.js"></script>
  <script type="text/javascript" src="js/scriptaculous.js?load=effects,slider"></script>
  <?php endif; ?>
  
  <?php if ($_GET['mod'] == 'operator' || $_GET['mod'] == 'gallery' || $_GET['mod'] == 'ankieta' || $_GET['mod'] == 'file'): ?>
	<link rel='stylesheet' type='text/css' href='css/drag-drop-tree.css' />

  <?php endif; ?>  

  <?php if (((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('explode', true, $_tmp, "/") : smarty_modifier_explode($_tmp, "/")) != 'popup.php'): ?><script type="text/javascript" src="js/lytebox.js"></script><?php endif; ?>

  <script type="text/javascript" src="js/calendar.js"></script>
  <script type='text/javascript' src='js/swfobject.js'></script>

  <?php 
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
 ?>
<script type="text/ecmascript">
 <?php if ($_GET['iframe_name'] && $_GET['iframe_id']): ?>
 	var iframe_name='<?php echo $_GET['iframe_name']; ?>
';
	var iframe_id='<?php echo $_GET['iframe_id']; ?>
';
 <?php else: ?>
 	var iframe_name='';
	var iframe_id='';
 <?php endif; ?>

 <?php echo '
 function OnLoadDynamicData(){
 	if($("dataStats")) {
		initDynamicTable(\''; ?>
<?php echo $_GET['mod']; ?>
<?php echo '\');
		sortowanie_sesji();
	}
 } 
 '; ?>

</script>

</head>
<body onload="OnLoadDynamicData();">
<?php echo smarty_function_firefox_detect(array(), $this);?>

<?php if (! $this->_tpl_vars['firefox']): ?>
<div class="firefox_close"><a href="javascript:;" title="zamknij to ostrzeżenie" onclick="hide_firefox();">x</a></div>
<div class="firefox firefox_div"><img src="css/img/firefox.png" alt="" style="vertical-align:middle; margin:0 15px 0 0;" />
  Niektóre funkcje panelu nie są obsługiwane przez tą przeglądarkę. Zaleca się korzystanie z przeglądarki Mozilla Firefox. 
  Kliknij <a href="http://www.mozilla-europe.org/pl/firefox/" style="color:#3594bf; text-decoration:none;" target="_blank">tutaj</a> aby ją pobrać.
</div>
<?php endif; ?>

<div id="loader_js" style="text-align:center; display:none; vertical-align:middle; z-index:99999; opacity: 0.60; position:absolute; left:50%; top:50%; width:75px; height:66px; background: url(css/img/sns_logo.png); background-repeat:no-repeat; cursor:wait;"><img style="padding-top:28px;" src="css/img/ajax-loader.gif" /></div>
<div id="all_page">
<div class="header">
	<h2 onclick="document.location.href='<?php echo @SITE_ADDRESS; ?>
'" style="cursor:pointer"><?php echo @SITE_NAME; ?>
</h2>
  <h2 class="przejdz"><a href="../">przejdź do strony</a></h2>
  <h3><a href='#' target='_blank'><img width="90px" height="30px" src="css/img/inselis.png" alt="Inselis - Mariusz Filipkowski" /></a></h3>
</div>

<table border='0' cellspacing='0' cellpadding='0' align='center' valign='top' style='width:99%;'>
	<tr>
		<td class='content'>