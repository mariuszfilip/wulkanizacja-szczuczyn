<?php /* Smarty version 2.6.18, created on 2013-09-20 18:34:52
         compiled from event/templates/add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'event/templates/add.tpl', 49, false),)), $this); ?>
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
  <tr style="veritcal-align:top;">
    <td class='lewa'>Termin wyświetlania: </td>
    <td class='prawa'>
      <table cellpadding="0" cellspacing="0" border="0" style="width:90%;">
      <tr>
      <td>
      Od: <input type='text' class='form-text' maxlength="10" name='data[date_from]' value="<?php echo $this->_tpl_vars['data']['date_from']; ?>
" readonly='readonly' id='dataarea' style='width: 70px;' /><img src='css/img/calendar_low.gif' id='trigger' class='cal-button' alt='wybierz datę' title='wybierz datę' /> <img src="css/img/gumka.png" alt="wyczyść" id="eraser" title="wyczyść" class="gumka" />
          <?php echo '
            <script type="text/javascript">
            Calendar.setup(
              {
                  inputField  : "dataarea",
                  button      : "trigger",
				  eraser	  : "eraser"
              }
            );
            </script>
          '; ?>

          
      </td>
      <td>
      Do: <input type='text' class='form-text' maxlength="10" name='data[date_to]' value="<?php echo $this->_tpl_vars['data']['date_to']; ?>
" readonly='readonly' id='dataarea1' style='width: 70px;' /><img src='css/img/calendar_low.gif' id='trigger1' class='cal-button' alt='wybierz datę' title='wybierz datę' /> <img src="css/img/gumka.png" alt="wyczyść" id="eraser1" title="wyczyść" class="gumka" />
          <?php echo '
            <script type="text/javascript">
            Calendar.setup(
              {
                  inputField  : "dataarea1",
                  button      : "trigger1",
				  eraser	  : "eraser1"
              }
            );
            </script>
          '; ?>


      </td>
      <td>
      <input type="checkbox" id="always" name="data[always]" value="1" <?php if ($this->_tpl_vars['data']['always'] == 'Y'): ?>checked="checked" <?php endif; ?> class="checkbox"/> <label for="always" class="label">bezterminowo</label>
      </td>
      </tr>
      </table>
    </td>
  </tr>
  <tr style="veritcal-align:top;">
    <td class='lewa'>Tytuł: </td>
    <td class='prawa'>
      <input class="form-text" type="text" id='title' name="data[title]" value='<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
' style='width: 500px;' />
    </td>
  </tr>
  <tr style="veritcal-align:top;">
    <td class='lewa'>Wstęp: </td>
    <td class='prawa'>
      <textarea class="form-textarea" cols="75" name="data[intro]"><?php echo $this->_tpl_vars['data']['intro']; ?>
</textarea>
    </td>
  </tr>
  <tr style="veritcal-align:top;">
    <td class='lewa'>Treść: </td>
    <td class='prawa'>
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
	<script type="text/javascript">
		document.documentElement.className += ' js ';
	</script>   
      <div class="input-file"> 
    	<label> <span>Kliknij by wybrać</span> <input type="file" name="file" /> </label> <var><input type="text" name="my-input-file-path" value="wybierz plik..." readonly="readonly" />&nbsp;</var>
    </div>    
	<script type="text/javascript"><?php echo '
		var aUploadFileBtns = document.getElementsByName(\'file\');
		for(var i=0,dBtn;dBtn = aUploadFileBtns[i];i++){
			new FileUploadUI(dBtn);
		};
	</script>'; ?>

      
    </td>
  </tr>
  <tr style="veritcal-align:top;">
    <td class='lewa'>Źródło: </td>
    <td class='prawa'>
      <input class="form-text" type="text" id='source' name="data[source]" value='<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['source'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
' style='width: 300px;' />
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
  </tr>
</table>
</form>