  {include file="main/templates/errors.tpl"}
<form name='editform' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=popup&amp;id={$data.id}">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
  <tr>
    <td class='lewa'>Nazwa: </td>
    <td class='prawa'>
      <input class="form-text" type="text" id='name' name="data[name]" value='{$data.name}' style='width: 264px;' />
    </td>
  </tr>
  <tr>
    <td class='lewa'>Opis: </td>
    <td class='prawa'>
      <textarea class="form-textarea" cols="60" name="data[description]">{$data.description}</textarea>
    </td>
  </tr>
  <tr>
    <td class='lewa'>Status: </td>
    <td class='prawa'>
      {if $data.active == N}
      <input type='radio' name='data[active]' value='N' id='status0' checked='checked' />
      {else}
      <input type='radio' name='data[active]' value='N' id='status0' checked='checked' />
      {/if}
      <label for='status0'>nieaktywny</label>
      {if $data.active == Y}
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
    	<img src='{#imgDir#}ico-anuluj.gif' onclick='refreshParent();' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />
      <input type='hidden' name='confirm' value='1' />
      <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
      <input type='hidden' name='data[id]' value='{$data.id}' />
    </td>
  </tr>
</table>
</form>
<div class='naglowek'>Lista plików w galerii</div>
<form name='addphoto' method="post" enctype='multipart/form-data' action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=popup&amp;id={$data.id}">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
  <tr>
    <td class='lewa'>Zdjęcia: </td>
    <td class='prawa'>
      {include file="gallery/templates/gallery.tpl" gallery=$photo}
    </td>
  </tr>
  <tr>
    <td class='lewa'>Dodaj zdjęcie:</td>
    <td class='prawa'>
      <input type='file' name='file'>
    </td>
  </tr>
  <tr>
    <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
      <img src='{#imgDir#}ico-anuluj.gif' onclick='refreshParent();' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />
      <input type='hidden' name='confirm_photo' value='1' />
      <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.addphoto.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
      <input type='hidden' name='data[id]' value='{$data.id}' />
    </td>
  </tr>
</table>
