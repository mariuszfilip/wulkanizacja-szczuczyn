<?php

/**
 * Zmienia kodowanie stringa na odpowiednie
 *
 * @param array $params
 * @param object $smarty
 * @return string
 */
function smarty_function_iconv($params, &$smarty)  {
	$in 		= $params['in'];
	$out 		= $params['out'];
	$string = $params['value'];
	$string = iconv($in,$out,$string);
	return $string;
}

?>