{foreach from=$parent key=k item=subnode name=sub_tree_loop}
<tr class='{cycle values="odd,even"}'>
	<td class='tree' class='tree' style='padding-left: 10px;'>

    {section name=foo loop=$depth step=+1}

    {if $smarty.section.foo.iteration eq 1}

    	{if   $parent_is_last eq 1}
    
        
       <img src="{#imgDir#}dir_sub.gif" style="border: 0px none ; width: 20px; height: 21px;" align="absmiddle">
        {else}
        <img src="{#imgDir#}dir_empty.gif" style="border: 0px none ; width: 20px; height: 21px;" align="absmiddle">
        {/if}

	{else}

    	{if   $parent_is_last_n eq 1}
        <img src="{#imgDir#}dir_sub.gif" style="border: 0px none ; width: 20px; height: 21px;" align="absmiddle">
		{else}
        <img src="{#imgDir#}dir_empty.gif" style="border: 0px none ; width: 20px; height: 21px;" align="absmiddle">
        {/if}

	{/if}

    {/section}


    {if $smarty.foreach.sub_tree_loop.last}
    {*<!--img src="{#imgDir#}dir_end.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"-->*}
    
    
    		{if $subnode.children > 0}
    			{if $smarty.session.tree[$subnode.id_catalog] neq 1}
            		<a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;tree={$subnode.id_catalog}"><img src="{#imgDir#}dir_end_plus.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/></a>
            	{else}
            		<a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;tree_m={$subnode.id_catalog}"><img src="{#imgDir#}dir_end_minus.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/></a>
            	{/if}
        	{else}
        		<img src="{#imgDir#}dir_end.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/>
        	{/if}
   
    
    {else}
    
    
    		{if $subnode.children > 0}
    			{if $smarty.session.tree[$subnode.id_catalog] neq 1}
            		<a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;tree={$subnode.id_catalog}"><img src="{#imgDir#}dir_plus.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/></a>
            	{else}
            		<a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;tree_m={$subnode.id_catalog}"><img src="{#imgDir#}dir_minus.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/></a>
            	{/if}
        	{else}
        		<img src="{#imgDir#}dir_end.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/>
        	{/if} 
    
    {*<!--img src="{#imgDir#}dir.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"-->*}
    {/if}

    {if isset($smarty.get.t_edit) && $smarty.get.id eq $subnode.id_catalog} {*jesli jest edycja i id sie zgadza*}
	<form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="POST" class="treeForm">
    <input type='text' name='name' value='{$subnode.name}'>
    <input type="submit" name="edit" value="OK">
    <input type="hidden" name="id_catalog" value="{$subnode.id_catalog}">
    <input type="submit" name="cancel" value="Anuluj">
    </form>

    {else}
    <a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$subnode.id_catalog}">
    {$subnode.name}
    </a>
    {/if}


    {if isset($smarty.get.t_addsub) && $smarty.get.id eq $subnode.id_catalog}
	<br />
    {section name=foo loop=$depth step=1}
    <img src="{#imgDir#}dir_empty.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/>
    {/section}
    <img src="{#imgDir#}dir_empty.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/>
    <img src="{#imgDir#}dir_empty.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/>
    <img src="{#imgDir#}dir_end.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/>

	<form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="post"  class="treeForm">
    <input type="text" name="name" value="" />
    <input name="id_catalog" value="{$subnode.id_catalog}" type="hidden"/>
    <input type="submit" name="addsub" value="OK"/>
    <input type="submit" name="cancel" value="Anuluj"/>
    </form>
    {/if}

	</td>

    <td>
	<!-- przyciski do przesuwania po drzewie -->
    {if $subnode.position > 0}
    <input type="submit" class="buttonSmall" value="&#9650;" title="Kliknij aby przesunąć w górę" onclick="self.location.href='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;moveup=1&amp;id_catalog={$subnode.id_catalog}';" />
    <!--a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;moveup=1&amp;id_catalog={$subnode.id_catalog}"><img src="images/move_up.gif" alt="Kliknij aby przesunąc w górę" title="Kliknij aby przesunąc w górę" style="vertical-align: middle;" /></a-->
    <!--form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="post" style="display: inline;">
    <input type="hidden" name="moveup" value="1" />
    <input type="hidden" name="id_catalog" value="{$subnode.id_catalog}" />
    <input type="submit" class="buttonSmall" value="&#9650;" title="Kliknij aby przesun�� w g�r�" />
    </form-->
    {else}
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    {/if}

    {if count($subnode.children) > 0}
	    {if $subnode.position < (count($subnode)-1)}
	    <input type="submit" class="buttonSmall" value="&#9660;" title="Kliknij aby przesunąć w dół" onclick="self.location.href='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;movedown=1&amp;id_catalog={$subnode.id_catalog}';" />
	    <!--a href="?{$mainParameterName}={$mainParameterValue}&amp;movedown=1&amp;id_catalog={$subnode.id_catalog}"><img src="images/move_down.gif" alt="Kliknij aby przesunąc w dół" title="Kliknij aby przesunąc w dół" style="vertical-align: middle;" /></a-->
	    <!--form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="post" style="display: inline;">
	    <input type="hidden" name="movedown" value="1" />
	    <input type="hidden" name="id_catalog" value="{$subnode.id_catalog}" />
	    <input type="submit" class="buttonSmall" value="&#9660;" title="Kliknij aby przesun�� w d�" />
	    </form-->
	    {/if}

    {else}

    	{if $subnode.position < (count($parent)-1)}
    	<input type="submit" class="buttonSmall" value="&#9660;" title="Kliknij aby przesunąć w dół" onclick="self.location.href='?{$mainParameterName}={$mainParameterValue}&amp;movedown=1&amp;id_catalog={$subnode.id_catalog}';" />
        <!--a href="?{$mainParameterName}={$mainParameterValue}&amp;movedown=1&amp;id_catalog={$subnode.id_catalog}"><img src="images/move_down.gif" alt="Kliknij aby przesunąc w dół" title="Kliknij aby przesunąc w dół" style="vertical-align: middle;" /></a-->
        <!--form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="post" style="display: inline;">
        <input type="hidden" name="movedown" value="1" />
        <input type="hidden" name="id_catalog" value="{$subnode.id_catalog}" />
        <input type="submit" class="buttonSmall" value="&#9660;" title="Kliknij aby przesun�� w d�" />
        </form-->
        {/if}
	{/if}
	</td>

	<td>
	<form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="post" style="margin: 0px; padding: 0px; display: inline;">
    <input name="status" value="1" type="hidden" />

    {if $subnode.active == 'Y'}
    <!--input type="hidden" name="id_catalog" value="{$node.id_catalog}" />
    <input type="hidden" name="active" value="N" />
    <input value="S" class="buttonSmall" title="Kliknij, aby zmieni� status" type="submit"-->
    <a href="?{$mainParameterName}={$mainParameterValue}&amp;active=N&amp;id_catalog={$subnode.id_catalog}&amp;status=1"><img src="images/check_on.gif" alt="Dezaktywuj kategorię" title="Dezaktywuj kategorię" style="vertical-align: middle;" /></a>
    {else}
    <!--input type="hidden" name="id_catalog" value="{$node.id_catalog}" />
    <input type="hidden" name="active" value="Y" />
    <input value="S" class="buttonSmall" style="color: white;" title="Kliknij, aby zmieni� status" type="submit"-->
    <a href="?{$mainParameterName}={$mainParameterValue}&amp;active=Y&amp;id_catalog={$subnode.id_catalog}&amp;status=1"><img src="images/check_off.gif" alt="Aktywuj kategorię" title="Aktywuj kategorię" style="vertical-align: middle;" /></a>
    {/if}

	</form>

	{*if $subnode.active == 'Y'}
    <input type="hidden" name="id_catalog" value="{$subnode.id_catalog}" />
    <input type="hidden" name="active" value="N" />
    <input value="S" class="buttonSmall" title="Kliknij, aby zmieni� status" type="submit">
    {else}
    <input type="hidden" name="id_catalog" value="{$subnode.id_catalog}" />
    <input type="hidden" name="active" value="Y" />
    <input value="S" class="buttonSmall" style="color:white;" title="Kliknij, aby zmieni� status" type="submit">
    {/if*}

    </form>
    
    <input class="buttonSmall" onclick="javascript:location.href='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;t_edit=&amp;id={$subnode.id_catalog}'" name="t_edit" value="E" class="buttonSmall" title="Kliknij, aby edytowac" type="button">
    <input class="buttonSmall" disabled="disabled" name="t_edit" value="D" class="buttonSmall" title="Kliknij, aby dodac" type="button"/>

    <form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="post" style="display: inline;">
    <input type="hidden" name="del" value="1" />
    <input type="hidden" name="id_catalog" value="{$subnode.id_catalog}" />
    <input value="U" class="buttonSmall" style="color: rgb(255, 0, 0);"
    onclick="javascript:if (confirm('Usuwasz rekord!\n Aby potwierdzic, wciśnij [ OK ],\n aby, anulowac wciśnij [ Anuluj ]\n')) this.form.submit();" title="Kliknij, aby usunąc" type="button">
    </form>
    </td>
    <td>
 {*
    

   		<input class="buttonSmall" onclick="javascript:location.href='?{$mainParameterName}={$mainParameterValue}&amp;act=add&amp;id_catalog={$subnode.id_catalog}'" name="t_edit" value="D" class="buttonSmall" title="Kliknij, aby dodać produkt" type="button"/>
	    <!--a href="?{$mainParameterName}={$mainParameterValue}&amp;act=add&amp;id_catalog={$subnode.id_catalog}">Dodaj</a-->
	    <input class="buttonSmall" onclick="javascript:location.href='?{$mainParameterName}={$mainParameterValue}&amp;prod=list_prod&amp;id_catalog={$subnode.id_catalog}'" name="t_edit" value="L" class="buttonSmall" title="Kliknij, zobaczyc produkty" type="button"/>
    	<!--a href="?{$mainParameterName}={$mainParameterValue}&amp;prod=list_prod&amp;id_catalog={$subnode.id_catalog}">Lista</a-->*}
    </td>
</tr>
    
{*if $subnode.id_catalog == $smarty.get.id_catalog && $smarty.get.prod == "list_prod"}
{include file="catalog/templates/list_prod.tpl"}
{/if*}

{if !$smarty.foreach.sub_tree_loop.last }
	{assign var=variable value=1}
{else}
	{assign var=variable value=0}
{/if}

{*if count($subnode.children > 0) and $smarty.foreach.sub_tree_loop.last}
	{assign var=variable value=0}
{/if*}

{if $subnode.children > 0}

	{if $smarty.session.tree[$subnode.id_catalog] eq 1}
  {*if count($subnode.children)> 0*}
		{include file="catalog/templates/tree_recursion.tpl" parent=$subnode.children depth=$depth+1 parent_is_last_n=$variable}
    {/if}
{/if}


{/foreach}