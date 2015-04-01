{config_load file=$smarty.session.lang|lower}
{include file="main/templates/header.tpl"}



{include file="main/templates/center.tpl"}





{include file="main/templates/footer.tpl"}

{if isset($debug) && $debug == true}

{/if}