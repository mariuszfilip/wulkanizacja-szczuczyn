<?php /* Smarty version 2.6.18, created on 2013-08-20 22:13:46
         compiled from general/templates/general.tpl */ ?>
<div class='naglowek'>
<h2>Witamy w panelu administracyjnym</h2>



<div class="ikonki" style="border-bottom:1px dashed #ace7ff;padding:10px 0;">
<ul>
          <!--  
          <li>
            <a href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=order'><img src="css/img/ikony/2/zamowienia.jpg" alt="" />Rejestr zamówień</a>
          </li>
          
          <li>
            <a href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=service'><img src="css/img/ikony/2/uslugi.jpg" alt="" />Usługi</a>
          </li>
          -->
          <li>
            <a href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=catalog'><img src="css/img/ikony/2/katalog.jpg" alt="" />Kategorie</a>
          </li>
          
          <li>
            <a href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=page'><img src="css/img/ikony/2/strony.png" alt="" />Strony</a>
          </li>
          
          <li>
            <a href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=file'><img src="css/img/ikony/2/pliki.jpg" alt="" />Pliki</a>
          </li>
          
          <li>
            <a href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=gallery'><img src="css/img/ikony/2/galerie.jpg" alt="" />Galerie</a>
          </li>
           <!-- 
          <li>
            <a href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=ankieta'><img src="css/img/ikony/2/formularze.png" alt="" />Formularze</a>
          </li>
          -->
          <li>
            <a href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=event'><img src="css/img/ikony/2/aktualnosci.jpg" alt="" />Aktualności</a>
          </li>
          
         

          

                 
        </ul>
        <div class="end"></div>
</div>      

<div class="ikonki" style="border-bottom:1px dashed #ace7ff; padding:10px 0;">  
        <ul>
        <!--  
        	<?php if (! $_SESSION['user']['permit']['modules']['payment'] || $_SESSION['user']['permit']['modules']['payment']['view'] == 1): ?>
            <li>
            <a href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=payment'><img src="css/img/ikony/2/platnosci.jpg" alt="" />Płatności</a>
          </li> 
          <?php endif; ?>
         --> 
       
          <?php if (! $_SESSION['user']['permit']['modules']['meta_tag'] || $_SESSION['user']['permit']['modules']['meta_tag']['view'] == 1): ?>
            <li>
            <a href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=meta_tag'><img src="css/img/ikony/2/uni.jpg" alt="" />Meta tagi</a>
          </li> 
          <?php endif; ?>
            <!--  
            <?php if (! $_SESSION['user']['permit']['modules']['smtp_account'] || $_SESSION['user']['permit']['modules']['smtp_account']['view'] == 1): ?>
            <li>
                  <a href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=smtp_account'><img src="css/img/ikony/2/smtp_account.jpg" alt="" />Konta pocztowe</a>
           </li>
           <?php endif; ?>
           -->
            <?php if (! $_SESSION['user']['permit']['modules']['operator'] || $_SESSION['user']['permit']['modules']['operator']['view'] == 1): ?>
            <li>
                  <a href='<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=operator'><img src="css/img/ikony/2/operatorzy.jpg" alt="" />Operatorzy</a>
           </li>
           <?php endif; ?>
           
        </ul>
        <div class="end"></div>        
</div>

</div>

</div>