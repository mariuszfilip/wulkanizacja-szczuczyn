{* Message *}
{if !empty($smarty.session.message)}
  <div class='message'>{$smarty.session.message}</div>
{/if}
{* Error *}
{if !empty($smarty.session.error)}
  <div class='message'>{$smarty.session.error}</div>
{/if}
{* Array of errors *}
{if !empty($smarty.session.errors)}
<div class='message'>
  {foreach from=$smarty.session.errors item=e}
    {$e}<br />
  {/foreach}
</div>
{/if}
