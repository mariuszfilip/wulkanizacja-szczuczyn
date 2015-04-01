  {include file="main/templates/errors.tpl"}
<form name='editform' enctype='multipart/form-data' method="post" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$data.id}">
<table cellpadding="0" cellspacing="3" border="0" id='formedit'>
<tr>
  <td class='lewa' style='width:15%;'>Kategoria:</td>
  <td class='prawa' style='width:85%;'>    
    <select type="text" name="data[id_catalog]" value="{$data.id_catalog}" style="width: 330px;">
    {foreach from=$categories item=category_item}
    <option {if $category_item.active eq 'N'}style="color:#CCC"{/if} {if $data.id_catalog eq $category_item.id_catalog}selected="selected"{/if} value="{$category_item.id_catalog}">&nbsp;{$category_item.name}</option>
    {if $category_item.children}
    	{foreach from=$category_item.children item=children_item}
        <option {if $children_item.active eq 'N'}style="color:#CCC"{/if} {if $data.id_catalog eq $children_item.id_catalog}selected="selected"{/if} value="{$children_item.id_catalog}">&nbsp;&nbsp; &raquo;&nbsp;{$children_item.name}</option>
        {/foreach}
    {/if}
    {/foreach}
    </select>
    
  </td>
</tr>
<tr>
  <td class='lewa' style='width:15%;'>Nazwa:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[name]" value="{$data.name|escape}" style="width: 330px;" />
  </td>
</tr>
<tr>
  <td class='lewa'>Opis skrócony: </td>
  <td class='prawa'>
  		<textarea cols="40" rows="40" id="contentss" name="data[short_content]" >{$data.short_content}</textarea>
  		{literal}
      	<script type="text/javascript">
      		 CKEDITOR.replace( 'contentss',{
       			width: 700,
      		 });        
  		</script>
      	{/literal}
  </td>
</tr><!-- wybierz jedna fomre zapisu -->
<tr>
  <td class='lewa'>Pełny opis: </td>
  <td class='prawa'>
  		<textarea cols="40" rows="40" id="contents" name="data[content]" >{$data.content}</textarea>
      	
      	{literal}
      	<script type="text/javascript">
      		 CKEDITOR.replace( 'contents',{
       			width: 700,
      		 });        
  		</script>
      	{/literal}
  </td>
</tr>
	<script type="text/javascript">
		{literal}
			function pokaz1(){
				jQuery(".akumulator").hide();
				jQuery(".felga").hide();
				jQuery(".opona").show();
			}
			function pokaz2(){
				jQuery(".akumulator").hide();
				jQuery(".opona").hide();
				jQuery(".felga").show();
			}
			function pokaz3(){
				jQuery(".felga").hide();
				jQuery(".opona").hide();
				jQuery(".akumulator").show();
			}
	

		{/literal}
	</script>
<tr>
  <td class='lewa' style='width:15%;'>Typ kategorii:</td>
  <td class='prawa' style='width:85%;'>    
    
    {foreach from=$categories_type item=category_item}
    	<input type="radio" onclick="pokaz{$category_item.id}()" id="cat_{$category_item.id}" name="data[id_category_type]" {if $data.id_category_type eq $category_item.id}checked='checked'{/if} value="{$category_item.id}">
        <label for='cat_{$category_item.id}'>{$category_item.name}</label>
    {/foreach}
    
  </td>
</tr>
<tr>
  <td class='lewa' style='width:15%;'>Producent:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[producer]" value="{$data.producer|escape}" style="width: 330px;" />
  </td>
</tr>
<tr>
  <td class='lewa' style='width:15%;'>Cena:</td>
  <td class='prawa' style='width:85%;'>
    <input style="text-align:right" class="form-text" type="text" name="data[price]" value="{$data.price}" style="width: 40px;" maxlength="13" /> &nbsp;PLN
  </td>
</tr>
<!-- opona -->

<tr class="opona">
  <td class='lewa' >Rolnicza: </td>
  <td class='prawa'>
    {if $data.agricultural eq '0' || $data.agricultural eq ''}
    <input type='radio' name='data[agricultural]' value='0' id='status0' checked='checked' />
    {else}
    <input type='radio' name='data[agricultural]' value='0' id='status0' />
    {/if}
    <label for='status0'>Nie</label>
    {if $data.agricultural eq '1'}
    <input type='radio' name='data[agricultural]' value='1' id='status1' checked='checked' />
    {else}
    <input type='radio' name='data[agricultural]' value='1' id='status1' />
    {/if}
    <label for='status1'>Tak</label>
  </td>
</tr>

<tr class="opona">
  <td class='lewa' style='width:15%;'>Ilosc partów:</td>
  <td class='prawa' style='width:85%;'>
    <input style="text-align:right" class="form-text" type="text" name="data[pr]" value="{$data.pr}" style="width: 40px;" maxlength="13" /> 
  </td>
</tr>
<tr class="opona">
  <td class='lewa' style='width:15%;'>Bieżnik:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[cap]" value="{$data.cap|escape}" style="width: 330px;" />
  </td>
</tr>
<tr class="opona">
  <td class='lewa' style='width:15%;'>Rozmiar:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[size]" value="{$data.size|escape}" style="width: 330px;" />
  </td>
</tr>
<tr class="opona">
  <td class='lewa' style='width:15%;'>Sezon:</td>
  <td class='prawa' style='width:85%;'>
    <select name="data[season]">
    	<option value="0">Wybierz pore roku</option>
    	<option value="1"  {if $data.season eq 1}selected="selected"{/if}>Lato</option>
    	<option value="2" {if $data.season eq 2}selected="selected"{/if}>Zima</option>
    	<option value="3" {if $data.season eq 3}selected="selected"{/if}>Wielosezonowa</option>
    </select>
  </td>
</tr>
<tr class="opona">
  <td class='lewa' style='width:15%;'>Przeznaczenia:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[destination]" value="{$data.destination|escape}" style="width: 330px;" />
  </td>
</tr>
<tr class="opona">
  <td class='lewa' style='width:15%;'>Indeks predkosci:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[speed_index]" value="{$data.speed_index|escape}" style="width: 330px;" />
  </td>
</tr>
<tr class="opona">
  <td class='lewa' style='width:15%;'>Nośność:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[maxload]" value="{$data.maxload|escape}" style="width: 330px;" />
  </td>
</tr>

<!-- koniec opona -->
<!-- felga -->

<tr class="felga">
  <td class='lewa' style='width:15%;'>Średnica felgi:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[diameter_wheel]" value="{$data.diameter_wheel}" style="width: 330px;" />
  </td>
</tr>
<tr class="felga">
  <td class='lewa' style='width:15%;'>Szerokość felgi:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[width_wheel]" value="{$data.width_wheel}" style="width: 330px;" />
  </td>
</tr>
<tr class="felga">
  <td class='lewa' style='width:15%;'>Rozstaw śrub:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[spacing_screw]" value="{$data.spacing_screw}" style="width: 330px;" />
  </td>
</tr>
<tr class="felga">
  <td class='lewa' style='width:15%;'>Osadzenie:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[seating]" value="{$data.seating}" style="width: 330px;" />
  </td>
</tr>
<!-- koniec felga -->
<!-- akumulator -->
<tr class="akumulator">
  <td class='lewa' style='width:15%;'>Gwarancja:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[warranty]" value="{$data.warranty}" style="width: 330px;" />
  </td>
</tr>
<tr class="akumulator">
  <td class='lewa' style='width:15%;'>Napięcie:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[tension]" value="{$data.tension}" style="width: 330px;" />
  </td>
</tr>
<tr class="akumulator">
  <td class='lewa' style='width:15%;'>Pojemność:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[capacity]" value="{$data.capacity}" style="width: 330px;" />
  </td>
</tr>
<tr class="akumulator">
  <td class='lewa' style='width:15%;'>Moc rozruchowa:</td>
  <td class='prawa' style='width:85%;'>
    <input class="form-text" type="text" name="data[power_starter]" value="{$data.power_starter}" style="width: 330px;" />
  </td>
</tr>

<!-- koniec akumulator -->
<tr>
    <td class='lewa'>Obrazek:</td>
    <td class='prawa'>
    {if $data.picture ne ''}
      <div style="display: inline; float: left; min-height: 120px; width: 270px; margin: 3px; text-align: left; padding: 5px; margin-left:0;        
		-moz-border-radius:3px;
		border:1px solid #A4A4A4;" class="gallery_image_div">
          <div style="width: 195px; height: 110px; text-align: left;float:left;padding-left:10px;">
            <span style="font-weight: normal;">plik:</span>&nbsp;&nbsp;<b>{$data.picture|substr:15}</b><br />
              <a href="../files/service/{$data.picture|escape}" title="{$data.picture|escape|substr:15:-4|capitalize|replace:'_':' '}" rel="lytebox" >
    		        <img src="../thumb.php?dir=files/service&amp;file={$data.picture|escape}&amp;w=100" style="-moz-border-radius:3px; border:1px solid #A4A4A4; opacity:.8;" onmouseover='jQuery(this).fadeTo("normal", 1); jQuery(this).css("border-color", "#058CC4");' onmouseout='jQuery(this).fadeTo("normal", .8); jQuery(this).css("border-color", "#A4A4A4");' />
    	       </a>
		      </div>
			<div style="width: 60px;float:left;padding-top: 20px;">
				<input type="checkbox" name="delete_file" id="delete_file" value="1" class="checkbox" /> <label for="delete_file" class="label">usuń</label>         
			</div>

     </div>

      {else}
    <script type="text/javascript">
		document.documentElement.className += ' js ';
	</script>    
    <div class="input-file" style="display:inline-block; width:394px!important;"> 
    	<label> <span>Kliknij by dodać obrazek</span> <input type="file" name="file" /> </label> <var><input type="text" name="my-input-file-path" value="wybierz plik..." readonly="readonly" />&nbsp;</var>
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
<!-- submit edycji rekordu -->
<tr>
  <td class='buttony' colspan='2' style='text-align: center; font-weight: bold;'>
  	<img src='{#imgDir#}ico-anuluj.gif' onclick='location.href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}"' onmouseover="this.src='{#imgDir#}ico-anuluj-over.gif'" onmouseout="this.src='{#imgDir#}ico-anuluj.gif'" class='icon' />
    <input type='hidden' name='confirms' value='1' />
    <img src='{#imgDir#}ico-zatwierdz.gif' onclick='document.editform.submit()' onmouseover="this.src='{#imgDir#}ico-zatwierdz-over.gif'" onmouseout="this.src='{#imgDir#}ico-zatwierdz.gif'" class='icon' />
    <input type='hidden' name='data[id]' value='{$data.id}' />
  	<img src='{#imgDir#}ico-usun.gif' onclick='if(confirm("Jeśli chcesz usunać kliknij [OK]\nJeśli nie [Anuluj]"))location.href="index.php?{$mainParameterName}={$mainParameterValue}&amp;act=del&amp;id={$data.id}"' onmouseover="this.src='{#imgDir#}ico-usun-over.gif'" onmouseout="this.src='{#imgDir#}ico-usun.gif'" class='icon' />
  </td>
</tr></table>
</form>

	<script type="text/javascript">
	{literal}
		jQuery( document ).ready(function() {
				var val_checked = jQuery("input:radio[name=data[id_category_type]]:checked").val();
				
				eval("pokaz"+val_checked+"()");
			});

	{/literal}
	</script>