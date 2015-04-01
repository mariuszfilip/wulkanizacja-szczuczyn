{if count($submenu)> 0}
	<div class="subpage_box">
    	<div class="subpage_box_top">
      	<h2 class="name">{$page.name}</h2>
      </div>
      <div class="subpage_box_content">
      	<ul>
        {foreach item=i key=k from=$submenu}
      	   <li class="submenu">
      	    <ul>
      	    <li>
      	    	<a href="{$smarty.server.PHP_SELF}?{$mainParameterName}=page&amp;id={$i.id_page}">{$i.name}</a>
      	    </li>
            </ul>
          </li>
      	{/foreach}
        </ul>
      </div>
      <div class="subpage_box_bottom"></div>
    </div>
{else}
{if !empty($prevsubmenuname)}
	<div class="subpage_box">
    	<div class="subpage_box_top">
      	<h2 class="name">{if !empty($prevsubmenuname)}{$prevsubmenuname}{else}Start{/if}</h2>
      </div>
      <div class="subpage_box_content">
      	<ul>
        {foreach item=i key=k from=$prevsubmenu}
      	   <li class="submenu">
      	    <ul>
      	    <li>
      	    	<a href="{$smarty.server.PHP_SELF}?{$mainParameterName}=page&amp;id={$i.id_page}">{$i.name}</a>
      	    </li>
            </ul>
          </li>
      	{/foreach}
        </ul>
      </div>
      <div class="subpage_box_bottom"></div>
    </div>
{/if}
{/if}