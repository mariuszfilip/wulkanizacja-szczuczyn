<table style="width:100%">
<tr>
<td style="width:100%" id="draged_contener">
{foreach item=i key=k from=$gallery name=pictures}

  <div class="gallery_image_div" id="g_image_{$smarty.foreach.pictures.index}" itemID="{$i.id_photo}">
  <div class="gallery_drag"></div>
  <div class="gallery_filename">{$i.file_name|substr:15:-4|capitalize|replace:'_':' '}</div>
  <div style="width: 110px; height: 110px; text-align: left;float:left;padding-left:9px;">
<a href="{$i.path}{$i.file_name|escape:url}" imageName="{$i.description}" onmouseover="return false;" rel="lytebox[fotki]"><img src="../thumb.php?dir=files/photo/&amp;file={$i.file_name|escape:url}&amp;w=100&amp;h=115" onmouseover='jQuery(this).fadeTo("fast", 1); jQuery(this).css("border-color", "#058CC4");' onmouseout='jQuery(this).fadeTo("fast", .8); jQuery(this).css("border-color", "#A4A4A4");' /></a></div>
	<div style="width: 52px;float:left;padding-top: 1px;">
      <span>{$i.width}x{$i.height}</span><br />
      <span style="height:20px; display:block;">{$i.sizek|string_format:"%.1f"} kB</span>
      <input type="checkbox" id="delPhoto_{$i.id_photo}" name="deletePhoto[]" value="{$i.id_photo}" class="checkbox" onchange="if(jQuery(this).is(':checked')) jQuery('#g_image_{$smarty.foreach.pictures.index}').addClass('to_delete'); else jQuery('#g_image_{$smarty.foreach.pictures.index}').removeClass('to_delete');" />
      <label for="delPhoto_{$i.id_photo}" class="label">usuń</label>
    </div>
    
    <div style=" clear:both; padding-left:5px;"><br />
    <span style="width:25px; display: inline-block;">title:</span> <input type="text" name="describe_array[{$i.id_photo}]" value="{$i.description|escape}" />
    </div>
    
    <div style=" clear:both;padding-left:5px; padding-bottom:5px; margin-top:10px;">
    <span style="width:25px; display: inline-block;">alt:</span> <input type="text" name="name_array[{$i.id_photo}]" value="{$i.name|escape}" />   
    </div>
  </div> 
{/foreach}
</td>
</tr>
</table>