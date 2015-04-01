<?php /* Smarty version 2.6.18, created on 2013-08-20 22:05:48
         compiled from service/templates/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'service/templates/edit.tpl', 23, false),array('modifier', 'substr', 'service/templates/edit.tpl', 228, false),array('modifier', 'capitalize', 'service/templates/edit.tpl', 229, false),array('modifier', 'replace', 'service/templates/edit.tpl', 229, false),)), $this); ?>
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
  <td class='lewa' style='width:15%;'>Kategoria:</td>
  <td class='prawa' style='width:85%;'>    
    <select type="text" name="data[id_catalog]" value="<?php echo $this->_tpl_vars['data']['id_catalog']; ?>
" style="width: 330px;">
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
  		<textarea cols="40" rows="40" id="contentss" name="data[short_content]" ><?php echo $this->_tpl_vars['data']['short_content']; ?>
</textarea>
  		<?php echo '
      	<script type="text/javascript">
      		 CKEDITOR.replace( \'contentss\',{
       			width: 700,
      		 });        
  		</script>
      	'; ?>

  </td>
</tr><!-- wybierz jedna fomre zapisu -->
<tr>
  <td class='lewa'>Pełny opis: </td>
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
	<script type="text/javascript">
		<?php echo '
			function pokaz1(){
				jQuery(".akumulator").hide();
				jQuery(".felga").hide();
				jQuery(".opona").show();
			}
			function pokaz2(){
				jQuery(".akumulator").hide();
				jQuery(".opona").hide();
				jQuery(".felga").show();
			}
			function pokaz3(){
				jQuery(".felga").hide();
				jQuery(".opona").hide();
				jQuery(".akumulator").show();
			}
	

		'; ?>

	</script>
<tr>
  <td class='lewa' style='width:15%;'>Typ kategorii:</td>
  <td class='prawa' style='width:85%;'>    
    
    <?php $_from = $this->_tpl_vars['categories_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category_item']):
?>
    	<input type="radio" onclick="pokaz<?php echo $this->_tpl_vars['category_item']['id']; ?>
()" id="cat_<?php echo $this->_tpl_vars['category_item']['id']; ?>
" name="data[id_category_type]" <?php if ($this->_tpl_vars['data']['id_category_type'] == $this->_tpl_vars['category_item']['id']): ?>checked='checked'<?php endif; ?> value="<?php echo $this->_tpl_vars['category_item']['id']; ?>
">
        <label for='cat_<?php echo $this->_tpl_vars['category_item']['id']; ?>
'><?php echo $this->_tpl_vars['category_item']['name']; ?>
</label>
    <?php endforeach; endif; unset($_from); ?>
    
  </td>
</tr>
<tr>
  <td class='lewa' style='width:15%;'>Producent:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[producer]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['producer'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" style="width: 330px;" />
  </td>
</tr>
<tr>
  <td class='lewa' style='width:15%;'>Cena:</td>
  <td class='prawa' style='width:85%;'>
    <input style="text-align:right" class="form-text" type="text" name="data[price]" value="<?php echo $this->_tpl_vars['data']['price']; ?>
" style="width: 40px;" maxlength="13" /> &nbsp;PLN
  </td>
</tr>
<!-- opona -->

<tr class="opona">
  <td class='lewa' >Rolnicza: </td>
  <td class='prawa'>
    <?php if ($this->_tpl_vars['data']['agricultural'] == '0' || $this->_tpl_vars['data']['agricultural'] == ''): ?>
    <input type='radio' name='data[agricultural]' value='0' id='status0' checked='checked' />
    <?php else: ?>
    <input type='radio' name='data[agricultural]' value='0' id='status0' />
    <?php endif; ?>
    <label for='status0'>Nie</label>
    <?php if ($this->_tpl_vars['data']['agricultural'] == '1'): ?>
    <input type='radio' name='data[agricultural]' value='1' id='status1' checked='checked' />
    <?php else: ?>
    <input type='radio' name='data[agricultural]' value='1' id='status1' />
    <?php endif; ?>
    <label for='status1'>Tak</label>
  </td>
</tr>

<tr class="opona">
  <td class='lewa' style='width:15%;'>Ilosc partów:</td>
  <td class='prawa' style='width:85%;'>
    <input style="text-align:right" class="form-text" type="text" name="data[pr]" value="<?php echo $this->_tpl_vars['data']['pr']; ?>
" style="width: 40px;" maxlength="13" /> 
  </td>
</tr>
<tr class="opona">
  <td class='lewa' style='width:15%;'>Bieżnik:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[cap]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['cap'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" style="width: 330px;" />
  </td>
</tr>
<tr class="opona">
  <td class='lewa' style='width:15%;'>Rozmiar:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[size]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['size'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" style="width: 330px;" />
  </td>
</tr>
<tr class="opona">
  <td class='lewa' style='width:15%;'>Sezon:</td>
  <td class='prawa' style='width:85%;'>
    <select name="data[season]">
    	<option value="0">Wybierz pore roku</option>
    	<option value="1"  <?php if ($this->_tpl_vars['data']['season'] == 1): ?>selected="selected"<?php endif; ?>>Lato</option>
    	<option value="2" <?php if ($this->_tpl_vars['data']['season'] == 2): ?>selected="selected"<?php endif; ?>>Zima</option>
    	<option value="3" <?php if ($this->_tpl_vars['data']['season'] == 3): ?>selected="selected"<?php endif; ?>>Wielosezonowa</option>
    </select>
  </td>
</tr>
<tr class="opona">
  <td class='lewa' style='width:15%;'>Przeznaczenia:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[destination]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['destination'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" style="width: 330px;" />
  </td>
</tr>
<tr class="opona">
  <td class='lewa' style='width:15%;'>Indeks predkosci:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[speed_index]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['speed_index'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" style="width: 330px;" />
  </td>
</tr>
<tr class="opona">
  <td class='lewa' style='width:15%;'>Nośność:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[maxload]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['maxload'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" style="width: 330px;" />
  </td>
</tr>

<!-- koniec opona -->
<!-- felga -->

<tr class="felga">
  <td class='lewa' style='width:15%;'>Średnica felgi:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[diameter_wheel]" value="<?php echo $this->_tpl_vars['data']['diameter_wheel']; ?>
" style="width: 330px;" />
  </td>
</tr>
<tr class="felga">
  <td class='lewa' style='width:15%;'>Szerokość felgi:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[width_wheel]" value="<?php echo $this->_tpl_vars['data']['width_wheel']; ?>
" style="width: 330px;" />
  </td>
</tr>
<tr class="felga">
  <td class='lewa' style='width:15%;'>Rozstaw śrub:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[spacing_screw]" value="<?php echo $this->_tpl_vars['data']['spacing_screw']; ?>
" style="width: 330px;" />
  </td>
</tr>
<tr class="felga">
  <td class='lewa' style='width:15%;'>Osadzenie:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[seating]" value="<?php echo $this->_tpl_vars['data']['seating']; ?>
" style="width: 330px;" />
  </td>
</tr>
<!-- koniec felga -->
<!-- akumulator -->
<tr class="akumulator">
  <td class='lewa' style='width:15%;'>Gwarancja:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[warranty]" value="<?php echo $this->_tpl_vars['data']['warranty']; ?>
" style="width: 330px;" />
  </td>
</tr>
<tr class="akumulator">
  <td class='lewa' style='width:15%;'>Napięcie:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[tension]" value="<?php echo $this->_tpl_vars['data']['tension']; ?>
" style="width: 330px;" />
  </td>
</tr>
<tr class="akumulator">
  <td class='lewa' style='width:15%;'>Pojemność:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[capacity]" value="<?php echo $this->_tpl_vars['data']['capacity']; ?>
" style="width: 330px;" />
  </td>
</tr>
<tr class="akumulator">
  <td class='lewa' style='width:15%;'>Moc rozruchowa:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[power_starter]" value="<?php echo $this->_tpl_vars['data']['power_starter']; ?>
" style="width: 330px;" />
  </td>
</tr>

<!-- koniec akumulator -->
<tr>
    <td class='lewa'>Obrazek:</td>
    <td class='prawa'>
    <?php if ($this->_tpl_vars['data']['picture'] != ''): ?>
      <div style="display: inline; float: left; min-height: 120px; width: 270px; margin: 3px; text-align: left; padding: 5px; margin-left:0;        
		-moz-border-radius:3px;
		border:1px solid #A4A4A4;" class="gallery_image_div">
          <div style="width: 195px; height: 110px; text-align: left;float:left;padding-left:10px;">
            <span style="font-weight: normal;">plik:</span>&nbsp;&nbsp;<b><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['picture'])) ? $this->_run_mod_handler('substr', true, $_tmp, 15) : substr($_tmp, 15)); ?>
</b><br />
              <a href="../files/service/<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['picture'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" title="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['data']['picture'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('substr', true, $_tmp, 15, -4) : substr($_tmp, 15, -4)))) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)))) ? $this->_run_mod_handler('replace', true, $_tmp, '_', ' ') : smarty_modifier_replace($_tmp, '_', ' ')); ?>
" rel="lytebox" >
    		        <img src="../thumb.php?dir=files/service&amp;file=<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['picture'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&amp;w=100" style="-moz-border-radius:3px; border:1px solid #A4A4A4; opacity:.8;" onmouseover='jQuery(this).fadeTo("normal", 1); jQuery(this).css("border-color", "#058CC4");' onmouseout='jQuery(this).fadeTo("normal", .8); jQuery(this).css("border-color", "#A4A4A4");' />
    	       </a>
		      </div>
			<div style="width: 60px;float:left;padding-top: 20px;">
				<input type="checkbox" name="delete_file" id="delete_file" value="1" class="checkbox" /> <label for="delete_file" class="label">usuń</label>         
			</div>

     </div>

      <?php else: ?>
    <script type="text/javascript">
		document.documentElement.className += ' js ';
	</script>    
    <div class="input-file" style="display:inline-block; width:394px!important;"> 
    	<label> <span>Kliknij by dodać obrazek</span> <input type="file" name="file" /> </label> <var><input type="text" name="my-input-file-path" value="wybierz plik..." readonly="readonly" />&nbsp;</var>
    </div>    
	<script type="text/javascript"><?php echo '
		var aUploadFileBtns = document.getElementsByName(\'file\');
		for(var i=0,dBtn;dBtn = aUploadFileBtns[i];i++){
			new FileUploadUI(dBtn);
		};
	</script>'; ?>


<?php endif; ?>
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
<!-- submit edycji rekordu -->
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
    <input type='hidden' name='data[id]' value='<?php echo $this->_tpl_vars['data']['id']; ?>
' />
  	<img src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-usun.gif' onclick='if(confirm("Jeśli chcesz usunać kliknij [OK]\nJeśli nie [Anuluj]"))location.href="index.php?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;act=del&amp;id=<?php echo $this->_tpl_vars['data']['id']; ?>
"' onmouseover="this.src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-usun-over.gif'" onmouseout="this.src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-usun.gif'" class='icon' />
  </td>
</tr></table>
</form>

	<script type="text/javascript">
	<?php echo '
		jQuery( document ).ready(function() {
				var val_checked = jQuery("input:radio[name=data[id_category_type]]:checked").val();
				
				eval("pokaz"+val_checked+"()");
			});

	'; ?>

	</script>