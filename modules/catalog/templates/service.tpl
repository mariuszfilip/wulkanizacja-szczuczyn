    	<h1>{$curent_tatalog.name}</h1>
			
      	<div class="offer"><!-- pojedyncza usluga -->
        	<div class="mini"><!-- obrazek szerokosci 80px -->
          	<a><img src="{if $service.picture}./thumb.php?dir=files/service/&amp;file={$service.picture}&amp;w=80{else}./css/img/offer_mini.jpg{/if}" alt="{$service.name}" /></a>
          </div>
          	<h2><a>{$service.name}</a></h2>
          	{$service.content}
            <div class="more">
            	<h2 class="price">Price: <span>{$service.price} $</span></h2>
            	{if !$sended}<a href="javascript:;" onclick="jQuery(this).hide();jQuery('#order').slideDown(); goToByScroll('order')">order now &raquo;</a>{/if}

            </div>
          <div class="end"></div>
        </div><!-- / pojedyncza usluga -->  
        
        
        
        
        <div class="offer" {if !$smarty.post.data}style="display:none;"{/if} id="order"><!-- pojedyncza usluga - form -->
        <a name="order"></a>
        	<h2>Order form</h2>
          {*<!--div class="error red">Nie udało się wysłać formularza.<br/>Wprowadź wszystkie wymagane dane</div-->*}
          
          {if $sended}
          <div class="error green">{$otherpages[2]->content}</div>          
          {else}          
        	<form action="{modrewrite name=$service.name},service,{$service.id_catalog},{$service.id_service}.html#order" method="post" onsubmit="return false;">

          	<p><span>Name &amp; Surmane:</span><input type="text" name="data[name]" class="required" /><small>*</small></p>
            <p><span>Address:</span><input type="text" name="data[address]" class="required" /><small>*</small></p>
            <p><span>Email:</span><input type="text" name="data[email]" class="email" /><small>*</small></p>
            <p><span>Phone:</span><input type="text" name="data[phone]" class="required" /><small>*</small></p>

            <p><span>Comments:</span><textarea name="data[comment]" cols="10" rows="10"></textarea></p>
            
            
            
            <p style="height:75px;"><span class="captcha_refresh"><small title="refresh" onclick="gen_new_captcha()"></small></span><img id="captcha" src="" style="display:none;" alt="ładowanie obrazka..."  /><img id="loader" style=" margin-top:30px; margin-left:54px; margin-right:54px; margin-bottom:30px;" src="css/img/ajax-loader.gif" alt="ładowanie..." /></p>


    <p><span>Code:</span><input type="text" name="uid" id="uid_js" maxlength="4" style="width:40px;" onkeyup="this.value=this.value.toUpperCase(); if(this.value.length==4) captchaValidate();"/><small>*</small></p>
    
    
    <script type="text/javascript">
		  $("#uid_js").attr("autocomplete","off");
		  	$(window).load(function(){literal}{{/literal}
				var CaptchaImage = new Image();
				CaptchaImage.src = "./captha/CaptchaImage.php?uid=54;{$uid}";
				CaptchaImage.onload = function(){literal}{{/literal}							
					$("#captcha").attr("src", CaptchaImage.src);
					$("#loader").hide(); 
					$("#captcha").fadeIn('normal');
				{literal}}
			});{/literal}
		  </script>
          
          <p><span></span><input type="submit" class="ok" onclick="captchaValidate(this.form, true);" value="order now" /><input type="hidden" name="cid" id="cid_js" value="{$cid}" /></p>

            
            <p><span>&nbsp;</span><small>*</small> - required</p>
          </form>
         {/if}
        </div><!-- / pojedyncza usluga - form --> 