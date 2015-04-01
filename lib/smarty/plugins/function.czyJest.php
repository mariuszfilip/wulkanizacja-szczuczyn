<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.czyJest.php
 * Type:     function
 * Name:     czyjest
 * Purpose:  sprawdza
 * -------------------------------------------------------------
 */
 
/*
{czyJest tablica=$smarty.session.user.permit.modules zmienna=module_id assign=wynik_m id=$menu.id_module wartosc=view}
czy jest w tablicy 'tablica' zmienna tablicowa zmienna o wartosci id 
{if $wynik_m}Wartosc parametru wynosi 1{/if}	
*/

function smarty_function_czyJest($params, &$smarty)
{
  $wartosc = $params['wartosc'];
  $tablica = $params['tablica'];
  $zmienna = $params['zmienna'];
  $contr = 'false';
  foreach($tablica as $linia){
  	//print $linia.'QQQ';
	
	if($linia==$wartosc)
	{
		$contr = 'true';
		break;
	}
	
  }
$smarty->assign($params['assign'], $contr);
//echo $contr.'AAAAAAAAAAAAAA';
}



?>
