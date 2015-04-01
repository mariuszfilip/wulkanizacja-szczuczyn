<?php
define('DEBUG',0);
$_SESSION['show_debug'] = false;
include_once('core/init.inc.php');
include_once('modules/main/classes/DBObject.class.php');
include_once('modules/main/classes/DB.class.php');
include_once('modules/catalog/classes/DBObject/Catalog.class.php');
include_once('modules/service/classes/DBObject/Service.class.php');
	if (isset($_REQUEST['action'])) {
		$action = $_REQUEST['action'];
		
		switch ($action) {
			case 'get_rows':
				getRows();
				break;
			case 'row_count':
				getRowCount();
				break;
			default;
				break;
		}
		
		exit;
	} else {
		return false;
	}
	
	
	function getRowCount() {
		$service = new Service();
		$count = $service->getCountAll($_GET['id']);
		echo $count;
	}
	
	
	function getRows() {
		$start_row = isset($_REQUEST['start'])?$_REQUEST['start']:0;
		$start_row = 5 * (int)$start_row;
		
		$service_object = new Service();
		$service = $service_object->getAllPagination($_GET['id'],$start_row);
		
		echo "<div class='text'>";
			foreach($service as $ser_one){
				echo "<div class='cms_content'>";
				echo "<h1>$ser_one[name]</h1>";
				if($ser_one['picture'] != ''):
					echo "<img src='files/service/$ser_one[picture]' class='picture_ajax' />";
				endif;
				echo "<table class='ajax_table' cellpadding='5px'>";
				echo "<tr class='tr_table'><td class='left_table'>Producent:</td><td class='right_table'>$ser_one[producer]</td></tr>";
				echo "<tr class='tr_table'><td class='left_table'>Bieżnik:</td><td class='right_table'>$ser_one[cap]</td></tr>";
				echo "<tr class='tr_table'><td class='left_table'>Rozmiar:</td><td class='right_table'>$ser_one[size]</td></tr>";
				
				if($ser_one['agricultural'] == 0):
					echo "<tr class='tr_table'><td class='left_table'>Sezon:</td><td class='right_table' align='center' valign='middle'>";
					if($ser_one['season'] == 1): echo "<img src='css/images/summer.png' alt='lato' height='24' width='24' class='season' />"; elseif($ser_one['season'] == 3): echo "<img src='css/images/c.png' class='season'  height='24' width='24' alt='wielosezonowa' />"; elseif($ser_one['season'] == 2): echo "<img src='css/images/winter.png' class='season'  height='24' width='24' alt='zima' />";   endif;
					echo "</td></tr>";
				endif;
				echo "<tr class='tr_table'><td class='left_table'>Przeznaczenie:</td><td class='right_table'>$ser_one[destination]</td></tr>";
				if($ser_one['agricultural'] == 0):
					echo "<tr class='tr_table'><td class='left_table'>Indeks prędkości:</td><td class='right_table'>$ser_one[speed_index]</td></tr>";
				endif;
				echo "<tr class='tr_table'><td class='left_table'>Indeks nośności:</td><td class='right_table'>$ser_one[maxload]</td></tr>";
				if($ser_one['agricultural'] == 1):
				echo "<tr class='tr_table'><td class='left_table'>Ilość partów:</td><td class='right_table'>$ser_one[pr]</td></tr>";
				endif;
				
				echo "<tr class='tr_table'><td class='left_table'>Cena:</td><td class='right_table'>$ser_one[price]</td></tr>";
				echo "</table>";
				echo "<div style='clear:both;'></div>";
				echo "<div class='short_content'>$ser_one[short_content]</div>";
				echo "<div class='line_ajax'></div>";
				echo "</div>";
				}
	}