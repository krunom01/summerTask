<?php include_once "../konfiguracija.php" ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once "../predlozak/head.php"?>
  </head>
  <body>
  <div class="grid-container">
  <?php include_once "../predlozak/header.php"?>
   <?php include_once "../predlozak/menu.php"?>
   <?php 
   $kategorije=$veza->prepare
   ("select c.ime, c.prezime, a.naziv, a.brojpolaznika, a.sifra 
   from kategorija a
   inner join trener b on a.trener=b.sifra
   inner join zaposlenik c on c.sifra=b.zaposlenik;");
   $kategorije->execute();
   $rezKategorije = $kategorije->fetchall(PDO::FETCH_OBJ);
   ?>
  <?php
    if(isset($_SESSION["bok"])):?>
      <a class="button" href="<?php echo $putanja; ?>skola/novaKategorija.php" style="width:100%; text-align: center; ">Dodaj novu kategoriju</a>
    <?php endif ?>
    <table class="responsive-card-table unstriped">
  <thead>
    <tr>
        <th>Naziv</th>
        <th>Trener</th>
        <th>Broj polaznika</th>
        <?php if(isset($_SESSION["bok"])):?>
        <th>Izmjena/brisanje podataka</th>
        <?php endif;?>
    </tr>
  </thead>
  <tbody>
    <?php foreach($rezKategorije as $kartica): ?>
    <tr>
      <td data-label="Naziv"><?php echo $kartica->naziv ?></td>
      <td data-label="Trener"><?php echo $kartica->ime ." ".$kartica->prezime ?></td>
      <td data-label="Broj polaznika"><?php echo $kartica->brojpolaznika ?></td>
      <?php if(isset($_SESSION["bok"])):?>
      <td data-label="Izmjena/brisanje podataka">
              <a href="promjenaKategorije.php?sifra=<?php echo $kartica->sifra ?>" style="text-decorations:none; color:blue;"><i class="far fa-edit fa-2x"></i></a>
              <a style="text-decorations:none; color:inherit;" onclick="return confirm('Želite li sigurno obrisati kategoriju <?php echo $kartica->naziv ?>')"
              href="obrisiKategoriju.php?sifra=<?php echo $kartica->sifra; ?>"><i class="far fa-trash-alt fa-2x" style="color: rgba(201,12,15,.9);"></i></a>
      </td>
      <?php endif;?>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php include_once "../predlozak/footer.php"?>
<?php include_once "../predlozak/skripte.php"?>
</body>
</html>
