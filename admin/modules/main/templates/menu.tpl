<table border='0' cellspacing='0' cellpadding='0' style='width:185px;' class="lewo">
<tr>
	<td>
    <table border="0" class="panel_klienta" cellpadding="0" cellspacing="0" style="margin:0 0 0px 0; padding:10px;">
    <tr>
    	<td>
      <p>Jesteś zalogowany jako:</p>
      <p><span style="font-size:12px;font-weight:bold; color:#323232;">{$smarty.session.user.name} {$smarty.session.user.surname}</span></p>
      <form name="userlogout" id="userlogout" action="{$smarty.server.PHP_SELF}" method="post">
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
     {if $const_languages && $const_languages|@count >1}
      <form action="" method="post">
      	{foreach from=$const_languages item=single_language}
        <input type="{if $smarty.session.lang eq $single_language}button{else}submit{/if}" name="lang" class="lang"  value="{$single_language}" >
        {/foreach}
      </form>
     {/if}
    </td>
    </tr> 
    
    <tr>
      <td>
	<ul>
    <li {if !$smarty.get.mod}class="active"{/if}>      
        <a class="glowna" href='index.php'>Strona główna panelu</a>
    </li>
<!-- 
    <li {if $smarty.get.$mainParameterName eq 'order'}class="active"{/if}>
		<a class="zamowienia" href='{$smarty.server.PHP_SELF}?{$mainParameterName}=order'>Rejestr zamówień</a>
	</li>
    
    <li {if $smarty.get.$mainParameterName eq 'service'}class="active"{/if}>
		<a class="uslugi" href='{$smarty.server.PHP_SELF}?{$mainParameterName}=service'>Usługi</a>
	</li>   -->
    
    <li {if $smarty.get.$mainParameterName eq 'catalog'}class="active"{/if}>
		<a class="katalog" href='{$smarty.server.PHP_SELF}?{$mainParameterName}=catalog'>Kategorie</a>
	</li>
	 <li {if $smarty.get.$mainParameterName eq 'service'}class="active"{/if}>
		<a class="katalog" href='{$smarty.server.PHP_SELF}?{$mainParameterName}=service'>Tresc Kategorii</a>
	</li>
	  
    
    <li {if $smarty.get.$mainParameterName eq 'page'}class="active"{/if}>
		<a class="strony" href='{$smarty.server.PHP_SELF}?{$mainParameterName}=page'>Strony</a>
	</li>
    
    <li {if $smarty.get.$mainParameterName eq 'file'}class="active"{/if}>
		<a class="pliki" href='{$smarty.server.PHP_SELF}?{$mainParameterName}=file'>Pliki</a>
	</li>
    
    <li {if $smarty.get.$mainParameterName eq 'gallery'}class="active"{/if}>
		<a class="galerie" href='{$smarty.server.PHP_SELF}?{$mainParameterName}=gallery'>Galerie</a>
	</li>
    <!-- 
    <li {if $smarty.get.$mainParameterName eq 'ankieta'}class="active"{/if}>
		<a class="formularze" href='{$smarty.server.PHP_SELF}?{$mainParameterName}=ankieta'>Formularze</a>
	</li>
	 -->
    
    <li {if $smarty.get.$mainParameterName eq 'event'}class="active"{/if}>
		<a class="aktualnosci" href='{$smarty.server.PHP_SELF}?{$mainParameterName}=event'>Aktualności</a>
	</li>
    
  
	</ul>
    

	<ul style="margin-top:8px;{*border-top:2px solid #a2a2a2;*}">
    <!--  
    	<li {if $smarty.get.$mainParameterName eq 'payment'}class="active"{/if}>
			<a class="platnosci" href='{$smarty.server.PHP_SELF}?{$mainParameterName}=payment'>Płatności</a>
		</li>
    -->
		{if !$smarty.session.user.permit.modules.meta_tag || $smarty.session.user.permit.modules.meta_tag.view eq 1}
		<li {if $smarty.get.$mainParameterName eq 'meta_tag'}class="active"{/if}>
			<a href='{$smarty.server.PHP_SELF}?{$mainParameterName}=meta_tag'>Meta tagi</a>
		</li>
		{/if}
        <!--  
		{if !$smarty.session.user.permit.modules.smtp_account || $smarty.session.user.permit.modules.smtp_account.view eq 1}
		<li {if $smarty.get.$mainParameterName eq 'smtp_account'}class="active"{/if}>
			<a class="smtp_account" href='{$smarty.server.PHP_SELF}?{$mainParameterName}=smtp_account'>Konta pocztowe</a>
		</li>
		{/if}
    	-->
    
    {if !$smarty.session.user.permit.modules.operator || $smarty.session.user.permit.modules.operator.view eq 1}
		<li {if $smarty.get.$mainParameterName eq 'operator'}class="active"{/if}>
       <a class="operatorzy" href='{$smarty.server.PHP_SELF}?{$mainParameterName}=operator'>Operatorzy</a>
    </li>
    {/if}
    
  </ul>
  


     <form name="user_logout" action="{$smarty.server.PHP_SELF}" method="post">
          <input type="hidden" name="logout_confirm" value="1" />
          <span onclick="user_logout.submit();" class="form-button" style="width:165px; display:block; padding-top:2px!important; padding-bottom:2px!important;"><img src="css/images/logout3.png" style="margin:0; padding:0; vertical-align:middle;" />&nbsp;wyloguj się&nbsp;&nbsp;</span>
        </form>
        <div style="margin:10px 0 0 0; width:98%; text-align:center;">
        {foreach from=$allLanguages item=lng key=klucz name=jezyki}
        <form action="" method="post" style="display: inline;">
          <input type="submit" class="form-button" name="lang" class="lang"  value="{$lng.name|lower}" {if $smarty.session.lang|lower eq $lng.name|lower}disabled="disabled"{/if}>
        </form>
        {/foreach}
      </td>
    </tr>
  </table>
  </td>
</tr>

</table>