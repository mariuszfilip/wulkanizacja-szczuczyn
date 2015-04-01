  {include file="main/templates/errors.tpl"}
<form name='editform' enctype='multipart/form-data' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$data.id}">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
<tr>
  <td class='lewa' style='width:15%;'>Usługa:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[id_service]" value="{$data.id_service}" style="width: 330px;" />
  </td>
</tr><tr>
  <td class='lewa' style='width:15%;'>Imię i nazwisko:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[name]" value="{$data.name}" style="width: 330px;" />
  </td>
</tr><!-- wybierz jedna fomre zapisu -->
<tr>
  <td class='lewa'>address: </td>
  <td class='prawa'>
    <!-- textarea -->
    <textarea class="form-textarea" cols="60" name="data[address]">{$data.address}</textarea>
    <!-- prosty fckeditor -->
    <!--{fckeditor name="data[address]" value=$data.address width="700" height="200" toolbar="Basic" path='../lib/FCKeditor/'}-->
    <!-- fckeditor -->
    <!--{fckeditor name='data[description]' value=$data.description width=700 height=500 path='../lib/FCKeditor/'}-->
  </td>
</tr><tr>
  <td class='lewa' style='width:15%;'>E-mail:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[email]" value="{$data.email}" style="width: 330px;" />
  </td>
</tr><tr>
  <td class='lewa' style='width:15%;'>Telefon:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[phone]" value="{$data.phone}" style="width: 330px;" />
  </td>
</tr><!-- wybierz jedna fomre zapisu -->
<tr>
  <td class='lewa'>comment: </td>
  <td class='prawa'>
    <!-- textarea -->
    <textarea class="form-textarea" cols="60" name="data[comment]">{$data.comment}</textarea>
    <!-- prosty fckeditor -->
    <!--{fckeditor name="data[comment]" value=$data.comment width="700" height="200" toolbar="Basic" path='../lib/FCKeditor/'}-->
    <!-- fckeditor -->
    <!--{fckeditor name='data[description]' value=$data.description width=700 height=500 path='../lib/FCKeditor/'}-->
  </td>
</tr><!-- wybierz jedna fomre zapisu -->
<tr>
  <td class='lewa'>message: </td>
  <td class='prawa'>
    <!-- textarea -->
    <textarea class="form-textarea" cols="60" name="data[message]">{$data.message}</textarea>
    <!-- prosty fckeditor -->
    <!--{fckeditor name="data[message]" value=$data.message width="700" height="200" toolbar="Basic" path='../lib/FCKeditor/'}-->
    <!-- fckeditor -->
    <!--{fckeditor name='data[description]' value=$data.description width=700 height=500 path='../lib/FCKeditor/'}-->
  </td>
</tr><tr>
  <td class='lewa'>Status: </td>
  <td class='prawa'>
    {if $data.active eq 'N' || $data.active eq ''}
    <input type='radio' name='data[active]' value='N' id='status0' checked='checked' />
    {else}
    <input type='radio' name='data[active]' value='N' id='status0' />
    {/if}
    <label for='status0'>nieaktywny</label>
    {if $data.active eq 'Y'}
    <input type='radio' name='data[active]' value='Y' id='status1' checked='checked' />
    {else}
    <input type='radio' name='data[active]' value='Y' id='status1' />
    {/if}
    <label for='status1'>aktywny</label>
  </td>
</tr>
<!-- submit edycji rekordu -->
<tr>
  <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
  	<img src='{#imgDir#}ico-anuluj.gif' onclick='location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}"' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />
    <input type='hidden' name='confirm' value='1' />
    <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
    <input type='hidden' name='data[id]' value='{$data.id}' />
  	<img src='{#imgDir#}ico-usun.gif' onclick='if(confirm("Jeśli chcesz usunać kliknij [OK]\nJeśli nie [Anuluj]"))location.href="index.php?{$mainParameterName}={$mainParameterValue}&amp;act=del&amp;id={$data.id}"' onmouseover="this.src='{#imgDir#}ico-usun-over.gif'" onmouseout="this.src='{#imgDir#}ico-usun.gif'" class='icon' />
  </td>
</tr></table>
</form>