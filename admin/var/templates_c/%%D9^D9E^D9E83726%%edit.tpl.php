<?php /* Smarty version 2.6.18, created on 2013-09-20 18:35:45
         compiled from event/templates/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'event/templates/edit.tpl', 46, false),array('modifier', 'substr', 'event/templates/edit.tpl', 80, false),array('modifier', 'capitalize', 'event/templates/edit.tpl', 81, false),array('modifier', 'replace', 'event/templates/edit.tpl', 81, false),)), $this); ?>
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
    <td class='lewa'>Termin wyświetlania: </td>
    <td class='prawa' align="left">
      <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
      <tr>
        <td width="212" align="left">
      
      Od: <input type='text' class='form-text' maxlength="10" name='data[date_from]' value="<?php echo $this->_tpl_vars['data']['date_from']; ?>
" readonly='readonly' id='dataarea' style='width: 70px;' /><img src='css/img/calendar_low.gif' id='trigger' class='cal-button' alt='wybierz datę' title='wybierz datę' /> <img src="css/img/gumka.png" alt="wyczyść" id="eraser" title="wyczyść" class="gumka" />
          <?php echo '
            <script type="text/javascript">
            Calendar.setup(
             {
               inputField : "dataarea",
               button     : "trigger",
               eraser     : "eraser"
             }
            );
            </script>
          '; ?>

      </td>
      <td width="212">
      Do: <input type='text' class='form-text' maxlength="10" name='data[date_to]' value="<?php echo $this->_tpl_vars['data']['date_to']; ?>
" readonly='readonly' id='dataarea1' style='width: 70px;' /><img src='css/img/calendar_low.gif' id='trigger1' class='cal-button' alt='wybierz datę' title='wybierz datę' /> <img src="css/img/gumka.png" alt="wyczyść" id="eraser1" title="wyczyść" class="gumka" />
            <?php echo '<script type="text/javascript">
            Calendar.setup(
             {
               inputField : "dataarea1",
               button     : "trigger1",
               eraser     : "eraser1"
             }
            );
            </script>'; ?>
          
      </td>
      <td>
     <input type="checkbox" id="always" name="data[always]" value="1" <?php if ($this->_tpl_vars['data']['always'] == 'Y'): ?>checked="checked" <?php endif; ?> class="checkbox"/> <label for="always" class="label">bezterminowo</label>
      </td>
      </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class='lewa'>Tytuł: </td>
    <td class='prawa'>
      <input class="form-text" type="text" id='title' name="data[title]" value='<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
' style='width: 353px;' />
    </td>
  </tr>
  <tr style="veritcal-align:top;">
    <td class='lewa'>Wstęp: </td>
    <td class='prawa'>
      <textarea class="form-textarea" style="width:701px;" name="data[intro]"><?php echo $this->_tpl_vars['data']['intro']; ?>
</textarea>
    </td>
  </tr>
  <tr style="veritcal-align:top;">
    <td class='lewa'>Treść: </td>
    <td class='prawa'>
    
     	<textarea  id="contents" name="data[content]" style="width:500px height:500px;"><?php echo $this->_tpl_vars['data']['content']; ?>
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
  <tr style="veritcal-align:top;">
    <td class='lewa'>Obrazek: </td>
    <td class='prawa'>
      <?php if ($this->_tpl_vars['data']['picture'] != ''): ?>
      <div style="display: inline; float: left; min-height: 120px; width: 348px; margin: 3px; text-align: left; padding: 5px; margin-left:0;        
		-moz-border-radius:3px;
		border:1px solid #A4A4A4;" class="gallery_image_div">
          <div style="width: 195px; height: 110px; text-align: left;float:left;padding-left:10px;">
            <span style="font-weight: normal;">plik:</span>&nbsp;&nbsp;<b><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['picture'])) ? $this->_run_mod_handler('substr', true, $_tmp, 15) : substr($_tmp, 15)); ?>
</b><br />
              <a href="../files/event/<?php echo $this->_tpl_vars['data']['picture']; ?>
" title="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['data']['picture'])) ? $this->_run_mod_handler('substr', true, $_tmp, 15, -4) : substr($_tmp, 15, -4)))) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)))) ? $this->_run_mod_handler('replace', true, $_tmp, '_', ' ') : smarty_modifier_replace($_tmp, '_', ' ')); ?>
" rel="lytebox" >
    		        <img src="tools/thumb.php?dir=../files/event&amp;file=<?php echo $this->_tpl_vars['data']['picture']; ?>
&amp;w=100" style="-moz-border-radius:3px; border:1px solid #A4A4A4;" onmouseover='jQuery(this).fadeTo("normal", 1); jQuery(this).css("border-color", "#058CC4");' onmouseout='jQuery(this).fadeTo("normal", .8); jQuery(this).css("border-color", "#A4A4A4");' />
    	       </a>
		      </div>
			<div style="width: 60px;float:left;padding-top: 20px;">
				<input type="checkbox" name="delete_file" id="delete_file" value="1" class="checkbox" /> <label for="delete_file" class="label">usuń</label>         
			</div>
       <div style="clear:both; width:100%; height:25px; text-align:center;">
          
	<script type="text/javascript">
		document.documentElement.className += ' js ';
	</script>    
    <div class="input-file" style="width:330px; padding-left:10px;"> 
    	<label> <span>Kliknij by wybrać</span> <input type="file" name="file" /> </label> <var><input type="text" name="my-input-file-path" value="wybierz plik..." readonly="readonly" />&nbsp;</var>
    </div>    
	<script type="text/javascript"><?php echo '
		var aUploadFileBtns = document.getElementsByName(\'file\');
		for(var i=0,dBtn;dBtn = aUploadFileBtns[i];i++){
			new FileUploadUI(dBtn);
		};
	</script>'; ?>
   
      </div>
     </div>
        
      <?php else: ?>
      <script type="text/javascript">
		document.documentElement.className += ' js ';
	</script>   
      <div class="input-file" style="width:359px;"> 
    	<label> <span>Kliknij by wybrać</span> <input type="file" name="file" /> </label> <var><input type="text" name="my-input-file-path" value="wybierz plik..." readonly="readonly" />&nbsp;</var>
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

  <tr style="veritcal-align:top;">
    <td class='lewa'>Źródło: </td>
    <td class='prawa'>
      <input class="form-text" type="text" id='source' name="data[source]" value='<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['source'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
' style='width: 353px;' />
    </td>
  </tr>

  <tr style="veritcal-align:top;">
    <td class='lewa'>Status: </td>
    <td class='prawa'>
      <input type='radio' name='data[active]' value='0' id='status0' <?php if ($this->_tpl_vars['data']['active'] != 'Y'): ?>checked='checked'<?php endif; ?> />
      <label for='status0'>nieaktywny</label>
      
      <input type='radio' name='data[active]' value='1' id='status1' <?php if ($this->_tpl_vars['data']['active'] == 'Y'): ?>checked='checked'<?php endif; ?> />
      <label for='status1'>aktywny</label>
    </td>
  </tr>

  <tr>
    <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
      <input type='hidden' name='data[picture]' value='<?php echo $this->_tpl_vars['data']['picture']; ?>
' />
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
ico-usun.gif' onclick='if(confirm("Jeśli chcesz usunać kliknij [OK]\nJeśli nie [Anuluj]"))location.href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;act=del&amp;id=<?php echo $this->_tpl_vars['data']['id']; ?>
"' onmouseover="this.src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-usun-over.gif'" onmouseout="this.src='<?php echo $this->_config[0]['vars']['imgDir']; ?>
ico-usun.gif'" class='icon' >
    </td>
  </tr>
</table>
</form>