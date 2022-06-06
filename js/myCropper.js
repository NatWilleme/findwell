$("#imagePC").change(function () {
  imagePreview(this, "pc");
});

$("#imageMobile").change(function () {
  imagePreview(this, "mobile");
});

$("#imagePopup").change(function () {
  imagePreview(this, "popup");
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
      } else if (type == "mobile"){
        $("#previewMobile").html(
          '<img id="pubMobileImage" src="' +
            event.target.result +
            '" width="300" height="auto"/>'
        );
      } else if (type == "popup"){
        $("#previewPopup").html(
          '<img src="' +
            event.target.result +
            '" width="300" height="auto"/>'
        );
        var oldImagePopup = document.getElementById("oldImagePopup");
        oldImagePopup.parentNode.removeChild(oldImagePopup);
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
          aspectRatio: 16 / 9,
        });
      } else {
        cropperMobile = new Cropper(image, {
          aspectRatio: 9 / 16,
        });
      }
    }, 100);
  }
}

document.addEventListener("click", function (clickEvent) {
  if (clickEvent.target.id == "submit") {
    if (cropperPC != null && cropperMobile != null) {
      fileName = document.getElementById("imagePC").value;
      extension = fileName.split(".").pop();
      if (extension == "jpg" || extension == "jpeg") {
        document.getElementById("imagePCBase64").value = cropperPC
          .getCroppedCanvas()
          .toDataURL("image/jpeg");
        console.log(document.getElementById("imagePCBase64").value);
      }
      else if (extension == "png")
        document.getElementById("imagePCBase64").value = cropperPC
          .getCroppedCanvas()
          .toDataURL("image/png");

      fileName = document.getElementById("imageMobile").value;
      extension = fileName.split(".").pop();
      if (extension == "jpg" || extension == "jpeg")
        document.getElementById("imageMobileBase64").value = cropperMobile
          .getCroppedCanvas()
          .toDataURL();
      else if (extension == "png")
        document.getElementById("imageMobileBase64").value = cropperMobile
          .getCroppedCanvas()
          .toDataURL("image/png");
      document.forms["adForm"].submit();
    } else if (
      document.getElementById("imageOldPC") != null &&
      document.getElementById("imageOldMobile") != null
    ) {
      if (cropperPC != null) {
        fileName = document.getElementById("imagePC").value;
        extension = fileName.split(".").pop();
        if (extension == "jpg" || extension == "jpeg")
          document.getElementById("imagePCBase64").value = cropperPC
            .getCroppedCanvas()
            .toDataURL("image/jpeg");
        else if (extension == "png")
          document.getElementById("imagePCBase64").value = cropperPC
            .getCroppedCanvas()
            .toDataURL("image/png");
      }
      if (cropperMobile != null) {
        fileName = document.getElementById("imageMobile").value;
        extension = fileName.split(".").pop();
        if (extension == "jpg" || extension == "jpeg")
          document.getElementById("imageMobileBase64").value = cropperMobile
            .getCroppedCanvas()
            .toDataURL();
        else if (extension == "png")
          document.getElementById("imageMobileBase64").value = cropperMobile
            .getCroppedCanvas()
            .toDataURL("image/png");
      }
      document.forms["adForm"].submit();
    } else {
      alert("Vous devez sélectionner une image pour PC et Mobile");
    }
  }
});
