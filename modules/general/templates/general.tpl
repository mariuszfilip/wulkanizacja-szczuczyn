				
				<div class="left_top_box">
				<h2>{$news.title}</h2>
				<p>{$news.content}</p>
				</div>
				<div class="right_top_box">
					<h3>{$top.title}</h3>
					<p>{$top.content}</p>
					
					{if $save == 1 }<br/><h3 style='color:white;'>Dodano do bazy</h3>{/if}
					{if $save == 2 }<br/><h3 style='color:white;'>Wpis istnieje w bazie</h3>{/if}
					{if $save == 3 }<br/><h3 style='color:white;'>Zły format emaila</h3>{/if}
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
						<h3>{$bottom.title}</h3>
						<p>{$bottom.content} </p>
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