  {include file="main/templates/errors.tpl"}
<form name='editform' enctype='multipart/form-data' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=add">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
<tr>
  <td class='lewa' style='width:15%;'>Kategoria:</td>
  <td class='prawa' style='width:85%;'>    
    <select type="text" name="data[id_catalog]" value="{$data.id_catalog}" style="width: 330px;">
    <option>&nbsp;- wybierz - </option>
    {foreach from=$categories item=category_item}
    <option {if $category_item.active eq 'N'}style="color:#CCC"{/if} {if $data.id_catalog eq $category_item.id_catalog}selected="selected"{/if} value="{$category_item.id_catalog}">&nbsp;{$category_item.name}</option>
    {if $category_item.children}
    	{foreach from=$category_item.children item=children_item}
        <option {if $children_item.active eq 'N'}style="color:#CCC"{/if} {if $data.id_catalog eq $children_item.id_catalog}selected="selected"{/if} value="{$children_item.id_catalog}">&nbsp;&nbsp; &raquo;&nbsp;{$children_item.name}</option>
        {/foreach}
    {/if}
    {/foreach}
    </select>
  </td>
</tr>
<tr>
  <td class='lewa' style='width:15%;'>Nazwa:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[name]" value="{$data.name|escape}" style="width: 330px;" />
  </td>
</tr>
<tr>
  <td class='lewa'>Opis skrócony: </td>
  <td class='prawa'>
   	<textarea cols="40" rows="40" id="contents" name="data[short_content]" >{$data.short_content}</textarea>
      	
      	{literal}
      	<script type="text/javascript">
      		 CKEDITOR.replace( 'contents',{
       			width: 700,
      		 });        
  		</script>
      	{/literal}

  </td>
</tr>
<tr>
  <td class='lewa'>Pełny opis: </td>
  <td class='prawa'>
   	<textarea cols="40" rows="40" id="contentss" name="data[content]" >{$data.content}</textarea>
      	
      	{literal}
      	<script type="text/javascript">
      		 CKEDITOR.replace( 'contentss',{
       			width: 700,
      		 });        
  		</script>
      	{/literal}
  </td>
</tr>

<tr>
  <td class='lewa' style='width:15%;'>Cena:</td>
  <td class='prawa' style='width:85%;'>
    <input style="text-align:right" class="form-text" type="text" name="data[price]" value="{$data.price}" style="width: 40px;" maxlength="13" /> &nbsp;$
  </td>
</tr>

<tr>
  <td class='lewa'>Status: </td>
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
<!-- submit dodawania rekordu -->
<tr>
  <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
  	<img src='{#imgDir#}ico-anuluj.gif' onclick='location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}"' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />
    <input type='hidden' name='confirms' value='1' />
    <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
  </td>
</tr></table>
</form>