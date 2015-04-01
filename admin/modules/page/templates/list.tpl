<div style='text-align: center; padding: 10px 0px 10px 0px;'>
  {include file="main/templates/errors.tpl"}
</div>
<div style='text-align: right; padding: 3px 0px 5px 10px;'>
  <div class='naglowek'>Drzewko stron</div>
</div>
<div style='text-align: right;'>

</form>
</div>
<div>
<!--	<form action='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}' id='listaform' name='listaform' method='post'>-->
	<table class="list" style='width: 60%;margin: auto;' border='0' id='lista' cellspacing='0' cellpadding='0'>
	  <thead>
	    <tr>
	      <th style='text-align: center; width: 65%;'>Drzewko</th>
	      <th style='text-align: center; width: 10%;'>&nbsp;</th>
	      <th style='text-align: center; width: 25%;'>Opcje</th>
	    </tr>
	  </thead>
		{include file="page/templates/tree.tpl"}
		<tr>
			<td>
			{if $smarty.post.t_new}
					<img src="{#imgDir#}dir_end.gif" style="border: 0px none ; width: 15px; height: 21px;" align="absmiddle"/>
					<form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="post" class="treeForm">
						<input type="text" name="name" value="" />
						<input type="submit" name="add" value="OK"/>
						<input type="submit" name="cancel" value="Anuluj"/>
					</form>
			{/if}
			</td>
			<td>
				<form action="{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}" method="post">
					<input type="image" src="{#imgDir#}ico-dodaj.gif" class="icon" title="Dodaj nowy element" name="t_new" alt="dodaj" value="t_new"/>
				</form>
			</td>
			<td>&nbsp;</td>
		</tr>
	</table>
<!--	</from>-->
</div>