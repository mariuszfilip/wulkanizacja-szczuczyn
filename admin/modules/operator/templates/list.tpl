{include file="main/templates/errors.tpl"}

{*<!--div style='text-align: center; padding: 10px 0px 10px 0px;'>
  {include file="operator/templates/search.tpl"}
</div-->*}
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

<table class="list" style='width: 100%;' border='0' id='lista' cellspacing='0' cellpadding='0'>
  <thead>
    <tr>
      <th style='text-align: center; width: 5%;'>Lp.</th>
      <th style='text-align: left; width: 27%;'>Imię</th>
      <th style='text-align: left; width: 27%;'>Nazwisko</th>      
      <th style='text-align: left; width: 26%;'>Email</th>
      <th style='text-align: center; width: 10%;'>Aktywny</th>
      <th style='text-align: center; width: 5%;'></th>
    </tr>
  </thead>

{if count($collection.items)>0}
  {foreach item=i key=k from=$collection.items}
    <tr class='{cycle values="odd,even"}'>
      <td style='text-align: center;'>{math equation="( x + y)" x=$k y=$collection.page.from}</td>
      <td style='text-align: left;'>{$i.name}</td>
      <td style='text-align: left;'>{$i.surname}</td>
      <td style='text-align: left;'>{$i.email}</td>
      <td style='text-align: center;'>
      {if $i.active eq 'Y'}
        <img src='{#imgDir#}mark-green.gif'>
      {elseif  $i.active eq 'N'}
        <img src='{#imgDir#}mark-red.gif'>
      {/if}
      </td>
      <td>
        <a href='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$i.id}'>
          <img src='css/img/ico-edit.png' border='0' alt='edytuj' title='edytuj' />
        </a>
      </td>
    </tr>
  {/foreach}
  <tr class='odd'>
    <td class='odd' colspan='8' style='text-align: center;'>{include file="main/templates/page.tpl" page=$collection.page}</td>
  </tr>
{else}
  <tr class='odd'>
    <td class='odd' colspan='8' style='text-align: center;'>BRAK DANYCH</td>
  </tr>
{/if}
</table>