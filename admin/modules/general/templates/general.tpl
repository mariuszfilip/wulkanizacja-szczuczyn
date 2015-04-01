<div class='naglowek'>
<h2>Witamy w panelu administracyjnym</h2>



<div class="ikonki" style="border-bottom:1px dashed #ace7ff;padding:10px 0;">
<ul>
          <!--  
          <li>
            <a href='{$smarty.server.PHP_SELF}?{$mainParameterName}=order'><img src="css/img/ikony/2/zamowienia.jpg" alt="" />Rejestr zamówień</a>
          </li>
          
          <li>
            <a href='{$smarty.server.PHP_SELF}?{$mainParameterName}=service'><img src="css/img/ikony/2/uslugi.jpg" alt="" />Usługi</a>
          </li>
          -->
          <li>
            <a href='{$smarty.server.PHP_SELF}?{$mainParameterName}=catalog'><img src="css/img/ikony/2/katalog.jpg" alt="" />Kategorie</a>
          </li>
          
          <li>
            <a href='{$smarty.server.PHP_SELF}?{$mainParameterName}=page'><img src="css/img/ikony/2/strony.png" alt="" />Strony</a>
          </li>
          
          <li>
            <a href='{$smarty.server.PHP_SELF}?{$mainParameterName}=file'><img src="css/img/ikony/2/pliki.jpg" alt="" />Pliki</a>
          </li>
          
          <li>
            <a href='{$smarty.server.PHP_SELF}?{$mainParameterName}=gallery'><img src="css/img/ikony/2/galerie.jpg" alt="" />Galerie</a>
          </li>
           <!-- 
          <li>
            <a href='{$smarty.server.PHP_SELF}?{$mainParameterName}=ankieta'><img src="css/img/ikony/2/formularze.png" alt="" />Formularze</a>
          </li>
          -->
          <li>
            <a href='{$smarty.server.PHP_SELF}?{$mainParameterName}=event'><img src="css/img/ikony/2/aktualnosci.jpg" alt="" />Aktualności</a>
          </li>
          
         

          

                 
        </ul>
        <div class="end"></div>
</div>      

<div class="ikonki" style="border-bottom:1px dashed #ace7ff; padding:10px 0;">  
        <ul>
        <!--  
        	{if !$smarty.session.user.permit.modules.payment || $smarty.session.user.permit.modules.payment.view eq 1}
            <li>
            <a href='{$smarty.server.PHP_SELF}?{$mainParameterName}=payment'><img src="css/img/ikony/2/platnosci.jpg" alt="" />Płatności</a>
          </li> 
          {/if}
         --> 
       
          {if !$smarty.session.user.permit.modules.meta_tag || $smarty.session.user.permit.modules.meta_tag.view eq 1}
            <li>
            <a href='{$smarty.server.PHP_SELF}?{$mainParameterName}=meta_tag'><img src="css/img/ikony/2/uni.jpg" alt="" />Meta tagi</a>
          </li> 
          {/if}
            <!--  
            {if !$smarty.session.user.permit.modules.smtp_account || $smarty.session.user.permit.modules.smtp_account.view eq 1}
            <li>
                  <a href='{$smarty.server.PHP_SELF}?{$mainParameterName}=smtp_account'><img src="css/img/ikony/2/smtp_account.jpg" alt="" />Konta pocztowe</a>
           </li>
           {/if}
           -->
            {if !$smarty.session.user.permit.modules.operator || $smarty.session.user.permit.modules.operator.view eq 1}
            <li>
                  <a href='{$smarty.server.PHP_SELF}?{$mainParameterName}=operator'><img src="css/img/ikony/2/operatorzy.jpg" alt="" />Operatorzy</a>
           </li>
           {/if}
           
        </ul>
        <div class="end"></div>        
</div>

</div>

</div>