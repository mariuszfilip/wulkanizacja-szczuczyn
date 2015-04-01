  {include file="main/templates/errors.tpl"}
<form name='editform' enctype='multipart/form-data' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$data.id}">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
  <tr>
    <td class='lewa'>Nazwa: </td>
    <td class='prawa'>
      <input class="form-text" type="text" id='name' name="data[name]" value='{$data.name|escape}' style='width: 350px;' />
    </td>
  </tr>
  
{if $smarty.session.user.super_user eq 1}
  <tr>
    <td class='lewa'>Moduł: </td>
    <td class='prawa'>
		<select type="text" name="data[id_module]" style="width: 355px;">
    <option value=""> [ - wybierz - ] </option>
    
    {foreach from=$modules item=module}
    <option {if $data.id_module eq $module.id_module}selected="selected"{/if} value="{$module.id_module}">&nbsp;{$module.name}</option>
    {/foreach}
    </select>
    </td>
  </tr>
{/if}

  <tr>
    <td class='lewa'>Treść: </td>
    <td class='prawa'>
      
      			
      	<textarea cols="40" rows="40" id="contents" name="data[content]" >{$data.content}</textarea>
      	
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
      <span style="font-size:10px;width:200px;">(Poniższa wartość jest domyślna.)</span><br />
      <input type="text" class="form-text" name="data[meta_robots]" value="{$meta_robots}" style='width: 200px;' readonly="readonly" />
    </td>
  </tr>
  <tr>
    <td class='lewa'>Meta Last Modified: </td>
    <td class='prawa'>
      <input type="text" class="form-text" name="data[meta_last_modified]" value="{$meta_last_modified}" style='width: 200px;' readonly="readonly" />
    </td>
  </tr>
  <tr>
    <td class='lewa'>Status: </td>
    <td class='prawa'>
      
      <input type='radio' name='data[active]' value='N' id='status0' {if $data.active != 'Y'}checked='checked'{/if} />
      <label for='status0'>niewidoczny</label>
      
      <input type='radio' name='data[active]' value='Y' id='status1' {if $data.active == 'Y'}checked='checked'{/if} />
      <label for='status1'>widoczny</label>
    </td>
  </tr>
  
  
<tr>
	<td class='lewa'>&nbsp;</td>
	<td class='prawa'>
	<input type="checkbox" class="checkbox" {if $data.bottom_menu == 'Y'}checked="checked"{/if} value="Y" name="data[bottom_menu]" id="bottom_menu"> <label class="label" for="bottom_menu" style="margin-left:0px;">wyświetlaj także w dolnym menu</label>
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
       {if $data.editable neq N || $smarty.session.user.super_user eq 1}<input type='hidden' name='confirmed' value='1' />
      <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
      <input type='hidden' name='data[id]' value='{$data.id}' />{/if}
           {if $data.deletable neq N}<img src='{#imgDir#}ico-usun.gif' onclick='if(confirm("Jeśli chcesz usunąć kliknij [OK]\nJeśli nie [Anuluj]"))location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=del&amp;id={$data.id}"' onmouseover="this.src='{#imgDir#}ico-usun-over.gif'" onmouseout="this.src='{#imgDir#}ico-usun.gif'" class='icon' />{/if}
    </td>
  </tr>

  <tr>
    <td colspan="2">
      <div style="border-bottom: 1px solid #058CC4; width: 100%;"></div>
    </td>
  </tr>

  <tr style="vertical-align:top;">
         <td class="lewa">Przypisane pliki: </td>
         <td class="prawa" style="padding-top:10px;">
      {if count($addedFiles) > 0}
      <div style="overflow: auto; max-height: 250px;">
           <table class="lista noTigra" id='lista' border="0" cellpadding="0" cellspacing="0">
                <thead>
                   <tr class="nodrop nodrag">
                     <th style="width:5%;text-align:center;padding-right:5px;" class="no_link">&nbsp;</th>
                     <th style="width:40%;text-align:left;padding-left:5px;" class="no_link">Nazwa</th>
                     <th style="width:35%;text-align:left;padding-left:5px;" class="no_link">Plik</th>
                     <th style="width:10%;text-align:center;" class="no_link">Edycja</th>
                   </tr>
                 </thead>
                 {foreach from=$addedFiles item=file}
                 <tr class='{cycle values="odd,even"}' id="{$file.id_file}">
									{if count($addedFiles) > 1}<td class="dragHandle icon_tip" title="przeciągnij by zmienić kolejność"><span class="handle"></span></td>{else}<td>&nbsp;</td>{/if}
                   <td style="text-align:left;padding-left:5px;">{$file.name}</td>
                   <td style="text-align:left;padding-left:5px;">{$file.file_name|substr:15}</td>
                   <td style="text-align:center;">
                     <a href="popup.php?mod=file&amp;act=popup&amp;id={$file.id_file}" title='edytuj' class="icon_tip" rel="lyteframe" rev="width: 850px; height: 600px; scrolling: auto;">
                        <img src='{#imgDir#}ico-edit.png' border='0' alt='edytuj' class='icon' />
                       </a>
                   </td>
                </tr>
                {/foreach}
           </table>
                </div>
                {else}
        brak przypisanych
      {/if}
      <br /><a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=files&amp;id={$data.id_page}">przypisz plik &raquo;</a>
         </td>
  </tr>




  <tr style="vertical-align:top;">
    <td class='lewa' style="padding-top:10px;">Przypisane galerie: </td>
    <td class='prawa' style="padding-top:10px;">
      {if count($gallerys) > 0}
      <div style="overflow: auto; max-height: 250px;">
        <table class="lista noTigra" id='lista2' border="0" cellpadding="0" cellspacing="0">
        <thead>
          <tr class="nodrop nodrag">
            <th style="width:5%;text-align:center;padding-right:5px;">&nbsp;</th>
            <th class="no_link" style="width:75%;text-align:left;padding-left:5px;">Nazwa</th>
            <th class="no_link" style="width:10%;text-align:center;">Podgląd</th>
            <th style="width:10%;text-align:center;">Edycja</th>
          </tr>
        </thead>
        {foreach item=i key=k from=$gallerys}
          <tr id="{$i.id_gallery}">
            {if count($gallerys) > 1}<td class="dragHandle icon_tip" title="przeciągnij by zmienić kolejność"><span class="handle"></span></td>{else}<td>&nbsp;</td>{/if}
            <td style="text-align:left;padding-left:5px;">{$i.name}</td>
            <td style="text-align:center;">
                    <a href="previewGallery.php?id={$i.id_gallery}&amp;height=600&amp;width=890" class="icon_tip" title="zdjęcia w galerii" rel="lyteframe" rev="width: 900px; height: 600px; scrolling: auto;">
                       <img src="{#imgDir#}preview.gif" style="height: 15px;" alt="podgląd" />
                    </a>
            </td>
            <td style="text-align:center;">
             <a href="popup.php?mod=gallery&amp;act=popup&amp;id={$i.id_gallery}" title="edytuj" class="icon_tip" rel="lyteframe" rev="width: 850px; height: 600px; scrolling: auto;">
              <img src='{#imgDir#}ico-edit.png' border='0' alt='edytuj' class='icon' />
             </a>
            </td>
          </tr>
        {/foreach}
        </table>
        </div>
      {else}
        brak przypisanych
      {/if}
      <br /><a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=gallerys&amp;id={$data.id_page}">przypisz galerie &raquo;</a>
    </td>
  </tr>
{* <!-- 
<tr style="vertical-align:top;">
    <td class='lewa' style="padding-top:10px;">Artykuły: </td>
    <td class='prawa' style="padding-top:10px;">
      {if count($articles) > 0}
      <div style="overflow: auto; max-height: 250px;">
        <table class="lista" id='lista' border="0" cellpadding="0" cellspacing="0">
        <thead>
          <tr>
            <td style="width:5%;text-align:right;padding-right:5px;">Lp.</td>
            <td style="width:75%;text-align:left;padding-left:5px;">Nazwa</td>
            <td style="width:10%;text-align:center;">&nbsp;</td>
            <td style="width:10%;text-align:center;">Edycja</td>
          </tr>
        </thead>
        {foreach item=ia key=k from=$articles}
          <tr class='{cycle values="odd,even"}'>
            <td style="text-align:right;padding-right:5px;">{$ia.id}</td>
            <td style="text-align:left;padding-left:5px;">{$ia.name}</td>
            <td style="text-align:center;">&nbsp;</td>
            <td style="text-align:center;">
              <img onclick="popup('popup.php?mod=articles&amp;act=popup&amp;id_article={$ia.id_article}','990','550');" src='{#imgDir#}ico-edit.gif' border='0' alt='edytuj' title='edytuj' />
            </td>
          </tr>
        {/foreach}
        </table>
        </div>
      {else}
        <b>brak przypisanych</b><br>
      {/if}
      <a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=articles&amp;id={$data.id_page}">przypisz artykuł &raquo;</a>
    </td>
  </tr>
-->*}
</table>
</form>
{if count($gallerys)>1 || count($addedFiles)>1}
<script type="text/javascript" src="js/jquery.tablednd_0_5.js"></script>
<script type="text/javascript">
//<![CDATA[
{if count($addedFiles) > 1}
		setTableAjaxOrderDrag("lista", 'mod=page&act=order_file&id={$data.id}');
{/if}
{if count($gallerys)>1}
		setTableAjaxOrderDrag("lista2", 'mod=page&act=order_galery&id={$data.id}');
{/if}
		MM_preloadImages('./css/img/openhand.cur', './css/img/closedhand.cur', './css/img/large-grey-back-light-blue.gif', './css/img/large-blue-back-hover.gif', './css/img/UI-loader.gif');
//]]>
</script>
{/if}