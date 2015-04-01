<?php /* Smarty version 2.6.18, created on 2013-08-20 22:04:40
         compiled from main/templates/errors.tpl */ ?>
<?php if (! empty ( $_SESSION['message'] )): ?>
  <div class='message'><?php echo $_SESSION['message']; ?>
</div>
<?php endif; ?>
<?php if (! empty ( $_SESSION['error'] )): ?>
  <div class='message'><?php echo $_SESSION['error']; ?>
</div>
<?php endif; ?>
<?php if (! empty ( $_SESSION['errors'] )): ?>
<div class='message'>
  <?php $_from = $_SESSION['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['e']):
?>
    <?php echo $this->_tpl_vars['e']; ?>
<br />
  <?php endforeach; endif; unset($_from); ?>
</div>
<?php endif; ?>