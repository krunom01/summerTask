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
?>
<div class="callout clearfix">
<a class="button float-left" style="padding:0px; background-color: black;"  ><input type="text" placeholder="traži člana..."></a>
<a class="button float-left" ><i class="fas fa-search"></i></a>
  <a class="button float-right" href="<?php echo $putanja; ?>skola/clanovi/noviClan.php">Dodaj novog člana</a>
</div>




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
        <th></th>    
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
<?php include_once "../../predlozak/skripte.php"?>
<script>

var stranica = 1;

$("#trenutna").html(stranica);

$("#prethodni").click(function(){
  stranica--;
      if(stranica==0){
        stranica=1;
      }
    dohvatiPodatke(stranica);
    return false;
});
$("#sljedeci").click(function(){
  stranica++;
  if(stranica>parseInt($("#ukupno").html())){
        stranica=parseInt($("#ukupno").html());
      }
      dohvatiPodatke(stranica);
       return false;
});

function dohvatiPodatke(stranica){

  $.ajax({
    type: "POST",
    url: "trazi.php",
    data: "stranica=" + stranica,
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

          tr.appendChild(dodajCeliju(p.ime)).setAttribute("data-label", "Ime");
          tr.appendChild(dodajCeliju(p.prezime)).setAttribute("data-label", "Prezime");
          var datum = new Date(p.datumrodenja);
          var mjesec = datum.getMonth();
          mjesec++;
          var formatDatuma = datum.getDate() + "." + mjesec + "." + datum.getFullYear();
          tr.appendChild(dodajCeliju(formatDatuma)).setAttribute("data-label", "Datum rođenja");
          tr.appendChild(dodajCeliju(p.oib)).setAttribute("data-label", "OIB");
          tr.appendChild(dodajCeliju(p.mob)).setAttribute("data-label", "mobitel");
          tr.appendChild(dodajCeliju(p.imeroditelja + " " + p.prezimeroditelja)).setAttribute("data-label", "Ime roditelja");
          tr.appendChild(dodajCeliju(p.naziv)).setAttribute("data-label", "Kategorija");
          

          var td = document.createElement("td");
          var a = document.createElement("a");
          a.setAttribute("href","promjenaClana.php?sifra=" + p.sifra);
          var i = document.createElement("i");
          i.setAttribute("class","fas fa-edit fa-2x");
          a.appendChild(i);
          td.appendChild(a);

          a = document.createElement("a");
          a.setAttribute("onclick","return confirm('Sigurno obrisati " + p.ime + " " + p.prezime + "')");
          a.setAttribute("href","obrisiClana.php?sifra=" + p.sifra);
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


dohvatiPodatke(stranica);



function dodajCeliju(tekst){
  var td= document.createElement("td");
  var tekst = document.createTextNode(tekst==null ? "" : tekst);
  td.appendChild(tekst);
  return td;
}




</script>
</body>
</html>


 