{config_load file="smarty.conf" section="admin"}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title>{$smarty.const.SITE_NAME} :: DEBUGER</title>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <link rel='stylesheet' type='text/css' href='admin/css/ajax_debuger.css' />
    <link rel="shortcut icon" href="{$smarty.const.ADMIN_DIR}css/img/fav.ico" />
    <meta name="robots" content="noindex,nofollow">     
    <script type="text/javascript" src="admin/js/jquery.js"></script>
 	<script type="text/javascript">
		jQuery.noConflict();
  	</script>
    <script type="text/javascript" src="admin/js/prototype.js"></script>
    <script type="text/javascript">{literal}
	function getDebug(){
		window.opener.ajax_debuger_window = this.window;
		new Ajax.Request('ajax.php?mod=ajax_debuger',{
			onComplete:function(response) {
				jQuery('body').append(response.responseText);
				setTimeout('getDebug()', 5000);
            }
        });
	}
</script>{/literal}
<body onload="getDebug();">
</body>