<div style='text-align: right; padding: 3px 0px 5px 10px;'>
  <div class='naglowek'>Wybierz pliki dla edytowanej strony</div>
</div>

<div style='text-align: center; padding: 10px 0px 10px 0px;'>
  {include file="page/templates/search-files.tpl"}
</div>

<div style='text-align: right;'>
  <table style="width:100%">
    <tr>
      <td>
        {include file="main/templates/sort.tpl"}
      </td>
      <td>
      </td>
    </tr>
  </table>
</div>

<form id='listaform' name='listaform' method='post'>
<table class="list" style='width: 100%;' border='0' id='lista' cellspacing='0' cellpadding='0'>
  <thead>
    <tr>
      <th style='text-align: center; width: 5%;'>Lp.</th>
      <th style='text-align: center; width: 28px;'></th>
      <th style='text-align: left; width: auto;'>Nazwa</th>
      <th style='text-align: left; width: 35%;'>Plik</th>
    </tr>
  </thead>

  {if count($collection.items)>0}
    {foreach item=i key=k from=$collection.items}
    {assign var='idfile' value=$i.id_file}
    <tr class='{cycle values="odd,even"}'>
      <td style='text-align: center;'>{math equation="( x + y)" x=$k y=$collection.page.from}</td>
      <td style='text-align: center;'>
          <input type='hidden' name='hidden[{$i.id_file}]' value='1' />
      </td>
      <td style='text-align: left;'><input type='checkbox' name='ascribe[{$i.id_file}]' id='asc{$i.id_file}' class="checkbox" value='1'{if $files.$idfile.added eq '1'} checked="checked"{/if} /><label for="asc{$i.id_file}" class="label" style="margin-left:-28px; padding-left:28px;">{$i.name}</label></td>

      <td style='text-align: left;'><label for="asc{$i.id_file}" class="label" style="margin-left:0; padding-left:0px; background:none; background-image:none;">{$i.file_name|substr:15}</label></td>
    </tr>
    {/foreach}
  {else}
    <tr class='odd'>
      <td class='odd' colspan='6' style='text-align: center;'>BRAK DANYCH</td>
    </tr>
  {/if}

  <tr class='odd'>
    <td class='odd' colspan='6' style='text-align: center;'>
      {assign var="link" value="&amp;act=files&amp;id="}
      {assign var="return" value="&amp;act=edit&amp;id="}
      {include file="main/templates/page.tpl" page=$collection.page submit_ascribe=ascribe_files return=$return$id_page link=$link$id_page }
    </td>
  </tr>
  
</table>
</form>