{if count($tree) > 0}
	{assign var=tab_of_last value=''}
	{foreach from=$tree key=k item=node name=main_tree_loop}

  <tr class='{cycle values="odd,even"}'>
  	<td class='tree' class='tree' style='padding-left: 10px';>



		{if  !$smarty.foreach.main_tree_loop.last and count($node.children) > 0}

		{/if}
			{if isset($smarty.get.t_edit) && $smarty.get.id eq $node.id_page} {*jesli jest edycja i id sie zgadza*}
			<form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="POST" class="treeForm">
				<input type='text' name='name' value='{$node.name}'/>
				<input type="submit" name="edit" value="OK"/>
				<input type="hidden" name="id_page" value="{$node.id_page}"/>
				<input type="submit" name="cancel" value="Anuluj"/>
			</form>

			{else}

				<a href="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;act=edit&amp;id={$node.id_page}">
				{$node.name}
				</a>
			{/if}

			{if $smarty.foreach.tree_loop.last}
			{if isset($smarty.get.t_addsub) && $smarty.get.id eq $node.id_page}
				<br />
				<img src="{#imgDir#}dir_empty.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/>
				<img src="{#imgDir#}dir_end.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/>

		  	<form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="post"  class="treeForm">
					<input type="text" name="name" value="" />
					<input name="id_page" value="{$node.id_page}" type="hidden"/>
					<input type="submit" name="addsub" value="OK"/>
					<input type="submit" name="cancel" value="Anuluj"/>
				</form>
  		{/if}
  		{/if}

  	</td>
  	<td>
  	<!-- przyciski do przesuwania po drzewie -->

	  	{if $node.position > 0}
	  	<form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="post" style="display: inline;">
	  		<input type="hidden" name="moveup" value="1" />
	  		<input type="hidden" name="id_page" value="{$node.id_page}" />
 	  		<input type="submit" class="buttonSmall" value="&#9650;" title="Kliknij aby przesunąć w górę" />
	  	</form>
	  	{/if}

	  	{if !$smarty.foreach.main_tree_loop.last}
	  	<form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="post" style="display: inline;">
	  		<input type="hidden" name="movedown" value="1" />
	  		<input type="hidden" name="id_page" value="{$node.id_page}" />
	  		<input type="submit" class="buttonSmall" value="&#9660;" title="Kliknij aby przesunąć w dół" />
	  	</form>
	  	{/if}
  	</td>
  	<td>

			<input class="buttonSmall" onclick="javascript:location.href='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;t_edit=&amp;id={$node.id_page}'" name="t_edit" value="E" class="buttonSmall" title="Kliknij, aby edytować" type="button">
		<form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="post" style="margin: 0px; padding: 0px; display: inline;">
		<input name="status" value="1" type="hidden"/>
		{if $node.active eq 'Y'}
			<input type="hidden" name="id_page" value="{$node.id_page}" />
			<input type="hidden" name="active" value="N" />
 			<input value="S" class="buttonSmall" title="Kliknij, aby zmienić status" type="submit">
		{else}
			<input type="hidden" name="id_page" value="{$node.id_page}" />
			<input type="hidden" name="active" value="Y" />
			<input value="S" class="buttonSmall" style="color: white;" title="Kliknij, aby zmienić status" type="submit">
		{/if}
			</form>
			<input class="buttonSmall" onclick="javascript:location.href='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}&amp;t_addsub=&amp;id={$node.id_page}'" name="t_edit" value="D" class="buttonSmall" title="Kliknij, aby dodać" type="button"/>


		<form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="post" style="display: inline;">
			<input type="hidden" name="del" value="1" />
	  	<input type="hidden" name="id_page" value="{$node.id_page}" />
			<input value="U" class="buttonSmall" style="color: rgb(255, 0, 0);"
			onclick="javascript:if (confirm('Usuwasz rekord!\n Aby potwierdzić, wcińnij [ OK ],\n aby, anulować wciśnij [ Anuluj ]\n')) this.form.submit();" title="Kliknij, aby usunąć" type="button">
		</form>
  	</td>
  </tr>
  {if !$smarty.foreach.main_tree_loop.last}
  {assign var=variable value=1}
  {else}
    {assign var=variable value=0}
  {/if}


		{if $node.children > 0}
			{include file="page/templates/tree_recursion.tpl" parent=$node.children depth=1 parent_is_last=$variable}
		{/if}
  {/foreach}

{else}
	<tr>
		<td colspan="4">Drzewko nie zostało utworzone. Dodaj nowy element klikając na<i>"Dodaj"</i></td>
	</tr>
{/if}
