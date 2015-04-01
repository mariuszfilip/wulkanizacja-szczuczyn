{if count($tree) > 0}
{assign var=tab_of_last value=''}
{foreach from=$tree key=k item=node name=main_tree_loop}

<tr class='{cycle values="odd,even"}'>
	<td class='tree' class='tree' style='padding-left: 10px';>
{*$smarty.session.tree[$node.id_catalog]*}
	{if $smarty.foreach.main_tree_loop.last}

    	{if $node.children > 0}
    		{if $smarty.session.tree[$node.id_catalog] neq 1}
            <a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;tree={$node.id_catalog}"><img src="{#imgDir#}dir_end_plus.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/></a>
            {else}
            <a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;tree_m={$node.id_catalog}"><img src="{#imgDir#}dir_end_minus.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/></a>
            {/if}
        {else}
        	<img src="{#imgDir#}dir_end.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/>
        {/if}

    {else}
    	{if $node.children > 0}
    		{if $smarty.session.tree[$node.id_catalog] neq 1}
            <a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;tree={$node.id_catalog}"><img src="{#imgDir#}dir_plus.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/></a>
            {else}
            <a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;tree_m={$node.id_catalog}"><img src="{#imgDir#}dir_minus.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/></a>
            {/if}
        {else}
        	<img src="{#imgDir#}dir.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/>
        {/if}
    {/if}
    {if  !$smarty.foreach.main_tree_loop.last and count($node.children) > 0}
    {*<img src="{#imgDir#}dir_sub.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/>*}
    {/if}

    {if isset($smarty.get.t_edit) && $smarty.get.id eq $node.id_catalog} {*jesli jest edycja i id sie zgadza*}
    <form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="POST" class="treeForm">
    <input type='text' name='name' value='{$node.name}'/>
    <input type="submit" name="edit" value="OK"/>
    <input type="hidden" name="id_catalog" value="{$node.id_catalog}"/>
    <input type="submit" name="cancel" value="Anuluj"/>
    </form>

    {else}
	<a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$node.id_catalog}">

    {$node.name}
   </a>
    {/if}

    {if $smarty.foreach.tree_loop.last}

    {if isset($smarty.get.t_addsub) && $smarty.get.id eq $node.id_catalog}
    <br />
    <img src="{#imgDir#}dir_empty.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/>
    <img src="{#imgDir#}dir_end.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/>

    <form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="post"  class="treeForm">
    <input type="text" name="name" value="" />
    <input name="id_catalog" value="{$node.id_catalog}" type="hidden"/>
    <input type="submit" name="addsub" value="OK"/>
    <input type="submit" name="cancel" value="Anuluj"/>
    </form>
    {/if}

    {/if}

	</td>

	<td>
	<!-- przyciski do przesuwania po drzewie -->

    {if $node.position > 0}
    <input type="submit" class="buttonSmall" value="&#9650;" title="Kliknij aby przesunąć w górę" onclick="self.location.href='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;moveup=1&amp;id_catalog={$node.id_catalog}';" />
    <!--a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;moveup=1&amp;id_catalog={$node.id_catalog}"><img src="images/move_up.gif" alt="Kliknij aby przesunąc w górę" title="Kliknij aby przesuną w górę" style="vertical-align: middle;" /></a-->
    {/if}

    {if !$smarty.foreach.main_tree_loop.last}
    <input type="submit" class="buttonSmall" value="&#9660;" title="Kliknij aby przesunąć w dół" onclick="self.location.href='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;movedown=1&amp;id_catalog={$node.id_catalog}';" />

    <!--a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;movedown=1&amp;id_catalog={$node.id_catalog}"><img src="images/move_down.gif" alt="Kliknij aby przesunąc w dół" title="Kliknij aby przesunąc w dół" style="vertical-align: middle;" /></a-->
    {/if}
    </td>

    <td>
    <form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="post" style="margin: 0px; padding: 0px; display: inline;">
    <input name="status" value="1" type="hidden"/>
    {if $node.active == 'Y'}
    <a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;id={$node.id_catalog}&amp;active=N&amp;id_catalog={$node.id_catalog}&amp;status=1"><img src="images/check_on.gif" alt="Dezaktywuj kategorię" title="Dezaktywuj kategorię" style="vertical-align: middle;" /></a>

    {else}
    <a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;id={$node.id_catalog}&amp;active=Y&amp;id_catalog={$node.id_catalog}&amp;status=1"><img src="images/check_off.gif" alt="Aktywuj kategorię" title="Aktywuj kategorię" style="vertical-align: middle;" /></a>
    {/if}
    </form>
    
    <input class="buttonSmall" onclick="javascript:location.href='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;t_edit=&amp;id={$node.id_catalog}'" name="t_edit" value="E" class="buttonSmall" title="Kliknij, aby edytować" type="button">
    <input class="buttonSmall" onclick="javascript:location.href='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;t_addsub=&amp;id={$node.id_catalog}'" name="t_edit" value="D" class="buttonSmall" title="Kliknij, aby dodać" type="button"/>


    <form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="post" style="display: inline;">
    <input type="hidden" name="del" value="1" />
    <input type="hidden" name="id_catalog" value="{$node.id_catalog}" />
    <input value="U" class="buttonSmall" style="color: rgb(255, 0, 0);"
    onclick="javascript:if (confirm('Usuwasz rekord!\n Aby potwierdzić, wciśnij [ OK ],\n aby, anulować wciśnij [ Anuluj ]\n')) this.form.submit();" title="Kliknij, aby usunąc" type="button">
    </form>
    </td>

	<td>
    {*<a hred="">produkty</a>*}
    {*produkty poziom pierwszy
		<input class="buttonSmall" onclick="javascript:location.href='?{$mainParameterName}={$mainParameterValue}&amp;act=add&amp;id_catalog={$node.id_catalog}'" name="t_edit" value="D" class="buttonSmall" title="Kliknij, aby dodać produkt" type="button"/>
		<!--a href="?{$mainParameterName}={$mainParameterValue}&amp;act=add&amp;id_catalog={$node.id_catalog}">Dodaj</a-->
		<input class="buttonSmall" onclick="javascript:location.href='?{$mainParameterName}={$mainParameterValue}&amp;prod=list_prod&amp;id_catalog={$node.id_catalog}'" name="t_edit" value="L" class="buttonSmall" title="Kliknij, aby zobaczyć produkty" type="button"/>
		<!--a href="?{$mainParameterName}={$mainParameterValue}&amp;prod=list_prod&amp;id_catalog={$node.id_catalog}">Lista</a-->
	*}{$smarty.get.prod}</td>
</tr>

{if $node.id_catalog == $smarty.get.id_catalog && $smarty.get.prod == "list_prod"}
{include file="catalog/templates/list_prod.tpl"}
{/if}

{if !$smarty.foreach.main_tree_loop.last}
{assign var=variable value=1}
{else}
{assign var=variable value=0}
{/if}


{if $node.children > 0}
	{if $smarty.session.tree[$node.id_catalog] eq 1}
		{include file="catalog/templates/tree_recursion.tpl" parent=$node.children depth=1 parent_is_last=$variable}
    {/if}
{/if}
{/foreach}

{else}
<tr>
	<td colspan="5">Drzewko nie zostało utworzone. Dodaj nowy element klikając na<i>"Dodaj"</i></td>
</tr>
{/if}