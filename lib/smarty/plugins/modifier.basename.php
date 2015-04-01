<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty plugin
 *
 * Type:     modifier<br>
 * Name:     basename<br>
 * Date:     Mar 28, 2007
 * Purpose:  basename of file
 * Input:<br>
 * Example:  {$smarty.server.PHP_SELF|basename}
 * @version  1.0
 * @author Maciej Soliński
 * @param string
 * @return string
 */
function smarty_modifier_basename($string)
{
    return basename($string);
}

/* vim: set expandtab: */

?>
