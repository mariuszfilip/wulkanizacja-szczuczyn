<table class="list" style='width: 100%;' border='0' id='stronicowanie' cellspacing='0' cellpadding='0'>
  <tr class='dolna'>
    <td style='text-align: left; padding-left: 15px;width:25%;' rowspan='2'>
    </td>
    <td style='width:50%;text-align:center;'>
    {* stronicowanie *}
    {if $page.first != 0}
      <a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;page={$page.first}{$link}" class='wiecejNobold'>|<</a>&nbsp;
    {/if}
    {if $page.previous != 0}
      <a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;page={$page.previous}{$link}" class='wiecejNobold'><<</a>&nbsp;&nbsp;
    {/if}
    {if $page.backwards != 0}
      <a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;page={$page.backwards}{$link}" class='wiecejNobold'>...</a>
    {/if}
    {if $page.previous_2 != 0}
      <a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;page={$page.previous_2}{$link}" class='wiecejNobold'>{$page.previous_2}</a>
    {/if}
    {if $page.previous_1 != 0}
      <a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;page={$page.previous_1}{$link}" class='wiecejNobold'>{$page.previous_1}</a>
    {/if}
    {if $page.current != 0}
      <span class='wiecejBold'>[{$page.current}]</span>
    {/if}
    {if $page.next_1 != 0}
      <a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;page={$page.next_1}{$link}" class='wiecejNobold'>{$page.next_1}</a>
    {/if}
    {if $page.next_2 != 0}
      <a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;page={$page.next_2}{$link}" class='wiecejNobold'>{$page.next_2}</a>
    {/if}
    {if $page.forwards != 0}
      <a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;page={$page.forwards}{$link}" class='wiecejNobold'>...</a>
    {/if}
    {if $page.next != 0 && $page.next != 1}
      &nbsp;&nbsp;<a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;page={$page.next}{$link}" class='wiecejNobold'>>></a>
    {/if}
    {if $page.last != 0 && $page.last != 1}
      &nbsp;<a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;page={$page.last}{$link}" class='wiecejNobold' style=''>>|</a>
    {/if}
    </td>
    <td style='text-align: center; padding-left: 15px; padding-right: 15px; width:25%;' rowspan='2'>
    {if $submit_ascribe ne ''}
      <input class="form-button" value="&laquo; powrót" onclick='location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}{$return}"' type="button">
      <input class="form-button"  type="submit" name="{$submit_ascribe}" value="zapisz">
    {/if}
    </td>    
  </tr>
  <tr class='dolna' style='text-align:center;'>
    <td>
      Wyświetlane: od <span style='font-weight: bold;'>{$page.from}</span> do
      <span style='font-weight: bold;'>{$page.to}</span> z
      <span style='font-weight: bold;'>{$page.all}</span> rekordów
    </td>
  </tr>
  </table>
