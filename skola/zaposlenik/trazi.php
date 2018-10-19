<?php include_once "../../konfiguracija.php";

 

 $izraz=$veza->prepare("select b.sifra,  b.ime,b.prezime,b.oib, b.mob, b.radnomjesto
 from zaposlenik b
  where concat(b.ime, ' ',b.prezime) like :uvjet  
 order by b.ime,b.prezime limit :stranica, 10  ");
 $izraz->bindValue("stranica",($_POST["stranica"]*10) - 10,PDO::PARAM_INT);
 $izraz->bindValue("uvjet","%" . $_POST["uvjet"] . "%");
 
 $izraz->execute();
 $rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
 

 $izraz=$veza->prepare("select count(b.sifra)
 from zaposlenik b
 where concat(b.ime, ' ',b.prezime) like :uvjet  
 ");
 $izraz->execute(array("uvjet"=>"%" . $_POST["uvjet"] . "%"));
 $ukupnoPolaznika = $izraz->fetchColumn();
$ukupnoStranica=ceil($ukupnoPolaznika/10);
if($ukupnoStranica==0){
    $ukupnoStranica=1;
}
$vrati = new stdClass();

$vrati->podaci= $rezultati;
$vrati->ukupnoStranica = $ukupnoStranica;

echo json_encode($vrati);

?>

