  {include file="main/templates/errors.tpl"}
  {include file="event/templates/search.tpl"}

<div style='text-align: right;'>
  <table style="width:100%">
    <tr>
      <td>
        {*include file="main/templates/sort.tpl"*}
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
      <th style='text-align: left; width: 20%;'>Tytuł</th>
      <th style='text-align: left; width: 10%;'>Data dodania</th>
      <th style='text-align: left; width: 10%;'>Data rozpoczęcia</th>
      <th style='text-align: left; width: 10%;'>Data zakończnia</th>
      <th style='text-align: center; width: 10%;'>Bezterminowo</th>
      <th style='text-align: center; width: 20%;'>Aktywny</th>
      <th style='text-align: center; width: 10%;'></th>
    </tr>
  </thead>

  {if count($collection.items)>0}
    {foreach item=i key=k from=$collection.items}
    <tr class='{cycle values="odd,even"}'>
      <td style='text-align: center;'>{math equation="(x + y)" x=$k y=$collection.page.from}</td>
      <td style='text-align: left;'>{$i.title}</td>
      <td style='text-align: left;'>{$i.added|truncate:10:""}</td>
      <td style='text-align: left;'>{$i.date_from}</td>
      <td style='text-align: left;'>{$i.date_to}</td>
      <td style='text-align: center;'>
        {if $i.always eq 'Y'}
          <img src='{#imgDir#}mark-green.gif'>
        {elseif $i.always eq 'N'}
          <img src='{#imgDir#}mark-red.gif'>
        {/if}
      </td>
      <td style='text-align: center;'>
      {if $i.active}
        <img src='{#imgDir#}mark-green.gif'>
      {else}
        <img src='{#imgDir#}mark-red.gif'>
      {/if}
      </td>
      <td>
        <a href='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$i.id_event}'><img src='{#imgDir#}ico-edit.png' border='0' alt='edytuj' title='edytuj' /></a>
      </td>
    </tr>
    {/foreach}
  {else}
    <tr class='odd'>
      <td class='odd' colspan='8' style='text-align: center;'>BRAK DANYCH</td>
    </tr>
  {/if}

  <tr class='odd'>
    <td class='odd' colspan='8' style='text-align: center;'>{include file="main/templates/page.tpl" page=$collection.page}</td>
  </tr>
  
</table>
</form>
