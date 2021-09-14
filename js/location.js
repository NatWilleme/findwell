navigator.geolocation.getCurrentPosition(success);

function success(position){
    console.log("success");
    console.log(position.coords.latitude + ', ' + position.coords.longitude); 
    for(i=0; i<document.getElementsByName("location").length; i++){
        document.getElementsByName("location")[i].value = position.coords.latitude + ', ' + position.coords.longitude;
       }
}

function echec(){
    console.log("echec");
}