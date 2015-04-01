<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty to_roman modifier plugin
 *
 * Type:     modifier
 * Name:     to_roman
 * Purpose:  convert arabic digits to roman
 * @author   Lukasz Dziergwa
 * @param string
 * @return string
 */

function smarty_modifier_to_roman($string)
{
  $r1   = array('I','II','III','IV','V','VI','VII','VIII','IX');
  $r10  = array('X','XX','XXX','XL','L','LX','LXX','LXXX','XC');
  $r100 = array('C','CC','CCC','CD','D','DC','DCC','DCCC','CM');

  # pobieramy cyfry arabskie
  $a1    = $string%10;
  $string    = ($string-$a1)/10;
  $a10   = $string%10;
  $string    = ($string-$a10)/10;
  $a100  = $string%10;
  $a1000 = ($string-$a100)/10;

  # tworzymy liczby rzymskie
  for ($i=0,$out=''; $i<$a1000; $i++) { $out .= 'M'; }
  if ($a100) { $out .= $r100[$a100-1]; }
  if ($a10)  { $out .= $r10[$a10-1]; }
  if ($a1)   { $out .= $r1[$a1-1]; }

  return($out);
}

?>