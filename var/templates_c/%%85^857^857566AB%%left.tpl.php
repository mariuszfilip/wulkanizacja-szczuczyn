<?php /* Smarty version 2.6.18, created on 2013-03-11 19:57:26
         compiled from main/templates/left.tpl */ ?>
<div class="sub_menu">
						<div class="sub_menu_header">
							<h3>Opony</h3>
						</div>
						<ul>
							 <?php $_from = $this->_tpl_vars['catalogues']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['catalogues_item']):
?>
								<li><a style='cursor:pointer;'  onclick=" $('#new').load('load.php?id=<?php echo $this->_tpl_vars['catalogues_item']['id_catalog']; ?>
&amp;id_service=<?php echo $this->_tpl_vars['catalogues_item']['id_service']; ?>
');"><?php echo $this->_tpl_vars['catalogues_item']['name']; ?>
</a>
								<img src="css/img/line_subpage.png" />
							 <?php if ($this->_tpl_vars['catalogues_item']['children']): ?>
					                <ul>
					                    <?php $_from = $this->_tpl_vars['catalogues_item']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['catalogues_subitem']):
?>
					                    <li>    
					                    <a onclick=" $('#new').load('load.php?id=<?php echo $this->_tpl_vars['catalogues_subitem']['id_catalog']; ?>
&amp;id_service=<?php echo $this->_tpl_vars['catalogues_subitem']['id_service']; ?>
');">
					                     <?php echo $this->_tpl_vars['catalogues_subitem']['name']; ?>
</a>
					                     </li>
					                     <?php endforeach; endif; unset($_from); ?>
					                </ul>   
				               		 </li>
				                <?php else: ?>
				                      </li>  
				                <?php endif; ?>
					
							 <?php endforeach; endif; unset($_from); ?>
						</ul>
</div>



            

                 
               