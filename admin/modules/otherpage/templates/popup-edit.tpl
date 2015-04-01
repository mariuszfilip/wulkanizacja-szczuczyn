  {include file="main/templates/errors.tpl"}
<div class='naglowek'>Edycja treści</div>
<form name='editform' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=popup&amp;id={$data.id}">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
  <tr>
    <td class='lewa'>Nazwa klucz:</td>
    <td class='prawa'>
      <b>{$data.name}</b>
    </td>
  </tr>
  <tr>
    <td class='lewa'>Tytuł:</td>
    <td class='prawa'>
      <input class="form-text" type="text" id='title' name="data[title]" value='{$data.title}' style='width: 240px;' />
    </td>
  </tr>
 
    
	
  
    
   

  <tr>
    <td class='lewa'>Treść:</td>
    <td class='prawa'>
      
      
   
      {ckeditor name='data[content]' value=$data.content width=800 height=500 path='../lib/FCKeditor/'}
   
  	</td>
  </tr>
  
    
	
  <tr>
    <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
    	<img src='{#imgDir#}ico-anuluj.gif' onclick='refreshParent();' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />
      <input type='hidden' name='confirms' value='1' />
      <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
      <input type='hidden' name='data[id]' value='{$data.id}' />
    </td>
  </tr>
</table>
</form>
