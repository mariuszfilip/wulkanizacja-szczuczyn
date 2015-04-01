<?php /* Smarty version 2.6.18, created on 2013-08-20 22:04:36
         compiled from main/templates/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "main/templates/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if ($_SESSION['user']['id_operator'] > 0): ?>
<table border='0' cellspacing='0' cellpadding='0' style='width:100%;'>
	<tr>
		<td style='vertical-align: top;width:190px; padding-right:4px;<?php if ($_SESSION['hide_left_menu']): ?> display:none;<?php endif; ?>' class="left_menu_js" >
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "main/templates/menu.tpl", 'smarty_include_vars' => array('width' => '150px;')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
    
		<td style='vertical-align: top; text-align:left;'><a href="javascript:;" title="<?php if ($_SESSION['hide_left_menu']): ?>pokaż<?php else: ?>ukryj<?php endif; ?> menu" <?php echo 'onclick="this.blur(); if(jQuery(\'.left_menu_js\').css(\'display\')==\'none\') show_left_menu(\'show\'); else show_left_menu(\'hide\');"'; ?>
 class="show_hide_menu icon_tip"><?php if ($_SESSION['hide_left_menu']): ?>&raquo;<?php else: ?>&laquo;<?php endif; ?></a>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "main/templates/menu-top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<table border='0' cellspacing='0' cellpadding='0' style='width: 100%;' class="zawartosc">
				<tr>
					<td style='text-align: center;'>
					 <?php if ($this->_tpl_vars['moduletpl'] != ''): ?>
					   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['moduletpl'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					 <?php endif; ?>
					</td>
				</tr>
			</table>
      
		</td>
    
	</tr>
</table>
<?php else: ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['moduletpl'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<?php if (isset ( $this->_tpl_vars['debug'] ) && $this->_tpl_vars['debug'] == true): ?>
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "main/templates/debug.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "main/templates/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>