<?php /* Smarty version 2.6.18, created on 2013-08-20 22:04:36
         compiled from main/templates/menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'main/templates/menu.tpl', 24, false),array('modifier', 'lower', 'main/templates/menu.tpl', 118, false),)), $this); ?>
<table border='0' cellspacing='0' cellpadding='0' style='width:185px;' class="lewo">
<tr>
	<td>
    <table border="0" class="panel_klienta" cellpadding="0" cellspacing="0" style="margin:0 0 0px 0; padding:10px;">
    <tr>
    	<td>
      <p>Jesteś zalogowany jako:</p>
      <p><span style="font-size:12px;font-weight:bold; color:#323232;"><?php echo $_SESSION['user']['name']; ?>
 <?php echo $_SESSION['user']['surname']; ?>
</span></p>
      <form name="userlogout" id="userlogout" action="<?php echo $_SERVER['PHP_SELF']; ?>
" method="post">
      <p><input type="hidden" name="logout_confirm" value="1" /></p>
      <p style="text-align:right;"><a href="#" onclick="document.userlogout.submit();">wyloguj się&nbsp;&raquo;</a></p>
      </form>
      </td>
    </tr>
    </table>  
	</td>
</tr>

<tr>
	<td>
  <table border="0" class="navigation" cellpadding="0" cellspacing="0" style="margin:0 0 0px 0;">
    <tr>
    <td id="languages_menu">
     <?php if ($this->_tpl_vars['const_languages'] && count($this->_tpl_vars['const_languages']) > 1): ?>
      <form action="" method="post">
      	<?php $_from = $this->_tpl_vars['const_languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['single_language']):
?>
        <input type="<?php if ($_SESSION['lang'] == $this->_tpl_vars['single_language']): ?>button<?php else: ?>submit<?php endif; ?>" name="lang" class="lang"  value="<?php echo $this->_tpl_vars['single_language']; ?>
" >
        <?php endforeach; endif; unset($_from); ?>
      </form>
     <?php endif; ?>
    </td>
    </tr> 
    
    <tr>
      <td>
	<ul>
    <li <?php if (! $_GET['mod']): ?>class="active"<?php endif; ?>>      
        <a class="glowna" href='index.php'>Strona główna panelu</a>
    </li>
<!-- 
    <li <?php if ($_GET[$this->_tpl_vars['mainParameterName']] == 'order'): ?>class="active"<?php endif; ?>>
		<a class="zamowienia" href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=order'>Rejestr zamówień</a>
	</li>
    
    <li <?php if ($_GET[$this->_tpl_vars['mainParameterName']] == 'service'): ?>class="active"<?php endif; ?>>
		<a class="uslugi" href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=service'>Usługi</a>
	</li>   -->
    
    <li <?php if ($_GET[$this->_tpl_vars['mainParameterName']] == 'catalog'): ?>class="active"<?php endif; ?>>
		<a class="katalog" href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=catalog'>Kategorie</a>
	</li>
	 <li <?php if ($_GET[$this->_tpl_vars['mainParameterName']] == 'service'): ?>class="active"<?php endif; ?>>
		<a class="katalog" href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=service'>Tresc Kategorii</a>
	</li>
	  
    
    <li <?php if ($_GET[$this->_tpl_vars['mainParameterName']] == 'page'): ?>class="active"<?php endif; ?>>
		<a class="strony" href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=page'>Strony</a>
	</li>
    
    <li <?php if ($_GET[$this->_tpl_vars['mainParameterName']] == 'file'): ?>class="active"<?php endif; ?>>
		<a class="pliki" href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=file'>Pliki</a>
	</li>
    
    <li <?php if ($_GET[$this->_tpl_vars['mainParameterName']] == 'gallery'): ?>class="active"<?php endif; ?>>
		<a class="galerie" href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=gallery'>Galerie</a>
	</li>
    <!-- 
    <li <?php if ($_GET[$this->_tpl_vars['mainParameterName']] == 'ankieta'): ?>class="active"<?php endif; ?>>
		<a class="formularze" href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=ankieta'>Formularze</a>
	</li>
	 -->
    
    <li <?php if ($_GET[$this->_tpl_vars['mainParameterName']] == 'event'): ?>class="active"<?php endif; ?>>
		<a class="aktualnosci" href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=event'>Aktualności</a>
	</li>
    
  
	</ul>
    

	<ul style="margin-top:8px;">
    <!--  
    	<li <?php if ($_GET[$this->_tpl_vars['mainParameterName']] == 'payment'): ?>class="active"<?php endif; ?>>
			<a class="platnosci" href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=payment'>Płatności</a>
		</li>
    -->
		<?php if (! $_SESSION['user']['permit']['modules']['meta_tag'] || $_SESSION['user']['permit']['modules']['meta_tag']['view'] == 1): ?>
		<li <?php if ($_GET[$this->_tpl_vars['mainParameterName']] == 'meta_tag'): ?>class="active"<?php endif; ?>>
			<a href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=meta_tag'>Meta tagi</a>
		</li>
		<?php endif; ?>
        <!--  
		<?php if (! $_SESSION['user']['permit']['modules']['smtp_account'] || $_SESSION['user']['permit']['modules']['smtp_account']['view'] == 1): ?>
		<li <?php if ($_GET[$this->_tpl_vars['mainParameterName']] == 'smtp_account'): ?>class="active"<?php endif; ?>>
			<a class="smtp_account" href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=smtp_account'>Konta pocztowe</a>
		</li>
		<?php endif; ?>
    	-->
    
    <?php if (! $_SESSION['user']['permit']['modules']['operator'] || $_SESSION['user']['permit']['modules']['operator']['view'] == 1): ?>
		<li <?php if ($_GET[$this->_tpl_vars['mainParameterName']] == 'operator'): ?>class="active"<?php endif; ?>>
       <a class="operatorzy" href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=operator'>Operatorzy</a>
    </li>
    <?php endif; ?>
    
  </ul>
  


     <form name="user_logout" action="<?php echo $_SERVER['PHP_SELF']; ?>
" method="post">
          <input type="hidden" name="logout_confirm" value="1" />
          <span onclick="user_logout.submit();" class="form-button" style="width:165px; display:block; padding-top:2px!important; padding-bottom:2px!important;"><img src="css/images/logout3.png" style="margin:0; padding:0; vertical-align:middle;" />&nbsp;wyloguj się&nbsp;&nbsp;</span>
        </form>
        <div style="margin:10px 0 0 0; width:98%; text-align:center;">
        <?php $_from = $this->_tpl_vars['allLanguages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['jezyki'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['jezyki']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['klucz'] => $this->_tpl_vars['lng']):
        $this->_foreach['jezyki']['iteration']++;
?>
        <form action="" method="post" style="display: inline;">
          <input type="submit" class="form-button" name="lang" class="lang"  value="<?php echo ((is_array($_tmp=$this->_tpl_vars['lng']['name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
" <?php if (((is_array($_tmp=$_SESSION['lang'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == ((is_array($_tmp=$this->_tpl_vars['lng']['name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp))): ?>disabled="disabled"<?php endif; ?>>
        </form>
        <?php endforeach; endif; unset($_from); ?>
      </td>
    </tr>
  </table>
  </td>
</tr>

</table>