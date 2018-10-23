<?php include_once "../../konfiguracija.php" ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once "../../predlozak/head.php"?>
    <link rel="stylesheet" href="<?php echo $putanja; ?>cropper/css/cropper.css">
    <style>
   
.card-info {
  background: #fefefe;
  border: 1px solid #8a8a8a;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
  margin: 1rem 0;
  overflow: hidden;
  border-radius: 0;
  color:black;
}

.card-info .card-info-label {
  border-color: transparent #8a8a8a transparent transparent;
  border-color: rgba(255, 255, 255, 0) #8a8a8a rgba(255, 255, 255, 0) rgba(255, 255, 255, 0);
}

.card-info.primary {
  border-color: #1779ba;
}

.card-info.primary .card-info-label {
  border-color: transparent #1779ba transparent transparent;
  border-color: rgba(255, 255, 255, 0) #1779ba rgba(255, 255, 255, 0) rgba(255, 255, 255, 0);
}

.card-info.secondary {
  border-color: #767676;
}

.card-info.secondary .card-info-label {
  border-color: transparent #767676 transparent transparent;
  border-color: rgba(255, 255, 255, 0) #767676 rgba(255, 255, 255, 0) rgba(255, 255, 255, 0);
}

.card-info.info {
  border-color: #37a0e6;
}

.card-info.info .card-info-label {
  border-color: transparent #37a0e6 transparent transparent;
  border-color: rgba(255, 255, 255, 0) #37a0e6 rgba(255, 255, 255, 0) rgba(255, 255, 255, 0);
}

.card-info.alert {
  border-color: #cc4b37;
}

.card-info.alert .card-info-label {
  border-color: transparent #cc4b37 transparent transparent;
  border-color: rgba(255, 255, 255, 0) #cc4b37 rgba(255, 255, 255, 0) rgba(255, 255, 255, 0);
}

.card-info.success {
  border-color: #3adb76;
}

.card-info.success .card-info-label {
  border-color: transparent #3adb76 transparent transparent;
  border-color: rgba(255, 255, 255, 0) #3adb76 rgba(255, 255, 255, 0) rgba(255, 255, 255, 0);
}

.card-info.warning {
  border-color: #ffae00;
}

.card-info.warning .card-info-label {
  border-color: transparent #ffae00 transparent transparent;
  border-color: rgba(255, 255, 255, 0) #ffae00 rgba(255, 255, 255, 0) rgba(255, 255, 255, 0);
}

.card-info .card-info-label {
  border-style: solid;
  border-width: 0 4.375rem 2.5rem 0;
  float: right;
  height: 0px;
  width: 0px;
  -webkit-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
          transform: rotate(360deg);
}

.card-info .card-info-content {
  padding: 0.5rem 1.5rem 0.875rem;
}

.card-info .card-info-label-text {
  color: #fefefe;
  font-size: 0.75rem;
  font-weight: bold;
  position: relative;
  right: -2.5rem;
  top: 2px;
  white-space: nowrap;
  -webkit-transform: rotate(30deg);
      -ms-transform: rotate(30deg);
          transform: rotate(30deg);
}

    
      .slika{
        max-width: 15rem;
        cursor: pointer;
      }

      .cropper-container, .cropper-bg{
        width: 200px !important;
        height: 200px !important;
      }
    

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#hide").click(function(){
        $("p").hide();
    });
    $("#show").click(function(){
        $("p").show();
    });
});
</script>
  </head>
  <body>
  <div class="grid-container">
  
  <?php include_once "../../predlozak/header.php"?>
   <?php include_once "../../predlozak/menu.php"?>
   <?php 
   $kategorije=$veza->prepare
   (" select c.ime, c.prezime, a.naziv, a.sifra
   from kategorija a
   inner join trener b on a.trener=b.sifra
   inner join zaposlenik c on c.sifra=b.zaposlenik
   ");
   $kategorije->execute();
   $rezKategorije = $kategorije->fetchall(PDO::FETCH_OBJ);
   $kategorije=$veza->prepare
   (" select c.ime, c.prezime, a.naziv, a.sifra
   from kategorija a
   inner join trener b on a.trener=b.sifra
   inner join zaposlenik c on c.sifra=b.zaposlenik
   ");
   $kategorije->execute();
   $rezKategorije = $kategorije->fetchall(PDO::FETCH_OBJ);
   ?>
  
   
     <div class="callout clearfix">

<a href="../../index.php" class="button float-left">Nazad</a>
<?php if(isset($_SESSION["bok"])):?>
  <a class="button float-right" href="<?php echo $putanja; ?>skola/kategorija/novaKategorija.php">Dodaj novu kategoriju</a>
  <?php endif ?>
</div>
    
    <?php foreach($rezKategorije as $rez): ?>
    <div class="card-info alert">
 
  <div class="card-info-content">
    <h3 class="lead"><?php echo $rez->naziv ?></h3>
    <img title="Klik na sliku za promjenu" class="slika" id="s_<?php echo $rez->sifra;?>" src="<?php 
         if(file_exists("../../img/kategorije/" . $rez->sifra . ".png")){
          echo $putanja . "img/kategorije/" . $rez->sifra . ".png";
          }else{
            echo $putanja . "img/kategorije/nepoznato.png";
          }
          
          ?>" alt="<?php echo $rez->naziv  ?>" />
    <h4 class="lead">Trener:<?php echo " ". $rez->ime . " " . $rez->prezime  ?></h4>
    <button id="hide">Hide</button>
    <button id="show">Show</button>
    <p>The Death Star was a moon-sized Imperial military battlestation armed with a planet-destroying superlaser.</p>
    <button id="show">Pregled igrača</button>
  </div>
  </div>
  <?php endforeach; ?>
  <?php if(isset($_SESSION["bok"])): ?>
  <div class="reveal small" id="odaberiSliku" data-reveal>

    <img id="image" src="<?php echo $putanja; ?>img/kategorije/nepoznato.png" alt="Picture">
    <input type="file" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
	  <a href="#" id="spremi">Spremi</a>
<button class="close-button" data-close aria-label="Zatvori" type="button">
   <span aria-hidden="true">&times;</span>
 </button>
</div>
        <?php endif; ?>
</div>
<?php include_once "../../predlozak/footer.php"?>
<?php include_once "../../predlozak/skripte.php"?>
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
