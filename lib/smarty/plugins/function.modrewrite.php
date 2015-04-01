<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.modrewrite.php
 * Type:     function
 * Name:     modrewrite
 * Purpose:  create link
 * -------------------------------------------------------------
 */
function smarty_function_modrewrite($params, &$smarty)
{
  $string = $params['name'];
  $string = String::toModerewrite($string);  
  return strtolower($string);
}
?>