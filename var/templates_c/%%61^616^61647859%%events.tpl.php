<?php /* Smarty version 2.6.18, created on 2013-03-12 15:33:32
         compiled from event/templates/events.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'event/templates/events.tpl', 12, false),array('modifier', 'escape', 'event/templates/events.tpl', 15, false),)), $this); ?>
<div class="top_content"></div>
				<div class="center_content">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "main/templates/left.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<div class="right" id="new">
						<h1><?php echo $this->_tpl_vars['event_title']; ?>
</h1>

						    <?php if (count ( $this->_tpl_vars['collection']['items'] ) > 0): ?>
						
						      <?php $_from = $this->_tpl_vars['collection']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
						      <div class="single_news">
						
						          <p class="inner_text"><?php echo $this->_tpl_vars['i']['title']; ?>
<span class="date_news"><i></i> <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['added'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</i></span></p>
						          
						          <div class="content_news">
						          	<?php if ($this->_tpl_vars['i']['picture']): ?><a href="files/event/<?php echo ((is_array($_tmp=$this->_tpl_vars['i']['picture'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><img  src="thumb.php?dir=files/event/&amp;file=<?php echo ((is_array($_tmp=$this->_tpl_vars['i']['picture'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;w=50&amp;h=50" class="img_news" align="right" alt="<?php echo $this->_tpl_vars['i']['title']; ?>
" style="margin:0 5px 5px 0;" /></a><?php endif; ?>
						            <p><?php echo $this->_tpl_vars['i']['intro']; ?>
</p> 
								</div>
						      </div>
						      <?php endforeach; endif; unset($_from); ?>
						
						      <div class="stronicowanie">
						        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "main/templates/page.tpl", 'smarty_include_vars' => array('page' => $this->_tpl_vars['collection']['page'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						      </div>        
						    <?php else: ?>
						      <h2>Brak ogłoszeń.</h2>
						    <?php endif; ?>
   					</div>
<div class="bottom_content"></div>
<div class="tire_subpage"></div>
<div class="content_thin_page"></div>
</div>