<h2 class="title">{$event_title} <img src="./css/img/ul1.jpg" alt="" style="vertical-align: middle; margin-bottom:2px;" /> {$event.title}</h2>
<div class="offer">
                 
{if $event.picture ne ''}
<p>
	<a href="#">{if $event.picture}<img src="thumb.php?dir=files/event/&amp;file={$event.picture|escape:url}&amp;w=150&amp;h=150" alt="" />{/if}</a>
</p>
{/if}                   
	<p style="margin:0 0 4px 0;"><strong>{$event.intro}</strong></p>
	{$event.content}  
	<br />
</div> 
<div style="float:left;"><h2 class="more3"><a class="active1" href="news.html">&laquo; more news</a></h2></div>
<div style="float:right; text-align:right;" class="dodane"><small>added: <span>{$event.added|truncate:10:""}</span></small></div>