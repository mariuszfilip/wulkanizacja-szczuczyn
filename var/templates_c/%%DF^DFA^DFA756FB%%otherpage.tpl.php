<?php /* Smarty version 2.6.18, created on 2013-03-12 15:36:28
         compiled from catalog/templates/otherpage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'catalog/templates/otherpage.tpl', 5, false),)), $this); ?>
<div class="top_content"></div>
<div class="center_content">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "main/templates/left.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<div class="right" id="new">
					<h1><?php echo ((is_array($_tmp=$this->_tpl_vars['page']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</h1>
					<div class="text"><?php echo $this->_tpl_vars['page']['content']; ?>
</div>

							
								        
								   
								        
							
</div>
<div class="bottom_content"></div>
<div class="tire_subpage"></div>
<div class="content_thin_page"></div>
</div>