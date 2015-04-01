<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Mąż nie Mąż</title>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<link rel='stylesheet' type='text/css' href='css/style.css' />
<link rel='stylesheet' type='text/css' href='css/lytebox.css' />
<link rel="shortcut icon" href="css/img/fav.ico" />
<meta name="robots" content="noindex,nofollow"> 
<style type="text/css">@import url(css/calendar-blue.css);</style>
<style type="text/css">
</style>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
     jQuery.noConflict();
	 
</script>

<script type="text/javascript" src="js/jqueryblockui.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/advajax.js"></script>
<script type="text/javascript" src="js/dataTable.js"></script>
<script type='text/javascript' src='js/tigra_tables.js'></script>
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="js/lytebox.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>

<script type="text/javascript" src="js/calendar-mypl.js"></script>
<script type="text/javascript" src="js/calendar-setup.js"></script>
<script type='text/javascript' src='js/swfobject.js'></script>
<script type="text/javascript">function sortowanie_sesji(){return true;}</script><script type="text/ecmascript">
  	var iframe_name='';
	var iframe_id='';
 
 
 function OnLoadDynamicData(){
 	if($("dataStats")) {
		initDynamicTable('gallery');
		sortowanie_sesji();
	}
 }
 
 function closedWin() {
confirm("close ?");
return false; /* which will not allow to close the window */
}
if(window.addEventListener) {
window.addEventListener("close", closedWin, false);
}

window.onunload = closedWin;
</script>

<style>
/*body{
	position: absolute;
    width: 100%; height: 100%;
    margin: 0; padding: 0;
}*/
</style>

</head>
<body onload="OnLoadDynamicData();" >
<div id="loader_js" style="text-align:center; display:none; vertical-align:middle; z-index:99999; opacity: 0.45; position:absolute; left:50%; top:50%; width:75px; height:66px; background: url(css/img/sns_logo.png); background-repeat:no-repeat;"><img style="padding-top:28px;" src="css/img/ajax-loader.gif" /></div>
<div class="header">
<h2 onclick="document.location.href='index.php'" style="cursor:pointer">Mąż nie Mąż</h2>
<h2 class="przejdz"><a href="../">przejdź do strony</a></h2>

<h3><a href='http://www.sns.pl/' target='_blank'><img src="css/img/sns.jpg" alt="SNS - Smart Net Solutions" /></a></h3>
</div>
<table border='0' cellspacing='0' cellpadding='0' align='center' valign='top' style='width:99%;'>
<tr>
<td class='content' colspan='2'><table border='0' cellspacing='0' cellpadding='0' style='width:100%;'>
<tr>
<td style='vertical-align: top;width:190px;' >
<table border='0' cellspacing='0' cellpadding='0' style='width:185px;' class="lewo">
<tr>
<td>
<table border="0" class="panel_klienta" cellpadding="0" cellspacing="0" style="margin:0 0 0px 0; padding:10px;">
<tr>
<td>
<p>Jesteś zalogowany jako:</p>
<p><span style="font-size:12px;font-weight:bold; color:#323232;">sns sns</span></p>

<form name="userlogout" id="userlogout" action="/projekty/mazniemaz/admin/index.php" method="post">
<p><input type="hidden" name="logout_confirm" value="1" /></p>
<p style="text-align:right;"><a href="#" onclick="document.userlogout.submit();">wyloguj się&nbsp;&raquo;</a></p>
</form>
</td>
</tr>
</table>  
</td>
</tr>
<tr>
<td>
<table border="0" class="navigation" cellpadding="0" cellspacing="0" style="margin:0 0 0px 0;">
<tr>
<td id="languages_menu">
</td>
</tr>

<tr>
<td> 
<ul>
<li >      
<a class="glowna" href='index.php'>Strona główna panelu</a>
</li>
<li >
<a class="strony" href='/projekty/mazniemaz/admin/index.php?mod=page'>Strony</a>
</li>
<li >
<a class="pliki" href='/projekty/mazniemaz/admin/index.php?mod=file'>Pliki</a>
</li>
<li class="active">
<a class="galerie" href='/projekty/mazniemaz/admin/index.php?mod=gallery'>Galerie</a>

</li>
<li >
<a class="formularze" href='/projekty/mazniemaz/admin/index.php?mod=ankieta'>Formularze</a>
</li>
</ul>
<ul style="margin-top:8px;">
<li >
<a class="operatorzy" href='/projekty/mazniemaz/admin/index.php?mod=operator'>Operatorzy</a>
</li>
</ul>
<form name="user_logout" action="/projekty/mazniemaz/admin/index.php" method="post">
<input type="hidden" name="logout_confirm" value="1" /><input class="form-button" type="submit" style="background-image:url(css/images/logout3.png)!important; background-repeat:no-repeat!important; background-position: 39px 3px!important;" name="logout" value="&nbsp;&nbsp; wyloguj się" />
</form>
<div style="margin:10px 0 0 0; width:98%; text-align:center;">
</td>

</tr>
</table>
</td>
</tr>
</table>		</td>
<td class='separator'>&nbsp;</td>
<td style='vertical-align: top;width: 87%;'>
<table border='0' cellspacing='0' cellpadding='0' style='width: 100%; margin:0 0 0 5px;'>
<tr>
<td class='miedzy' width="30"><img src='css/img/miedzy4.png' /></td>
<td style='text-align: left;'>
<table border='0' cellspacing='0' cellpadding='0' style='width: 100%;' class="topmenu">
<tr>
<td valign="middle" style="background:#dcdcdc;white-space:nowrap; border-top:1px solid #e5e5e5;">
&nbsp;<a href="/projekty/mazniemaz/admin/index.php?mod=gallery" style="color:#7c7c7c!important;">Lista galerii</a>&nbsp;

</td>
<td valign="middle" class="miedzy"><img src='css/img/miedzy5.png' /></td>
<td valign="middle" style="white-space:nowrap;background:#f8f8f8; border-top:1px solid #ffffff;">
&nbsp;<a href="">Edycja galerii</a>&nbsp;
</td>
<td style='width: 30px;' valign="middle"class="miedzy"><img src='css/img/miedzy3.png' alt='' /></td>
<td class='menuGoraWypelnienie' valign="middle">&nbsp;</td>
</tr>
</table>
</td>
</tr>
</table>    
<table border='0' cellspacing='0' cellpadding='0' style='width: 100%;' class="zawartosc">
<tr>
<td style='text-align: center;'>
<div style='text-align: center; padding: 10px 0px 10px 0px;'>

</div>
<div class='naglowek'>Edycja galerii</div>
<form name='editform' method="post" class="niceform" action="/projekty/mazniemaz/admin/index.php?mod=gallery&amp;act=edit&amp;id=14">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
<tr>
<td class='lewa'>Nazwa: </td>
<td class='prawa'>
<input class="form-text" type="text" id='name' name="data[name]" value='Przykładowa galeria' style='width: 353px;' />
</td>
</tr>
<tr>
<td class='lewa'>Opis: </td>
<td class='prawa'>
<textarea class="form-textarea"  style="width:353px;" name="data[description]">opis tej galerii</textarea>

</td>
</tr>
<tr>
<td class='lewa'>Status:</td>
<td class='prawa'>
<input type='radio' name='data[active]' value='N' id='status0' />
<label for='status0'>nieaktywny</label>
<input type='radio' name='data[active]' value='Y' id='status1' checked='checked' />
<label for='status1'>aktywny</label>
</td>
</tr>
<tr>
<td class='lewa'>Data dadania: </td>

<td class='prawa'>
2009-09-30 13:26:38
</td>
</tr>
<tr>
<td class='lewa'>Data modyfikacji: </td>
<td class='prawa'>
2009-09-30 15:24:18
</td>
</tr>
<tr>
<td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
<img src='css/img/ico-anuluj.gif' onclick='location.href="/projekty/mazniemaz/admin/index.php?mod=gallery"' onmouseover="this.src='css/img/ico-anuluj-over.gif'" onmouseout="this.src='css/img/ico-anuluj.gif'" class='icon' />
<input type='hidden' name='confirms' value='1' />
<img src='css/img/ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='css/img/ico-zatwierdz-over.gif'" onmouseout="this.src='css/img/ico-zatwierdz.gif'" class='icon' />
<input type='hidden' name='data[id]' value='14' />

<img src='css/img/ico-usun.gif' onclick='if(confirm("Jeśli chcesz usunać kliknij [OK]\nJeśli nie [Anuluj]"))location.href="/projekty/mazniemaz/admin/index.php?mod=gallery&amp;act=del&amp;id=14"' onmouseover="this.src='css/img/ico-usun-over.gif'" onmouseout="this.src='css/img/ico-usun.gif'" class='icon' />
</td>
</tr>
</table>
</form>
<div class='naglowek'>Lista plików w galerii</div>
<form name="change_image_position" enctype='multipart/form-data' method="post" action="/projekty/mazniemaz/admin/index.php?mod=gallery&amp;act=edit&amp;id=14">
<input type="hidden" name="direction" id="img_direction" value=""  />
<input type="hidden" name="id_image" id="img_id_image" value=""  />
<input type="hidden" name="change_position" id="img_change_position" value=""  />
</form>
<form name='addphoto' method="post" enctype='multipart/form-data' action="/projekty/mazniemaz/admin/index.php?mod=gallery&amp;act=edit&amp;id=14">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
<tr>
<td class='lewa'>Zdjęcia: </td>

<td class='prawa'>
<table style="width:100%">
<tr>
<td style="width:100%" id="draged_contener">

<div class="gallery_image_div" id="g_image_0" itemID="128">
<div class="gallery_drag"></div>
<div style="width: 110px; height: 110px; text-align: left;float:left;padding-left:10px;">
<b>3d modeling humor</b><br />
<a href="../files/photo/20091003225826_3d_modeling_humor.jpg" title="Osram"  rel="lytebox[fotki]">
<img src="../thumb.php?dir=files/photo/&amp;file=20091003225826_3d_modeling_humor.jpg&amp;w=100" onmouseover='jQuery(this).fadeTo("fast", 1); jQuery(this).css("border-color", "#058CC4");' onmouseout='jQuery(this).fadeTo("fast", .7); jQuery(this).css("border-color", "#A4A4A4");' />
</a>
</div>
<div style="width: 52px;float:left;padding-top: 20px;">

<span>1024x768</span><br />
<span style="height:20px; display:block;">110.4 kB</span>

<input type="checkbox" id="delPhoto_128" name="deletePhoto[]" value="128" class="checkbox" onchange="if(jQuery(this).is(':checked')) jQuery('#g_image_0').addClass('to_delete'); else jQuery('#g_image_0').removeClass('to_delete');" />
<label for="delPhoto_128" class="label">usuń</label>
</div>
<div style=" clear:both; padding-left:5px;"><br />
<span style="width:25px; display: inline-block;">title:</span> <input type="text" name="describe_array[128]" value="Osram" />
</div>
<div style=" clear:both;padding-left:5px; padding-bottom:5px; margin-top:10px;">
<span style="width:25px; display: inline-block;">alt:</span> <input type="text" name="name_array[128]" value="" />   

</div>
</div> 

<div class="gallery_image_div" id="g_image_1"  itemID="126">
<div class="gallery_drag"></div>
<div style="width: 110px; height: 110px; text-align: left;float:left;padding-left:10px;">
<b>colorswing 1280</b><br />
<a href="../files/photo/20091002121501_colorswing_1280.jpg" title="Podpisik"  rel="lytebox[fotki]">
<img src="../thumb.php?dir=files/photo/&amp;file=20091002121501_colorswing_1280.jpg&amp;w=100" onmouseover='jQuery(this).fadeTo("fast", 1); jQuery(this).css("border-color", "#058CC4");' onmouseout='jQuery(this).fadeTo("fast", .7); jQuery(this).css("border-color", "#A4A4A4");' />
</a>
</div>
<div style="width: 52px;float:left;padding-top: 20px;">
<span>1280x800</span><br />
<span style="height:20px; display:block;">326.5 kB</span>
<input type="checkbox" id="delPhoto_126" name="deletePhoto[]" value="126" class="checkbox" onchange="if(jQuery(this).is(':checked')) jQuery('#g_image_1').addClass('to_delete'); else jQuery('#g_image_1').removeClass('to_delete');" />

<label for="delPhoto_126" class="label">usuń</label>

</div>
<div style=" clear:both; padding-left:5px;"><br />
<span style="width:25px; display: inline-block;">title:</span> <input type="text" name="describe_array[126]" value="Podpisik" />
</div>
<div style=" clear:both;padding-left:5px; padding-bottom:5px; margin-top:10px;">
<span style="width:25px; display: inline-block;">alt:</span> <input type="text" name="name_array[126]" value="jakiś alt" />   

</div>
</div> 

<div class="gallery_image_div" id="g_image_2"  itemID="124">
<div class="gallery_drag"></div>
<div style="width: 110px; height: 110px; text-align: left;float:left;padding-left:10px;">
<b>Zachod slonca</b><br />
<a href="../files/photo/20090930140101_zachod_slonca.jpg" title="Zachód słońca"  rel="lytebox[fotki]">
<img src="../thumb.php?dir=files/photo/&amp;file=20090930140101_zachod_slonca.jpg&amp;w=100" onmouseover='jQuery(this).fadeTo("fast", 1); jQuery(this).css("border-color", "#058CC4");' onmouseout='jQuery(this).fadeTo("fast", .7); jQuery(this).css("border-color", "#A4A4A4");' />
</a>
</div>
<div style="width: 52px;float:left;padding-top: 20px;">
<span>800x600</span><br />
<span style="height:20px; display:block;">69.5 kB</span>
<input type="checkbox" id="delPhoto_124" name="deletePhoto[]" value="124" class="checkbox" onchange="if(jQuery(this).is(':checked')) jQuery('#g_image_2').addClass('to_delete'); else jQuery('#g_image_2').removeClass('to_delete');" />
<label for="delPhoto_124" class="label">usuń</label>
</div>
<div style=" clear:both; padding-left:5px;"><br />
<span style="width:25px; display: inline-block;">title:</span> <input type="text" name="describe_array[124]" value="Zachód słońca" />
</div>
<div style=" clear:both;padding-left:5px; padding-bottom:5px; margin-top:10px;">
<span style="width:25px; display: inline-block;">alt:</span> <input type="text" name="name_array[124]" value="" />   

</div>
</div>

<div class="gallery_image_div" id="g_image_3"  itemID="129">
<div class="gallery_drag"></div>
<div style="width: 110px; height: 110px; text-align: left;float:left;padding-left:10px;">
<b>experiment wall 2</b><br />
<a href="../files/photo/20091003225859_experiment_wall_2.jpg" title="Experyment"  rel="lytebox[fotki]">
<img src="../thumb.php?dir=files/photo/&amp;file=20091003225859_experiment_wall_2.jpg&amp;w=100" onmouseover='jQuery(this).fadeTo("fast", 1); jQuery(this).css("border-color", "#058CC4");' onmouseout='jQuery(this).fadeTo("fast", .7); jQuery(this).css("border-color", "#A4A4A4");' />
</a>
</div>
<div style="width: 52px;float:left;padding-top: 20px;">
<span>1680x1050</span><br />
<span style="height:20px; display:block;">476.0 kB</span>
<input type="checkbox" id="delPhoto_129" name="deletePhoto[]" value="129" class="checkbox" onchange="if(jQuery(this).is(':checked')) jQuery('#g_image_3').addClass('to_delete'); else jQuery('#g_image_3').removeClass('to_delete');" />
<label for="delPhoto_129" class="label">usuń</label>
<span style="height:30px; display:inline-table; vertical-align: middle;">&nbsp;</span>
</div>
<div style=" clear:both; padding-left:5px;"><br />
<span style="width:25px; display: inline-block;">title:</span> <input type="text" name="describe_array[129]" value="Experyment" />
</div>
<div style=" clear:both;padding-left:5px; padding-bottom:5px; margin-top:10px;">
<span style="width:25px; display: inline-block;">alt:</span> <input type="text" name="name_array[129]" value="" />   
</div>
</div>


<input name="order_sort" id="order_sort" value="" />


<script type="text/javascript" src="js/dragsort-0.3.js"></script>

<script type="text/javascript">
	jQuery("body").dragsort({ itemSelector: '.gallery_image_div', dragSelector: '.gallery_drag' });
	
	jQuery('.gallery_drag').each(function(){
		this.title='przeciągnij by zmienić kolejność';
		this.onmouseover=function(event){
			chmurka(event,this);
		}
	});	

	function saveOrder() {
		var serialStr = "";
		jQuery("#draged_contener .gallery_image_div:not(.to_delete, .placeHolder)").each(function(i, elm) {
			serialStr += (i > 0 ? "|" : "") + jQuery(elm).attr("itemID");
		});
		jQuery("#order_sort").val(serialStr);
		return false;
	}
</script>

<input type="button" onclick=" saveOrder(); return false;" value="pokaż kolejność nieusuniętych" />

</td>
</tr>
</table>    </td>
</tr>
<tr>
<td class='lewa'>Dodaj zdjęcie:</td>
<td class='prawa'>
<script type="text/javascript">
	document.documentElement.className += ' js ';
</script>    
<div class="input-file" style="display:inline-block;"> 
<label> <span>Kliknij by wybrać</span> <input type="file" name="file" /> </label> <var><input type="text" name="my-input-file-path" value="wybierz plik..." readonly="readonly" />&nbsp;</var>

</div>    
<script type="text/javascript">
	var aUploadFileBtns = document.getElementsByName('file');
	for(var i=0,dBtn;dBtn = aUploadFileBtns[i];i++){
		new FileUploadUI(dBtn);
	};
</script>    
<br /> Podpis nowego zdjęcia (<i>title</i>): <input type='text' name='description' />&nbsp; &nbsp; Nazwa nowego zdjęcia (<i>alt</i>): <input type='text' name='name' />
</td>
</tr>
<tr>
<td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>

<img src='css/img/ico-anuluj.gif' onclick='location.href="/projekty/mazniemaz/admin/index.php?mod=gallery"' onmouseover="this.src='css/img/ico-anuluj-over.gif'" onmouseout="this.src='css/img/ico-anuluj.gif'" class='icon' />
<input type='hidden' name='confirm_photo' value='1' />
<img src='css/img/ico-zatwierdz.gif' onclick='document.addphoto.submit()' onmouseover="this.src='css/img/ico-zatwierdz-over.gif'" onmouseout="this.src='css/img/ico-zatwierdz.gif'" class='icon' />
<input type='hidden' name='data[id]' value='14' />
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr> 
</table>
<div class="footer">

created by <a href='http://www.sns.pl/' target='_blank'>Smart Net Solutions</a>
</div>
<script type="text/javascript">
	<!--
	if (document.getElementById('lista') != null && document.getElementById('mytree') == null) {
		tigra_tables('lista', 1, 0, '#fefefe', '#f5f5f5', '#E1EAF2', '#CAE9FF');
	}
	
	if (document.getElementById('lista2') != null) {
		tigra_tables('lista2', 1, 0, '#fefefe', '#f5f5f5', '#E1EAF2', '#CAE9FF');
	}
	
	if (document.getElementById('lista3') != null) {
		tigra_tables('lista3', 1, 0, '#fefefe', '#f5f5f5', '#E1EAF2', '#CAE9FF');
	}
	
	if (document.getElementById('lista4') != null) {
		tigra_tables('lista4', 1, 0, '#fefefe', '#f5f5f5', '#E1EAF2', '#CAE9FF');
	}
	
	if (document.getElementById('lista5') != null) {
		tigra_tables('lista5', 1, 0, '#fefefe', '#f5f5f5', '#E1EAF2', '#CAE9FF');
	}
	
	if (document.getElementById('lista6') != null) {
		tigra_tables('lista6', 1, 0, '#fefefe', '#f5f5f5', '#E1EAF2', '#CAE9FF');
	}
	
	if (document.getElementById('lista7') != null) {
		tigra_tables('lista7', 1, 0, '#fefefe', '#f5f5f5', '#E1EAF2', '#CAE9FF');
	}
	
	if (document.getElementById('lista8') != null) {
		tigra_tables('lista8', 1, 0, '#fefefe', '#f5f5f5', '#E1EAF2', '#CAE9FF');
	}
	// -->
	
</script>
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="js/pngfix.js"></script>
<![endif]-->
</body>
</html>