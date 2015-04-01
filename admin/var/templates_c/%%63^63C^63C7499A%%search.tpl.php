<?php /* Smarty version 2.6.18, created on 2013-08-20 22:04:40
         compiled from service/templates/search.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'service/templates/search.tpl', 15, false),array('modifier', 'stripslashes', 'service/templates/search.tpl', 15, false),)), $this); ?>
<table class="search_list"  style='width: <?php if (! $_SESSION['show_search'][$this->_tpl_vars['mainParameterValue']]): ?>125px<?php else: ?>100%<?php endif; ?>; ' id='search_list' cellspacing='0' cellpadding='0'>
<thead>
  <tr>
    <th style='text-align: left; width: 100%;padding-left:10px;'><a href="javascript:;" onclick="change_search('<?php echo $this->_tpl_vars['mainParameterValue']; ?>
');">Wyszukiwarka <img src="./img/<?php if (! $_SESSION['show_search'][$this->_tpl_vars['mainParameterValue']]): ?>un<?php endif; ?>visible.png" style="margin-bottom:-5px;" id="search_img" /></a></th>
  </tr>
</thead>
</table>
<div id="search_body" class="search_body" <?php if (! $_SESSION['show_search'][$this->_tpl_vars['mainParameterValue']]): ?>style="display:none;"<?php endif; ?>>
<form action='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
' method='post'>
<table border='0' cellspacing='0' cellpadding='0'>

  <tr class='even'>
    <td align='left' valign='middle' style='padding:5px;'>
    <b>Kategoria</b><br>
   <input type='text' size='20' name='s_<?php echo $this->_tpl_vars['mainParameterValue']; ?>
[catalog_name]' value='<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['s_service']['catalog_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
' class='form-text'>
    </td>
    
    <td align='left' valign='middle' style='padding:5px;'>
    <b>Nazwa</b><br>
    <input type='text' size='20' name='s_<?php echo $this->_tpl_vars['mainParameterValue']; ?>
[name]' value='<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['s_service']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
' class='form-text'>
    </td>

    <td align='left' valign='middle' style='padding:5px;'>
      <b>Cena od</b><br>
      <input type='text' size='10' name='s_<?php echo $this->_tpl_vars['mainParameterValue']; ?>
[price_from]' value='<?php echo $this->_tpl_vars['s_service']['price_from']; ?>
' class='form-text'> $
    </td>

    <td align='left' valign='middle' style='padding:5px;'>
      <b>Cena do</b><br>
      <input type='text' size='10' name='s_<?php echo $this->_tpl_vars['mainParameterValue']; ?>
[price_to]' value='<?php echo $this->_tpl_vars['s_service']['price_to']; ?>
' class='form-text'> $
    </td>

    <td align='left' valign='middle' style='padding:5px;'>
      <b>Status</b><br>
      <select class="form-select" name="s_<?php echo $this->_tpl_vars['mainParameterValue']; ?>
[active]" style="width:98px">
        <option value="">bez znaczenia</option>
        <option value="Y" <?php if ($this->_tpl_vars['s_service']['active'] == 'Y'): ?>selected="selected"<?php endif; ?>>aktywny</option>
        <option value="N" <?php if ($this->_tpl_vars['s_service']['active'] == 'N'): ?>selected="selected"<?php endif; ?>>nieaktywny</option>
      </select>
    </td>
    <td align='center' valign='middle' style='padding:5px;'>
      <input type='submit' value='szukaj' name='search_<?php echo $this->_tpl_vars['mainParameterValue']; ?>
' class='form-button' />
    </td>
  </tr>


</table>
</form>
</div>