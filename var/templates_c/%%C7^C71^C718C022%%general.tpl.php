<?php /* Smarty version 2.6.18, created on 2013-03-11 19:57:02
         compiled from general/templates/general.tpl */ ?>
				
				<div class="left_top_box">
				<h2><?php echo $this->_tpl_vars['news']['title']; ?>
</h2>
				<p><?php echo $this->_tpl_vars['news']['content']; ?>
</p>
				</div>
				<div class="right_top_box">
					<h3><?php echo $this->_tpl_vars['top']['title']; ?>
</h3>
					<p><?php echo $this->_tpl_vars['top']['content']; ?>
</p>
					
					<?php if ($this->_tpl_vars['save'] == 1): ?><br/><h3 style='color:white;'>Dodano do bazy</h3><?php endif; ?>
					<?php if ($this->_tpl_vars['save'] == 2): ?><br/><h3 style='color:white;'>Wpis istnieje w bazie</h3><?php endif; ?>
					<?php if ($this->_tpl_vars['save'] == 3): ?><br/><h3 style='color:white;'>Zły format emaila</h3><?php endif; ?>
					<form id="contact_form" action="kontakt.html" method="post">
					<input type="text" name="email" class="email"  value="Podaj swój email"/>
					<input type="text" name="tel" class="tel" value="Podaj swój numer telefonu" />
					<div class="submit_div">
							<div class="submit" onclick="$('#contact_form').submit();">
								Zatwierdz
							</div>
					</div>
					
					</form>
					<div class="clear"></div>
					<div class="line"></div>
					<div class="another_info">
						<h3><?php echo $this->_tpl_vars['bottom']['title']; ?>
</h3>
						<p><?php echo $this->_tpl_vars['bottom']['content']; ?>
 </p>
					</div>
				</div>
				<div class="bottom_box">
					<div class="women">
					<h4>Fachowa obsługa</h4>
					<p class="left">żródłem twojego zadowolenia</p>
						<div class="button_women">
							<a href="fachowa_obsluga.html">Dowiedz się więcej</a>
						</div>
					</div>
					<p>
					adres: <span class="ul">ul.Łąkowa 1A</span><br/>
					<span class="ul">19-230 Szczuczyn</span> <br/>
					Infolinia: <span class="tel">694273099</span>
					</p>
				</div>
				<div class="tire">
				</div>
				<div class="thin_page">
				</div>