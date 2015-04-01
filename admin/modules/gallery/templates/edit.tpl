  {include file="main/templates/errors.tpl"}
<form name='editform' method="post" class="niceform" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$data.id}">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
  <tr>
    <td class='lewa'>Nazwa: </td>
    <td class='prawa'>
      <input class="form-text" type="text" id='name' name="data[name]" value='{$data.name|escape}' style='width: 353px;' />
    </td>
  </tr>
  <tr>
    <td class='lewa'>Opis: </td>
    <td class='prawa'>
      <textarea class="form-textarea"  style="width:353px;" name="data[description]">{$data.description}</textarea>
    </td>
  </tr>
  <tr>
    <td class='lewa'>Status:</td>
    <td class='prawa'>
      {if $data.active eq 'N' || $data.active eq ''}
      <input type='radio' name='data[active]' value='N' id='status0' checked='checked' />
      {else}
      <input type='radio' name='data[active]' value='N' id='status0' />
      {/if}
      <label for='status0'>nieaktywny</label>
      {if $data.active eq 'Y'}
      <input type='radio' name='data[active]' value='Y' id='status1' checked='checked' />
      {else}
      <input type='radio' name='data[active]' value='Y' id='status1' />
      {/if}
      <label for='status1'>aktywny</label>
    </td>
  </tr>
  <tr>
    <td class='lewa'>Data dadania: </td>
    <td class='prawa'>
      {$data.added}
    </td>
  </tr>
  <tr>
    <td class='lewa'>Data modyfikacji: </td>
    <td class='prawa'>
      {$data.modified}
    </td>
  </tr>
  <tr>
    <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
    	<img src='{#imgDir#}ico-anuluj.gif' onclick='location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}"' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />
      <input type='hidden' name='confirms' value='1' />
      <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
      <input type='hidden' name='data[id]' value='{$data.id}' />
    	<img src='{#imgDir#}ico-usun.gif' onclick='if(confirm("Jeśli chcesz usunać kliknij [OK]\nJeśli nie [Anuluj]"))location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=del&amp;id={$data.id}"' onmouseover="this.src='{#imgDir#}ico-usun-over.gif'" onmouseout="this.src='{#imgDir#}ico-usun.gif'" class='icon' />
    </td>
  </tr>
</table>
</form>
<div class='naglowek'>Lista plików w galerii</div>

<form name="change_image_position" enctype='multipart/form-data' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$data.id}">
	<input type="hidden" name="direction" id="img_direction" value=""  />
    <input type="hidden" name="id_image" id="img_id_image" value=""  />
    <input type="hidden" name="change_position" id="img_change_position" value=""  />
</form>



<form name='addphoto' method="post" enctype='multipart/form-data' action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$data.id}" onsubmit="return false">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
  <tr>
    <td class='lewa'>Zdjęcia: </td>
    <td class='prawa'>
      {include file="gallery/templates/gallery.tpl" gallery=$photo}
      
      
      
      
      <input type="hidden" name="order_sort" id="order_sort" value="" />


<script type="text/javascript" src="js/dragsort-0.3.js"></script>

<script type="text/javascript">{literal}
	//jQuery("#all_page").dragsort({ itemSelector: '.gallery_image_div', dragSelector: '.gallery_drag' });
	
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
		document.addphoto.submit();
		return false;
	}{/literal}
</script>
      
    </td>
  </tr>
  <tr>
    <td class='lewa'>&nbsp;</td>
    <td class='prawa'>
    
    {*<!--script type="text/javascript">
		document.documentElement.className += ' js ';
	</script>    
    <div class="input-file" style="display:inline-block; width:394px!important;"> 
    	<label> <span>Kliknij by dodać zdjęcie</span> <input type="file" name="file" /> </label> <var><input type="text" name="my-input-file-path" value="wybierz plik..." readonly="readonly" />&nbsp;</var>
    </div>    
	<script type="text/javascript">{literal}
		var aUploadFileBtns = document.getElementsByName('file');
		for(var i=0,dBtn;dBtn = aUploadFileBtns[i];i++){
			new FileUploadUI(dBtn);
		};
	</script>{/literal}    
    
<br /> Podpis nowego zdjęcia (<i>title</i>): <input type='text' name='description' />&nbsp; &nbsp; Nazwa nowego zdjęcia (<i>alt</i>): <input type='text' name='name' /-->*}


<br />
<link rel='stylesheet' type='text/css' href='css/uploadify.css' />
<script type="text/javascript" src="js/jquery.uploadify.v2.1.0.js"></script>
<script type="text/javascript">{literal}

/*testuj = eval('({"id":166, file:"20100423174749_blue.jpg"})').id;
alert(testuj);*/

jQuery(document).ready(function() {
	jQuery("#uploadify").uploadify({
		'uploader'		: 'swf/uploadify.swf',
		'script'		: 'ajax.php',
		'scriptData'	: {'mod':'gallery', 'act' : 'ajax_add_photo', 'id':'{/literal}{$smarty.get.id}{literal}', 'PHPSESSID':'{/literal}{$session_id}{literal}'},
		'queueID'			: 'fileQueue',
		'auto'			: true,
		'fileDesc'		: 'Pliki graficzne (*.jpg, *.gif, *.png)',
		'fileExt'		: '*.jpg;*.gif;*.png',
		'multi'			: true
	});
});


function addImageBox(id, file, size, image_size){
	
	//console.debug("Rozmiar to: %o", size);	
	currentMaxId = jQuery("#draged_contener > .gallery_image_div").size();
	
	zmienna='<div itemid="'+id+'" id="g_image_'+currentMaxId+'" style="display:none;" class="gallery_image_div"><div class="gallery_drag icon_tip" style="cursor: url(&quot;css/img/cur_move.png&quot;), move;" title="przeciągnij by zmienić kolejność"></div><div class="gallery_filename">'+file.substr(15, (file.length-19))+'</div><div style="width: 110px; height: 110px; text-align: left; float: left; padding-left: 9px;"><a rel="lytebox[fotki]" onmouseover="return false;" imagename="'+file.substr(15, (file.length-19))+'" href="../files/photo/'+file+'"><img onmouseout="jQuery(this).fadeTo(&quot;fast&quot;, .8); jQuery(this).css(&quot;border-color&quot;, &quot;#A4A4A4&quot;);" onmouseover="jQuery(this).fadeTo(&quot;fast&quot;, 1); jQuery(this).css(&quot;border-color&quot;, &quot;#058CC4&quot;);" src="../thumb.php?dir=files/photo/&file='+file+'&w=100&h=115" ></a></div><div style="width: 52px; float: left; padding-top: 1px;"><span>'+image_size+'</span><br><span style="height: 20px; display: block;">'+size+'</span><input type="checkbox" onchange="if(jQuery(this).is(\':checked\')) jQuery(\'#g_image_'+currentMaxId+'\').addClass(\'to_delete\'); else jQuery(\'#g_image_'+currentMaxId+'\').removeClass(\'to_delete\');" class="checkbox" value="'+id+'" name="deletePhoto[]" id="delPhoto_'+id+'"><label class="label" for="delPhoto_'+id+'">usuń</label></div><div style="clear: both; padding-left: 5px;"><br><span style="width: 25px; display: inline-block;">title:</span> <input type="text" value="" name="describe_array['+id+']"></div><div style="clear: both; padding-left: 5px; padding-bottom: 5px; margin-top: 10px;"><span style="width: 25px; display: inline-block;">alt:</span> <input type="text" value="" name="name_array['+id+']"></div></div>';
	jQuery('#draged_contener').append(zmienna);
	jQuery('#g_image_'+currentMaxId).fadeIn();
	jQuery("#all_page").dragsort({ itemSelector: '.gallery_image_div', dragSelector: '.gallery_drag' });
	
	jQuery(".checkbox").each(function(){
		if(jQuery(this).is(":checked")){
			jQuery(this).next("label").addClass("label_checked");
		}else{
			jQuery(this).next("label").removeClass("label_checked");
		}
	});
	
	jQuery(".checkbox").change(function(){
		if(jQuery(this).is(":checked")){
			jQuery(this).next("label").addClass("label_checked");
		}else{
			jQuery(this).next("label").removeClass("label_checked");
		}
		jQuery(this).next("label").blur();
	});
	icon_tip_active();
	initLytebox();

}


jQuery("#all_page").dragsort({ itemSelector: '.gallery_image_div', dragSelector: '.gallery_drag' });
	
	jQuery('.gallery_drag').each(function(){
		this.title='przeciągnij by zmienić kolejność';
		this.onmouseover=function(event){
			chmurka(event,this);
		}
	});	

{/literal}
</script>
{*<!--p><a href="javascript:jQuery('#uploadify').uploadifyUpload()">Wyślij pliki</a> | <a href="javascript:jQuery('#uploadify').uploadifyClearQueue()">Anuluj wysyłanie</a></p-->*}
<input type="file" name="uploadify" id="uploadify" style="display:none;" />

<div class="form-button-red" id="cancel_upload_btn" onclick="jQuery('#uploadify').uploadifyClearQueue()" style="
-moz-border-radius:4px; -webkit-border-radius:4px; border-radius:4px;
text-align:center;
z-index:8; margin-top:-23px;
display:none;
margin-bottom:23px;
width:156px!important; height:14px;
margin-left:1px;
white-space: nowrap;
border: solid 1px;
color: #ffffff;
padding-top: 0.25em;
padding-bottom: 0.2em;
font-weight: 700;
cursor: pointer;">Przerwij wysyłanie</div>
    </td>
  </tr>
  <tr>
    <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
      <img src='{#imgDir#}ico-anuluj.gif' onclick='location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}"' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />
      <input type='hidden' name='confirm_photo' value='1' />
      <img src='{#imgDir#}ico-zatwierdz.gif' onclick='saveOrder()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
      <input type='hidden' name='data[id]' value='{$data.id}' />
    </td>
  </tr>
</table>
</form>

<div id="fileQueue"></div>