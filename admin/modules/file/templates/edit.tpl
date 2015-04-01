  {include file="main/templates/errors.tpl"}
<form name='editform' enctype='multipart/form-data' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$data.id}">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
	<tr>
    <td class='lewa'>Nazwa: </td>
    <td class='prawa'>
      <input class="form-text" type="text" id='name' name="data[name]" value='{$data.name|escape}' style='width: 353px;' />
    </td>
  </tr>
  {if !empty($data.file_name)}
  
  {if $data.type > 5 && $data.type < 11}
  <tr>
  	<td class='lewa'>&nbsp;</td>
  	<td class='prawa'>
    	<a href="../files/docs/{$data.file_name|escape:url}" title="{$data.file_name|substr:15:-4|capitalize|replace:'_':' '}" rel="lytebox" >
        	<img src="../thumb.php?dir=files/docs/&amp;file={$data.file_name|escape:url}&amp;w=353&amp;h=353"  class="over_effect"onmouseover='jQuery(this).fadeTo("normal", 1); jQuery(this).css("border-color", "#058CC4");' onmouseout='jQuery(this).fadeTo("normal", .8); jQuery(this).css("border-color", "#A4A4A4");'/>
		</a>
  	</td>
  </tr>
  {/if}
  <tr>
  	<td>&nbsp;</td>
  	<td>
  		<div style="text-align:left;margin: 5px 0 5px 0;">
  			Nazwa pliku: &nbsp;<a href="../files/docs/{$data.file_name}" onclick="this.target='_blank'">{$data.file_name|substr:15}</a>
  		</div>
  		<div style="text-align:left;margin: 5px 0 5px 0;">
  			Rozmiar pliku: &nbsp;<strong>{$data.sizek|string_format:"%.2f"}&nbsp;KiB</strong>
  		</div>
        <div style="text-align:left;margin: 5px 0 5px 0;">
  			Typ pliku: {if $data.type eq 5}<img src="css/icons/pdf.gif" title="PDF" alt="PDF" />{elseif $data.type == 4}<img src="css/icons/doc.gif" title="Dokument Microsoft Word" alt="Dokument Microsoft Word" />{elseif $data.type > 5 && $data.type < 11}<img src="css/icons/document-image.png" title="Image" alt="Image" />{elseif isset($video)}<img src="css/icons/video.png" title="Video dla Flash" alt="Video dla Flasha" />{else}<img src="css/icons/unknown.png" title="Nieznany format pliku" alt="Nieznany format pliku" />{/if} {if $data.type_name and $data.type_name neq ''}&nbsp; <strong>{$data.type_name}</strong> {if $data.mime}&nbsp;<span style="color: #999">[{$data.mime}]</span>{/if}{else} &nbsp;<span style="color: #999">[nieznany]</span>{/if}
  		</div>
  		</td>
  </tr>
  {else}
  <tr>
    <td class='lewa'>Wczytaj plik: </td>
    <td class='prawa'>
      <input class="form-file" type="file" id='source_name' name="source_name" style='width: 353px;' />
      
    </td>
  </tr>
  {/if}
  {if isset($video)}

  <tr>
    <td class='lewa'>Podgląd wideo:</td>
    <td class='prawa'>
   	<div id="myDynamicContent">
		<div>
	<script type="text/javascript">
		{literal}
		var flashvars = false;
		var params = {
			menu: "false",
			allowfullscreen: "true",
			flashvars: "file=../files/docs/{/literal}{$data.file_name}{if !empty($data.photo)}&image=../files/flv/{$data.photo}{/if}{literal}"
		};
		
		swfobject.embedSWF("flvplayer.swf", "myDynamicContent", "358", "289", "7","expressInstall.swf", flashvars, params);
	</script>{/literal}

		</td>
  </tr>

<tr style="veritcal-align:top;">
    <td class='lewa'>Obrazek: </td>
    <td class='prawa'>
      {if $data.photo ne ''}
        <div style="display: inline; float: left; min-height: 120px; width: 348px; margin: 3px; text-align: left; padding: 5px; margin-left:0;        
		-moz-border-radius:3px;
		border:1px solid #A4A4A4;" class="gallery_image_div">
          <div style="width: 195px; height: 110px; text-align: left;float:left;padding-left:10px;">
            <span style="font-weight: normal;">plik:</span>&nbsp;&nbsp;<b>{$data.photo|substr:15}</b><br />
              <a href="../files/flv/{$data.photo|escape:url}" title="{$data.photo|substr:15:-4|capitalize|replace:'_':' '}" rel="lytebox" >
    		        <img src="../thumb.php?dir=files/flv&amp;file={$data.photo|escape:url}&amp;w=100&amp;h=100" onmouseover='jQuery(this).fadeTo("normal", 1); jQuery(this).css("border-color", "#058CC4");' onmouseout='jQuery(this).fadeTo("normal", .8); jQuery(this).css("border-color", "#A4A4A4");' />
    	       </a>
		      </div>
			<div style="width: 60px;float:left;padding-top: 20px;">
				<input type="checkbox" name="delete_file" id="delete_file" class="checkbox" value="1" /> <label for="delete_file" class="label">usuń</label>         
			</div>
       <div style="clear:both; width:100%; height:25px; text-align:center;">
          
	<script type="text/javascript">
		document.documentElement.className += ' js ';
	</script>    
    <div class="input-file" style="width:330px; padding-left:10px;"> 
    	<label> <span>Kliknij by wybrać</span> <input type="file" name="file" /> </label> <var><input type="text" name="my-input-file-path" value="wybierz plik..." readonly="readonly" />&nbsp;</var>
    </div>    
	<script type="text/javascript">{literal}
		var aUploadFileBtns = document.getElementsByName('file');
		for(var i=0,dBtn;dBtn = aUploadFileBtns[i];i++){
			new FileUploadUI(dBtn);
		};
	</script>{/literal}   
      </div>
       
      {else}
	<script type="text/javascript">
		document.documentElement.className += ' js ';
	</script>    
    <div class="input-file" style="width:359px;"> 
    	<label> <span>Kliknij by wybrac</span> <input type="file" name="file" /> </label> <var><input type="text" name="my-input-file-path" value="wybierz plik..." readonly="readonly" />&nbsp;</var>
    </div>    
	<script type="text/javascript">{literal}
		var aUploadFileBtns = document.getElementsByName('file');
		for(var i=0,dBtn;dBtn = aUploadFileBtns[i];i++){
			new FileUploadUI(dBtn);
		};
	</script>{/literal} 
      {/if}
      </div>
    </td>
  </tr>
  {/if}
  <tr>
  	<td class='lewa'>Opis: </td>
    <td class='prawa'>
      <textarea class="form-textarea" style="width:353px;" rows="14" name="data[description]">{$data.description}</textarea>
  	</td>
  </tr>
  {if isset($video)}

<tr style="veritcal-align:top;">
		<td class='lewa'>Pokaż na stronie głównej: </td>
		<td class='prawa'>
		{if $data.headline eq 'N' || $data.headline eq ''}
			<input type='radio' name='data[headline]' value='N' id='headline0' checked='checked' />
		{else}
			<input type='radio' name='data[headline]' value='N' id='headline0' />
		{/if}
		<label for='headline0'>nie</label>
		{if $data.headline eq 'Y'}
			<input type='radio' name='data[headline]' value='Y' id='headline1' checked='checked' />
		{else}
			<input type='radio' name='data[headline]' value='Y' id='headline1' />
		{/if}
		<label for='headline1'>tak</label>
	</td>
	</tr>
	{/if}
  <tr>
    <td class='lewa'>Status: </td>
    <td class='prawa'>
      
      <input type='radio' name='data[active]' value='N' id='status0' {if $data.active neq 'Y'}checked='checked'{/if} />
      <label for='status0'>nieaktywny</label>
      
      <input type='radio' name='data[active]' value='Y' id='status1' {if $data.active eq 'Y'}checked='checked'{/if} />
      <label for='status1'>aktywny</label>
    </td>
  </tr>
  <tr>
    <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
    	<img src='{#imgDir#}ico-anuluj.gif' onclick='location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}"' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />
      <input type='hidden' name='confirm' value='1' />
      <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
      <img src='{#imgDir#}ico-usun.gif' onclick='if(confirm("Jeśli chcesz usunać kliknij [OK]\nJeśli nie [Anuluj]"))location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=del&amp;id={$data.id}"' onmouseover="this.src='{#imgDir#}ico-usun-over.gif'" onmouseout="this.src='{#imgDir#}ico-usun.gif'" class='icon' />
    </td>
  </tr>
</table>
</form>