		    <ul>
		{foreach from=$menuLevelRoot key=lr item=main_menu_element name=main_menu_loop}
        {if $main_menu_element.id_module eq 3}
        <li{*if $main_menu_element.id_page eq $page.id_page or $main_menu_element.id_page eq $page.id_parent or $main_menu_element.id_page eq $page.parent_parent_id} class="active"{/if*}><a href="index.html">{$main_menu_element.name|escape}</a> 
        {elseif $main_menu_element.id_module eq 2}
        <li{*if $smarty.request.mod eq 'event'} class="active"{/if*}><a href="ogloszenia.html">{$main_menu_element.name|escape}</a>
        {else}
        <li{*if $main_menu_element.id_page eq $page.id_page or $main_menu_element.id_page eq $page.id_parent or $main_menu_element.id_page eq $page.parent_parent_id} class="active"{/if*}><a href="{modrewrite name=$main_menu_element.name},{$main_menu_element.id_page}.html">{$main_menu_element.name|escape}</a>
        {/if}
        		{if $main_menu_element.children}
                <ul>
                {foreach from=$main_menu_element.children key=2r item=submenu_element name=submenu_element_loop}
                  <li{*if $submenu_element.id_page eq $page.id_page or $submenu_element.id_page eq $page.id_parent} class="active"{/if*}><a href="{if $submenu_element.id_module eq 2}index.php?mod=event{else}{modrewrite name=$submenu_element.name},{$submenu_element.id_page}.html{/if}">{$submenu_element.name|escape}</a>
                  {if $submenu_element.children}
                  <ul>
                  {foreach from=$submenu_element.children key=3r item=sub_submenu_element name=sub_submenu_element_loop}
                  		<li{*if $sub_submenu_element.id_page eq $page.id_page or $sub_submenu_element.id_page eq $page.id_parent} class="active"{/if*}><a href="{if $sub_submenu_element.id_module eq 2}news.html{else}{modrewrite name=$sub_submenu_element.name},{$sub_submenu_element.id_page}.html{/if}">{$sub_submenu_element.name|escape}</a>
                              {if $sub_submenu_element.children}
                              <ul>
                              {foreach from=$sub_submenu_element.children key=4r item=sub_sub_submenu_element name=sub_submenu_element_loop}
                                    <li{*if $sub_sub_submenu_element.id_page eq $page.id_page or $sub_sub_submenu_element.id_page eq $page.id_parent} class="active"{/if*}><a href="{if $sub_sub_submenu_element.id_module eq 2}news.html{else}{modrewrite name=$sub_sub_submenu_element.name},{$sub_sub_submenu_element.id_page}.html{/if}">{$sub_sub_submenu_element.name|escape}</a></li>
                              {/foreach}
                              </ul>
                              {/if}
                        </li>
                  {/foreach}
                  </ul>
                  {/if}
                  </li>
                {/foreach}
                </ul>
                {/if}
        </li>
{/foreach}
    <!--  <li {*if $smarty.get.mod eq 'map'} class="active"{/if*}><a href="map.html">Sitemap</a></li>-->
    </ul>