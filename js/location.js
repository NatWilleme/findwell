navigator.geolocation.getCurrentPosition(success);

function success(position){
    for(i=0; i<document.getElementsByName("location").length; i++){
        document.getElementsByName("location")[i].value = position.coords.latitude + ', ' + position.coords.longitude;
       }
}