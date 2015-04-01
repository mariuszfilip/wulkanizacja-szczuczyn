<?php /* Smarty version 2.6.18, created on 2013-08-20 22:08:17
         compiled from catalog/templates/tree_drag_drop_recursion.tpl */ ?>
<ul>
  <?php $_from = $this->_tpl_vars['parent']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['sub_tree_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['sub_tree_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['subnode']):
        $this->_foreach['sub_tree_loop']['iteration']++;
?>
		<li id="<?php echo $this->_tpl_vars['subnode']['id_catalog']; ?>
"> <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;act=edit&amp;id=<?php echo $this->_tpl_vars['subnode']['id_catalog']; ?>
"><?php echo $this->_tpl_vars['subnode']['name']; ?>
</a> <div class="tree_options_div"><a href="javascript:void(0);" class="icon_tip icon_add" onclick="add_page(<?php echo $this->_tpl_vars['subnode']['id_catalog']; ?>
);" title="dodaj podkategorię"><img border="0" alt="dodaj podkategorię" src="img/add_file.png"/></a> 
        <a href="javascript:void(0);" class="icon_tip" onclick="delete_page(<?php echo $this->_tpl_vars['subnode']['id_catalog']; ?>
);" title="usuń kategorię"><img border="0" alt="usuń kategorię" src="img/delete_file.png"/></a> 
         <a href="javascript:void(0);" class="icon_tip" title="zmień status"><img src="img/<?php if ($this->_tpl_vars['subnode']['active'] == 'N'): ?>un<?php endif; ?>visible.png" onclick="if(this.src=='<?php echo @SITE_ADDRESS; ?>
admin/img/visible.png')<?php echo '{'; ?>
 this.src='img/unvisible.png'; change_status(<?php echo $this->_tpl_vars['subnode']['id_catalog']; ?>
, 'N'); <?php echo '}'; ?>
 else<?php echo '{'; ?>
 this.src='img/visible.png'; change_status(<?php echo $this->_tpl_vars['subnode']['id_catalog']; ?>
, 'Y');<?php echo '}'; ?>
" /></a> 
         <a href="javascript:void(0);" class="icon_tip" onclick="rename_page(<?php echo $this->_tpl_vars['subnode']['id_catalog']; ?>
);" title="zmień nazwę"><img border="0" alt="zmień nazwę" src="img/rename_small.png"/></a> 
          &nbsp;<a href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;act=edit&amp;id=<?php echo $this->_tpl_vars['subnode']['id_catalog']; ?>
" class="icon_tip" title="edytuj"><img border="0"  alt="edytuj" src="css/img/ico-edit.png"/></a></div>


    <?php if (! ($this->_foreach['sub_tree_loop']['iteration'] == $this->_foreach['sub_tree_loop']['total'])): ?>
  		<?php $this->assign('variable', 1); ?>
  	<?php else: ?>
    	<?php $this->assign('variable', 0); ?>
  	<?php endif; ?>


    <?php if ($this->_tpl_vars['subnode']['children'] > 0): ?>
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "catalog/templates/tree_drag_drop_recursion.tpl", 'smarty_include_vars' => array('parent' => $this->_tpl_vars['subnode']['children'],'depth' => $this->_tpl_vars['depth']+1,'parent_is_last_n' => $this->_tpl_vars['variable'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endif; ?>


  <?php endforeach; endif; unset($_from); ?>
</ul>