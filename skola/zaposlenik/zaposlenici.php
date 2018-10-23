<?php include_once "../../konfiguracija.php" ;

$stranica=1;
if(isset($_GET["stranica"])){
  $stranica=$_GET["stranica"];
}


$uvjet="";
if(isset($_GET["uvjet"])){
  $uvjet=$_GET["uvjet"];
}

$izraz = $veza->prepare("
 
 select count(sifra) from zaposlenik where concat(ime, ' ', prezime) like :uvjet ;
 ");
 $izraz->execute(array("uvjet"=>"%" . $uvjet . "%"));
 $ukupnoPolaznika = $izraz->fetchColumn();
$ukupnoStranica=ceil($ukupnoPolaznika/10);
if($stranica>$ukupnoStranica){
  $stranica=$ukupnoStranica;
}
if($stranica==0){
  $stranica=1;
}

?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once "../../predlozak/head.php" ?>
    <link rel="stylesheet" href="<?php echo $putanja; ?>cropper/css/cropper.css">
    <style>
      .slika{
        max-width: 4rem;
        cursor: pointer;
      }

      .cropper-container, .cropper-bg{
        width: 300px !important;
        height: 300px !important;
      }
    </style>
  </head>
  <body>
  <?php
 $izraz = $veza->prepare("
 
 select a.sifra,b.zaposlenik, a.ime, a.prezime, a.oib, a.mob, a.radnomjesto, a.ziroracun
    from zaposlenik a
    left join trener b on b.zaposlenik=a.sifra
  where concat(a.ime, ' ',a.prezime) like :uvjet  
  order by a.ime,a.prezime limit :stranica, 10 
 ");

 $izraz->bindValue("stranica",($stranica*10) - 10,PDO::PARAM_INT);
 $izraz->bindValue("uvjet","%" . $uvjet . "%");
 $izraz->execute();
 $rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);

 ?>
    <div class="grid-container">
      
    <?php include_once "../../predlozak/header.php";?>

    <?php include_once "../../predlozak/menu.php" ?>
<?php if(isset($_SESSION["bok"])): ?>
  <div class="callout clearfix">
<form action="<?php echo $_SERVER["PHP_SELF"] ?>">
<a class="button float-left" style="padding:0px; background-color: black;"  > <input type="text" name="uvjet" value="<?php echo $uvjet ?>"></a>
<input type="submit" value="Traži" class="button float-left"/>
</form>
  <a class="button float-right" href="<?php echo $putanja; ?>skola/zaposlenik/noviZaposlenik.php">Dodaj novog zaposlenika</a>
</div>

 
  <table class="responsive-card-table unstriped">
    <thead>
    <tr>
    <th></th>
    <th>Ime</th>
    <th>Prezime</th>
    <td >Mobitel</td>
    <th>Radno mjesto</th>
    <th>Izmjena podataka</th>
   

    
    
    </tr>
    </thead>
    <tbody>
    <?php foreach($rezultati as $red):?>
      <tr>
      <td>
      <img title="Klik na sliku za promjenu" class="slika" id="s_<?php echo $red->sifra;?>" src="<?php 
         if(file_exists("../../img/zaposlenici/" . $red->sifra . ".png")){
          echo $putanja . "img/zaposlenici/" . $red->sifra . ".png";
          }else{
            echo $putanja . "img/zaposlenici/nepoznato.png";
          }
          
          ?>" alt="<?php echo $red->ime . " " . $red->prezime ?>" />

      </td>
      <td data-label="Ime"><?php echo $red->ime; ?></td>
      <td data-label="Prezime" title="<?php echo "OIB: " . $red->oib; ?>"><?php echo $red->prezime; ?></td>
      <td data-label="Mobitel" ><?php echo $red->mob; ?></td>
      <td data-label="Radno mjesto"><?php if($red->radnomjesto==1){echo "Uprava";}else{echo "Trener";} ?></td>
      
      <td data-label="Izmjena podataka">
      <input type="hidden" name="radnomjesto" value="<?php echo $kartica->radnomjesto ?>">
      
      <a href="promjenaZaposlenika.php?sifra=<?php echo $red->sifra ?>" style="text-decorations:none; color:inherit;"><i class="far fa-edit fa-2x"></i></a>
              <a style="text-decorations:none; color:inherit;"
              <?php if($red->radnomjesto==1):?>
              onclick="return confirm('Želite li sigurno obrisati zaposlenika <?php echo $red->ime . " " . $red->prezime; ?>')"
              href="obrisiZaposlenika.php?sifra=<?php echo $red->sifra ?>"
              <?php else: ?>
              onclick="return confirm('Želite li sigurno obrisati trenera i zaposlenika <?php echo $red->ime . " " . $red->prezime; ?>')"
              href="obrisiZaposlenika.php?sifra=<?php echo $red->sifra."&zaposlenik=".$red->zaposlenik ?>"
              <?php endif;?>
              >
      <i class="far fa-trash-alt fa-2x" style="color: rgba(201,12,15,.9);"></i></a>
      
      </td>
      </tr>
    <?php endforeach;?>
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
  <a href="zaposlenici.php?stranica=<?php echo $stranica-1; ?>&uvjet=<?php echo $uvjet ?>" aria-label="Next page">Prethodno <span class="show-for-sr">page</span></a></li>
    <li class="current"><span class="show-for-sr">Trenutno na</span> <?php echo $stranica; ?>/<?php echo $ukupnoStranica; ?></li>
   
    <li class="pagination-next"><a href="zaposlenici.php?stranica=<?php echo $stranica+1; ?>&uvjet=<?php echo $uvjet ?>" aria-label="Next page">Sljedeće <span class="show-for-sr">page</span></a></li>
  </ul>
</nav>
<?php else: ?>
<h3>Uprava</h3>
<div class="grid-x grid-padding-x small-up-1 medium-up-3">
  <?php foreach($rezultati as $red): ?>
  <?php if($red->radnomjesto==1): ?>

    <div class="cell">
      <div class="card">
      <img title="Klik na sliku za promjenu" class="slika" style=" max-width: 10rem !important;" id="s_<?php echo $red->sifra;?>" src="<?php 
         if(file_exists("../../img/zaposlenici/" . $red->sifra . ".png")){
          echo $putanja . "img/zaposlenici/" . $red->sifra . ".png";
          }else{
            echo $putanja . "img/zaposlenici/nepoznato.png";
          }
          
          ?>" alt="<?php echo $red->ime . " " . $red->prezime ?>" />
          <div class="card-section">
            <h4><?php echo $red->ime." " . $red->prezime;?></h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sit amet lorem condimentum, tincidunt dui eu, volutpat erat. Duis ultricies pretium sapien. Ut malesuada velit augue, id sodales nisl ultrices nec. Duis nulla quam, hendrerit eget ligula vestibulum, congue fermentum est. Sed tempor
               congue purus vitae luctus. Vivamus at leo ut ligula euismod tempus. Vestibulum nec sodales diam, vel placerat sem.</p>
          </div>
      </div>
    </div>
    
        <?php endif; ?>  
  <?php endforeach ;?>    
</div>


<?php endif; ?>
    <?php include_once "../../predlozak/footer.php" ?>

<?php if(isset($_SESSION["bok"])): ?>
 <div class="reveal small" id="odaberiSliku" data-reveal>

    <img id="image" src="<?php echo $putanja; ?>img/zaposlenici/nepoznato.png" alt="Picture">
    <input type="file" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
	  <a href="#" id="spremi">Spremi</a>
<button class="close-button" data-close aria-label="Zatvori" type="button">
   <span aria-hidden="true">&times;</span>
 </button>
</div>
<?php endif; ?>


    <?php include_once "../../predlozak/skripte.php" ?>
  <script src="https://fengyuanchen.github.io/js/common.js"></script>
 
    <script src="<?php echo $putanja; ?>cropper/js/cropper.js"></script>
    <script>
	$(function () {
  'use strict';

var slika;
  $(".slika").click(function(){
    slika=$(this);
    $('#odaberiSliku').foundation("open");

    return false;
  });

    
    $("#spremi").click(function(){

      var opcije = { "width": 200, "height": 200 };
      var result = $image.cropper("getCroppedCanvas", opcije, opcije);
      
      $.ajax({
          type: "POST",
          url: "spremiSliku.php",
          data: "sifra=" + slika.attr("id").split("_")[1] + "&slika="+result.toDataURL(),
          success: function(vratioServer){
            //console.log(vratioServer);
            if (vratioServer==="OK"){
              slika.attr("src",result.toDataURL());
              $('#odaberiSliku').foundation("close");
            }
            
          }
        });
      

      return false;
    });

  var console = window.console || { log: function () {} };
  var URL = window.URL || window.webkitURL;
  var $image = $('#image');
  var options = {
    aspectRatio: 1 / 1
  };

var originalImageURL = $image.attr('src');
  var uploadedImageName = 'cropped.jpg';
  var uploadedImageType = 'image/jpeg';
  var uploadedImageURL;


  // Cropper
  $image.on({
    
  }).cropper(options);

  
  // Import image
  var $inputImage = $('#inputImage');

  if (URL) {
    $inputImage.change(function () {
      var files = this.files;
      var file;

      if (!$image.data('cropper')) {
        return;
      }

      if (files && files.length) {
        file = files[0];

        if (/^image\/\w+$/.test(file.type)) {
          uploadedImageName = file.name;
          uploadedImageType = file.type;

          if (uploadedImageURL) {
            URL.revokeObjectURL(uploadedImageURL);
          }

          uploadedImageURL = URL.createObjectURL(file);
          $image.cropper('destroy').attr('src', uploadedImageURL).cropper(options);
          $inputImage.val('');
        } else {
          window.alert('Please choose an image file.');
        }
      }
    });
  } else {
    $inputImage.prop('disabled', true).parent().addClass('disabled');
  }
  

  
});

  </script>
  </body>
</html>
