  {include file="main/templates/errors.tpl"}
<div style='text-align: right;'>
  <table style="width:100%">
    <tr>
      <td>
        {include file="main/templates/sort.tpl"}
      </td>
      <td>
        <img src="{#imgDir#}ico-dodaj.gif" class="icon" alt="dodaj" onclick="location.href='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=add'" />
      </td>
    </tr>
  </table>
</div>

<form action='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}' id='listaform' name='listaform' method='post'>
<table class="list" style='width: 100%;' border='0' id='lista' cellspacing='0' cellpadding='0'>
  <thead>
    <tr>
      <th style='text-align: center; width: 5%;'>Lp.</th>
      <th style='text-align: left; width: 35%;'>Nazwa klucz</th>
      <th style='text-align: left; width: 35%;'>Tytuł</th>
      <th style='text-align: center; width: 10%;'></th>
    </tr>
  </thead>

  {if count($collection.items)>0}
    {foreach item=i key=k from=$collection.items}
    <tr class='{cycle values="odd,even"}'>
      <td style='text-align: center;'>{math equation="( x + y)" x=$k y=$collection.page.from}</td>
      <td style='text-align: left;'>{$i.name}</td>
      <td style='text-align: left;'>{$i.title}</td>
      <td>
        <a href='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$i.id_otherpage}'><img src='{#imgDir#}ico-edit.png' border='0' alt='edytuj' title='edytuj' /></a>
      </td>
    </tr>
    {/foreach}
  {else}
    <tr class='odd'>
      <td class='odd' colspan='6' style='text-align: center;'>BRAK DANYCH</td>
    </tr>
  {/if}

  <tr class='odd'>
    <td class='odd' colspan='6' style='text-align: center;'>{include file="main/templates/page.tpl" page=$collection.page}</td>
  </tr>
  
</table>
</form>
