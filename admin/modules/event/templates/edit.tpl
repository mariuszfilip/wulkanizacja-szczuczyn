  {include file="main/templates/errors.tpl"}
<form name='editform' enctype='multipart/form-data' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$data.id}">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
  <tr>
    <td class='lewa'>Termin wyświetlania: </td>
    <td class='prawa' align="left">
      <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
      <tr>
        <td width="212" align="left">
      
      Od: <input type='text' class='form-text' maxlength="10" name='data[date_from]' value="{$data.date_from}" readonly='readonly' id='dataarea' style='width: 70px;' /><img src='css/img/calendar_low.gif' id='trigger' class='cal-button' alt='wybierz datę' title='wybierz datę' /> <img src="css/img/gumka.png" alt="wyczyść" id="eraser" title="wyczyść" class="gumka" />
          {literal}
            <script type="text/javascript">
            Calendar.setup(
             {
               inputField : "dataarea",
               button     : "trigger",
               eraser     : "eraser"
             }
            );
            </script>
          {/literal}
      </td>
      <td width="212">
      Do: <input type='text' class='form-text' maxlength="10" name='data[date_to]' value="{$data.date_to}" readonly='readonly' id='dataarea1' style='width: 70px;' /><img src='css/img/calendar_low.gif' id='trigger1' class='cal-button' alt='wybierz datę' title='wybierz datę' /> <img src="css/img/gumka.png" alt="wyczyść" id="eraser1" title="wyczyść" class="gumka" />
            {literal}<script type="text/javascript">
            Calendar.setup(
             {
               inputField : "dataarea1",
               button     : "trigger1",
               eraser     : "eraser1"
             }
            );
            </script>{/literal}          
      </td>
      <td>
     <input type="checkbox" id="always" name="data[always]" value="1" {if $data.always eq 'Y'}checked="checked" {/if} class="checkbox"/> <label for="always" class="label">bezterminowo</label>
      </td>
      </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class='lewa'>Tytuł: </td>
    <td class='prawa'>
      <input class="form-text" type="text" id='title' name="data[title]" value='{$data.title|escape}' style='width: 353px;' />
    </td>
  </tr>
  <tr style="veritcal-align:top;">
    <td class='lewa'>Wstęp: </td>
    <td class='prawa'>
      <textarea class="form-textarea" style="width:701px;" name="data[intro]">{$data.intro}</textarea>
    </td>
  </tr>
  <tr style="veritcal-align:top;">
    <td class='lewa'>Treść: </td>
    <td class='prawa'>
    
     	<textarea  id="contents" name="data[content]" style="width:500px height:500px;">{$data.content}</textarea>
      	
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
      {if $data.picture ne ''}
      <div style="display: inline; float: left; min-height: 120px; width: 348px; margin: 3px; text-align: left; padding: 5px; margin-left:0;        
		-moz-border-radius:3px;
		border:1px solid #A4A4A4;" class="gallery_image_div">
          <div style="width: 195px; height: 110px; text-align: left;float:left;padding-left:10px;">
            <span style="font-weight: normal;">plik:</span>&nbsp;&nbsp;<b>{$data.picture|substr:15}</b><br />
              <a href="../files/event/{$data.picture}" title="{$data.picture|substr:15:-4|capitalize|replace:'_':' '}" rel="lytebox" >
    		        <img src="tools/thumb.php?dir=../files/event&amp;file={$data.picture}&amp;w=100" style="-moz-border-radius:3px; border:1px solid #A4A4A4;" onmouseover='jQuery(this).fadeTo("normal", 1); jQuery(this).css("border-color", "#058CC4");' onmouseout='jQuery(this).fadeTo("normal", .8); jQuery(this).css("border-color", "#A4A4A4");' />
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
	<script type="text/javascript">{literal}
		var aUploadFileBtns = document.getElementsByName('file');
		for(var i=0,dBtn;dBtn = aUploadFileBtns[i];i++){
			new FileUploadUI(dBtn);
		};
	</script>{/literal}   
      </div>
     </div>
        
      {else}
      <script type="text/javascript">
		document.documentElement.className += ' js ';
	</script>   
      <div class="input-file" style="width:359px;"> 
    	<label> <span>Kliknij by wybrać</span> <input type="file" name="file" /> </label> <var><input type="text" name="my-input-file-path" value="wybierz plik..." readonly="readonly" />&nbsp;</var>
    </div>    
	<script type="text/javascript">{literal}
		var aUploadFileBtns = document.getElementsByName('file');
		for(var i=0,dBtn;dBtn = aUploadFileBtns[i];i++){
			new FileUploadUI(dBtn);
		};
	</script>{/literal}
    {/if}
    </td>
  </tr>

  <tr style="veritcal-align:top;">
    <td class='lewa'>Źródło: </td>
    <td class='prawa'>
      <input class="form-text" type="text" id='source' name="data[source]" value='{$data.source|escape}' style='width: 353px;' />
    </td>
  </tr>

  <tr style="veritcal-align:top;">
    <td class='lewa'>Status: </td>
    <td class='prawa'>
      <input type='radio' name='data[active]' value='0' id='status0' {if $data.active neq 'Y'}checked='checked'{/if} />
      <label for='status0'>nieaktywny</label>
      
      <input type='radio' name='data[active]' value='1' id='status1' {if $data.active eq 'Y'}checked='checked'{/if} />
      <label for='status1'>aktywny</label>
    </td>
  </tr>

  <tr>
    <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
      <input type='hidden' name='data[picture]' value='{$data.picture}' />
    	<img src='{#imgDir#}ico-anuluj.gif' onclick='location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}"' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />
      <input type='hidden' name='confirms' value='1' />
      <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
      <input type='hidden' name='data[id]' value='{$data.id}' />
    	<img src='{#imgDir#}ico-usun.gif' onclick='if(confirm("Jeśli chcesz usunać kliknij [OK]\nJeśli nie [Anuluj]"))location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=del&amp;id={$data.id}"' onmouseover="this.src='{#imgDir#}ico-usun-over.gif'" onmouseout="this.src='{#imgDir#}ico-usun.gif'" class='icon' >
    </td>
  </tr>
</table>
</form>