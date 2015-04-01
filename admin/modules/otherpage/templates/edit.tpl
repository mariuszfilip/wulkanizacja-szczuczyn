  {include file="main/templates/errors.tpl"}
<form name='editform' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$data.id}">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
  <tr>
    <td class='lewa'>Nazwa-klucz:</td>
    <td class='prawa'>
     <strong>{$data.name}</strong><br />&nbsp;
    </td>
  </tr>
  
  <tr>
    <td class='lewa'>Tytuł:</td>
    <td class='prawa'>
      <input class="form-text" type="text" id='title' name="data[title]" value='{$data.title|escape}' style='width: 240px;' />
    </td>
  </tr>

  <tr>
    <td class='lewa'>Treść:</td>
    <td class='prawa'>

   
   		<textarea cols="80" id="contents" name="data[content]" rows="10">{$data.content}</textarea>
      	
      	{literal}
      	<script type="text/javascript">
      		 CKEDITOR.replace( 'contents',{
      			width: 700,
          		 });    
  		</script>
      	{/literal}
  	</td>
  </tr>
  <tr>
    <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
    	<img src='{#imgDir#}ico-anuluj.gif' onclick='location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}"' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />
      <input type='hidden' name='confirms' value='1' />
      <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
      <input type='hidden' name='data[id]' value='{$data.id}' />
    	<img src='{#imgDir#}ico-usun.gif' onclick='if(confirm("Jeśli chcesz usunać kliknij [OK]\nJeśli nie [Anuluj]"))location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=del&amp;id={$data.id}"' onmouseover="this.src='{#imgDir#}ico-usun-over.gif'" onmouseout="this.src='{#imgDir#}ico-usun.gif'" class='icon' />
    </td>
  </tr>
</table>
</form>
