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
 
 select a.sifra, b.zaposlenik, a.ime, a.prezime, a.oib,
 a.mob, a.radnomjesto, a.image
from zaposlenik a
left join trener b on b.zaposlenik=a.sifra;");

 $izraz->execute();
 $rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
 ?>
  <table>
    <thead>
    <tr>
    <th></th>
    <th>Ime</th>
    <th>Prezime</th>
  
    </tr>
    </thead>
    <tbody>
    <?php foreach($rezultati as $red):?>
      <tr>
      <td>
      <img title="Klik na sliku za promjenu" class="slika" id="s_<?php echo $red->prezime;?>" src="
      <?php if(file_exists("../../img/zaposlenici/" . $red->prezime . ".png")){
          echo $putanja . "img/zaposlenici/" . $red->prezime . ".png";
          }else{
            echo $putanja . "img/zaposlenici/nepoznato.png";
          }
          
          ?>" alt="<?php echo $red->ime . " " . $red->prezime ?>" />

      </td>
      <td><?php echo $red->ime; ?></td>
      <td title="<?php echo "OIB: " . $red->oib; ?>"><?php echo $red->prezime; ?></td>
      
      </tr>
    <?php endforeach;?>
    </tbody>
    </table>


    <?php include_once "../../predlozak/footer.php" ?>


 <div class="reveal small" id="odaberiSliku" data-reveal>

    <img id="image" src="<?php echo $putanja; ?>img/zaposlenici/nepoznato.png" alt="Picture">
    <input type="file" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
	  <a href="#" id="spremi">Spremi</a>
<button class="close-button" data-close aria-label="Zatvori" type="button">
   <span aria-hidden="true">&times;</span>
 </button>
</div>



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
          data: "prezime=" + slika.attr("id").split("_")[1] + "&slika="+result.toDataURL(),
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
