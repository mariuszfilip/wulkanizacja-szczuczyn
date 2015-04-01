  {include file="main/templates/errors.tpl"}
<form name='editform' method="post" enctype='multipart/form-data' action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=add">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
	<tr>
    <td class='lewa'>Nazwa: </td>
    <td class='prawa'>
      <input class="form-text" type="text" id='name' name="data[name]" value='{$data.name|escape}' style='width: 333px;' />
    </td>
  </tr>

  <tr>
    <td class='lewa'>Plik z dysku: </td>
    <td class='prawa'>
            
      <script type="text/javascript">
		document.documentElement.className += ' js ';
	</script>    
    <div class="input-file"> 
    	<label> <span>Kliknij by wybrać</span> <input type="file" name="source_name" /> </label> <var><input type="text" name="my-input-file-path" value="wybierz plik..." readonly="readonly" />&nbsp;</var>
    </div>    
	<script type="text/javascript">{literal}
		var aUploadFileBtns = document.getElementsByName('source_name');
		for(var i=0,dBtn;dBtn = aUploadFileBtns[i];i++){
			new FileUploadUI(dBtn);
		};
	</script>{/literal}      
      
    </td>
  </tr>
  <tr>
  	<td class='lewa'>Opis: </td>
    <td class='prawa'>
      <textarea class="form-textarea" cols="58" name="data[description]">{$data.description}</textarea>
  	</td>
  </tr>
  <tr>
    <td class='lewa'>Status: </td>
    <td class='prawa'>
      {if !$data.active}
      <input type='radio' name='data[active]' value='N' id='status0' checked='checked' />
      {else}
      <input type='radio' name='data[active]' value='N' id='status0' />
      {/if}
      <label for='status0'>nieaktywny</label>
      {if $data.active}
      <input type='radio' name='data[active]' value='Y' id='status1' checked='checked' />
      {else}
      <input type='radio' name='data[active]' value='Y' id='status1' />
      {/if}
      <label for='status1'>aktywny</label>
    </td>
  </tr>
  <tr>
    <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
    	<img src='{#imgDir#}ico-anuluj.gif' onclick='location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}"' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />
      <input type='hidden' name='confirm' value='1' />
      <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
    </td>
  </tr>
</table>
</form>
