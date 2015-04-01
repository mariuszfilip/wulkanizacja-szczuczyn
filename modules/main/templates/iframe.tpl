{config_load file=$smarty.session.lang|lower}


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="{$smarty.const.SITE_ADDRESS}" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name='author' content='{$page.const.author}' />

<link rel="stylesheet" href="css/style.css" media="screen" />

<!--[if lte IE 6]>
<link rel="stylesheet" type="text/css" href="css/ie.css" />
<![endif]-->
<!--[if gt IE 6]>
<link rel="stylesheet" type="text/css" href="css/ie.css" />
<![endif]--> 
<script src="js/jquery-1.2.3.pack.js" type="text/javascript"></script>

<style>{literal}
	body {
overflow-x: hidden;

}{/literal}
</style>
</head>



<body style="margin: 0 0 0 0; background-color:#FFF; text-align:left; font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:0 0 0 0;">


	{if $moduletpl != ''}
      {include file=$moduletpl}
    {/if}


</body>
</html>


