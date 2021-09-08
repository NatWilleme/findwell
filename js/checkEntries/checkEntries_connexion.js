if (document.getElementById("formEditCompany") != null) {
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
}

if (document.getElementById("formPassword") != null) {
    document.getElementById("formPassword").addEventListener("submit", function (e) {
        var regexPassword = new RegExp("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$");

        document.getElementById('errorPwd').innerHTML = "";

        if(document.getElementById("password").value == "" || !regexPassword.test(document.getElementById("password").value)) {
            e.preventDefault();
            document.getElementById('errorPwd').innerHTML = "Le mot de passe doit contenir minimum 8 caractères avec une majuscule, une minuscule et un chiffre.";
            document.getElementById('errorPwd').style.color = "red";
        }

    })
}