<div style='text-align: center; padding: 10px 0px 10px 0px;'>
  {include file="main/templates/errors.tpl"}
</div>
<div>
<div id="scripter"></div>
<table class="list" style='width: 750px;margin: auto;' border='0' id='lista' cellspacing='0' cellpadding='0'>
<thead>
<tr>
<th style='text-align: center; width: 65%;'>Drzewko stron</th>
<th style='text-align: center; width: 10%;'>&nbsp;</th>
<th style='text-align: right; width: 25%; padding-right:49px;'>Opcje</th>
</tr>
</thead>
<tbody>
<tr><td colspan="3" style="padding-bottom:5px; padding-top:5px;">
 <ul id="mytree" style="text-align:left;">
 {if count($tree) > 0}
 	{foreach from=$tree key=k item=node name=main_tree_loop}    
    <li id="{$node.id_page}" {if $node.dragable eq N}class="undragable"{/if}> <a {if $node.editable eq N && $smarty.session.user.super_user neq 1}style="cursor:default;"{else}href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$node.id_page}"{/if}>{$node.name}</a> <div class="tree_options_div">{if $node.addable eq N}<a><img border="0" alt="" src="img/add_file.png" class="menu_unactive"/></a>{else}<a href="javascript:void(0);" class="icon_tip" onclick="add_page({$node.id_page});" title="dodaj podstronę"><img border="0" alt="dodaj podstronę" src="img/add_file.png"/></a>{/if}
        {if $node.deletable eq N}<a><img border="0" alt="" src="img/delete_file.png" class="menu_unactive" /></a>{else}<a href="javascript:void(0);" class="icon_tip" onclick="delete_page({$node.id_page});" title="usuń stronę"><img border="0" alt="usuń stronę" src="img/delete_file.png"/></a>{/if}
         {if $node.statusable eq N}<a><img src="img/{if $node.active eq 'N'}un{/if}visible.png" class="menu_unactive" /></a>{else}<a href="javascript:void(0);" class="icon_tip" title="zmień status"><img src="img/{if $node.active eq 'N'}un{/if}visible.png" onclick="if(this.src=='{$smarty.const.SITE_ADDRESS}admin/img/visible.png'){literal}{{/literal} this.src='img/unvisible.png'; change_status({$node.id_page}, 'N'); {literal}}{/literal} else{literal}{{/literal} this.src='img/visible.png'; change_status({$node.id_page}, 'Y');{literal}}{/literal}" /></a>{/if}
          {if $node.renameable eq N}<a><img border="0" alt="" src="img/rename_small.png" class="menu_unactive" /></a>{else}<a href="javascript:void(0);" class="icon_tip" onclick="rename_page({$node.id_page});" title="zmień nazwę"><img border="0" alt="zmień nazwę" src="img/rename_small.png"/></a>{/if}
          &nbsp;{if $node.editable eq N}<a><img border="0"  alt="" src="css/img/ico-edit.png" class="menu_unactive" /></a>{else}<a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$node.id_page}" class="icon_tip" title="edytuj"><img border="0"  alt="edytuj" src="css/img/ico-edit.png"/></a>{/if}</div>    
	{if !$smarty.foreach.main_tree_loop.last}
  		{assign var=variable value=1}
  	{else}
		{assign var=variable value=0}
	{/if}
    
    {if $node.children > 0}
			{include file="page/templates/tree_drag_drop_recursion.tpl" parent=$node.children depth=1 parent_is_last=$variable}
		{/if}    
    </li>
	{/foreach}
 </ul>
        
 {else}</ul>
<span id="no_nodes_com">Drzewko nie zostało utworzone.</span>
{/if}
</td>
</tr>

<tr align="left"><td colspan="3" style="padding-left:18px; border-top-style:dashed; padding-top:8px; padding-bottom:8px;">
<a href="javascript:void(0);" onclick="add_page(0);" class="icon_tip" title="dodaj nową stronę"><img border="0" alt="dodaj nową stronę" src="img/add_file.png"/></a>
</td></tr>
</tbody>
</table>
<script type="text/javascript">{literal}
//<![CDATA[
	drag_drop_tree_construct('{/literal}{$smarty.get.mod}{literal}');
	
	function change_status(id, status){
		new Ajax.Request('ajax.php?mod=page&act=drag_drop_status',{
				parameters:'id='+id+'&drag_drop=1&status='+status,
				onComplete:function(response) {
					$('scripter').update(response.responseText);			
				}
    });
	}
	
	function real_add_page(id){
		id_added = 0;
		$('scripter').update(' ');
		jQuery.post("ajax.php", {'mod':'page', 'act':'drag_drop_add','id':id, 'drag_drop':1, 'name':jQuery('#new_page_name').val()}, function(data) {
				if(isUnsignedInteger(data)){
					id_added=data;
					new_li_content='<li id="'+id_added+'"> <a href="index.php?mod=page&amp;act=edit&amp;id='+id_added+'">'+ jQuery('#new_page_name').val()+'</a><div class="tree_options_div"><a href="javascript:void(0);" class="icon_tip" onclick="add_page('+id_added+');" title="dodaj podstronę"><img border="0" alt="dodaj podstronę" src="img/add_file.png"/></a> <a href="javascript:void(0);" class="icon_tip" onclick="delete_page('+id_added+');" title="usuń stronę"><img border="0" alt="usuń stronę" src="img/delete_file.png"/></a>  <a href="javascript:void(0);" class="icon_tip" title="zmień status"><img src="img/unvisible.png" onclick="if(this.src==\'{/literal}{$smarty.const.SITE_ADDRESS}{literal}admin/img/visible.png\'){ this.src=\'img/unvisible.png\'; change_status('+id_added+', \'N\'); } else{ this.src=\'img/visible.png\'; change_status('+id_added+', \'Y\');}" /></a> <a href="javascript:void(0);" class="icon_tip" onclick="rename_page('+id_added+');" title="zmień nazwę"><img border="0" alt="zmień nazwę" src="img/rename_small.png"/></a> &nbsp;<a href="index.php?mod=page&amp;act=edit&amp;id='+id_added+'" class="icon_tip" title="edytuj"><img border="0"  alt="edytuj" src="css/img/ico-edit.png"/></a></div></li>';
					if(id==0 || !id){
						jQuery('#mytree').html(jQuery('#mytree').html()+new_li_content);
						jQuery('#no_nodes_com').remove();
					}else{
						if(jQuery('#'+id).find('ul').exists()) {
							var name = jQuery('#'+id).html();
							name = name.substring(0, name.lastIndexOf('</ul>'));
							jQuery('#'+id).html(name+new_li_content)+'</ul>';
						}else{
							jQuery('#'+id).html(jQuery('#'+id).html()+'<ul>'+new_li_content)+'</ul>';
						}
					}
					drag_drop_tree_construct('{/literal}{$smarty.get.mod}{literal}');
					jQuery.unblockUI();
				}	else $('scripter').update(data);
		});
	}
	
	function real_delete_page(id){
		jQuery('#'+id).outerHTML(' ');
		drag_drop_tree_construct('{/literal}{$smarty.get.mod}{literal}');
		new Ajax.Request('ajax.php?mod=page&act=drag_drop_delete',{
				parameters:'drag_drop=1&id='+id,
				onComplete:function(response) {
					$('scripter').update(response.responseText);
				}
    });
		jQuery.unblockUI();
	}	
	
	function real_rename_page(){
		id = jQuery('#id_page_to_rename').val();
		name_page_to_rename = jQuery('#'+id).children('a:first').html(jQuery('#page_rename_input').val());
		jQuery.post("ajax.php", {'mod':'page', 'act':'drag_drop_rename','id':id, 'drag_drop':1, 'name':jQuery('#page_rename_input').val()}, function(data) {
			$('scripter').update(data);	
		});
		jQuery.unblockUI();
	}
//]]>
</script>{/literal}
<br />
   <div id="dodawanie_strony" style="display:none; color:#FFF;"> 
        <h1>Dodajesz nową stronę</h1>        
        <form onsubmit="return false">					
        <input name="id_page" value="" id="new_page_parent_id" type="hidden"/>
        <input type="hidden" name="addsub" value="1" />		        
        <input type="text" name="name" id="new_page_name" value="" maxlength="255" /> &nbsp;
        <input class="form-button" type="submit" value="Dodaj" onclick="real_add_page(jQuery('#new_page_parent_id').val());" />         
        <input class="form-button" type="button" value="Anuluj" onclick="jQuery.unblockUI();" />        
        </form>
	</div>    
    
  <div id="usuwanie_strony" style="display:none; color: #F33;"> 
        <h1>Czy na pewno usunąć stronę '<i id="page_to_delete_name"></i>'<br />wraz ze wszystkimi jej podstronami?</h1>	
        <form onsubmit="return false">						
        <input name="id_page_to_delete" value="" id="id_page_to_delete" type="hidden"/>               
        <input class="form-button form-button-red" type="submit" value="Tak, usuń" onclick="real_delete_page(jQuery('#id_page_to_delete').val())" />         
        <input class="form-button" type="button" value="Anuluj" onclick="jQuery.unblockUI();" />
        </form>
	</div>

    <div id="zmiana_nazwy_strony" style="display:none; color: #FFF;"> 
        <h1>Zmieniasz nazwę strony '<i id="page_to_rename_name"></i>'</h1>		
        <form onsubmit="return false">			
        <input name="id_page_to_rename" value="" id="id_page_to_rename" type="hidden"/>    
        <input type="text" name="page_rename_input" id="page_rename_input" value="" maxlength="255" /> &nbsp;           
        <input class="form-button" type="submit" value="Zmień" onclick="real_rename_page()" />         
        <input class="form-button" type="button" value="Anuluj" onclick="jQuery.unblockUI();" />
        </form>
	</div>
</div>