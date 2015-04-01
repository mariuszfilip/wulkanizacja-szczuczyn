<?php /* Smarty version 2.6.18, created on 2013-08-20 22:08:17
         compiled from catalog/templates/drag_drop.tpl */ ?>
<div style='text-align: center; padding: 10px 0px 10px 0px;'>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "main/templates/errors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<div>
<div id="scripter"></div>
<table class="list" style='width: 750px;margin: auto;' border='0' id='lista' cellspacing='0' cellpadding='0'>
<thead>
<tr>
<th style='text-align: center; width: 65%;'>Drzewko kategorii</th>
<th style='text-align: center; width: 10%;'>&nbsp;</th>
<th style='text-align: right; width: 25%; padding-right:49px;'>Opcje</th>
</tr>
</thead>
<tbody>
<tr><td colspan="3" style="padding-bottom:5px; padding-top:5px;">
 <ul id="mytree" style="text-align:left;">
 <?php if (count ( $this->_tpl_vars['tree'] ) > 0): ?>
 	<?php $_from = $this->_tpl_vars['tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['main_tree_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['main_tree_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['node']):
        $this->_foreach['main_tree_loop']['iteration']++;
?>
    <li id="<?php echo $this->_tpl_vars['node']['id_catalog']; ?>
"> <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;act=edit&amp;id=<?php echo $this->_tpl_vars['node']['id_catalog']; ?>
"><?php echo $this->_tpl_vars['node']['name']; ?>
</a>
       <div class="tree_options_div"><a href="javascript:void(0);" class="icon_tip icon_add" onclick="add_page(<?php echo $this->_tpl_vars['node']['id_catalog']; ?>
);" title="dodaj podkategorię"><img border="0" alt="dodaj podkategorię" src="img/add_file.png"/></a> 
       <a href="javascript:void(0);" class="icon_tip" onclick="delete_page(<?php echo $this->_tpl_vars['node']['id_catalog']; ?>
);" title="usuń kategorię"><img border="0" alt="usuń kategorię" src="img/delete_file.png"/></a>                  
       <a href="javascript:void(0);" class="icon_tip" title="zmień status"><img src="img/<?php if ($this->_tpl_vars['node']['active'] == 'N'): ?>un<?php endif; ?>visible.png" onclick="if(this.src=='<?php echo @SITE_ADDRESS; ?>
admin/img/visible.png')<?php echo '{'; ?>
 this.src='img/unvisible.png'; change_status(<?php echo $this->_tpl_vars['node']['id_catalog']; ?>
, 'N'); <?php echo '}'; ?>
 else<?php echo '{'; ?>
 this.src='img/visible.png'; change_status(<?php echo $this->_tpl_vars['node']['id_catalog']; ?>
, 'Y');<?php echo '}'; ?>
" /></a> 
       <a href="javascript:void(0);" class="icon_tip" onclick="rename_page(<?php echo $this->_tpl_vars['node']['id_catalog']; ?>
);" title="zmień nazwę"><img border="0" alt="zmień nazwę" src="img/rename_small.png"/></a> 
       &nbsp;<a href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;act=edit&amp;id=<?php echo $this->_tpl_vars['node']['id_catalog']; ?>
" class="icon_tip" title="edytuj"><img border="0"  alt="edytuj" src="css/img/ico-edit.png"/></a></div>
    
	<?php if (! ($this->_foreach['main_tree_loop']['iteration'] == $this->_foreach['main_tree_loop']['total'])): ?>
  	<?php $this->assign('variable', 1); ?>
  <?php else: ?>
		<?php $this->assign('variable', 0); ?>
	<?php endif; ?>
    
   <?php if ($this->_tpl_vars['node']['children'] > 0): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "catalog/templates/tree_drag_drop_recursion.tpl", 'smarty_include_vars' => array('parent' => $this->_tpl_vars['node']['children'],'depth' => 1,'parent_is_last' => $this->_tpl_vars['variable'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>    
  </li>    
    
	<?php endforeach; endif; unset($_from); ?>
   </ul>        
        
 <?php else: ?></ul>
<span id="no_nodes_com">Drzewko nie zostało utworzone.</span>
<?php endif; ?>
</td>
</tr>

<tr align="left"><td colspan="3" style="padding-left:18px; border-top-style:dashed; padding-top:8px; padding-bottom:8px;">
<a href="javascript:void(0);" onclick="add_page(0);" class="icon_tip" title="dodaj nową kategorię"><img border="0" alt="dodaj nową kategorię" src="img/add_file.png"/></a>
</td></tr>
</tbody>
</table>
<script type="text/javascript"><?php echo '
//<![CDATA[
	drag_drop_tree_construct(\''; ?>
<?php echo $_GET['mod']; ?>
<?php echo '\');
	
	function change_status(id, status){
		new Ajax.Request(\'ajax.php?mod=catalog&act=drag_drop_status\',{
	        parameters:\'id=\'+id+\'&drag_drop=1&status=\'+status,
					onComplete:function(response) {
	            $(\'scripter\').update(response.responseText);			
           }
      });
	}
	
	function real_add_page(id){
		id_added = 0;
		$(\'scripter\').update(\' \');
		jQuery.post("ajax.php", {\'mod\':\'catalog\', \'act\':\'drag_drop_add\',\'id\':id, \'drag_drop\':1, \'name\':jQuery(\'#new_page_name\').val()}, function(data) {
			if(isUnsignedInteger(data)){
					id_added=data;
					new_li_content=\'<li id="\'+id_added+\'"> <a href="index.php?mod=catalog&amp;act=edit&amp;id=\'+id_added+\'">\'+ jQuery(\'#new_page_name\').val()+\'</a><div class="tree_options_div"><a href="javascript:void(0);" class="icon_tip icon_add" onclick="add_page(\'+id_added+\');" title="dodaj podkategorię"><img border="0" alt="dodaj podkategorię" src="img/add_file.png"/></a> <a href="javascript:void(0);" class="icon_tip" onclick="delete_page(\'+id_added+\');" title="usuń kategorię"><img border="0" alt="usuń kategorię" src="img/delete_file.png"/></a>  <a href="javascript:void(0);" class="icon_tip" title="zmień status"><img src="img/unvisible.png" onclick="if(this.src==\\\''; ?>
<?php echo @SITE_ADDRESS; ?>
<?php echo 'admin/img/visible.png\\\'){ this.src=\\\'img/unvisible.png\\\'; change_status(\'+id_added+\', \\\'N\\\'); } else{ this.src=\\\'img/visible.png\\\'; change_status(\'+id_added+\', \\\'Y\\\');}" /></a> <a href="javascript:void(0);" class="icon_tip" onclick="rename_page(\'+id_added+\');" title="zmień nazwę"><img border="0" alt="zmień nazwę" src="img/rename_small.png"/></a> &nbsp;<a href="index.php?mod=catalog&amp;act=edit&amp;id=\'+id_added+\'" class="icon_tip" title="edytuj"><img border="0"  alt="edytuj" src="css/img/ico-edit.png"/></a></div></li>\';
					if(id==0 || !id){
						jQuery(\'#mytree\').html(jQuery(\'#mytree\').html()+new_li_content);
						jQuery(\'#no_nodes_com\').remove();
					}else{
						if(jQuery(\'#\'+id).find(\'ul\').exists()) {
							var name = jQuery(\'#\'+id).html();
							name = name.substring(0, name.lastIndexOf(\'</ul>\'));
							jQuery(\'#\'+id).html(name+new_li_content)+\'</ul>\';
						}else{
							jQuery(\'#\'+id).html(jQuery(\'#\'+id).html()+\'<ul>\'+new_li_content)+\'</ul>\';
						}
					}
					drag_drop_tree_construct(\''; ?>
<?php echo $_GET['mod']; ?>
<?php echo '\');
					jQuery.unblockUI();	
			} else $(\'scripter\').update(data);
		});
	}
	
	function real_delete_page(id){
		jQuery(\'#\'+id).outerHTML(\' \');
		drag_drop_tree_construct(\''; ?>
<?php echo $_GET['mod']; ?>
<?php echo '\');
		new Ajax.Request(\'ajax.php?mod=catalog&act=drag_drop_delete\',{
				parameters:\'drag_drop=1&id=\'+id,
				onComplete:function(response) {
					$(\'scripter\').update(response.responseText);				
				}
     });
		jQuery.unblockUI();
	}
	
	function real_rename_page(){
		id = jQuery(\'#id_page_to_rename\').val();
		name_page_to_rename = jQuery(\'#\'+id).children(\'a:first\').html(jQuery(\'#page_rename_input\').val());
		jQuery.post("ajax.php", {\'mod\':\'catalog\', \'act\':\'drag_drop_rename\',\'id\':id, \'drag_drop\':1, \'name\':jQuery(\'#page_rename_input\').val()}, function(data) {
			$(\'scripter\').update(data);	
		});
		jQuery.unblockUI();
	}
//]]>
</script>'; ?>

<br />
   <div id="dodawanie_strony" style="display:none; color:#FFF;"> 
        <h1>Dodajesz nową kategorię</h1>        
         <form onsubmit="return false">					
        <input name="id_page" value="" id="new_page_parent_id" type="hidden"/>
        <input type="hidden" name="addsub" value="1" />		        
        <input type="text" name="name" id="new_page_name" value="" maxlength="255" /> &nbsp;
        <input class="form-button" type="submit" value="Dodaj" onclick="real_add_page(jQuery('#new_page_parent_id').val());" />         
        <input class="form-button" type="button" value="Anuluj" onclick="jQuery.unblockUI();" />        
        </form>
	</div> 
    
    <div id="usuwanie_strony" style="display:none; color: #F33;"> 
        <h1>Czy na pewno usunąć kategorię '<i id="page_to_delete_name"></i>'<br />wraz ze wszystkimi jej podkategoriami?</h1>	
        <form onsubmit="return false">						
        <input name="id_page_to_delete" value="" id="id_page_to_delete" type="hidden"/>               
        <input class="form-button form-button-red" type="submit" value="Tak, usuń" onclick="real_delete_page(jQuery('#id_page_to_delete').val())" />         
        <input class="form-button" type="button" value="Anuluj" onclick="jQuery.unblockUI();" />
        </form>
	</div>
    
    <div id="zmiana_nazwy_strony" style="display:none; color: #FFF;"> 
        <h1>Zmieniasz nazwę kategorii '<i id="page_to_rename_name"></i>'</h1>		
        <form onsubmit="return false">			
        <input name="id_page_to_rename" value="" id="id_page_to_rename" type="hidden"/>    
        <input type="text" name="page_rename_input" id="page_rename_input" value="" maxlength="255" /> &nbsp;           
        <input class="form-button" type="submit" value="Zmień" onclick="real_rename_page()" />         
        <input class="form-button" type="button" value="Anuluj" onclick="jQuery.unblockUI();" />
        </form>
	</div>
</div>