  {include file="main/templates/errors.tpl"}
<form name='editform' enctype='multipart/form-data' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=popup&amp;id={$data.id}">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
	<tr>
    <td class='lewa'>Nazwa: </td>
    <td class='prawa'>
      <input class="form-text" type="text" id='name' name="data[name]" value='{$data.name}' style='width: 350px;' />
    </td>
  </tr>
  {if !empty($data.file_name)}
  <tr>
  	<td>&nbsp;</td>
  	<td>
  		{if $data.typ eq 'image/jpg' or $data.typ eq 'image/png' or $data.typ eq 'image/gif' or $data.typ eq 'image/tiff'}
				<img src="tools/thumb.php?dir=files/docs/&file={$data.file_name}w=100"/>
  		{/if}
  	</td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
  	<td>
  		<div style="text-align:left;margin: 5px 0 5px 0;">
  			Nazwa pliku: &nbsp;<span style="font-weight: bold;">{$data.file_name}</span>
  		</div>
  		<div style="text-align:left;margin: 5px 0 5px 0;">
  			Rozmiar pliku: &nbsp;{$data.sizek|string_format:"%.2f"}&nbsp;KiB
  		</div>
    </td>
  </tr>
  {else}
  <tr>
    <td class='lewa'>Wczytaj plik: </td>
    <td class='prawa'>
      <input class="form-file" type="file" id='source_name' name="source_name" style='width: 300px;' />
    </td>
  </tr>
  {/if}
  <tr>
  	<td class='lewa'>Opis: </td>
    <td class='prawa'>
      <textarea class="form-textarea" cols="60" name="data[description]">{$data.description}</textarea>
  	</td>
  </tr>
  <tr>
    <td class='lewa'>Status: </td>
    <td class='prawa'>
      {if $data.active eq 'N'}
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
    <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
    	<img src='{#imgDir#}ico-anuluj.gif' onclick='refreshParent();' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />
      <input type='hidden' name='confirm' value='1' />
      <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
    </td>
  </tr>
</table>
</form>