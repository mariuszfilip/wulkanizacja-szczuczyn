  {include file="main/templates/errors.tpl"}
<form name='editform' enctype='multipart/form-data' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=add">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
  <tr style="veritcal-align:top;">
    <td class='lewa'>Termin wyświetlania: </td>
    <td class='prawa'>
      <table cellpadding="0" cellspacing="0" border="0" style="width:90%;">
      <tr>
      <td>
      Od: <input type='text' class='form-text' maxlength="10" name='data[date_from]' value="{$data.date_from}" readonly='readonly' id='dataarea' style='width: 70px;' /><img src='css/img/calendar_low.gif' id='trigger' class='cal-button' alt='wybierz datę' title='wybierz datę' /> <img src="css/img/gumka.png" alt="wyczyść" id="eraser" title="wyczyść" class="gumka" />
          {literal}
            <script type="text/javascript">
            Calendar.setup(
              {
                  inputField  : "dataarea",
                  button      : "trigger",
				  eraser	  : "eraser"
              }
            );
            </script>
          {/literal}
          
      </td>
      <td>
      Do: <input type='text' class='form-text' maxlength="10" name='data[date_to]' value="{$data.date_to}" readonly='readonly' id='dataarea1' style='width: 70px;' /><img src='css/img/calendar_low.gif' id='trigger1' class='cal-button' alt='wybierz datę' title='wybierz datę' /> <img src="css/img/gumka.png" alt="wyczyść" id="eraser1" title="wyczyść" class="gumka" />
          {literal}
            <script type="text/javascript">
            Calendar.setup(
              {
                  inputField  : "dataarea1",
                  button      : "trigger1",
				  eraser	  : "eraser1"
              }
            );
            </script>
          {/literal}

      </td>
      <td>
      <input type="checkbox" id="always" name="data[always]" value="1" {if $data.always eq 'Y'}checked="checked" {/if} class="checkbox"/> <label for="always" class="label">bezterminowo</label>
      </td>
      </tr>
      </table>
    </td>
  </tr>
  <tr style="veritcal-align:top;">
    <td class='lewa'>Tytuł: </td>
    <td class='prawa'>
      <input class="form-text" type="text" id='title' name="data[title]" value='{$data.title|escape}' style='width: 500px;' />
    </td>
  </tr>
  <tr style="veritcal-align:top;">
    <td class='lewa'>Wstęp: </td>
    <td class='prawa'>
      <textarea class="form-textarea" cols="75" name="data[intro]">{$data.intro}</textarea>
    </td>
  </tr>
  <tr style="veritcal-align:top;">
    <td class='lewa'>Treść: </td>
    <td class='prawa'>
      {literal}
      	<script type="text/javascript">
      		 CKEDITOR.replace( 'contents',{
       			width: 700,
      		 });        
  		</script>
      	{/literal}
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
	<script type="text/javascript">{literal}
		var aUploadFileBtns = document.getElementsByName('file');
		for(var i=0,dBtn;dBtn = aUploadFileBtns[i];i++){
			new FileUploadUI(dBtn);
		};
	</script>{/literal}
      
    </td>
  </tr>
  <tr style="veritcal-align:top;">
    <td class='lewa'>Źródło: </td>
    <td class='prawa'>
      <input class="form-text" type="text" id='source' name="data[source]" value='{$data.source|escape}' style='width: 300px;' />
    </td>
  </tr>
  
  <tr>
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
  <tr>
    <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
    	<img src='{#imgDir#}ico-anuluj.gif' onclick='location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}"' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />
      <input type='hidden' name='confirms' value='1' />
      <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
    </td>
  </tr>
</table>
</form>
