{config_load file="smarty.conf" section="admin"}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>SmartSystem v.4 - DostepnePokoje.pl</title>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<link rel='stylesheet' type='text/css' href='css/style.css' />
{literal}

	<style>

#amtc_0_option_0, #amtc_0_option_1, #amtc_0_option_2, #amtc_0_option_3
	{
	color:#68B5F2;
	}

	</style>

<script src="http://maps.google.com/maps?file=api&v=2.x&key=ABQIAAAAcR7VmOvT45qBgVT3lC_AHBScFZ7w0e4R2RNhQSgdImH8cG_2mBR5idk-5_Be9qF-FIniFc71C00VEg" type="text/javascript"></script>

<script type="text/javascript">



var map;

var marker1 =false;


var Icon = new GIcon(G_DEFAULT_ICON);
      Icon.image = "img/house.png";
	  Icon.iconSize = new GSize(32, 32);
	  Icon.iconAnchor = new GPoint(16, 32);	  
	  Icon.imageMap  = [0,23,0,4,4,0,29,0,32,3,32,22,29,26,3,26];
	  Icon.shadow = "img/house-shadow.png";
	  Icon.shadowSize = new GSize(59, 32);


var geodecoder = null;
var map = null;

 function showAddress(address) {
   geocoder.getLatLng(
     address,
     function(point) {
       if (!point) {
         alert(address + " nie zostal odnaleziony");
       } else {

         map.setCenter(point, 16);
		 if(!marker1) {
			 marker1 = new GMarker(point, {title: "ustaw ten znacznik w miejscu obiektu", icon: Icon,  draggable:true});
			 map.addOverlay(marker1);
			 document.getElementById('lat').value = marker1.getPoint().lat().toString();
			 document.getElementById('lng').value = marker1.getPoint().lng().toString();
			 marker1.openInfoWindowHtml('<div style="text-align:left;"><strong>Świetnie!</strong><br />Jeśli lokalizacja jest właściwa wciśnij przycisk <i>zatwierdź</i>, jeśli coś jeszcze wymaga poprawy przenieś znacznik we właściwe miejsce, możesz także zmienić kryteria wyszukiwania.</div>');
		 }else{
		 	marker1.setLatLng(point);
			//marker1.openInfoWindowHtml(marker1.getPoint().lat().toString() + ' :: ' + marker1.getPoint().lng().toString() );
			document.getElementById('lat').value = marker1.getPoint().lat().toString();
			document.getElementById('lng').value = marker1.getPoint().lng().toString();
		 }


		GEvent.addListener(marker1, "dragstart", function() {
	   marker1.closeInfoWindow();
        });

        GEvent.addListener(marker1, "dragend", function() {
          //marker1.openInfoWindowHtml(this.getPoint().lat().toString() + ' :: ' + this.getPoint().lng().toString() );
		  document.getElementById('lat').value = marker1.getPoint().lat().toString();
		  document.getElementById('lng').value = marker1.getPoint().lng().toString();
        });


       }
     }
   );
 }






function load() {
  map = new GMap2(document.getElementById("map"));

  map.addMapType(G_PHYSICAL_MAP)
  
  map.enableScrollWheelZoom();
  if(parent.document.getElementById('lat').value!='') {
  	map.setCenter(new GLatLng(parent.document.getElementById('lat').value, parent.document.getElementById('lng').value), 15);
	
	var marker1 = new GMarker(new GLatLng(parent.document.getElementById('lat').value, parent.document.getElementById('lng').value), {title: 'obecna lokalizacja', icon: Icon , draggable:true});
 		
   GEvent.addListener(marker1, "dragend", function() {
          //marker1.openInfoWindowHtml(this.getPoint().lat().toString() + ' :: ' + this.getPoint().lng().toString() );
		  document.getElementById('lat').value = marker1.getPoint().lat().toString();
		  document.getElementById('lng').value = marker1.getPoint().lng().toString();
        });
	map.addOverlay(marker1);
		
		
  } else map.setCenter(new GLatLng(52, 18.7), 6);
  
  map.addControl(new GOverviewMapControl(new GSize(200,150)));

  map.addControl(new GLargeMapControl());
  map.addControl(new GMapTypeControl());

  geocoder = new GClientGeocoder();
  

}







var markersArray = [];
var maxNum = 50;
var num = 0;

function loadMarkers(){
  setTimeout('createMarker()', 10);
}

function createMarker(){




		icon = new GIcon();
          icon.image = "img/pasek.png";
          
          icon.iconSize = new GSize(201, 36);
          icon.shadow = "img/pasek_tlo.png";
          icon.shadowSize = new GSize(201, 36);






  num++;
  //progressBar.updateLoader(1);

  var bounds = map.getBounds();
  var southWest = bounds.getSouthWest();
  var northEast = bounds.getNorthEast();
  var lngSpan = northEast.lng() - southWest.lng();
  var latSpan = northEast.lat() - southWest.lat();
  var latlng = new GLatLng(southWest.lat() + latSpan * Math.random(), 
      southWest.lng() + lngSpan * Math.random());
  var marker = new GMarker(latlng, {title: 'tekst', icon: Icon , draggable:false});

 		
  GEvent.addListener(marker, "click", function() {
          marker.openInfoWindowHtml('<div class="dymek"><strong>Współbrzędne</strong>'+ this.getPoint().lat().toString() + '<br />' + this.getPoint().lng().toString()+'</div>' );
        });
  
  
  markersArray.push(marker);
  map.addOverlay(marker);

  if (num < maxNum) {
    setTimeout('createMarker()', 25);
  } else {
    //progressBar.remove();
    num = 0;
  }
}


function removeMarkers(){
  //progressBar.start(markersArray.length);
  setTimeout("removeMarker()", 25);
}


function removeMarker(){
  //progressBar.updateLoader(1);
  map.removeOverlay(markersArray.pop());
  if (markersArray.length > 0) {
    setTimeout("removeMarker()", 25);
  } else {
    //progressBar.remove();
  }
}
</script>

{/literal}



</head>

<body onload="load()" onunload="GUnload()">

<div id="loader_js" style="text-align:center; display:none; vertical-align:middle; z-index:99999; opacity: 0.45; position:absolute; left:50%; top:50%; width:75px; height:66px; background: url(css/img/sns_logo.png); background-repeat:no-repeat;"><img style="padding-top:28px;" src="css/img/ajax-loader.gif" /></div>



<table id="popup_table" border='0' cellspacing='0' cellpadding='0' style='width:98%; margin-left:1%;'>
	<tr>
		<td style='vertical-align: top;width: 100%'>
		{include file="main/templates/popup-menu-top.tpl"}
			<table border='0' cellspacing='0' cellpadding='0' style='width: 100%;'>
				<tr>
					<td class='box-l'></td>
					<td class='box-content' style='text-align: center;'>
                     
             <div style="text-align:left; width:100%">     
             
<table cellpadding="0" cellspacing="0" width="100%">
<tr valign="middle">
<td>   
                     
                     <form onsubmit="showAddress(this.address.value); return false" action="#">
<input type="text" id="address" value="Wpisz adres obiektu... (np: stefana żeromskiego 52, łódź)" name="address" size="68" style="color:#999;" onclick="if(this.value=='Wpisz adres obiektu... (np: stefana żeromskiego 52, łódź)') this.value=''" onblur="if(this.value=='') this.value='Wpisz adres obiektu... (np: stefana żeromskiego 52, łódź)'"/> <script type="text/javascript">document.getElementById('address').select();nowy=1;</script>
&nbsp;<input class="form-button" style="color:green;" type="submit" value="Znajdź na mapie"/> </td>
<td align="right"><img class="icon" onmouseout="this.src='css/img/ico-zatwierdz.gif'" onmouseover="this.src='css/img/ico-zatwierdz-over.gif'" onclick="parent.document.getElementById('lat').value=document.getElementById('lat').value; parent.document.getElementById('lng').value=document.getElementById('lng').value; parent.myLytebox.end(); return false;" src="css/img/ico-zatwierdz.gif" style="margin-bottom:0px;"/>&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
</form>

<input type="hidden" name="lat" id="lat" />
<input type="hidden" name="lng" id="lng" />
<script type="text/javascript">

	document.getElementById('lat').value=parent.document.getElementById('lat').value;
	document.getElementById('lng').value=parent.document.getElementById('lng').value;

</script>
</div>


 <br/>
 <div id="map" style="width: 99%; height: 490px"></div>
                     
					 
	        </td>
					<td class='box-r'></td>
				</tr>
				<tr>
					<td class='box-bl'></td>
					<td class='box-b'></td>
					<td class='box-br'></td>
				</tr>
			</table>
		</td>
	</tr>
</table>


</body>
</html>
