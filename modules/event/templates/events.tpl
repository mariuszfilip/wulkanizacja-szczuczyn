<div class="top_content"></div>
				<div class="center_content">
					{include file="main/templates/left.tpl"}
					<div class="right" id="new">
						<h1>{$event_title}</h1>

						    {if count($collection.items) > 0}
						
						      {foreach item=i key=k from=$collection.items}
						      <div class="single_news">
						
						          <p class="inner_text">{$i.title}<span class="date_news"><i></i> {$i.added|date_format:"%d-%m-%Y"}</i></span></p>
						          
						          <div class="content_news">
						          	{if $i.picture}<a href="files/event/{$i.picture|escape:url}"><img  src="thumb.php?dir=files/event/&amp;file={$i.picture|escape:url}&amp;w=50&amp;h=50" class="img_news" align="right" alt="{$i.title}" style="margin:0 5px 5px 0;" /></a>{/if}
						            <p>{$i.intro}</p> 
								</div>
						      </div>
						      {/foreach}
						
						      <div class="stronicowanie">
						        {include file="main/templates/page.tpl" page=$collection.page}
						      </div>        
						    {else}
						      <h2>Brak ogłoszeń.</h2>
						    {/if}
   					</div>
<div class="bottom_content"></div>
<div class="tire_subpage"></div>
<div class="content_thin_page"></div>
</div>