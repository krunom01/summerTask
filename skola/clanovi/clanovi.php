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

 $stranica=1;
 if(isset($_GET["stranica"])){
   $stranica=$_GET["stranica"];
 }

 $clanovi=$veza->prepare("select b.sifra, b.datumrodenja , a.naziv, b.ime,b.prezime,b.oib,
 b.mob,b.imeroditelja,b.prezimeroditelja
 from clan b
 inner join kategorija a on a.sifra=b.kategorija limit :stranica, 8");
 $clanovi->bindValue("stranica",($stranica*6) - 6,PDO::PARAM_INT);
 $clanovi->execute();
 $rezClanovi=$clanovi->FETCHALL(PDO::FETCH_OBJ);
 $ukupnoPolaznika = $clanovi->rowCount();
 
 $ukupnoStranica=ceil($ukupnoPolaznika/6);
 
if($stranica>$ukupnoStranica){
  $stranica=$ukupnoStranica;
}
if($stranica==0){
  $stranica=1;
}

 
?>
<a class="button" href="<?php echo $putanja; ?>skola/clanovi/noviClan.php" style="width:100%; text-align: center; ">Dodaj novog člana </a>
<table class="responsive-card-table unstriped">

  <thead>
    <tr>
        <th>Ime</th>
        <th>Prezime</th>
        <th>Datum rođenja</th>
        <th>OIB</th>
        <th>Mobitel</th>
        <th>Ime roditelja</th>
        <th>Kategorija</th>
        <th>Izmjena/brisanje podataka</th>    
    </tr>
  </thead>
  <tbody>
  
  
    <?php foreach($rezClanovi as $kartica): ?>
    
    <tr>
      <td data-label="Ime"><a href="analizaClana.php?sifra=<?php echo $kartica->sifra; ?>"><?php echo $kartica->ime ?></a></td>
      <td data-label="Prezime"><?php echo $kartica->prezime ?></td>
      <td data-label="Datum rođenja"><?php echo $kartica->datumrodenja ?></td>
      <td data-label="OIB"><?php echo $kartica->oib ?></td>
      <td data-label="Mobitel"><?php echo $kartica->mob ?></td>
      <td data-label="imeroditelja"><?php echo $kartica->imeroditelja . " " . $kartica->prezimeroditelja  ?></td>
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
    <?php 
if($ukupnoStranica==0){
  $ukupnoStranica=1;
}
?>
 <nav aria-label="Pagination" class="text-center">
  <ul class="pagination">
  <li class="pagination-previous">
  <a href="index.php?stranica=<?php echo $stranica-1; ?>" aria-label="Next page">Prethodno <span class="show-for-sr">page</span></a></li>
    <li class="current"><span class="show-for-sr">Trenutno na</span> <?php echo $stranica; ?>/<?php echo $ukupnoStranica; ?></li>
   
    <li class="pagination-next"><a href="index.php?stranica=<?php echo $stranica+1; ?>" aria-label="Next page">Sljedeće <span class="show-for-sr">page</span></a></li>
  </ul>
</nav>

<?php include_once "../../predlozak/footer.php"?>
</div>
<?php include_once "../../predlozak/skripte.php"?>
</body>
</html>
