    <div id="content">
    	<h2 class="pagetitle">Aktualności</h2>
      <div class="tresc">
      {if count($collection.items) > 0}

        {foreach item=i key=k from=$collection.items}
        <div class="news">
          	<h2>{$i.title}</h2>
            <small>dodano: {$i.added|truncate:10:""}</small>
            {$i.intro}
            <h2 class="more2"><a href="{$smarty.server.PHP_SELF}?{$mainParameterName}=event&amp;ida={$i.id}">czytaj dalej &raquo;</a></h2>
        </div>
        {/foreach}

        <div class="stronicowanie">
          {include file="main/templates/page.tpl" page=$collection.page}
        </div>        
      {else}
        <h2>There is no news</h2>
      {/if}
    </div>
  <div class="bottom"></div>
</div>
<!-- / artykuły -->