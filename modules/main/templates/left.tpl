<div class="sub_menu">
						<div class="sub_menu_header">
							<h3>Opony</h3>
						</div>
						<ul>
							 {foreach from=$catalogues item=catalogues_item}
								<li><a style='cursor:pointer;'  onclick=" $('#new').load('load.php?id={$catalogues_item.id_catalog}&amp;id_service={$catalogues_item.id_service}');">{$catalogues_item.name}</a>
								<img src="css/img/line_subpage.png" />
							 {if $catalogues_item.children}
					                <ul>
					                    {foreach from=$catalogues_item.children item=catalogues_subitem}
					                    <li>    
					                    <a onclick=" $('#new').load('load.php?id={$catalogues_subitem.id_catalog}&amp;id_service={$catalogues_subitem.id_service}');">
					                     {$catalogues_subitem.name}</a>
					                     </li>
					                     {/foreach}
					                </ul>   
				               		 </li>
				                {else}
				                      </li>  
				                {/if}
					
							 {/foreach}
						</ul>
</div>



            

                 
               
