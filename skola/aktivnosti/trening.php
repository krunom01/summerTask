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
 
 select a.prezime, c.mjesto, c.vrijeme, d.naziv
 from zaposlenik a
 inner join trener b on a.sifra=b.zaposlenik
 inner join trening c on c.trener=b.sifra
 inner join kategorija d on d.sifra=c.kategorija"
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
    <th>Trener</th>
  
    </tr>
    </thead>
    <tbody>
    <?php foreach($rezultati as $red):?>
      <tr>
 
      <td data-label="Mjesto"><?php echo $red->mjesto; ?></td>
      <td data-label="Vrijeme"><?php echo $red->vrijeme; ?></td>
      <td data-label="Kategorija"><?php echo $red->naziv; ?></td>
      <td data-label="Trener"><?php echo $red->prezime; ?></td>
      
      </tr>
    <?php endforeach;?>
    </tbody>
    </table>


    <?php include_once "../../predlozak/footer.php" ?>


 


    <?php include_once "../../predlozak/skripte.php" ?>

  </body>
</html>
