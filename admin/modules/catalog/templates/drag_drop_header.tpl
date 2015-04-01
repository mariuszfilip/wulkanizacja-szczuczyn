<link rel='stylesheet' type='text/css' href='css/drag-drop-tree.css' />
<script type="text/javascript" src="js/drag_and_drop/prototype.js"></script>
<script type="text/javascript" src="js/drag_and_drop/scriptaculous.js"></script>
<script type="text/javascript" src="cookie.js"></script>
<script type="text/javascript" src="js/drag_and_drop/drag-drop-tree.js"></script>
{if $smarty.const.CATALOG_DEPTH_LIMIT}
<style>
{section name=us1 start=0 loop=$smarty.const.CATALOG_DEPTH_LIMIT step=1}ul {/section}{literal} ul{
	opacity:.3;
}

{/literal}{section name=us1 start=0 loop=$smarty.const.CATALOG_DEPTH_LIMIT step=1}ul {/section}{literal} ul ul{
	opacity:1;
}

{/literal}{section name=us1 start=0 loop=$smarty.const.CATALOG_DEPTH_LIMIT step=1}ul {/section}{literal}.tree_options_div .icon_tip:first-child{
	display:none;
}
</style>
{/literal}
{/if}