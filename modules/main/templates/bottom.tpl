<div class="dol">

<div id="bor_main">

{foreach from=$menuLevelRoot key=lr item=main_menu_element name=main_menu_loop}
	{if $main_menu_element.bottom_menu eq 'Y'}
  	<!-- kolumna -->
  	<div class="kolumna">
  	{*<!--h3>Lorem ipsum</h3-->*} 
   <h3><a href="{if $main_menu_element.id_page eq 2}index.html{else}{modrewrite name=$main_menu_element.name},{$main_menu_element.id_page}.html{/if} ">{$main_menu_element.name}</a></h3>
   
   
   {if $main_menu_element.children}
                <ul>
                {foreach from=$main_menu_element.children key=2r item=submenu_element name=submenu_element_loop}
                	{if $submenu_element.bottom_menu eq 'Y'}	
                  <li><a href="{if $submenu_element.id_page eq 16}news.html{else}{modrewrite name=$submenu_element.name},{$submenu_element.id_page}.html{/if}">{$submenu_element.name}</a></li> 
                  	{/if}               
              	
                {/foreach}
                </ul>
                {/if}      
    </div>
{/if}
{/foreach}   
  	
    <div class="end"></div>
  </div></div>