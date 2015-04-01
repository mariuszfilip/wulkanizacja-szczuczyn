<?php /* Smarty version 2.6.18, created on 2013-08-22 19:49:02
         compiled from catalog/templates/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'catalog/templates/edit.tpl', 7, false),array('modifier', 'string_format', 'catalog/templates/edit.tpl', 23, false),)), $this); ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "main/templates/errors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form name='editform' enctype='multipart/form-data' method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;act=edit&amp;id=<?php echo $this->_tpl_vars['data']['id']; ?>
">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
  <tr>
    <td class='lewa'>Nazwa: </td>
    <td class='prawa'>
      <input class="form-text" type="text" id='name' name="data[name]" value='<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
' style='width: 350px;' />
    </td>
  </tr>

  <?php if (! empty ( $this->_tpl_vars['data']['picture'] )): ?>
	   <td class='lewa'>Obrazek:</td>
	   <td class='prawa'>
	          <div style="text-align:left;width: 550px;">
	           <a href="<?php echo @PICT_DIR; ?>
<?php echo $this->_tpl_vars['data']['picture']; ?>
" rel="lytebox" alt="<?php echo $this->_tpl_vars['data']['picture']; ?>
">
	           	<img style="float:left;" class="over_effect" src="tools/thumb.php?dir=<?php echo @PICT_DIR; ?>
&amp;file=<?php echo $this->_tpl_vars['data']['picture']; ?>
&amp;w=70"
              onmouseover='jQuery(this).fadeTo("fast", 1); jQuery(this).css("border-color", "#058CC4");' onmouseout='jQuery(this).fadeTo("fast", .8); jQuery(this).css("border-color", "#A4A4A4");'
               />
	           </a>
	           <div style="float:left;margin-left: 20px;">
	                       plik: <b><?php echo $this->_tpl_vars['data']['picture']; ?>
</b><br />
	                       <br />
	                       <?php echo ((is_array($_tmp=$this->_tpl_vars['data']['picture_sizek'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.1f") : smarty_modifier_string_format($_tmp, "%.1f")); ?>
&nbsp;kB
	                       <div style="margin-top:15px" />
                    
                    <input type="checkbox" name="delete" id="delete" class="checkbox" value="<?php echo $this->_tpl_vars['data']['id']; ?>
" /> <label for="delete" class="label">usuń</label>   
	           </div>
	    </div>
	  </td>
       <?php else: ?>
    <td class='lewa'>Obrazek: </td>
    <td class='prawa'>
      <script type="text/javascript">
		document.documentElement.className += ' js ';
	</script>    
    <div class="input-file" style="width:357px;"> 
    	<label> <span>Kliknij by wybrać</span> <input id="picture" type="file" name="source_name" /> </label> <var><input type="text" name="my-input-file-path" value="wybierz plik..." readonly="readonly" />&nbsp;</var>
    </div>    
	<script type="text/javascript"><?php echo '
		var aUploadFileBtns = document.getElementsByName(\'source_name\');
		for(var i=0,dBtn;dBtn = aUploadFileBtns[i];i++){
			new FileUploadUI(dBtn);
		};
	</script>'; ?>
  
      
    </td>
  <?php endif; ?>
   </tr>
  <tr>
    <td class='lewa'>&nbsp;</td>
    <td class='prawa'>&nbsp;</td>
  </tr>
	<tr>
		<td class='lewa'>Meta Title: </td>
		<td class='prawa'>
      <textarea class="form-textarea" cols="60" name="data[meta_title]"><?php echo $this->_tpl_vars['data']['meta_title']; ?>
</textarea>
		</td>
	</tr>
       <tr>
         <td class='lewa'>Meta Description: </td>
    <td class='prawa'>
      <textarea class="form-textarea" cols="60" name="data[meta_description]"><?php echo $this->_tpl_vars['data']['meta_description']; ?>
</textarea>
         </td>
  </tr>
        <tr>
         <td class='lewa'>Meta Keywords: </td>
    <td class='prawa'>
      <textarea class="form-textarea" cols="60" name="data[meta_keywords]"><?php echo $this->_tpl_vars['data']['meta_keywords']; ?>
</textarea>
         </td>
  </tr>
        <tr>
         <td class='lewa'>Meta Robots: </td>
    <td class='prawa'>
      <textarea class="form-textarea" cols="60" name="data[meta_robots]"><?php echo $this->_tpl_vars['data']['meta_robots']; ?>
</textarea>
         </td>
  </tr>
        <tr>
         <td class='lewa'>Meta Last Modified: </td>
    <td class='prawa'>
      <input class="form-text" name="data[meta_last_modified]" value="<?php echo $this->_tpl_vars['data']['meta_last_modified']; ?>
" style='width: 200px;' />
         </td>
  </tr>
  <tr>
    <td class='lewa'>Status: </td>
    <td class='prawa'>
      <?php if ($this->_tpl_vars['data']['active'] == 'N'): ?>
      <input type='radio' name='data[active]' value='N' id='status0' checked='checked' />
      <?php else: ?>
      <input type='radio' name='data[active]' value='N' id='status0' checked='checked' />
      <?php endif; ?>
      <label for='status0'>niewidoczny</label>
      <?php if ($this->_tpl_vars['data']['active'] == 'Y'): ?>
      <input type='radio' name='data[active]' value='Y' id='status1' checked='checked' />
      <?php else: ?>
      <input type='radio' name='data[active]' value='Y' id='status1' />
      <?php endif; ?>
      <label for='status1'>widoczny</label>
    </td>
  </tr>
  <tr>
    <td class='lewa'>Data dadania: </td>
    <td class='prawa'>
      <?php echo $this->_tpl_vars['data']['added']; ?>

    </td>
  </tr>
  <tr>
    <td class='lewa'>Data modyfikacji: </td>
    <td class='prawa'>
      <?php echo $this->_tpl_vars['data']['modified']; ?>

    </td>
  </tr>

  <tr>
    <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
           <img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-anuluj.gif' onclick='location.href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
"' onmouseover="this.src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-anuluj-over.gif'" onmouseout="this.src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-anuluj.gif'" class='icon' />
      <input type='hidden' name='confirm' value='1' />
      <img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-zatwierdz-over.gif'" onmouseout="this.src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-zatwierdz.gif'" class='icon' />
      <input type='hidden' name='data[id]' value='<?php echo $this->_tpl_vars['data']['id']; ?>
' />
           <img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-usun.gif' onclick='if(confirm("Je�li chcesz usuna� kliknij [OK]\nJeśli nie [Anuluj]"))location.href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;act=del&amp;id=<?php echo $this->_tpl_vars['data']['id']; ?>
"' onmouseover="this.src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-usun-over.gif'" onmouseout="this.src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-usun.gif'" class='icon' />
    </td>
  </tr>
  <tr>
    <td colspan="2">
      <div style="border-bottom: 1px solid rgb(193, 223, 250); color: rgb(100, 100, 100); width: 100%;"></div>
    </td>
  </tr>
</table>
</form>