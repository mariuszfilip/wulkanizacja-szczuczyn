  {include file="main/templates/errors.tpl"}
<form name='editform' enctype='multipart/form-data' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$data.id}">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
  <tr>
    <td class='lewa'>Nazwa: </td>
    <td class='prawa'>
      <input class="form-text" type="text" id='name' name="data[name]" value='{$data.name|escape}' style='width: 350px;' />
    </td>
  </tr>

  {if !empty($data.picture)}
	   <td class='lewa'>Obrazek:</td>
	   <td class='prawa'>
	          <div style="text-align:left;width: 550px;">
	           <a href="{$smarty.const.PICT_DIR}{$data.picture}" rel="lytebox" alt="{$data.picture}">
	           	<img style="float:left;" class="over_effect" src="tools/thumb.php?dir={$smarty.const.PICT_DIR}&amp;file={$data.picture}&amp;w=70"
              onmouseover='jQuery(this).fadeTo("fast", 1); jQuery(this).css("border-color", "#058CC4");' onmouseout='jQuery(this).fadeTo("fast", .8); jQuery(this).css("border-color", "#A4A4A4");'
               />
	           </a>
	           <div style="float:left;margin-left: 20px;">
	                       plik: <b>{$data.picture}</b><br />
	                       {*$data.picture_width}x{$data.picture_height*}<br />
	                       {$data.picture_sizek|string_format:"%.1f"}&nbsp;kB
	                       <div style="margin-top:15px" />
                    
                    <input type="checkbox" name="delete" id="delete" class="checkbox" value="{$data.id}" /> <label for="delete" class="label">usuń</label>   
	           </div>
	    </div>
	  </td>
       {else}
    <td class='lewa'>Obrazek: </td>
    <td class='prawa'>
      <script type="text/javascript">
		document.documentElement.className += ' js ';
	</script>    
    <div class="input-file" style="width:357px;"> 
    	<label> <span>Kliknij by wybrać</span> <input id="picture" type="file" name="source_name" /> </label> <var><input type="text" name="my-input-file-path" value="wybierz plik..." readonly="readonly" />&nbsp;</var>
    </div>    
	<script type="text/javascript">{literal}
		var aUploadFileBtns = document.getElementsByName('source_name');
		for(var i=0,dBtn;dBtn = aUploadFileBtns[i];i++){
			new FileUploadUI(dBtn);
		};
	</script>{/literal}  
      
    </td>
  {/if}
   </tr>
  <tr>
    <td class='lewa'>&nbsp;</td>
    <td class='prawa'>&nbsp;</td>
  </tr>
	<tr>
		<td class='lewa'>Meta Title: </td>
		<td class='prawa'>
      <textarea class="form-textarea" cols="60" name="data[meta_title]">{$data.meta_title}</textarea>
		</td>
	</tr>
       <tr>
         <td class='lewa'>Meta Description: </td>
    <td class='prawa'>
      <textarea class="form-textarea" cols="60" name="data[meta_description]">{$data.meta_description}</textarea>
         </td>
  </tr>
        <tr>
         <td class='lewa'>Meta Keywords: </td>
    <td class='prawa'>
      <textarea class="form-textarea" cols="60" name="data[meta_keywords]">{$data.meta_keywords}</textarea>
         </td>
  </tr>
        <tr>
         <td class='lewa'>Meta Robots: </td>
    <td class='prawa'>
      <textarea class="form-textarea" cols="60" name="data[meta_robots]">{$data.meta_robots}</textarea>
         </td>
  </tr>
        <tr>
         <td class='lewa'>Meta Last Modified: </td>
    <td class='prawa'>
      <input class="form-text" name="data[meta_last_modified]" value="{$data.meta_last_modified}" style='width: 200px;' />
         </td>
  </tr>
  <tr>
    <td class='lewa'>Status: </td>
    <td class='prawa'>
      {if $data.active == 'N'}
      <input type='radio' name='data[active]' value='N' id='status0' checked='checked' />
      {else}
      <input type='radio' name='data[active]' value='N' id='status0' checked='checked' />
      {/if}
      <label for='status0'>niewidoczny</label>
      {if $data.active == 'Y'}
      <input type='radio' name='data[active]' value='Y' id='status1' checked='checked' />
      {else}
      <input type='radio' name='data[active]' value='Y' id='status1' />
      {/if}
      <label for='status1'>widoczny</label>
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
      <input type='hidden' name='confirm' value='1' />
      <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
      <input type='hidden' name='data[id]' value='{$data.id}' />
           <img src='{#imgDir#}ico-usun.gif' onclick='if(confirm("Je�li chcesz usuna� kliknij [OK]\nJeśli nie [Anuluj]"))location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=del&amp;id={$data.id}"' onmouseover="this.src='{#imgDir#}ico-usun-over.gif'" onmouseout="this.src='{#imgDir#}ico-usun.gif'" class='icon' />
    </td>
  </tr>
  <tr>
    <td colspan="2">
      <div style="border-bottom: 1px solid rgb(193, 223, 250); color: rgb(100, 100, 100); width: 100%;"></div>
    </td>
  </tr>
</table>
</form>
