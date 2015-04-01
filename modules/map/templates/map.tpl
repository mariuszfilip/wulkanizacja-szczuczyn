<div class="content">
				<div class="top_content"></div>
				<div class="center_content">
					{include file="main/templates/left.tpl"}
					<div class="right">
<h1>{#site_map#}</h1>
<p>
  <ul class="map">
  {foreach item=i key=m from=$map}
    {if $i.id_module eq 2}
      <li><a href="news.html">{$i.name}</a></li>
        {if $events}
          {foreach item=event key=e from=$events.items name=events_list}
             {if $smarty.foreach.events_list.iteration<11}
              <li><a href="news,{$event.id_event},{modrewrite name=$event.title}.html">{$event.title}</a></li>
             {/if}
            {/foreach}
          {/if}
    {else}
    <li><a href="{if $i.id_module eq 3}index{else}{modrewrite name=$i.name},{$i.id_page}{/if}.html">{$i.name}</a></li>
      {if $i.children}
        {foreach item=child key=ch from=$i.children}
          <li><a href="{modrewrite name=$child.name},{$child.id_page}.html">{$child.name}</a></li>
            {if $child.children}
              {foreach item=child2 key=ch2 from=$child.children}
              <li><a href="{modrewrite name=$child2.name},{$child2.id_page}.html">{$child2.name}</a></li>
              {/foreach}
              {/if}                    
          {/foreach}
        {/if}
     {/if}
  {/foreach}
  </ul>
</p>
		
					</div>
				</div>
				
				<div class="bottom_content"></div>
				<div class="tire_subpage"></div>
			<div class="content_thin_page"></div>