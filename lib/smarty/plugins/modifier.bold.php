<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty bold modifier plugin
 *
 * Type:     modifier<br>
 * Name:     bold<br>
 * Purpose:  convert string to bolder
 * @author   Adam Mackiewicz
 * @param string
 * @return string
 */
function smarty_modifier_bold($string)
{
    return '<span style=\'font-weight: bold;\'>'. $string .'</span>';
}

?>
