<form action={$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue} method='post' name='sort_form'>
<table width=100% cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td align='center'>
      <input type="hidden" name="sort_change" value="1">
      Sortuj po: <select name='sort[sort]' class='form-select2' onChange='document.sort_form.submit();'>
      {foreach from=$sort.value key=k item=v}
        <option value="{$k}" 
        {if $sort.sort==$k}
          selected='selected'
        {/if}>{$v}</option>
      {/foreach}
      </select>&nbsp;
      <select name='sort[sortdir]' class='form-select2' onchange='document.sort_form.submit();'>
        <option value="ASC" {if $sort.sortdir=="ASC"}selected="selected"{/if}>rosnąco &nbsp;</option>
        <option value="DESC" {if $sort.sortdir=="DESC"}selected="selected"{/if}>malejąco &nbsp;</option>
      </select>
    </td>
  </tr>
</table>
</form>