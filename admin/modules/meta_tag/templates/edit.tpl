  {include file="main/templates/errors.tpl"}
<form name='editform' enctype='multipart/form-data' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
<tr>
  <td class='lewa' style='width:15%;'>meta title:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[meta_title]" value="{$data.meta_title|escape}" style="width: 330px;" />
    <input type="checkbox" id="meta_title_overwrite" name="data[meta_title_overwrite]" value="1" {if $data.meta_title_overwrite eq 1}checked="checked"{/if} class="checkbox"/> <label for="meta_title_overwrite" class="label">nadpisuj wszystkie</label>
    {if $const_languages && $const_languages|@count >1}
    <input type="checkbox" id="meta_title_all_lang" name="all_lang[meta_title]" value="1" class="checkbox"/> <label for="meta_title_all_lang" class="label">wszystkie języki</label>
    {/if}
  </td>
</tr>

<tr>
  <td class='lewa' style='width:15%;'>meta keywords:</td>
  <td class='prawa' style='width:85%;'>
    <textarea class="form-textarea" style="width:330px;" name="data[meta_keywords]">{$data.meta_keywords}</textarea>
    <input type="checkbox" id="meta_keywords_overwrite" name="data[meta_keywords_overwrite]" value="1" {if $data.meta_keywords_overwrite eq 1}checked="checked"{/if} class="checkbox"/> <label for="meta_keywords_overwrite" class="label" style="vertical-align:top;">nadpisuj wszystkie</label>
    {if $const_languages && $const_languages|@count >1}
     <input type="checkbox" id="meta_keywords_all_lang" name="all_lang[meta_keywords]" value="1" class="checkbox"/> <label for="meta_keywords_all_lang" class="label" style="vertical-align:top;">wszystkie języki</label>
     {/if}
  </td>
</tr>

<tr valign="top">
  <td class='lewa'>meta description:</td>
  <td class='prawa'>    
    <textarea class="form-textarea" style="width:330px;" name="data[meta_description]">{$data.meta_description}</textarea>
    <input type="checkbox" id="meta_description_overwrite" name="data[meta_description_overwrite]" value="1" {if $data.meta_description_overwrite eq 1}checked="checked"{/if} class="checkbox"/> <label for="meta_description_overwrite" class="label" style="vertical-align:top;">nadpisuj wszystkie</label>
    {if $const_languages && $const_languages|@count >1}
    <input type="checkbox" id="meta_description_all_lang" name="all_lang[meta_description]" value="1" class="checkbox"/> <label for="meta_description_all_lang" class="label" style="vertical-align:top;">wszystkie języki</label>
     {/if}
  </td>
</tr>

<tr>
  <td class='lewa' style='width:15%;'>meta robots:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[meta_robots]" value="{$data.meta_robots|escape}" style="width: 330px;" />
    <input type="checkbox" id="meta_robots_overwrite" name="data[meta_robots_overwrite]" value="1" {if $data.meta_robots_overwrite eq 1}checked="checked"{/if} class="checkbox"/> <label for="meta_robots_overwrite" class="label">nadpisuj wszystkie</label>
    {if $const_languages && $const_languages|@count >1}
    <input type="checkbox" id="meta_robots_all_lang" name="all_lang[meta_robots]" value="1" class="checkbox"/> <label for="meta_robots_all_lang" class="label">wszystkie języki</label>
    {/if}
  </td>
</tr>

<tr>
  <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
    <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
    <input type='hidden' name='confirms' value='1' />
    <input type='hidden' name='data[id]' value='{$data.id}' />
  </td>
</tr></table>
</form>