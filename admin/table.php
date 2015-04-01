<?php
header("Content-type: text/xml; charset=UTF-8");
require('core/init.inc.php');
$presentation = new Presentation();
$presentation->setMainTpl('main/templates/clear.tpl');


$system = new SmartSystem(new Request(), new Response(), $presentation);
$system->run();


$from = 0;
$maxPerPage = 25;
$total = 0;
$mod = "";

$mod = ( isset($_GET["mod"]) && !empty( $_GET["mod"] ) ) ? trim( $_GET["mod"] ) : "";
$id_module = ( isset($_GET["id_module"]) && !empty( $_GET["id_module"] ) ) ? trim( $_GET["id_module"] ) : 0;
//	Zapisujemy do sesji aktualny nr strony i odczytujemy go z sesji
	if(isset($_GET["p"]) ) $_SESSION['paging'][$mod] = $_GET["p"];
	if(isset($_SESSION['paging'][$mod])) $_GET["p"] = $_SESSION['paging'][$mod];
	
	if(isset($_GET["s"]) ) $_SESSION['sort'][$mod] = $_GET["s"];
	if(isset($_SESSION['sort'][$mod])) $_GET["s"] = $_SESSION['sort'][$mod];
	
// #konieczapisu/odczytu sesji
$p = ( isset($_GET["p"]) && !empty( $_GET["p"] ) ) ? trim( $_GET["p"] ) : 0;
$s = ( isset($_GET["s"]) && !empty( $_GET["s"] ) ) ? trim( $_GET["s"] ) : "";

//$s = substr($s,0, -3).'COLLATE '.$_SESSION['collation'].' '.substr($s, -3);

if( !empty($mod) ) {
  if ( $mod == 'client' ) {
    $client = new ClientCollection($p,$s);
    echo $client->getXML();
  } elseif ( $mod == 'region' ) {
    $region = new RegionCollection($p,$s);
    echo $region->getXML();
     } elseif ( $mod == 'service_film' ) {
    $region = new Service_filmCollection($p,$s);
    echo $region->getXML();
  } elseif ( $mod == 'order' ) {
	$service = new OrderCollection($p,$s);
    echo $service->getXML();
  } elseif ( $mod == 'box' ) {
    $test = new BoxCollection($p,$s);
    echo $test->getXML();
  } elseif ( $mod == 'service' ) {
    $service = new ServiceCollection($p,$s);
    echo $service->getXML();
  } elseif ( $mod == 'smtp_account' ) {
    $room = new Smtp_accountCollection($p,$s);
    echo $room->getXML();
  } elseif ( $mod == 'room_type' ) {
    $room_type = new Room_typeCollection($p,$s);
    echo $room_type->getXML();
  } elseif ( $mod == 'city' ) {
    $city = new CityCollection($p,$s);
    echo $city->getXML();
  } elseif ( $mod == 'language' ) {
    $language = new LanguageCollection($p,$s);
    echo $language->getXML();
  } elseif ( $mod == 'pension_type' ) {
    $pension_type = new Pension_typeCollection($p,$s);
    echo $pension_type->getXML();
  } elseif ( $mod == 'users' ) {
    $users = new UsersCollection($p,$s);
    echo $users->getXML();
  } elseif ( $mod == 'room_price' ) {
    $room_price = new Room_priceCollection($p,$s);
    echo $room_price->getXML();
  } elseif ( $mod == 'room_price2' ) {
    $room_price2 = new Room_price2Collection($p,$s);
    echo $room_price2->getXML();
  } elseif ( $mod == 'reservations' ) {
    $reservations = new ReservationsCollection($p,$s);
    echo $reservations->getXML();
  } elseif ( $mod == 'comment' ) {
    $comment = new CommentCollection($p,$s);
    echo $comment->getXML();
  } elseif ( $mod == 'payment' ) {
    $payment = new PaymentCollection($p,$s);
    echo $payment->getXML();
  } 
} else {
  null;
}
DB::getLog();
?>