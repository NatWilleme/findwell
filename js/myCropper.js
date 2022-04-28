$("#imagePC").change(function () {
  imagePreview(this, "pc");
});

$("#imageMobile").change(function () {
  imagePreview(this, "mobile");
});

var cropperPC;
var cropperMobile;

function imagePreview(fileInput, type) {
  if (fileInput.files && fileInput.files[0]) {
    var fileReader = new FileReader();
    fileReader.onload = function (event) {
      if (type == "pc") {
        $("#previewPC").html(
          '<img id="pubPCImage" src="' +
            event.target.result +
            '" width="300" height="auto"/>'
        );
      } else {
        $("#previewMobile").html(
          '<img id="pubMobileImage" src="' +
            event.target.result +
            '" width="300" height="auto"/>'
        );
      }
    };
    fileReader.readAsDataURL(fileInput.files[0]);
    setTimeout(() => {
      var image = null;
      if (type == "pc") {
        image = document.getElementById("pubPCImage");
      } else {
        image = document.getElementById("pubMobileImage");
      }

      if (type == "pc") {
        cropperPC = new Cropper(image, {
          aspectRatio: 16 / 9
        });
      } else {
        cropperMobile = new Cropper(image, {
          aspectRatio: 9 / 16
        });
      }
    }, 100);
  }
}

document.addEventListener('click', function(clickEvent) {
    if (clickEvent.target.id == 'submit') {
        if(cropperPC != null) {
            document.getElementById("imagePCBase64").value = cropperPC.getCroppedCanvas().toDataURL();
            console.log(cropperPC.getCroppedCanvas().toDataURL());
        }
        if(cropperMobile != null) {
            document.getElementById("imagePCBase64").value = cropperMobile.getCroppedCanvas().toDataURL();
        }
    }
});
