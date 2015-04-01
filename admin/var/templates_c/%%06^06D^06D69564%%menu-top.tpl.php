<?php /* Smarty version 2.6.18, created on 2013-08-20 22:04:36
         compiled from main/templates/menu-top.tpl */ ?>
<table border='0' cellspacing='0' cellpadding='0' style='width: 100%; margin:0 0 0 5px;'>
	<tr>
	<?php if ($this->_tpl_vars['menuTopL'] != null): ?>
		<td class='miedzy' width="30"><img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
miedzy4.png' /></td>
	<?php else: ?>
		<td class='miedzy' width="30"><img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
miedzy2.png' /></td>
	<?php endif; ?>
    <td style='text-align: left;'>
    
      <table border='0' cellspacing='0' cellpadding='0' style='width: 100%;' class="topmenu">
        <tr>
        <?php if ($this->_tpl_vars['menuTopL'] != null): ?>
          <?php unset($this->_sections['pozycja']);
$this->_sections['pozycja']['loop'] = is_array($_loop=$this->_tpl_vars['menuTopL']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pozycja']['name'] = 'pozycja';
$this->_sections['pozycja']['show'] = true;
$this->_sections['pozycja']['max'] = $this->_sections['pozycja']['loop'];
$this->_sections['pozycja']['step'] = 1;
$this->_sections['pozycja']['start'] = $this->_sections['pozycja']['step'] > 0 ? 0 : $this->_sections['pozycja']['loop']-1;
if ($this->_sections['pozycja']['show']) {
    $this->_sections['pozycja']['total'] = $this->_sections['pozycja']['loop'];
    if ($this->_sections['pozycja']['total'] == 0)
        $this->_sections['pozycja']['show'] = false;
} else
    $this->_sections['pozycja']['total'] = 0;
if ($this->_sections['pozycja']['show']):

            for ($this->_sections['pozycja']['index'] = $this->_sections['pozycja']['start'], $this->_sections['pozycja']['iteration'] = 1;
                 $this->_sections['pozycja']['iteration'] <= $this->_sections['pozycja']['total'];
                 $this->_sections['pozycja']['index'] += $this->_sections['pozycja']['step'], $this->_sections['pozycja']['iteration']++):
$this->_sections['pozycja']['rownum'] = $this->_sections['pozycja']['iteration'];
$this->_sections['pozycja']['index_prev'] = $this->_sections['pozycja']['index'] - $this->_sections['pozycja']['step'];
$this->_sections['pozycja']['index_next'] = $this->_sections['pozycja']['index'] + $this->_sections['pozycja']['step'];
$this->_sections['pozycja']['first']      = ($this->_sections['pozycja']['iteration'] == 1);
$this->_sections['pozycja']['last']       = ($this->_sections['pozycja']['iteration'] == $this->_sections['pozycja']['total']);
?>
          <td valign="middle" style="background:#dcdcdc;white-space:nowrap; border-top:1px solid #e5e5e5;">
            &nbsp;<a href="<?php echo $this->_tpl_vars['menuTopL'][$this->_sections['pozycja']['index']]['href']; ?>
" style="color:#7c7c7c!important;"><?php echo $this->_tpl_vars['menuTopL'][$this->_sections['pozycja']['index']]['title']; ?>
</a>&nbsp;
          </td>
          <?php if (! $this->_sections['pozycja']['last']): ?>
          <td valign="middle" class="miedzy"><img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
miedzy7.png' /></td>
          <?php endif; ?>
          <?php endfor; endif; ?>
          
          <td valign="middle" class="miedzy"><img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
miedzy5.png' /></td>
        <?php endif; ?>
        
        
          <td valign="middle" style="white-space:nowrap;background:#f8f8f8; border-top:1px solid #ffffff;">
          	&nbsp;<a href="<?php echo $this->_tpl_vars['menuTopA']['href']; ?>
"><?php echo $this->_tpl_vars['menuTopA']['title']; ?>
</a>&nbsp;
          </td>
        <?php if ($this->_tpl_vars['menuTopR'] != null): ?>
          <td valign="middle" class="miedzy"><img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
miedzy1.png' alt='' /></td>
          <?php unset($this->_sections['pozycja']);
$this->_sections['pozycja']['loop'] = is_array($_loop=$this->_tpl_vars['menuTopR']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pozycja']['name'] = 'pozycja';
$this->_sections['pozycja']['show'] = true;
$this->_sections['pozycja']['max'] = $this->_sections['pozycja']['loop'];
$this->_sections['pozycja']['step'] = 1;
$this->_sections['pozycja']['start'] = $this->_sections['pozycja']['step'] > 0 ? 0 : $this->_sections['pozycja']['loop']-1;
if ($this->_sections['pozycja']['show']) {
    $this->_sections['pozycja']['total'] = $this->_sections['pozycja']['loop'];
    if ($this->_sections['pozycja']['total'] == 0)
        $this->_sections['pozycja']['show'] = false;
} else
    $this->_sections['pozycja']['total'] = 0;
if ($this->_sections['pozycja']['show']):

            for ($this->_sections['pozycja']['index'] = $this->_sections['pozycja']['start'], $this->_sections['pozycja']['iteration'] = 1;
                 $this->_sections['pozycja']['iteration'] <= $this->_sections['pozycja']['total'];
                 $this->_sections['pozycja']['index'] += $this->_sections['pozycja']['step'], $this->_sections['pozycja']['iteration']++):
$this->_sections['pozycja']['rownum'] = $this->_sections['pozycja']['iteration'];
$this->_sections['pozycja']['index_prev'] = $this->_sections['pozycja']['index'] - $this->_sections['pozycja']['step'];
$this->_sections['pozycja']['index_next'] = $this->_sections['pozycja']['index'] + $this->_sections['pozycja']['step'];
$this->_sections['pozycja']['first']      = ($this->_sections['pozycja']['iteration'] == 1);
$this->_sections['pozycja']['last']       = ($this->_sections['pozycja']['iteration'] == $this->_sections['pozycja']['total']);
?>
          <?php if (! $this->_sections['pozycja']['first']): ?>
          <td valign="middle" class="miedzy"><img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
miedzy7.png' /></td>
          <?php endif; ?>
          <td valign="middle" style='text-align: right;white-space:nowrap;background:#dcdcdc;border-top:1px solid #e5e5e5;'>
            &nbsp;<a href="<?php echo $this->_tpl_vars['menuTopR'][$this->_sections['pozycja']['index']]['href']; ?>
" style="color:#7c7c7c!important;"><?php echo $this->_tpl_vars['menuTopR'][$this->_sections['pozycja']['index']]['title']; ?>
</a>&nbsp;
          </td>
          <?php endfor; endif; ?>
          <td style='width: 21px;' valign="middle" class="miedzy"><img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
miedzy6.png' alt='' /></td>
        <?php else: ?>
          <td style='width: 30px;' valign="middle"class="miedzy"><img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
miedzy3.png' alt='' /></td>
        <?php endif; ?>
          <td class='menuGoraWypelnienie' valign="middle">&nbsp;</td>
        </tr>
      </table>
      
    </td>
      </tr>
</table>