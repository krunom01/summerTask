<?php include_once "../../konfiguracija.php" ?>
<!doctype html>
  <html class="no-js" lang="en" dir="ltr">
  <head>
<?php include_once "../../predlozak/head.php"?>
  </head>
  <body>
<div class="grid-container">
<?php include_once "../../predlozak/header.php";
 include_once "../../predlozak/menu.php";
$analiza=$veza->prepare("select * from clan where sifra =:sifra;");
$analiza->execute();

?>




<?php include_once "../../predlozak/footer.php"?>
</div>
<?php include_once "../../predlozak/skripte.php"?>
</body>
</html>
