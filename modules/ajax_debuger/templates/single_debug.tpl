<div class="debug">
    <div class="ajax_debug_close"><a onclick="jQuery(this).parent().parent().remove()" title="usuń">x</a><br /><a onclick="jQuery(this).parent().parent().prevAll().remove();" title="usuń wszystkie poprzednie">&laquo;</a><br /><a onclick="jQuery(this).parent().parent().nextAll().remove();" title="usuń wszystkie następne">&raquo;</a></div>
    <div class="time" {if $ajax_debug.totalErrors > 0}style="color:#FF3300;"{/if}>{$ajax_debug.Time}</div>
		<ul>
    		<li><strong>Czas zapytań:</strong> {$ajax_debug.totalTime} ms</li>
    		<li><strong>Liczba zapytań:</strong> {$ajax_debug.totalQueries|@count}</li>
			{if $ajax_debug.totalErrors > 0}<li style="color:red;"><strong>Liczba błędów:</strong> {$ajax_debug.totalErrors}</li>{/if}
  		</ul>
  		{if $ajax_debug.totalQueries|@count >0}
  		<div class="debug_details">
  		{foreach from=$ajax_debug.totalQueries item=query_item name=single_query_foreach}
  		<div style="border-color:{if $query_item.error[2]}#F60{else}#0F0{/if};{if $smarty.foreach.single_query_foreach.last}margin-bottom:-6px;{/if}">
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
 		{/if} 
</div>

