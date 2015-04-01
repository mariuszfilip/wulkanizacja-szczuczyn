<div class="top_content"></div>
<div class="center_content">
					{include file="main/templates/left.tpl"}
					<div class="right" id="new">
					<h1>{$page.name|escape}</h1>
					<div class="text">{$page.content}</div>

								{if count($addedFiles)>0}
								      <h1>Download</h1>
								        <ul class="pliki">
								        {foreach from=$addedFiles item=file}
								        	{if $file.type != 2}
								          <li><a href="dl.php?file={$file.file_name}" title="{$file.name}">{$file.name}&nbsp;({$file.sizek|string_format:"%.1f"} kB)</a></li>
								          	{/if}
								        {/foreach}
								        </ul>
								      {/if}
								        
								    {if count($gallerys) > 0}
								    	{foreach from=$gallerys item=gallery}
								    	<h1>{$gallery.name|escape}</h1>
								        	<div class="gallery"><!-- skalowanie zdjec po wysokości -->
											{if count($gallery.files)>0}
								    			{foreach from=$gallery.files item=file}
								             <a class="thickbox" rel='galeria' title="{$file.description|escape}" href="files/photo/{$file.file_name|escape:url}">
										        <img src="thumb.php?dir=files/photo/&amp;file={$file.file_name|escape:url}&amp;h=80" alt="{$file.name|escape}" />
								             </a>
												{/foreach}
								                <div class="end"></div>
											{/if}
											</div>
								    	{/foreach}
								    {/if}
								        
							
</div>
<div class="bottom_content"></div>
<div class="tire_subpage"></div>
<div class="content_thin_page"></div>
</div>