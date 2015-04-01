  {include file="main/templates/errors.tpl"}

  {include file="file/templates/search.tpl"}

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
      <th style='text-align: left; width: 30%;'>Nazwa</th>
      <th style='text-align: left; width: 20%;'>Plik</th>
      <th style='text-align: left; width: 10%;'>Rozmiar (kB)</th>
      <th style='text-align: center; width: 5%;'>Aktywny</th>
      <th style='text-align: left; width: 5%;'></th>
    </tr>
  </thead>

  {if count($collection.items)>0}
    {foreach item=i key=k from=$collection.items}
    <tr class='{cycle values="odd,even"}'>
      <td style='text-align: center;'>{math equation="( x + y)" x=$k y=$collection.page.from}</td>
      <td style='text-align: left;'>{$i.name}</td>
      <td style='text-align: left;'>{if $i.type eq 5}<img src="css/icons/pdf.gif" title="PDF" alt="PDF" />{elseif $i.type == 4 || $i.type == 11}<img src="css/icons/doc.gif" title="Dokument Microsoft Word" alt="Dokument Microsoft Word" />{elseif $i.type > 5 && $i.type<11}<img src="css/icons/document-image.png" title="Image" alt="Image" />{elseif $i.video}<img src="css/icons/video.png" title="Video dla Flash" alt="Video dla Flasha" />{else}<img src="css/icons/unknown.png" title="Nieznany format pliku" alt="Nieznany format pliku" />{/if} {$i.file_name|substr:15}</td>
      <td style='text-align: left;'>{$i.sizek|string_format:"%.2f"}</td>
      <td style='text-align: center;'>
      {if $i.active eq 'Y'}
        <img src='{#imgDir#}mark-green.gif'>
      {else}
        <img src='{#imgDir#}mark-red.gif'>
      {/if}
      </td>
      <td>
        <a href='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$i.id_file}'><img src='{#imgDir#}ico-edit.png' border='0' alt='edytuj' title='edytuj' /></a>
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