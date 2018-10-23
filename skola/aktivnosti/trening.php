<?php include_once "../../konfiguracija.php" ;


?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once "../../predlozak/head.php" ?>
    <link rel="stylesheet" href="<?php echo $putanja; ?>css/cropper.css">
    <style>
      .slika{
        max-width: 4rem;
        cursor: pointer;
      }

    
    </style>
  </head>
  <body>
    <div class="grid-container">
      
    <?php include_once "../../predlozak/header.php" ?>

    <?php include_once "../../predlozak/menu.php" ?>



  <?php
 $izraz = $veza->prepare("
 
 select a.mjesto, a.vrijeme, b.naziv,b.sifra, a.sifra as sifratreninga
from trening a
inner join kategorija b on b.sifra=a.kategorija;"
);

 $izraz->execute();
 $rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
 ?>
 <div class="callout clearfix">
<?php if(isset($_SESSION["bok"])): ?>
  <a class="button float-right" href="<?php echo $putanja; ?>skola/aktivnosti/noviTrening.php">Dodaj novi trening</a>
<?php endif; ?>
</div>
  <table class="responsive-card-table unstriped">
    <thead>
    <tr>
    <th>Mjesto</th>
    <th>Vrijeme</th>
    <th>Kategorija</th>
    
  
    </tr>
    </thead>
    <tbody>
    <?php foreach($rezultati as $red):?>
      <tr>
 
      <td data-label="Mjesto"><?php echo $red->mjesto; ?></td>
      <td data-label="Vrijeme"><?php echo $red->vrijeme; ?></td>
      <td data-label="naziv"><?php echo $red->naziv; ?></a>
      
      
      
      </tr>
    <?php endforeach;?>
    </tbody>
    </table>


    <?php include_once "../../predlozak/footer.php" ?>


 


    <?php include_once "../../predlozak/skripte.php" ?>

  </body>
</html>
