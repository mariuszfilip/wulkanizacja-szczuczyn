<?php /* Smarty version 2.6.18, created on 2013-03-11 19:55:26
         compiled from main/templates/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'main/templates/header.tpl', 6, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php if ($this->_tpl_vars['meta']['meta_title']): ?>
<title><?php echo ((is_array($_tmp=$this->_tpl_vars['meta']['meta_title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</title>
<?php endif; ?>
<?php if ($this->_tpl_vars['meta']['meta_description']): ?>
<meta name="description" content="<?php echo $this->_tpl_vars['meta']['meta_description']; ?>
">
<?php endif; ?>
<?php if ($this->_tpl_vars['meta']['meta_keywords']): ?>
<meta name="keywords" content="<?php echo $this->_tpl_vars['meta']['meta_keywords']; ?>
">
<?php endif; ?>
<?php if ($this->_tpl_vars['meta']['meta_robots']): ?>
<meta name="robots" content="<?php echo $this->_tpl_vars['meta']['meta_robots']; ?>
">
<?php endif; ?>
<?php if (@AUTHOR): ?>
<meta name="author" content="<?php echo @AUTHOR; ?>
">
<?php endif; ?>
		<script src="js/jquery-1.6.2.min.js"></script>
		<script src="js/jquery-ui-1.8.16.custom.min.js"></script>
		
		<script type="text/javascript" src="js/jquery.lightbox-0.5.min.js"></script>
		
		 <link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />

		<!--[if lt IE 7]>
			<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
		<![endif]-->
		<!--[if lt IE 8]>
			<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
		<![endif]-->
		<!--[if lt IE 9]>
			<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
	<![endif]-->
		<link href="css/style.css" media="screen" rel="stylesheet" type="text/css" />
		
		<?php echo '
		<script type="text/javascript">
		
		$(document).ready(function() {
			$("p:empty").remove();
			$(function() {
				
			    $(\'input[name=email]\').focus(function() {
			    	$(this).val(\'\');
			   

			      });

			    $(\'input[name=tel]\').focus(function() {

	
			    	$(this).val(\'\');
				      });

			 });
			 $(function() {

			        $(\'#new a\').lightBox();

			    });
						 
			});
		
		</script>
		
		
		'; ?>

		
<?php echo '
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push([\'_setAccount\', \'UA-27499258-1\']);
  _gaq.push([\'_trackPageview\']);

  (function() {
    var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
'; ?>

<?php echo '
<script type="text/javascript">
 
    $(function(){
 
    $("#wysuwane").css("left","-210px");
    
 
$("#wysuwane").hover(
  function () {
    $("#wysuwane").animate({left: "0px"}, 1000 );
        $(this).addClass("zamknij");
  },
  function () {
    $("#wysuwane").animate({left: "-210px"}, 1000 );
        $(this).removeClass("zamknij");
  }
);
});
    </script>
   '; ?>

</head>
<body>
<div id="wysuwane">
<div id="wewnatrz" style="float:left; width:185px; display:block; margin-left:0px; background-color: white;">
<iframe src="http://www.facebook.com/plugins/likebox.php?href=http://www.facebook.com/pages/Wulkanizacja-Szczuczyn/415052495249373&amp;width=182&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=true&amp;header=true&amp;height=365" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:180px; height:370px;" allowTransparency="true"></iframe>
</div>
</div>
<div class="container">
			<div class="header">
				<h1><a href="index.html">Wulkanizacja - Szczuczyn</a></h1>
				<div class="header_top">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "main/templates/menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
			</div>