<?php include_once "konfiguracija.php"?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once "predlozak/head.php"?>
  </head>
  <body>
  <div class="grid-container">
   <?php include_once "predlozak/header.php"?>
   <?php include_once "predlozak/menu.php"?>  
   <div id="map" style="width:50%;height:250px; margin: 0 auto;">
<script>
function myMap() {
  var myCenter = new google.maps.LatLng(45.544418, 18.696316);
  var mapCanvas = document.getElementById("map");
  var mapOptions = {center: myCenter, zoom: 15};
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({position:myCenter});
  marker.setMap(map);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpRnWIS9p9FFtHxApH8SHZghxX2FsakC0&callback=myMap"></script>
  </div>


   

 
 <?php include_once "predlozak/footer.php"?>
 
  </div>
 
 <?php include_once "predlozak/skripte.php"?>
  </body>
</html>
