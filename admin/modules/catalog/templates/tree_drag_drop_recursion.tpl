<ul>
  {foreach from=$parent key=k item=subnode name=sub_tree_loop}
		<li id="{$subnode.id_catalog}"> <a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$subnode.id_catalog}">{$subnode.name}</a> <div class="tree_options_div"><a href="javascript:void(0);" class="icon_tip icon_add" onclick="add_page({$subnode.id_catalog});" title="dodaj podkategorię"><img border="0" alt="dodaj podkategorię" src="img/add_file.png"/></a> 
        <a href="javascript:void(0);" class="icon_tip" onclick="delete_page({$subnode.id_catalog});" title="usuń kategorię"><img border="0" alt="usuń kategorię" src="img/delete_file.png"/></a> 
         <a href="javascript:void(0);" class="icon_tip" title="zmień status"><img src="img/{if $subnode.active eq 'N'}un{/if}visible.png" onclick="if(this.src=='{$smarty.const.SITE_ADDRESS}admin/img/visible.png'){literal}{{/literal} this.src='img/unvisible.png'; change_status({$subnode.id_catalog}, 'N'); {literal}}{/literal} else{literal}{{/literal} this.src='img/visible.png'; change_status({$subnode.id_catalog}, 'Y');{literal}}{/literal}" /></a> 
         <a href="javascript:void(0);" class="icon_tip" onclick="rename_page({$subnode.id_catalog});" title="zmień nazwę"><img border="0" alt="zmień nazwę" src="img/rename_small.png"/></a> 
          &nbsp;<a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$subnode.id_catalog}" class="icon_tip" title="edytuj"><img border="0"  alt="edytuj" src="css/img/ico-edit.png"/></a></div>


    {if !$smarty.foreach.sub_tree_loop.last }
  		{assign var=variable value=1}
  	{else}
    	{assign var=variable value=0}
  	{/if}


    {if $subnode.children > 0}
      {include file="catalog/templates/tree_drag_drop_recursion.tpl" parent=$subnode.children depth=$depth+1 parent_is_last_n=$variable}
    {/if}


  {/foreach}
</ul>