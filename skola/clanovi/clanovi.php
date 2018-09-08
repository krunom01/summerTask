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

 $clanovi=$veza->prepare("select b.sifra, a.naziv, b.ime,b.prezime,b.oib,
 b.email,b.mob,b.imeroditelja,b.prezimeroditelja,b.brojugovora,
 b.placenaclanarina
 from clan b
 inner join kategorija a on a.sifra=b.kategorija;");
 $clanovi->execute();
 $rezClanovi=$clanovi->FETCHALL(PDO::FETCH_OBJ);
?>
<a class="button" href="<?php echo $putanja; ?>skola/zaposlenik/noviClan.php" style="width:100%; text-align: center; ">Dodaj novog zaposlenika </a>
<table class="responsive-card-table unstriped">

  <thead>
    <tr>
        <th>Ime</th>
        <th>Prezime</th>
        <th>OIB</th>
        <th>Email</th>
        <th>Mobitel</th>
        <th>Ime roditelja</th>
        <th>Broj Ugovora</th>
        <th>Kategorija</th>
        <th>Izmjena/brisanje podataka</th>    
    </tr>
  </thead>
  <tbody>
  
  
    <?php foreach($rezClanovi as $kartica): ?>
    
    <tr>
      <td data-label="Prezime"><?php echo $kartica->ime ?></td>
      <td data-label="Prezime"><?php echo $kartica->prezime ?></td>
      <td data-label="OIB"><?php echo $kartica->oib ?></td>
      <td data-label="Email"><?php echo $kartica->email ?></td>
      <td data-label="Mobitel"><?php echo $kartica->mob ?></td>
      <td data-label="imeroditelja"><?php echo $kartica->imeroditelja . " " . $kartica->prezimeroditelja  ?></td>
      <td data-label="brojugovora"><?php echo $kartica->brojugovora ?></td>
      <td data-label="kategorija"><?php echo $kartica->naziv ?></td>
      <td data-label="Izmjena/brisanje podataka">
      <a href="promjenaClana.php?sifra=<?php echo $kartica->sifra ?>" style="text-decorations:none; color:inherit;">
      <i class="far fa-edit fa-2x"></i></a>
      <a onclick="return confirm('Sigurno obrisati <?php echo $kartica->prezime . " " . 
      $kartica->ime ?>')" href="obrisiClana.php?sifra=<?php echo $kartica->sifra; ?>">
      <i class="far fa-trash-alt fa-2x" style="color: rgba(201,12,15,.9);"></i>
      </a>
        
     
      
      </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    </table>


<?php include_once "../../predlozak/footer.php"?>
</div>
<?php include_once "../../predlozak/skripte.php"?>
</body>
</html>
