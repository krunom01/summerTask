
<?php include_once "../../konfiguracija.php" ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
  <?php include_once "../../predlozak/head.php"?>
 
  </head>
  <body>
  <?php
  if(isset($_POST["dodaj"]))
  {
     include_once "kontrola.php";
     include_once "noviSql.php";
    
  }
  ?>
  <div class="grid-container">
  <?php include_once "../../predlozak/header.php"?>
  <?php include_once "../../predlozak/menu.php"?>
  <?php include_once "osobniPodaci.php"?>


</div>
  
<?php include_once "../../predlozak/footer.php"?>
<?php include_once "../../predlozak/skripte.php"?>

</body>
</html>
