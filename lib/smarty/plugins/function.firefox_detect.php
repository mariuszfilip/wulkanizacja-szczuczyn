<?php
 /**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {firefox_detect} function plugin
 *
 * Type:     function<br>
 * Name:     firefox_detect<br>
 * Date:     2.10.2004<br>
 * Purpose:  Detect Firefox browser<br>
 * Input:<br>
 *
 * Example:   
 *  {firefox_detect}
 *  {if $firefox}
 *  <link rel="stylesheet" type="text/css" href="only-firefox.css" />
 *  {else}
 *  <link rel="stylesheet" type="text/css" href="not-firefox.css" />
 *  {/if}
 * @link http://smartbee.sourceforge.net/
 * @author   SNS <lukasz@sns.pl>
 * @version  1.0
 * @param null
 * @param Smarty
 * @return boolen
 */ 

function smarty_function_firefox_detect($params, &$smarty)
{
  $firefox = strpos($_SERVER["HTTP_USER_AGENT"], 'Firefox') ? true : false;
  if(!$firefox){
	$chrome = strpos($_SERVER["HTTP_USER_AGENT"], 'AppleWebKit') ? true : false;
	if($chrome){
		$firefox = true;
	}else{
		$opera = strpos('_'.$_SERVER["HTTP_USER_AGENT"], 'Opera/') ? true : false;
		if($opera){
			$version =  substr($_SERVER["HTTP_USER_AGENT"],6,5);
			if( (float)$version >=9.8) $firefox = true;			
		}
	}
  }  
  if($firefox) $smarty->assign('firefox', $firefox);  
}

/* vim: set expandtab: */ 

?>
