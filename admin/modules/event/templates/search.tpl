<table class="search_list"  style='width: {if !$smarty.session.show_search[$mainParameterValue]}125px{else}100%{/if}; ' id='search_list' cellspacing='0' cellpadding='0'>
<thead>
  <tr>
    <th style='text-align: left; width: 100%;padding-left:10px;'><a href="javascript:;" onclick="change_search('{$mainParameterValue}');">Wyszukiwarka <img src="./img/{if !$smarty.session.show_search[$mainParameterValue]}un{/if}visible.png" style="margin-bottom:-5px;" id="search_img" /></a></th>
  </tr>
</thead>
</table>
<div id="search_body" class="search_body" {if !$smarty.session.show_search[$mainParameterValue]}style="display:none;"{/if}>
<form action='{$smarty.server.PHP_SELF}?{$mainParameterName}={$mainParameterValue}' name='search_{$mainParameterValue}' method='post'>
<table border='0' cellspacing='0' cellpadding='0'>
<tbody>
  <tr>
    <td align='left' valign='middle' style='width:20%;'>
      <strong>Tytuł</strong><br />
      <input type='text' size='20' name='s_{$mainParameterValue}[title]' value='{$s_event.title|escape|stripslashes}' class='form-text'>
    </td>
    <td align='left' valign='middle' style='width:25%;padding-left:3px;'>
      <strong>Wyświetlane od</strong><br />
       <input type='text' class='form-text' maxlength="10" name='s_{$mainParameterValue}[date_from]' value="{$s_event.date_from}" readonly='readonly' id='dataarea' style='width: 60px;' /><img src='css/img/calendar_low.gif' id='trigger' class='cal-button' alt='wybierz datę' title='wybierz datę' /> <img src="css/img/gumka.png" alt="wyczyść" id="eraser" title="wyczyść" class="gumka" />
  {literal}<script type="text/javascript">
    Calendar.setup({
      inputField  : "dataarea",
      button      : "trigger",
      eraser      : "eraser"
    });
  </script>{/literal}
    </td>
    <td align='left' valign='middle' style='width:20%;padding-left:3px;'>
      <b>Wyświetlane do</b><br>
<input type='text' class='form-text' maxlength="10" name='s_{$mainParameterValue}[date_to]' value="{$s_event.date_to}" readonly='readonly' id='dataarea2' style='width: 60px;' /><img src='css/img/calendar_low.gif' id='trigger2' class='cal-button' alt='wybierz datę' title='wybierz datę' /> <img src="css/img/gumka.png" alt="wyczyść" id="eraser2" title="wyczyść" class="gumka" />
  {literal}<script type="text/javascript">
    Calendar.setup({
			inputField  : "dataarea2",
			button      : "trigger2" ,
			eraser      : "eraser2"
		});
  </script>{/literal}
    </td>
    <td align='left' valign='middle' style='width:20%;padding-left:3px;'>
      <b>Wyśw. bezterminowo</b><br>
      <select class="form-select" name="s_{$mainParameterValue}[always]">
        <option value=''>bez znaczenia&nbsp;</option>
        <option value='Y'{if $s_event.always eq 'Y'} selected="selected" {/if}>tak</option>
        <option value='N'{if $s_event.always eq 'N'} selected="selected" {/if}>nie</option>
      </select>
    </td>
    <td align='left' valign='middle' style='width:20%;padding-left:3px;'>
      <b>Aktywny</b><br>
      <select class="form-select" name="s_{$mainParameterValue}[active]">
        <option value=''>bez znaczenia&nbsp;</option>
        <option value='Y'{if $s_event.active eq 'Y'} selected="selected" {/if}>tak</option>
        <option value='N'{if $s_event.active eq 'N'} selected="selected" {/if}>nie</option>
      </select>
    </td>
  </tr>
  <tr>
    <td align='right' valign='middle' colspan="5">
      <input type='submit' value='szukaj' name='search_{$mainParameterValue}' class='form-button' style='color: green; margin-right:40px;' />
    </td>
  </tr>
  </tbody>
</table>
</form>
</div>