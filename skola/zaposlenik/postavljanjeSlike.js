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