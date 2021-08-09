document.getElementById("formLogin").addEventListener("submit", function (e) {
    
    document.getElementById('errorMail').innerHTML = "";
    document.getElementById('errorPwd').innerHTML = "";
    
    if(document.getElementById("mail").value == "") {
        e.preventDefault();
        document.getElementById('errorMail').innerHTML = "Veuillez entrer une adresse mail.";
        document.getElementById('errorMail').style.color = "red";
    }

    if(document.getElementById("password").value == "") {
        e.preventDefault();
        document.getElementById('errorPwd').innerHTML = "Veuillez entrer un mot de passe.";
        document.getElementById('errorPwd').style.color = "red";
    }

})
