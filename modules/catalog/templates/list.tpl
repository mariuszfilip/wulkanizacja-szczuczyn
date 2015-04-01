    	<h1>{$curent_tatalog.name}</h1>
			
      	{foreach from=$service_list item=single_service}
        <div class="offer"><!-- pojedyncza usluga -->
        	<div class="mini"><!-- obrazek szerokosci 80px -->
          	<a href="{modrewrite name=$single_service.name},service,{$curent_tatalog.id_catalog},{$single_service.id_service}.html"><img src="{if $single_service.picture}thumb.php?dir=files/service/&amp;file={$single_service.picture}&amp;w=80{else}css/img/offer_mini.jpg{/if}" alt="{$single_service.name}" /></a>
          </div>
          <div class="desc">
          	<h2><a href="{modrewrite name=$single_service.name},service,{$curent_tatalog.id_catalog},{$single_service.id_service}.html">{$single_service.name}</a></h2>
            
          	{$single_service.short_content}    
                    
            <div class="more">
            	<h2 class="price">Price: <span>{$single_service.price} $</span></h2>
            	<a href="{modrewrite name=$single_service.name},service,{$curent_tatalog.id_catalog},{$single_service.id_service}.html">details &raquo;</a>
            </div>
          </div>
          <div class="end"></div>
        </div><!-- / pojedyncza usluga -->
        {/foreach}