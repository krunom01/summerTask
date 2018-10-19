<?php include_once "../../konfiguracija.php" ?>
<!doctype html>
  <html class="no-js" lang="en" dir="ltr">
  <head>
<?php include_once "../../predlozak/head.php"?>
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
<?php include_once "../../predlozak/header.php";
 include_once "../../predlozak/menu.php";

 $uvjet="";
 if(isset($_GET["uvjet"])){
   $uvjet = $_GET["uvjet"];
 }

?>

<div class="callout clearfix">
<a class="button float-left" style="padding:0px; background-color: black;"  ><input type="text" id="uvjet" placeholder="traži člana..."></a>
<a class="button float-left" id="trazi" href="#" ><i class="fas fa-search"></i></a>
  <a class="button float-right" href="<?php echo $putanja; ?>skola/zaposlenik/noviZaposlenik.php">Dodaj novog zaposlenika</a>
</div>



 



<table class="responsive-card-table unstriped">

  <thead>
    <tr>
        <th></th>
        <th>Ime</th>
        <th>Prezime</th>
        <th>Mobitel</th>
        <th>Radno mjesto</th>
        <th>Izmjena/brisanje</th>
          
    </tr>
  </thead>
  <tbody id="podaci">
  
  

    </tbody>
    </table>
    <?php 

?>
    <nav aria-label="Pagination" class="text-center">
  <ul class="pagination">
  <li class="pagination-previous">
  <a id="prethodni" href="#" aria-label="Next page">Prethodno <span class="show-for-sr">page</span></a></li>
    <li class="current"><span class="show-for-sr">Trenutno na</span> <span id="trenutna"></span>/<span id="ukupno"></span></li>
   
    <li class="pagination-next"><a href="#" id="sljedeci" aria-label="Next page">Sljedeće <span class="show-for-sr">page</span></a></li>
  </ul>
</nav>

<?php include_once "../../predlozak/footer.php"?>
</div>
<div class="reveal small" id="odaberiSliku" data-reveal>
    <img id="image" src="<?php echo $putanja; ?>img/zaposlenici/nepoznato.png" alt="Picture">
    <input type="file" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
	  <a href="#" id="spremi">Spremi</a>
<button class="close-button" data-close aria-label="Zatvori" type="button">
   <span aria-hidden="true">&times;</span>
 </button>
</div>
<?php include_once "../../predlozak/skripte.php"?>
<script>

var stranica=1;
    $("#trenutna").html(stranica);

     $("#prethodni").click(function(){
      stranica--;
      if(stranica==0){
        stranica=1;
       
      }
      dohvatiPodatke(stranica,$("#uvjet").val());
       return false;
     });

      $("#sljedeci").click(function(){
      stranica++;
      if(stranica>parseInt($("#ukupno").html())){
        stranica=parseInt($("#ukupno").html());
        
      }
      dohvatiPodatke(stranica,$("#uvjet").val());
       return false;
     }
     
     );

       $("#trazi").click(function(){
      stranica=1;
      dohvatiPodatke(stranica,$("#uvjet").val());
      
      return false;
      
    });
    
  
    

function dohvatiPodatke(stranica,uvjet){

$.ajax({
  type: "POST",
  url: "trazi.php",
  data: "stranica=" + stranica + "&uvjet=" + uvjet,
  success: function(vratioServer){
    var sve = JSON.parse(vratioServer)
    $("#ukupno").html(sve.ukupnoStranica);
    $("#trenutna").html(stranica);
    var tbody = document.getElementById("podaci");
    while (tbody.firstChild) {
                tbody.removeChild(tbody.firstChild);
            }
   
    $.each(sve.podaci,function(kljuc,p){
      var tr = document.createElement("tr");

var td = document.createElement("td");
img = document.createElement("img");
img.setAttribute("title","klikni za promjenu");
img.setAttribute("class","slika");
img.setAttribute("id","s_" + p.sifra);
img.setAttribute("onerror","this.src='../../img/zaposlenici/nepoznato.png';");
img.setAttribute("src","../../img/zaposlenici/" + p.sifra + ".png");
img.setAttribute("alt", p.prezime );


td.appendChild(img);
tr.appendChild(td);

var td = document.createElement("td");

tr.appendChild(dodajCeliju(p.ime)).setAttribute("data-label", "Ime");
tr.appendChild(dodajCeliju(p.prezime)).setAttribute("data-label", "Prezime");
tr.appendChild(dodajCeliju(p.mob)).setAttribute("data-label", "Mobitel");
tr.appendChild(dodajCeliju(p.radnomjesto)).setAttribute("data-label", "Radno mjesto");
var td = document.createElement("td");
var a = document.createElement("a");
a.setAttribute("href","promjenaZaposlenika.php?sifra=" + p.sifra);
var i = document.createElement("i");
i.setAttribute("class","fas fa-edit fa-2x");
a.appendChild(i);
td.appendChild(a);

a = document.createElement("a");
a.setAttribute("onclick","return confirm('Sigurno obrisati " + p.ime + " " + p.prezime + "')");
a.setAttribute("href","obrisiZaposlenika.php?sifra=" + p.sifra);
i = document.createElement("i");
i.setAttribute("class","far fa-trash-alt fa-2x");
i.setAttribute("style","color: #DE1829;");
a.appendChild(i);
td.appendChild(a);
tr.appendChild(td);



tbody.appendChild(tr);
        
     
        
    });
  }

  
});

}


dohvatiPodatke(stranica,"");



function dodajCeliju(tekst){
  var td= document.createElement("td");
  var tekst = document.createTextNode(tekst==null ? "" : tekst);
  td.appendChild(tekst);
  return td;
}

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

<script src="https://fengyuanchen.github.io/js/common.js"></script>
  <script src="<?php echo $putanja; ?>cropper/js/cropper.js"></script>
</body>
</html>


 