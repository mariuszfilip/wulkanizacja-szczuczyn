<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty count_sentences modifier plugin
 *
 * Type:     modifier<br>
 * Name:     explode
 * Purpose:  tymczasowa na uzytek tylko tego serwisu
 * @author   Lukasz Dziergwa
 * @param string
 * @return string
 */
function smarty_modifier_explode($string, $char="/")
{
    // find periods with a word before but not after.
	$array=explode($char,$string);
	
    return $array[count($array)-1];
}

/* vim: set expandtab: */

?>
