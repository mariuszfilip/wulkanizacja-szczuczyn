<?php /* Smarty version 2.6.18, created on 2013-08-20 22:05:36
         compiled from service/templates/add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'service/templates/add.tpl', 23, false),)), $this); ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "main/templates/errors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form name='editform' enctype='multipart/form-data' method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;act=add">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
<tr>
  <td class='lewa' style='width:15%;'>Kategoria:</td>
  <td class='prawa' style='width:85%;'>    
    <select type="text" name="data[id_catalog]" value="<?php echo $this->_tpl_vars['data']['id_catalog']; ?>
" style="width: 330px;">
    <option>&nbsp;- wybierz - </option>
    <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category_item']):
?>
    <option <?php if ($this->_tpl_vars['category_item']['active'] == 'N'): ?>style="color:#CCC"<?php endif; ?> <?php if ($this->_tpl_vars['data']['id_catalog'] == $this->_tpl_vars['category_item']['id_catalog']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['category_item']['id_catalog']; ?>
">&nbsp;<?php echo $this->_tpl_vars['category_item']['name']; ?>
</option>
    <?php if ($this->_tpl_vars['category_item']['children']): ?>
    	<?php $_from = $this->_tpl_vars['category_item']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['children_item']):
?>
        <option <?php if ($this->_tpl_vars['children_item']['active'] == 'N'): ?>style="color:#CCC"<?php endif; ?> <?php if ($this->_tpl_vars['data']['id_catalog'] == $this->_tpl_vars['children_item']['id_catalog']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['children_item']['id_catalog']; ?>
">&nbsp;&nbsp; &raquo;&nbsp;<?php echo $this->_tpl_vars['children_item']['name']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    </select>
  </td>
</tr>
<tr>
  <td class='lewa' style='width:15%;'>Nazwa:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[name]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" style="width: 330px;" />
  </td>
</tr>
<tr>
  <td class='lewa'>Opis skrócony: </td>
  <td class='prawa'>
   	<textarea cols="40" rows="40" id="contents" name="data[short_content]" ><?php echo $this->_tpl_vars['data']['short_content']; ?>
</textarea>
      	
      	<?php echo '
      	<script type="text/javascript">
      		 CKEDITOR.replace( \'contents\',{
       			width: 700,
      		 });        
  		</script>
      	'; ?>


  </td>
</tr>
<tr>
  <td class='lewa'>Pełny opis: </td>
  <td class='prawa'>
   	<textarea cols="40" rows="40" id="contentss" name="data[content]" ><?php echo $this->_tpl_vars['data']['content']; ?>
</textarea>
      	
      	<?php echo '
      	<script type="text/javascript">
      		 CKEDITOR.replace( \'contentss\',{
       			width: 700,
      		 });        
  		</script>
      	'; ?>

  </td>
</tr>

<tr>
  <td class='lewa' style='width:15%;'>Cena:</td>
  <td class='prawa' style='width:85%;'>
    <input style="text-align:right" class="form-text" type="text" name="data[price]" value="<?php echo $this->_tpl_vars['data']['price']; ?>
" style="width: 40px;" maxlength="13" /> &nbsp;$
  </td>
</tr>

<tr>
  <td class='lewa'>Status: </td>
  <td class='prawa'>
    <?php if ($this->_tpl_vars['data']['active'] == 'N' || $this->_tpl_vars['data']['active'] == ''): ?>
    <input type='radio' name='data[active]' value='N' id='status0' checked='checked' />
    <?php else: ?>
    <input type='radio' name='data[active]' value='N' id='status0' />
    <?php endif; ?>
    <label for='status0'>nieaktywny</label>
    <?php if ($this->_tpl_vars['data']['active'] == 'Y'): ?>
    <input type='radio' name='data[active]' value='Y' id='status1' checked='checked' />
    <?php else: ?>
    <input type='radio' name='data[active]' value='Y' id='status1' />
    <?php endif; ?>
    <label for='status1'>aktywny</label>
  </td>
</tr>
<!-- submit dodawania rekordu -->
<tr>
  <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
  	<img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-anuluj.gif' onclick='location.href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
"' onmouseover="this.src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-anuluj-over.gif'" onmouseout="this.src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-anuluj.gif'" class='icon' />
    <input type='hidden' name='confirms' value='1' />
    <img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-zatwierdz-over.gif'" onmouseout="this.src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-zatwierdz.gif'" class='icon' />
  </td>
</tr></table>
</form>