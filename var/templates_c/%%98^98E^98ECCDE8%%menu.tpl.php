<?php /* Smarty version 2.6.18, created on 2013-03-11 19:55:26
         compiled from main/templates/menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'main/templates/menu.tpl', 4, false),array('function', 'modrewrite', 'main/templates/menu.tpl', 8, false),)), $this); ?>
		    <ul>
		<?php $_from = $this->_tpl_vars['menuLevelRoot']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['main_menu_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['main_menu_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['lr'] => $this->_tpl_vars['main_menu_element']):
        $this->_foreach['main_menu_loop']['iteration']++;
?>
        <?php if ($this->_tpl_vars['main_menu_element']['id_module'] == 3): ?>
        <li><a href="index.html"><?php echo ((is_array($_tmp=$this->_tpl_vars['main_menu_element']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a> 
        <?php elseif ($this->_tpl_vars['main_menu_element']['id_module'] == 2): ?>
        <li><a href="ogloszenia.html"><?php echo ((is_array($_tmp=$this->_tpl_vars['main_menu_element']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a>
        <?php else: ?>
        <li><a href="<?php echo smarty_function_modrewrite(array('name' => $this->_tpl_vars['main_menu_element']['name']), $this);?>
,<?php echo $this->_tpl_vars['main_menu_element']['id_page']; ?>
.html"><?php echo ((is_array($_tmp=$this->_tpl_vars['main_menu_element']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a>
        <?php endif; ?>
        		<?php if ($this->_tpl_vars['main_menu_element']['children']): ?>
                <ul>
                <?php $_from = $this->_tpl_vars['main_menu_element']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['submenu_element_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['submenu_element_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['2r'] => $this->_tpl_vars['submenu_element']):
        $this->_foreach['submenu_element_loop']['iteration']++;
?>
                  <li><a href="<?php if ($this->_tpl_vars['submenu_element']['id_module'] == 2): ?>index.php?mod=event<?php else: ?><?php echo smarty_function_modrewrite(array('name' => $this->_tpl_vars['submenu_element']['name']), $this);?>
,<?php echo $this->_tpl_vars['submenu_element']['id_page']; ?>
.html<?php endif; ?>"><?php echo ((is_array($_tmp=$this->_tpl_vars['submenu_element']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a>
                  <?php if ($this->_tpl_vars['submenu_element']['children']): ?>
                  <ul>
                  <?php $_from = $this->_tpl_vars['submenu_element']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['sub_submenu_element_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['sub_submenu_element_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['3r'] => $this->_tpl_vars['sub_submenu_element']):
        $this->_foreach['sub_submenu_element_loop']['iteration']++;
?>
                  		<li><a href="<?php if ($this->_tpl_vars['sub_submenu_element']['id_module'] == 2): ?>news.html<?php else: ?><?php echo smarty_function_modrewrite(array('name' => $this->_tpl_vars['sub_submenu_element']['name']), $this);?>
,<?php echo $this->_tpl_vars['sub_submenu_element']['id_page']; ?>
.html<?php endif; ?>"><?php echo ((is_array($_tmp=$this->_tpl_vars['sub_submenu_element']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a>
                              <?php if ($this->_tpl_vars['sub_submenu_element']['children']): ?>
                              <ul>
                              <?php $_from = $this->_tpl_vars['sub_submenu_element']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['sub_submenu_element_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['sub_submenu_element_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['4r'] => $this->_tpl_vars['sub_sub_submenu_element']):
        $this->_foreach['sub_submenu_element_loop']['iteration']++;
?>
                                    <li><a href="<?php if ($this->_tpl_vars['sub_sub_submenu_element']['id_module'] == 2): ?>news.html<?php else: ?><?php echo smarty_function_modrewrite(array('name' => $this->_tpl_vars['sub_sub_submenu_element']['name']), $this);?>
,<?php echo $this->_tpl_vars['sub_sub_submenu_element']['id_page']; ?>
.html<?php endif; ?>"><?php echo ((is_array($_tmp=$this->_tpl_vars['sub_sub_submenu_element']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></li>
                              <?php endforeach; endif; unset($_from); ?>
                              </ul>
                              <?php endif; ?>
                        </li>
                  <?php endforeach; endif; unset($_from); ?>
                  </ul>
                  <?php endif; ?>
                  </li>
                <?php endforeach; endif; unset($_from); ?>
                </ul>
                <?php endif; ?>
        </li>
<?php endforeach; endif; unset($_from); ?>
    <!--  <li ><a href="map.html">Sitemap</a></li>-->
    </ul>