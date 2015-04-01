<?php /* Smarty version 2.6.18, created on 2013-08-22 19:49:49
         compiled from page/templates/drag_drop_header.tpl */ ?>
<link rel='stylesheet' type='text/css' href='css/drag-drop-tree.css' />
<script type="text/javascript" src="js/drag_and_drop/prototype.js"></script>
<script type="text/javascript" src="js/drag_and_drop/scriptaculous.js"></script>
<script type="text/javascript" src="cookie.js"></script>
<script type="text/javascript" src="js/drag_and_drop/drag-drop-tree.js"></script>
<?php if (@DEPTH_LIMIT): ?>
<style>
<?php unset($this->_sections['us1']);
$this->_sections['us1']['name'] = 'us1';
$this->_sections['us1']['start'] = (int)0;
$this->_sections['us1']['loop'] = is_array($_loop=@DEPTH_LIMIT) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['us1']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['us1']['show'] = true;
$this->_sections['us1']['max'] = $this->_sections['us1']['loop'];
if ($this->_sections['us1']['start'] < 0)
    $this->_sections['us1']['start'] = max($this->_sections['us1']['step'] > 0 ? 0 : -1, $this->_sections['us1']['loop'] + $this->_sections['us1']['start']);
else
    $this->_sections['us1']['start'] = min($this->_sections['us1']['start'], $this->_sections['us1']['step'] > 0 ? $this->_sections['us1']['loop'] : $this->_sections['us1']['loop']-1);
if ($this->_sections['us1']['show']) {
    $this->_sections['us1']['total'] = min(ceil(($this->_sections['us1']['step'] > 0 ? $this->_sections['us1']['loop'] - $this->_sections['us1']['start'] : $this->_sections['us1']['start']+1)/abs($this->_sections['us1']['step'])), $this->_sections['us1']['max']);
    if ($this->_sections['us1']['total'] == 0)
        $this->_sections['us1']['show'] = false;
} else
    $this->_sections['us1']['total'] = 0;
if ($this->_sections['us1']['show']):

            for ($this->_sections['us1']['index'] = $this->_sections['us1']['start'], $this->_sections['us1']['iteration'] = 1;
                 $this->_sections['us1']['iteration'] <= $this->_sections['us1']['total'];
                 $this->_sections['us1']['index'] += $this->_sections['us1']['step'], $this->_sections['us1']['iteration']++):
$this->_sections['us1']['rownum'] = $this->_sections['us1']['iteration'];
$this->_sections['us1']['index_prev'] = $this->_sections['us1']['index'] - $this->_sections['us1']['step'];
$this->_sections['us1']['index_next'] = $this->_sections['us1']['index'] + $this->_sections['us1']['step'];
$this->_sections['us1']['first']      = ($this->_sections['us1']['iteration'] == 1);
$this->_sections['us1']['last']       = ($this->_sections['us1']['iteration'] == $this->_sections['us1']['total']);
?>ul <?php endfor; endif; ?><?php echo ' ul{
	opacity:.3;
}

'; ?>
<?php unset($this->_sections['us1']);
$this->_sections['us1']['name'] = 'us1';
$this->_sections['us1']['start'] = (int)0;
$this->_sections['us1']['loop'] = is_array($_loop=@DEPTH_LIMIT) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['us1']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['us1']['show'] = true;
$this->_sections['us1']['max'] = $this->_sections['us1']['loop'];
if ($this->_sections['us1']['start'] < 0)
    $this->_sections['us1']['start'] = max($this->_sections['us1']['step'] > 0 ? 0 : -1, $this->_sections['us1']['loop'] + $this->_sections['us1']['start']);
else
    $this->_sections['us1']['start'] = min($this->_sections['us1']['start'], $this->_sections['us1']['step'] > 0 ? $this->_sections['us1']['loop'] : $this->_sections['us1']['loop']-1);
if ($this->_sections['us1']['show']) {
    $this->_sections['us1']['total'] = min(ceil(($this->_sections['us1']['step'] > 0 ? $this->_sections['us1']['loop'] - $this->_sections['us1']['start'] : $this->_sections['us1']['start']+1)/abs($this->_sections['us1']['step'])), $this->_sections['us1']['max']);
    if ($this->_sections['us1']['total'] == 0)
        $this->_sections['us1']['show'] = false;
} else
    $this->_sections['us1']['total'] = 0;
if ($this->_sections['us1']['show']):

            for ($this->_sections['us1']['index'] = $this->_sections['us1']['start'], $this->_sections['us1']['iteration'] = 1;
                 $this->_sections['us1']['iteration'] <= $this->_sections['us1']['total'];
                 $this->_sections['us1']['index'] += $this->_sections['us1']['step'], $this->_sections['us1']['iteration']++):
$this->_sections['us1']['rownum'] = $this->_sections['us1']['iteration'];
$this->_sections['us1']['index_prev'] = $this->_sections['us1']['index'] - $this->_sections['us1']['step'];
$this->_sections['us1']['index_next'] = $this->_sections['us1']['index'] + $this->_sections['us1']['step'];
$this->_sections['us1']['first']      = ($this->_sections['us1']['iteration'] == 1);
$this->_sections['us1']['last']       = ($this->_sections['us1']['iteration'] == $this->_sections['us1']['total']);
?>ul <?php endfor; endif; ?><?php echo ' ul ul{
	opacity:1;
}

'; ?>
<?php unset($this->_sections['us1']);
$this->_sections['us1']['name'] = 'us1';
$this->_sections['us1']['start'] = (int)0;
$this->_sections['us1']['loop'] = is_array($_loop=@DEPTH_LIMIT) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['us1']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['us1']['show'] = true;
$this->_sections['us1']['max'] = $this->_sections['us1']['loop'];
if ($this->_sections['us1']['start'] < 0)
    $this->_sections['us1']['start'] = max($this->_sections['us1']['step'] > 0 ? 0 : -1, $this->_sections['us1']['loop'] + $this->_sections['us1']['start']);
else
    $this->_sections['us1']['start'] = min($this->_sections['us1']['start'], $this->_sections['us1']['step'] > 0 ? $this->_sections['us1']['loop'] : $this->_sections['us1']['loop']-1);
if ($this->_sections['us1']['show']) {
    $this->_sections['us1']['total'] = min(ceil(($this->_sections['us1']['step'] > 0 ? $this->_sections['us1']['loop'] - $this->_sections['us1']['start'] : $this->_sections['us1']['start']+1)/abs($this->_sections['us1']['step'])), $this->_sections['us1']['max']);
    if ($this->_sections['us1']['total'] == 0)
        $this->_sections['us1']['show'] = false;
} else
    $this->_sections['us1']['total'] = 0;
if ($this->_sections['us1']['show']):

            for ($this->_sections['us1']['index'] = $this->_sections['us1']['start'], $this->_sections['us1']['iteration'] = 1;
                 $this->_sections['us1']['iteration'] <= $this->_sections['us1']['total'];
                 $this->_sections['us1']['index'] += $this->_sections['us1']['step'], $this->_sections['us1']['iteration']++):
$this->_sections['us1']['rownum'] = $this->_sections['us1']['iteration'];
$this->_sections['us1']['index_prev'] = $this->_sections['us1']['index'] - $this->_sections['us1']['step'];
$this->_sections['us1']['index_next'] = $this->_sections['us1']['index'] + $this->_sections['us1']['step'];
$this->_sections['us1']['first']      = ($this->_sections['us1']['iteration'] == 1);
$this->_sections['us1']['last']       = ($this->_sections['us1']['iteration'] == $this->_sections['us1']['total']);
?>ul <?php endfor; endif; ?><?php echo '.tree_options_div .icon_tip:first-child{
	display:none;
}
</style>
'; ?>

<?php endif; ?>