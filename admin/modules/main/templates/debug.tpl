<div id="debug">
<div class="ajax_debuger_show" style="opacity:.1; cursor: default;" onclick="{literal} if(undefined===window.ajax_debuger_window) window.open('ajax_debuger.php', 'ajaxDebuger', 'status=0, height=420, width=750, scrollbars=1'); else if(ajax_debuger_window.document) ajax_debuger_window.focus(); else window.open('ajax_debuger.php', 'ajaxDebuger', 'status=0, height=420, width=750, scrollbars=1'); {/literal}">debuger ajaxa</div>
<script type="text/javascript">{literal}
	function showAjaxDebuerButton()
	{
		jQuery('.ajax_debuger_show').animate({opacity:'1'},{queue:false,duration:600});
		jQuery('.ajax_debuger_show').css({cursor:'pointer'});
	}{/literal}
	setTimeout('showAjaxDebuerButton()', 4400);
</script>

  <ul>
  	{if !empty($debug_exception)}
    <li style="font-weight: bold;color: red;">BŁĄD: {$debug_exception.info}</li>
	  	<ol>
	  		<li>Informacja: {$debug_exception.message}</li>
	  		<li>W pliku: {$debug_exception.file}</li>
	  		<li>W linii: {$debug_exception.line}</li>
	</ol>
    {/if}
    <li><strong>Czas zapytań:</strong> {$sql_log.totalTime} ms</li>
    <li><strong>Liczba zapytań:</strong> {$sql_log.totalQueries|@count}</li>
    {if $sql_log.totalErrors > 0}<li style="color:red;"><strong>Liczba błędów:</strong> {$sql_log.totalErrors}</li>{/if}
  </ul>
  {if $sql_log.totalQueries|@count >0}
  <div {if $smarty.session.show_debug}{else}style="display:none;" {/if}class="debug_details">
  {foreach from=$sql_log.totalQueries item=query_item}
  	<div style="border-color:{if $query_item.error[2]}#F60{else}#0F0{/if};">
    <table width="100%">
    	<tr>
    	<td align="left" style="font-weight:normal;">{$query_item.query|sql}</td>
        <td align="right" width="70px" valign="middle" style="font-weight:bold; border-left:{if $query_item.error[2]}#F60{else}#0F0{/if} solid 1px;" >{$query_item.time} ms</td>
    </tr>
    </table>
        {if $query_item.error[2]}
        <div class="sql_error">{$query_item.error[2]}</div>
        {/if}
    </div>
  {/foreach}
  </div>
 <div class="debug_show_details" onclick="this.blur(); if(jQuery('.debug_details').css('display')=='none') {literal}{show_debug('show'); jQuery('html,body').animate({scrollTop: jQuery('#debug').offset().top});}{/literal} else show_debug('hide');  jQuery('.debug_details').slideToggle();"><span style="margin-top:1px; display:inline-block;" >: :&nbsp; szczegóły zapytań &nbsp;: :</span></div>
 {/if}
</div>
