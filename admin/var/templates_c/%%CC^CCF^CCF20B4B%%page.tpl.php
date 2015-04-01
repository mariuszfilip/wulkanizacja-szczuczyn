<?php /* Smarty version 2.6.18, created on 2013-09-20 18:34:49
         compiled from main/templates/page.tpl */ ?>
<table class="list" style='width: 100%;' border='0' id='stronicowanie' cellspacing='0' cellpadding='0'>
  <tr class='dolna'>
    <td style='text-align: left; padding-left: 15px;width:25%;' rowspan='2'>
    </td>
    <td style='width:50%;text-align:center;'>
        <?php if ($this->_tpl_vars['page']['first'] != 0): ?>
      <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;page=<?php echo $this->_tpl_vars['page']['first']; ?>
<?php echo $this->_tpl_vars['link']; ?>
" class='wiecejNobold'>|<</a>&nbsp;
    <?php endif; ?>
    <?php if ($this->_tpl_vars['page']['previous'] != 0): ?>
      <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;page=<?php echo $this->_tpl_vars['page']['previous']; ?>
<?php echo $this->_tpl_vars['link']; ?>
" class='wiecejNobold'><<</a>&nbsp;&nbsp;
    <?php endif; ?>
    <?php if ($this->_tpl_vars['page']['backwards'] != 0): ?>
      <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;page=<?php echo $this->_tpl_vars['page']['backwards']; ?>
<?php echo $this->_tpl_vars['link']; ?>
" class='wiecejNobold'>...</a>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['page']['previous_2'] != 0): ?>
      <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;page=<?php echo $this->_tpl_vars['page']['previous_2']; ?>
<?php echo $this->_tpl_vars['link']; ?>
" class='wiecejNobold'><?php echo $this->_tpl_vars['page']['previous_2']; ?>
</a>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['page']['previous_1'] != 0): ?>
      <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;page=<?php echo $this->_tpl_vars['page']['previous_1']; ?>
<?php echo $this->_tpl_vars['link']; ?>
" class='wiecejNobold'><?php echo $this->_tpl_vars['page']['previous_1']; ?>
</a>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['page']['current'] != 0): ?>
      <span class='wiecejBold'>[<?php echo $this->_tpl_vars['page']['current']; ?>
]</span>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['page']['next_1'] != 0): ?>
      <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;page=<?php echo $this->_tpl_vars['page']['next_1']; ?>
<?php echo $this->_tpl_vars['link']; ?>
" class='wiecejNobold'><?php echo $this->_tpl_vars['page']['next_1']; ?>
</a>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['page']['next_2'] != 0): ?>
      <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;page=<?php echo $this->_tpl_vars['page']['next_2']; ?>
<?php echo $this->_tpl_vars['link']; ?>
" class='wiecejNobold'><?php echo $this->_tpl_vars['page']['next_2']; ?>
</a>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['page']['forwards'] != 0): ?>
      <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;page=<?php echo $this->_tpl_vars['page']['forwards']; ?>
<?php echo $this->_tpl_vars['link']; ?>
" class='wiecejNobold'>...</a>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['page']['next'] != 0 && $this->_tpl_vars['page']['next'] != 1): ?>
      &nbsp;&nbsp;<a href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;page=<?php echo $this->_tpl_vars['page']['next']; ?>
<?php echo $this->_tpl_vars['link']; ?>
" class='wiecejNobold'>>></a>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['page']['last'] != 0 && $this->_tpl_vars['page']['last'] != 1): ?>
      &nbsp;<a href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
&amp;page=<?php echo $this->_tpl_vars['page']['last']; ?>
<?php echo $this->_tpl_vars['link']; ?>
" class='wiecejNobold' style=''>>|</a>
    <?php endif; ?>
    </td>
    <td style='text-align: center; padding-left: 15px; padding-right: 15px; width:25%;' rowspan='2'>
    <?php if ($this->_tpl_vars['submit_ascribe'] != ''): ?>
      <input class="form-button" value="&laquo; powrót" onclick='location.href="<?php echo $_SERVER['PHP_SELF']; ?>
?<?php echo $this->_tpl_vars['mainParameterName']; ?>
=<?php echo $this->_tpl_vars['mainParameterValue']; ?>
<?php echo $this->_tpl_vars['return']; ?>
"' type="button">
      <input class="form-button"  type="submit" name="<?php echo $this->_tpl_vars['submit_ascribe']; ?>
" value="zapisz">
    <?php endif; ?>
    </td>    
  </tr>
  <tr class='dolna' style='text-align:center;'>
    <td>
      Wyświetlane: od <span style='font-weight: bold;'><?php echo $this->_tpl_vars['page']['from']; ?>
</span> do
      <span style='font-weight: bold;'><?php echo $this->_tpl_vars['page']['to']; ?>
</span> z
      <span style='font-weight: bold;'><?php echo $this->_tpl_vars['page']['all']; ?>
</span> rekordów
    </td>
  </tr>
  </table>