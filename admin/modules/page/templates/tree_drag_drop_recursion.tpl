<ul>
  {foreach from=$parent key=k item=subnode name=sub_tree_loop}
        <li id="{$subnode.id_page}" {if $subnode.dragable eq N}class="undragable"{/if}> <a {if $subnode.editable eq N && $smarty.session.user.super_user neq 1}style="cursor:default;"{else}href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$subnode.id_page}"{/if}>{$subnode.name}</a> <div class="tree_options_div">{if $subnode.addable eq N}<a><img border="0" alt="" src="img/add_file.png" class="menu_unactive"/></a>{else}<a href="javascript:void(0);" class="icon_tip" onclick="add_page({$subnode.id_page});" title="dodaj podstronę"><img border="0" alt="dodaj podstronę" src="img/add_file.png"/></a>{/if}
        {if $subnode.deletable eq N}<a><img border="0" alt="" src="img/delete_file.png" class="menu_unactive" /></a>{else}<a href="javascript:void(0);" class="icon_tip" onclick="delete_page({$subnode.id_page});" title="usuń stronę"><img border="0" alt="usuń stronę" src="img/delete_file.png"/></a>{/if}
         {if $subnode.statusable eq N}<a><img src="img/{if $subnode.active eq 'N'}un{/if}visible.png" class="menu_unactive" /></a>{else}<a href="javascript:void(0);" class="icon_tip" title="zmień status"><img src="img/{if $subnode.active eq 'N'}un{/if}visible.png" onclick="if(this.src=='{$smarty.const.SITE_ADDRESS}admin/img/visible.png'){literal}{{/literal} this.src='img/unvisible.png'; change_status({$subnode.id_page}, 'N'); {literal}}{/literal} else{literal}{{/literal} this.src='img/visible.png'; change_status({$subnode.id_page}, 'Y');{literal}}{/literal}" /></a>{/if}
          {if $subnode.renameable eq N}<a><img border="0" alt="" src="img/rename_small.png" class="menu_unactive" /></a>{else}<a href="javascript:void(0);" class="icon_tip" onclick="rename_page({$subnode.id_page});" title="zmień nazwę"><img border="0" alt="zmień nazwę" src="img/rename_small.png"/></a>{/if}
          &nbsp;{if $subnode.editable eq N}<a><img border="0"  alt="" src="css/img/ico-edit.png" class="menu_unactive" /></a>{else}<a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$subnode.id_page}" class="icon_tip" title="edytuj"><img border="0"  alt="edytuj" src="css/img/ico-edit.png"/></a>{/if}</div>
    {if !$smarty.foreach.sub_tree_loop.last }
  		{assign var=variable value=1}
  	{else}
    	{assign var=variable value=0}
  	{/if}

    {if $subnode.children > 0}
      {include file="page/templates/tree_drag_drop_recursion.tpl" parent=$subnode.children depth=$depth+1 parent_is_last_n=$variable}
    {/if}
  {/foreach}
</ul>