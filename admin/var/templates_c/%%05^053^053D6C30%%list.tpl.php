<?php /* Smarty version 2.6.18, created on 2013-09-20 18:34:49
         compiled from event/templates/list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'event/templates/list.tpl', 34, false),array('function', 'math', 'event/templates/list.tpl', 35, false),array('modifier', 'truncate', 'event/templates/list.tpl', 37, false),)), $this); ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "main/templates/errors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "event/templates/search.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='text-align: right;'>
  <table style="width:100%">
    <tr>
      <td>
              </td>
      <td>
        <img src="<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-dodaj.gif" class="icon" alt="dodaj" onclick="location.href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;act=add'" />
      </td>
    </tr>
  </table>
</div>

<form action='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
' id='listaform' name='listaform' method='post'>
<table class="list" style='width: 100%;' border='0' id='lista' cellspacing='0' cellpadding='0'>
  <thead>
    <tr>
      <th style='text-align: center; width: 5%;'>Lp.</th>
      <th style='text-align: left; width: 20%;'>Tytuł</th>
      <th style='text-align: left; width: 10%;'>Data dodania</th>
      <th style='text-align: left; width: 10%;'>Data rozpoczęcia</th>
      <th style='text-align: left; width: 10%;'>Data zakończnia</th>
      <th style='text-align: center; width: 10%;'>Bezterminowo</th>
      <th style='text-align: center; width: 20%;'>Aktywny</th>
      <th style='text-align: center; width: 10%;'></th>
    </tr>
  </thead>

  <?php if (count ( $this->_tpl_vars['collection']['items'] ) > 0): ?>
    <?php $_from = $this->_tpl_vars['collection']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
    <tr class='<?php echo smarty_function_cycle(array('values' => "odd,even"), $this);?>
'>
      <td style='text-align: center;'><?php echo smarty_function_math(array('equation' => "(x + y)",'x' => $this->_tpl_vars['k'],'y' => $this->_tpl_vars['collection']['page']['from']), $this);?>
</td>
      <td style='text-align: left;'><?php echo $this->_tpl_vars['i']['title']; ?>
</td>
      <td style='text-align: left;'><?php echo ((is_array($_tmp=$this->_tpl_vars['i']['added'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 10, "") : smarty_modifier_truncate($_tmp, 10, "")); ?>
</td>
      <td style='text-align: left;'><?php echo $this->_tpl_vars['i']['date_from']; ?>
</td>
      <td style='text-align: left;'><?php echo $this->_tpl_vars['i']['date_to']; ?>
</td>
      <td style='text-align: center;'>
        <?php if ($this->_tpl_vars['i']['always'] == 'Y'): ?>
          <img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
mark-green.gif'>
        <?php elseif ($this->_tpl_vars['i']['always'] == 'N'): ?>
          <img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
mark-red.gif'>
        <?php endif; ?>
      </td>
      <td style='text-align: center;'>
      <?php if ($this->_tpl_vars['i']['active']): ?>
        <img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
mark-green.gif'>
      <?php else: ?>
        <img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
mark-red.gif'>
      <?php endif; ?>
      </td>
      <td>
        <a href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;act=edit&amp;id=<?php echo $this->_tpl_vars['i']['id_event']; ?>
'><img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-edit.png' border='0' alt='edytuj' title='edytuj' /></a>
      </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
  <?php else: ?>
    <tr class='odd'>
      <td class='odd' colspan='8' style='text-align: center;'>BRAK DANYCH</td>
    </tr>
  <?php endif; ?>

  <tr class='odd'>
    <td class='odd' colspan='8' style='text-align: center;'><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "main/templates/page.tpl", 'smarty_include_vars' => array('page' => $this->_tpl_vars['collection']['page'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
  </tr>
  
</table>
</form>