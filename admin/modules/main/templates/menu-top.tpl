<table border='0' cellspacing='0' cellpadding='0' style='width: 100%; margin:0 0 0 5px;'>
	<tr>
	{if $menuTopL != null}
		<td class='miedzy' width="30"><img src='{#imgDir#}miedzy4.png' /></td>
	{else}
		<td class='miedzy' width="30"><img src='{#imgDir#}miedzy2.png' /></td>
	{/if}
    <td style='text-align: left;'>
    
      <table border='0' cellspacing='0' cellpadding='0' style='width: 100%;' class="topmenu">
        <tr>
        {if $menuTopL != null}
          {section loop=$menuTopL name=pozycja}
          <td valign="middle" style="background:#dcdcdc;white-space:nowrap; border-top:1px solid #e5e5e5;">
            &nbsp;<a href="{$menuTopL[pozycja].href}" style="color:#7c7c7c!important;">{$menuTopL[pozycja].title}</a>&nbsp;
          </td>
          {if !$smarty.section.pozycja.last}
          <td valign="middle" class="miedzy"><img src='{#imgDir#}miedzy7.png' /></td>
          {/if}
          {/section}
          
          <td valign="middle" class="miedzy"><img src='{#imgDir#}miedzy5.png' /></td>
        {/if}
        
        
          <td valign="middle" style="white-space:nowrap;background:#f8f8f8; border-top:1px solid #ffffff;">
          	&nbsp;<a href="{$menuTopA.href}">{$menuTopA.title}</a>&nbsp;
          </td>
        {if $menuTopR != null}
          <td valign="middle" class="miedzy"><img src='{#imgDir#}miedzy1.png' alt='' /></td>
          {section loop=$menuTopR name=pozycja}
          {if !$smarty.section.pozycja.first}
          <td valign="middle" class="miedzy"><img src='{#imgDir#}miedzy7.png' /></td>
          {/if}
          <td valign="middle" style='text-align: right;white-space:nowrap;background:#dcdcdc;border-top:1px solid #e5e5e5;'>
            &nbsp;<a href="{$menuTopR[pozycja].href}" style="color:#7c7c7c!important;">{$menuTopR[pozycja].title}</a>&nbsp;
          </td>
          {/section}
          <td style='width: 21px;' valign="middle" class="miedzy"><img src='{#imgDir#}miedzy6.png' alt='' /></td>
        {else}
          <td style='width: 30px;' valign="middle"class="miedzy"><img src='{#imgDir#}miedzy3.png' alt='' /></td>
        {/if}
          <td class='menuGoraWypelnienie' valign="middle">&nbsp;</td>
        </tr>
      </table>
      
    </td>
    {*<td class='box-tr3'></td>*}
  </tr>
</table>