<script>
$(document).ready(function(){
    $(function() {
    
    
        $('.gallery a').lightBox();

    });
  });
  </script>
<?php
define('DEBUG',0);
 $_SESSION['show_debug'] = false;
include_once('core/init.inc.php');
include_once('modules/main/classes/DBObject.class.php');
include_once('modules/main/classes/DB.class.php');
include_once('modules/catalog/classes/DBObject/Catalog.class.php');
include_once('modules/service/classes/DBObject/Service.class.php');
if(isset($_GET['id']))
{

	if($_GET['id'] == ''):
	$_GET['id']=0;
	endif;
	if($_GET['id_service'] == ''):
	$_GET['id_service']=0;
	endif;
	$_GET['mod']='';
	
	//$catalog = new Catalog($_GET['id'] );
	$service = new Service();
	$service = $service->getAll($_GET['id']);	

		echo "<div class='text'>";
	foreach($service as $ser_one){
		echo "<div class='cms_content'>";
		echo "<h1>$ser_one[name]</h1>";
		if($ser_one['picture'] != ''):
			echo "<img src='files/service/$ser_one[picture]' class='picture_ajax' />";
		endif;
		if($ser_one['id_category_type'] == 1):
			echo "<table class='ajax_table' cellpadding='5px'>";
			echo "<tr class='tr_table'><td class='left_table'>Producent:</td><td class='right_table'>$ser_one[producer]</td></tr>";
			echo "<tr class='tr_table'><td class='left_table'>Bieżnik:</td><td class='right_table'>$ser_one[cap]</td></tr>";
			echo "<tr class='tr_table'><td class='left_table'>Producent:</td><td class='right_table'>$ser_one[producer]</td></tr>";
			echo "<tr class='tr_table'><td class='left_table'>Rozmiar:</td><td class='right_table'>$ser_one[size]</td></tr>";
			echo "<tr class='tr_table'><td class='left_table'>Sezon:</td><td class='right_table' align='center' valign='middle'>";
			if($ser_one['season'] == 1): echo "<img src='css/images/summer.png' alt='lato' height='24' width='24' class='season' />"; elseif($ser_one['season'] == 2): echo "<img src='css/images/winter.png' class='season'  height='24' width='24' alt='zima' />";  endif;
			echo "</td></tr>";
			echo "<tr class='tr_table'><td class='left_table'>Przeznaczenie:</td><td class='right_table'>$ser_one[destination]</td></tr>";
			echo "<tr class='tr_table'><td class='left_table'>Index prędkości:</td><td class='right_table'>$ser_one[speed_index]</td></tr>";
			echo "<tr class='tr_table'><td class='left_table'>Cena:</td><td class='right_table'>$ser_one[price]</td></tr>";
			echo "</table>";
			echo "<div style='clear:both;'></div>";
			if($ser_one['short_content'] != ''){
				echo "<div class='short_content'>$ser_one[short_content]</div>";
				echo "<div class='line_ajax'></div>";
			}
			echo "</div>";
		endif;
		// felgi
		if($ser_one['id_category_type'] == 2):
			echo "<table class='ajax_table' cellpadding='5px'>";
			echo "<tr class='tr_table'><td class='left_table'>Producent:</td><td class='right_table'>$ser_one[producer]</td></tr>";			
			echo "<tr class='tr_table'><td class='left_table'>Średnica felgi:</td><td class='right_table'>$ser_one[diameter_wheel]</td></tr>";
			echo "<tr class='tr_table'><td class='left_table'>Szerokość felgi:</td><td class='right_table'>$ser_one[width_wheel]</td></tr>";
			echo "<tr class='tr_table'><td class='left_table'>Rozstaw śrub:</td><td class='right_table'>$ser_one[spacing_screw]</td></tr>";
			echo "<tr class='tr_table'><td class='left_table'>Osadzenie:</td><td class='right_table'>$ser_one[seating]</td></tr>";
			echo "<tr class='tr_table'><td class='left_table'>Cena:</td><td class='right_table'>$ser_one[price]</td></tr>";

			echo "</table>";
			echo "<div style='clear:both;'></div>";
			if($ser_one['short_content'] != ''){
				echo "<div class='short_content'>$ser_one[short_content]</div>";
				echo "<div class='line_ajax'></div>";
			}
			echo "</div>";
		endif;
		if($ser_one['id_category_type'] == 3):
			echo "<table class='ajax_table' cellpadding='5px'>";
			echo "<tr class='tr_table'><td class='left_table'>Producent:</td><td class='right_table'>$ser_one[producer]</td></tr>";			
			echo "<tr class='tr_table'><td class='left_table'>Gwarancja:</td><td class='right_table'>$ser_one[warranty]</td></tr>";
			echo "<tr class='tr_table'><td class='left_table'>Napięcie:</td><td class='right_table'>$ser_one[tension]</td></tr>";
			echo "<tr class='tr_table'><td class='left_table'>Pojemność:</td><td class='right_table'>$ser_one[capacity]</td></tr>";
			echo "<tr class='tr_table'><td class='left_table'>Moc rozruchowa:</td><td class='right_table'>$ser_one[power_starter]</td></tr>";
			echo "<tr class='tr_table'><td class='left_table'>Cena:</td><td class='right_table'>$ser_one[price]</td></tr>";
			echo "</table>";
			echo "<div style='clear:both;'></div>";
			if($ser_one['short_content'] != ''){
				echo "<div class='short_content'>$ser_one[short_content]</div>";
				echo "<div class='lin'ajax'></div>";
			}
			echo "</div>";
		endif;
	
		
		
	}
		echo "</div>";
    	
	
}
  
	
	 

	


?>

