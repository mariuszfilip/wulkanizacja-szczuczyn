<?php /* Smarty version 2.6.18, created on 2013-08-22 19:49:58
         compiled from page/templates/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'page/templates/edit.tpl', 7, false),array('modifier', 'substr', 'page/templates/edit.tpl', 149, false),array('function', 'cycle', 'page/templates/edit.tpl', 146, false),)), $this); ?>
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
  
<?php if ($_SESSION['user']['super_user'] == 1): ?>
  <tr>
    <td class='lewa'>Moduł: </td>
    <td class='prawa'>
		<select type="text" name="data[id_module]" style="width: 355px;">
    <option value=""> [ - wybierz - ] </option>
    
    <?php $_from = $this->_tpl_vars['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['module']):
?>
    <option <?php if ($this->_tpl_vars['data']['id_module'] == $this->_tpl_vars['module']['id_module']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['module']['id_module']; ?>
">&nbsp;<?php echo $this->_tpl_vars['module']['name']; ?>
</option>
    <?php endforeach; endif; unset($_from); ?>
    </select>
    </td>
  </tr>
<?php endif; ?>

  <tr>
    <td class='lewa'>Treść: </td>
    <td class='prawa'>
      
      			
      	<textarea cols="40" rows="40" id="contents" name="data[content]" ><?php echo $this->_tpl_vars['data']['content']; ?>
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
      <span style="font-size:10px;width:200px;">(Poniższa wartość jest domyślna.)</span><br />
      <input type="text" class="form-text" name="data[meta_robots]" value="<?php echo $this->_tpl_vars['meta_robots']; ?>
" style='width: 200px;' readonly="readonly" />
    </td>
  </tr>
  <tr>
    <td class='lewa'>Meta Last Modified: </td>
    <td class='prawa'>
      <input type="text" class="form-text" name="data[meta_last_modified]" value="<?php echo $this->_tpl_vars['meta_last_modified']; ?>
" style='width: 200px;' readonly="readonly" />
    </td>
  </tr>
  <tr>
    <td class='lewa'>Status: </td>
    <td class='prawa'>
      
      <input type='radio' name='data[active]' value='N' id='status0' <?php if ($this->_tpl_vars['data']['active'] != 'Y'): ?>checked='checked'<?php endif; ?> />
      <label for='status0'>niewidoczny</label>
      
      <input type='radio' name='data[active]' value='Y' id='status1' <?php if ($this->_tpl_vars['data']['active'] == 'Y'): ?>checked='checked'<?php endif; ?> />
      <label for='status1'>widoczny</label>
    </td>
  </tr>
  
  
<tr>
	<td class='lewa'>&nbsp;</td>
	<td class='prawa'>
	<input type="checkbox" class="checkbox" <?php if ($this->_tpl_vars['data']['bottom_menu'] == 'Y'): ?>checked="checked"<?php endif; ?> value="Y" name="data[bottom_menu]" id="bottom_menu"> <label class="label" for="bottom_menu" style="margin-left:0px;">wyświetlaj także w dolnym menu</label>
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
       <?php if ($this->_tpl_vars['data']['editable'] != N || $_SESSION['user']['super_user'] == 1): ?><input type='hidden' name='confirmed' value='1' />
      <img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-zatwierdz-over.gif'" onmouseout="this.src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-zatwierdz.gif'" class='icon' />
      <input type='hidden' name='data[id]' value='<?php echo $this->_tpl_vars['data']['id']; ?>
' /><?php endif; ?>
           <?php if ($this->_tpl_vars['data']['deletable'] != N): ?><img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-usun.gif' onclick='if(confirm("Jeśli chcesz usunąć kliknij [OK]\nJeśli nie [Anuluj]"))location.href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;act=del&amp;id=<?php echo $this->_tpl_vars['data']['id']; ?>
"' onmouseover="this.src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-usun-over.gif'" onmouseout="this.src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-usun.gif'" class='icon' /><?php endif; ?>
    </td>
  </tr>

  <tr>
    <td colspan="2">
      <div style="border-bottom: 1px solid #058CC4; width: 100%;"></div>
    </td>
  </tr>

  <tr style="vertical-align:top;">
         <td class="lewa">Przypisane pliki: </td>
         <td class="prawa" style="padding-top:10px;">
      <?php if (count ( $this->_tpl_vars['addedFiles'] ) > 0): ?>
      <div style="overflow: auto; max-height: 250px;">
           <table class="lista noTigra" id='lista' border="0" cellpadding="0" cellspacing="0">
                <thead>
                   <tr class="nodrop nodrag">
                     <th style="width:5%;text-align:center;padding-right:5px;" class="no_link">&nbsp;</th>
                     <th style="width:40%;text-align:left;padding-left:5px;" class="no_link">Nazwa</th>
                     <th style="width:35%;text-align:left;padding-left:5px;" class="no_link">Plik</th>
                     <th style="width:10%;text-align:center;" class="no_link">Edycja</th>
                   </tr>
                 </thead>
                 <?php $_from = $this->_tpl_vars['addedFiles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['file']):
?>
                 <tr class='<?php echo smarty_function_cycle(array('values' => "odd,even"), $this);?>
' id="<?php echo $this->_tpl_vars['file']['id_file']; ?>
">
									<?php if (count ( $this->_tpl_vars['addedFiles'] ) > 1): ?><td class="dragHandle icon_tip" title="przeciągnij by zmienić kolejność"><span class="handle"></span></td><?php else: ?><td>&nbsp;</td><?php endif; ?>
                   <td style="text-align:left;padding-left:5px;"><?php echo $this->_tpl_vars['file']['name']; ?>
</td>
                   <td style="text-align:left;padding-left:5px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['file']['file_name'])) ? $this->_run_mod_handler('substr', true, $_tmp, 15) : substr($_tmp, 15)); ?>
</td>
                   <td style="text-align:center;">
                     <a href="popup.php?mod=file&amp;act=popup&amp;id=<?php echo $this->_tpl_vars['file']['id_file']; ?>
" title='edytuj' class="icon_tip" rel="lyteframe" rev="width: 850px; height: 600px; scrolling: auto;">
                        <img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-edit.png' border='0' alt='edytuj' class='icon' />
                       </a>
                   </td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
           </table>
                </div>
                <?php else: ?>
        brak przypisanych
      <?php endif; ?>
      <br /><a href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;act=files&amp;id=<?php echo $this->_tpl_vars['data']['id_page']; ?>
">przypisz plik &raquo;</a>
         </td>
  </tr>




  <tr style="vertical-align:top;">
    <td class='lewa' style="padding-top:10px;">Przypisane galerie: </td>
    <td class='prawa' style="padding-top:10px;">
      <?php if (count ( $this->_tpl_vars['gallerys'] ) > 0): ?>
      <div style="overflow: auto; max-height: 250px;">
        <table class="lista noTigra" id='lista2' border="0" cellpadding="0" cellspacing="0">
        <thead>
          <tr class="nodrop nodrag">
            <th style="width:5%;text-align:center;padding-right:5px;">&nbsp;</th>
            <th class="no_link" style="width:75%;text-align:left;padding-left:5px;">Nazwa</th>
            <th class="no_link" style="width:10%;text-align:center;">Podgląd</th>
            <th style="width:10%;text-align:center;">Edycja</th>
          </tr>
        </thead>
        <?php $_from = $this->_tpl_vars['gallerys']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
          <tr id="<?php echo $this->_tpl_vars['i']['id_gallery']; ?>
">
            <?php if (count ( $this->_tpl_vars['gallerys'] ) > 1): ?><td class="dragHandle icon_tip" title="przeciągnij by zmienić kolejność"><span class="handle"></span></td><?php else: ?><td>&nbsp;</td><?php endif; ?>
            <td style="text-align:left;padding-left:5px;"><?php echo $this->_tpl_vars['i']['name']; ?>
</td>
            <td style="text-align:center;">
                    <a href="previewGallery.php?id=<?php echo $this->_tpl_vars['i']['id_gallery']; ?>
&amp;height=600&amp;width=890" class="icon_tip" title="zdjęcia w galerii" rel="lyteframe" rev="width: 900px; height: 600px; scrolling: auto;">
                       <img src="<?php echo $this->_config[0]['vars']['imgDir']; ?>
preview.gif" style="height: 15px;" alt="podgląd" />
                    </a>
            </td>
            <td style="text-align:center;">
             <a href="popup.php?mod=gallery&amp;act=popup&amp;id=<?php echo $this->_tpl_vars['i']['id_gallery']; ?>
" title="edytuj" class="icon_tip" rel="lyteframe" rev="width: 850px; height: 600px; scrolling: auto;">
              <img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-edit.png' border='0' alt='edytuj' class='icon' />
             </a>
            </td>
          </tr>
        <?php endforeach; endif; unset($_from); ?>
        </table>
        </div>
      <?php else: ?>
        brak przypisanych
      <?php endif; ?>
      <br /><a href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;act=gallerys&amp;id=<?php echo $this->_tpl_vars['data']['id_page']; ?>
">przypisz galerie &raquo;</a>
    </td>
  </tr>
</table>
</form>
<?php if (count ( $this->_tpl_vars['gallerys'] ) > 1 || count ( $this->_tpl_vars['addedFiles'] ) > 1): ?>
<script type="text/javascript" src="js/jquery.tablednd_0_5.js"></script>
<script type="text/javascript">
//<![CDATA[
<?php if (count ( $this->_tpl_vars['addedFiles'] ) > 1): ?>
		setTableAjaxOrderDrag("lista", 'mod=page&act=order_file&id=<?php echo $this->_tpl_vars['data']['id']; ?>
');
<?php endif; ?>
<?php if (count ( $this->_tpl_vars['gallerys'] ) > 1): ?>
		setTableAjaxOrderDrag("lista2", 'mod=page&act=order_galery&id=<?php echo $this->_tpl_vars['data']['id']; ?>
');
<?php endif; ?>
		MM_preloadImages('./css/img/openhand.cur', './css/img/closedhand.cur', './css/img/large-grey-back-light-blue.gif', './css/img/large-blue-back-hover.gif', './css/img/UI-loader.gif');
//]]>
</script>
<?php endif; ?>