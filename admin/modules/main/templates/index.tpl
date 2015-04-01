{include file="main/templates/header.tpl"}
{if $smarty.session.user.id_operator > 0}
<table border='0' cellspacing='0' cellpadding='0' style='width:100%;'>
	<tr>
		<td style='vertical-align: top;width:190px; padding-right:4px;{if $smarty.session.hide_left_menu} display:none;{/if}' class="left_menu_js" >
			{include file="main/templates/menu.tpl" width='150px;'}
		</td>
    
		<td style='vertical-align: top; text-align:left;'><a href="javascript:;" title="{if $smarty.session.hide_left_menu}pokaż{else}ukryj{/if} menu" {literal}onclick="this.blur(); if(jQuery('.left_menu_js').css('display')=='none') show_left_menu('show'); else show_left_menu('hide');"{/literal} class="show_hide_menu icon_tip">{if $smarty.session.hide_left_menu}&raquo;{else}&laquo;{/if}</a>
		{include file="main/templates/menu-top.tpl"}
		{*include file="main/templates/errors.tpl"*}
			<table border='0' cellspacing='0' cellpadding='0' style='width: 100%;' class="zawartosc">
				<tr>
					<td style='text-align: center;'>
					 {if $moduletpl ne ''}
					   {include file=$moduletpl}
					 {/if}
					</td>
				</tr>
			</table>
      
		</td>
    
	</tr>
</table>
{else}
  {include file=$moduletpl}
{/if}
{if isset($debug) && $debug == true}
 {include file="main/templates/debug.tpl"}
{/if}
{include file="main/templates/footer.tpl"}