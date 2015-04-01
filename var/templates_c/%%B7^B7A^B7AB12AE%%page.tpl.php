<?php /* Smarty version 2.6.18, created on 2013-03-11 19:57:26
         compiled from page/templates/page.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'page/templates/page.tpl', 5, false),array('modifier', 'string_format', 'page/templates/page.tpl', 13, false),)), $this); ?>
<div class="top_content"></div>
<div class="center_content">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "main/templates/left.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<div class="right" id="new">
					<h1><?php echo ((is_array($_tmp=$this->_tpl_vars['page']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</h1>
					<div class="text"><?php echo $this->_tpl_vars['page']['content']; ?>
</div>

								<?php if (count ( $this->_tpl_vars['addedFiles'] ) > 0): ?>
								      <h1>Download</h1>
								        <ul class="pliki">
								        <?php $_from = $this->_tpl_vars['addedFiles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['file']):
?>
								        	<?php if ($this->_tpl_vars['file']['type'] != 2): ?>
								          <li><a href="dl.php?file=<?php echo $this->_tpl_vars['file']['file_name']; ?>
" title="<?php echo $this->_tpl_vars['file']['name']; ?>
"><?php echo $this->_tpl_vars['file']['name']; ?>
&nbsp;(<?php echo ((is_array($_tmp=$this->_tpl_vars['file']['sizek'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.1f") : smarty_modifier_string_format($_tmp, "%.1f")); ?>
 kB)</a></li>
								          	<?php endif; ?>
								        <?php endforeach; endif; unset($_from); ?>
								        </ul>
								      <?php endif; ?>
								        
								    <?php if (count ( $this->_tpl_vars['gallerys'] ) > 0): ?>
								    	<?php $_from = $this->_tpl_vars['gallerys']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['gallery']):
?>
								    	<h1><?php echo ((is_array($_tmp=$this->_tpl_vars['gallery']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</h1>
								        	<div class="gallery"><!-- skalowanie zdjec po wysokości -->
											<?php if (count ( $this->_tpl_vars['gallery']['files'] ) > 0): ?>
								    			<?php $_from = $this->_tpl_vars['gallery']['files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['file']):
?>
								             <a class="thickbox" rel='galeria' title="<?php echo ((is_array($_tmp=$this->_tpl_vars['file']['description'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" href="files/photo/<?php echo ((is_array($_tmp=$this->_tpl_vars['file']['file_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
">
										        <img src="thumb.php?dir=files/photo/&amp;file=<?php echo ((is_array($_tmp=$this->_tpl_vars['file']['file_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;h=80" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['file']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
								             </a>
												<?php endforeach; endif; unset($_from); ?>
								                <div class="end"></div>
											<?php endif; ?>
											</div>
								    	<?php endforeach; endif; unset($_from); ?>
								    <?php endif; ?>
								        
							
</div>
<div class="bottom_content"></div>
<div class="tire_subpage"></div>
<div class="content_thin_page"></div>
</div>