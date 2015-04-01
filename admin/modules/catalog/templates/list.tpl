	{include file="main/templates/errors.tpl"}
<div style='text-align: right;'>

</form>
</div>
<div>
<!--<form action='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}' id='listaform' name='listaform' method='post'>-->

<table class="list" style='width: 75%;margin: auto;' border='0' id='lista' cellspacing='0' cellpadding='0'>
<thead>
<tr>
	<th style='text-align: center; width: 65%;'>Kategorie</th>
    <th style='text-align: center; width: 10%;'>&nbsp;</th>
    <th style='text-align: center; width: 20%;'>Operacje</th>
    <th style='text-align: center; width: 1%;'>&nbsp;</th>

</tr>
</thead>

{include file="catalog/templates/tree.tpl"}
<tr>
	<td colspan="2">
    {if $smarty.post.t_new}
    <img src="{#imgDir#}dir_end.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/>
    <form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="post" class="treeForm">
    <input type="text" name="name" value="" />
    <input type="submit" name="add" value="OK"/>
    <input type="submit" name="cancel" value="Anuluj"/>
    </form>
    {/if}&nbsp;
    </td>

    <td>
    <form enctype="multipart/form-data" action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="post">
    <input type="hidden" name="t_new" value="t_new"/>
	<input type="image" src="{#imgDir#}ico-dodaj.gif" class="icon" title="Dodaj nowy element" name="t_newp" alt="dodaj" value="t_newp"/>
    </form>
    </td>
    <td>&nbsp;</td>

</tr>
</table>
<!-- </from>-->
</div>