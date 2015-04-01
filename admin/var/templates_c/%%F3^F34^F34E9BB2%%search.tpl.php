<?php /* Smarty version 2.6.18, created on 2013-09-20 18:34:49
         compiled from event/templates/search.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'event/templates/search.tpl', 15, false),array('modifier', 'stripslashes', 'event/templates/search.tpl', 15, false),)), $this); ?>
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
' name='search_<?php echo $this->_tpl_vars['mainParameterValue']; ?>
' method='post'>
<table border='0' cellspacing='0' cellpadding='0'>
<tbody>
  <tr>
    <td align='left' valign='middle' style='width:20%;'>
      <strong>Tytuł</strong><br />
      <input type='text' size='20' name='s_<?php echo $this->_tpl_vars['mainParameterValue']; ?>
[title]' value='<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['s_event']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
' class='form-text'>
    </td>
    <td align='left' valign='middle' style='width:25%;padding-left:3px;'>
      <strong>Wyświetlane od</strong><br />
       <input type='text' class='form-text' maxlength="10" name='s_<?php echo $this->_tpl_vars['mainParameterValue']; ?>
[date_from]' value="<?php echo $this->_tpl_vars['s_event']['date_from']; ?>
" readonly='readonly' id='dataarea' style='width: 60px;' /><img src='css/img/calendar_low.gif' id='trigger' class='cal-button' alt='wybierz datę' title='wybierz datę' /> <img src="css/img/gumka.png" alt="wyczyść" id="eraser" title="wyczyść" class="gumka" />
  <?php echo '<script type="text/javascript">
    Calendar.setup({
      inputField  : "dataarea",
      button      : "trigger",
      eraser      : "eraser"
    });
  </script>'; ?>

    </td>
    <td align='left' valign='middle' style='width:20%;padding-left:3px;'>
      <b>Wyświetlane do</b><br>
<input type='text' class='form-text' maxlength="10" name='s_<?php echo $this->_tpl_vars['mainParameterValue']; ?>
[date_to]' value="<?php echo $this->_tpl_vars['s_event']['date_to']; ?>
" readonly='readonly' id='dataarea2' style='width: 60px;' /><img src='css/img/calendar_low.gif' id='trigger2' class='cal-button' alt='wybierz datę' title='wybierz datę' /> <img src="css/img/gumka.png" alt="wyczyść" id="eraser2" title="wyczyść" class="gumka" />
  <?php echo '<script type="text/javascript">
    Calendar.setup({
			inputField  : "dataarea2",
			button      : "trigger2" ,
			eraser      : "eraser2"
		});
  </script>'; ?>

    </td>
    <td align='left' valign='middle' style='width:20%;padding-left:3px;'>
      <b>Wyśw. bezterminowo</b><br>
      <select class="form-select" name="s_<?php echo $this->_tpl_vars['mainParameterValue']; ?>
[always]">
        <option value=''>bez znaczenia&nbsp;</option>
        <option value='Y'<?php if ($this->_tpl_vars['s_event']['always'] == 'Y'): ?> selected="selected" <?php endif; ?>>tak</option>
        <option value='N'<?php if ($this->_tpl_vars['s_event']['always'] == 'N'): ?> selected="selected" <?php endif; ?>>nie</option>
      </select>
    </td>
    <td align='left' valign='middle' style='width:20%;padding-left:3px;'>
      <b>Aktywny</b><br>
      <select class="form-select" name="s_<?php echo $this->_tpl_vars['mainParameterValue']; ?>
[active]">
        <option value=''>bez znaczenia&nbsp;</option>
        <option value='Y'<?php if ($this->_tpl_vars['s_event']['active'] == 'Y'): ?> selected="selected" <?php endif; ?>>tak</option>
        <option value='N'<?php if ($this->_tpl_vars['s_event']['active'] == 'N'): ?> selected="selected" <?php endif; ?>>nie</option>
      </select>
    </td>
  </tr>
  <tr>
    <td align='right' valign='middle' colspan="5">
      <input type='submit' value='szukaj' name='search_<?php echo $this->_tpl_vars['mainParameterValue']; ?>
' class='form-button' style='color: green; margin-right:40px;' />
    </td>
  </tr>
  </tbody>
</table>
</form>
</div>