

<div style='text-align: right; padding: 3px 0px 5px 10px;'>
  <div class='naglowek'>Wybierz artykul dla edytowanej strony</div>
</div>

<div style='text-align: center; padding: 10px 0px 10px 0px;'>
  {include file="exhibit/templates/search-gallerys.tpl"}
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

<form action='' id='listaform' name='listaform' method='post'>
<table class="list" style='width: 100%;' border='0' id='lista' cellspacing='0' cellpadding='0'>
  <thead>
    <tr>
      <th style='text-align: center; width: 5%;'>Lp.</th>
      <th style='text-align: center; width: 5%;'></th>
      <th style='text-align: left; width: 35%;'>Nazwa</th>
    </tr>
  </thead>

  {if count($collection.items)>0}
    {foreach item=i key=k from=$collection.items}
    {assign var='idgallery' value=$i.id_article}
    <tr class='{cycle values="odd,even"}'>
      <td style='text-align: center;'>{math equation="( x + y)" x=$k y=$collection.page.from}</td>
      <td style='text-align: center;'>
          <input type='hidden' name='hidden[{$i.id_article}]' value='1' />
          <input type='checkbox' name='ascribe[{$i.id_article}]' value='1'{if $articles.$idgallery.added eq '1'} checked="checked"{/if} />
      </td>
      <td style='text-align: left;'>{$i.name}</td>
    </tr>
    {/foreach}
  {else}
    <tr class='odd'>
      <td class='odd' colspan='3' style='text-align: center;'>BRAK DANYCH</td>
    </tr>
  {/if}

  <tr class='odd'>
    <td class='odd' colspan='3' style='text-align: center;'>
      {assign var="link" value="&amp;act=articles&amp;id="}
      {assign var="return" value="&amp;act=edit&amp;id="}
      {include file="main/templates/page.tpl" page=$collection.page submit_ascribe=ascribe_gallerys return=$return$id_page link=$link$id_page }
    </td>
  </tr>
  
</table>
</form>
