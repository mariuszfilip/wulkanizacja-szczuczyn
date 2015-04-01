<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
{if $meta.meta_title}
<title>{$meta.meta_title|escape}</title>
{/if}
{if $meta.meta_description}
<meta name="description" content="{$meta.meta_description}">
{/if}
{if $meta.meta_keywords}
<meta name="keywords" content="{$meta.meta_keywords}">
{/if}
{if $meta.meta_robots}
<meta name="robots" content="{$meta.meta_robots}">
{/if}
{if $smarty.const.AUTHOR}
<meta name="author" content="{$smarty.const.AUTHOR}">
{/if}
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
		
		{literal}
		<script type="text/javascript">
		
		$(document).ready(function() {
			$("p:empty").remove();
			$(function() {
				
			    $('input[name=email]').focus(function() {
			    	$(this).val('');
			   

			      });

			    $('input[name=tel]').focus(function() {

	
			    	$(this).val('');
				      });

			 });
			 $(function() {

			        $('#new a').lightBox();

			    });
						 
			});
		
		</script>
		
		
		{/literal}
		
{literal}
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-27499258-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
{/literal}
{literal}
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
   {/literal}
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
					{include file="main/templates/menu.tpl"}
				</div>
			</div>