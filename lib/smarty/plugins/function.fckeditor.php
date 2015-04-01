<?php
function smarty_function_fckeditor($params, &$smarty)  {
	$e = new FCKeditor( $params['name'] );
	if($_SESSION['user']['id_operator'] > 0){
		$e->isAdmin = true;
	}else{
		$e->isAdmin = false;
	}
	$e->BasePath = '../lib/FCKeditor/';
if($params['path']) $e->BasePath = $params['path'];
	$e->Value = $params['value'];
	$e->Height = $params['height'];
	$e->Width = $params['width'];


	if( !empty( $params['toolbar'] ) )  {
		$e->ToolbarSet = $params['toolbar'];
	}
	$e->Create();
}
?>