if (document.getElementById("formRegister") != null) {
    document.getElementById("formRegister").addEventListener("submit", function (e) {
        var regexPassword = new RegExp("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$");
        document.getElementById('errorMail').innerHTML = "";
        document.getElementById('errorPwd').innerHTML = "";
        
        if(document.getElementById("mail").value == "") {
            e.preventDefault();
            document.getElementById('errorMail').innerHTML = "Veuillez entrer une adresse mail.";
            document.getElementById('errorMail').style.color = "red";
        }

        if(document.getElementById("password").value == "" || !regexPassword.test(document.getElementById("password").value)) {
            e.preventDefault();
            document.getElementById('errorPwd').innerHTML = "Le mot de passe doit contenir minimum 8 caractères avec une majuscule, une minuscule et un chiffre.";
            document.getElementById('errorPwd').style.color = "red";
        }

        if(document.getElementById("name").value == "") {
            e.preventDefault();
            document.getElementById('errorName').innerHTML = "Veuillez entrer un nom pour l'entreprise.";
            document.getElementById('errorName').style.color = "red";
        }

        if(document.getElementById("phone").value == "") {
            e.preventDefault();
            document.getElementById('errorPhone').innerHTML = "Veuillez entrer un numéro de téléphone pour l'entreprise.";
            document.getElementById('errorPhone').style.color = "red";
        }

    })
}

if (document.getElementById("formCompany") != null) {

    document.getElementById("formCompany").addEventListener("submit", function (e) {
        var regexZip = new RegExp("^[0-9]{4,}$");
        var regexNumber = new RegExp("^[0-9]*$");
        var regexPhone = new RegExp("^[0-9]{9,}$");
        document.getElementById('errorName').innerHTML = "";
        document.getElementById('errorPhone').innerHTML = "";
        document.getElementById('errorDescription').innerHTML = "";
        document.getElementById('errorHours').innerHTML = "";
        document.getElementById('errorTva').innerHTML = "";
        document.getElementById('errorNumber').innerHTML = "";
        document.getElementById('errorStreet').innerHTML = "";
        document.getElementById('errorCity').innerHTML = "";
        document.getElementById('errorState').innerHTML = "";
        document.getElementById('errorZip').innerHTML = "";
        
        if(document.getElementById("name").value == "") {
            e.preventDefault();
            document.getElementById('errorName').innerHTML = "Veuillez entrer un nom";
            document.getElementById('errorName').style.color = "red";
        }

        if(document.getElementById("phone").value == "" || !regexPhone.test(document.getElementById("phone").value)) {
            e.preventDefault();
            document.getElementById('errorPhone').innerHTML = "Veuillez entrer un numéro de téléphone valide";
            document.getElementById('errorPhone').style.color = "red";
        }

        if(document.getElementById("description").value == "") {
            e.preventDefault();
            document.getElementById('errorDescription').innerHTML = "Veuillez entrer une description";
            document.getElementById('errorDescription').style.color = "red";
        }

        if(document.getElementById("hours").value == "") {
            e.preventDefault();
            document.getElementById('errorHours').innerHTML = "Veuillez entrer les heures d'ouverture";
            document.getElementById('errorHours').style.color = "red";
        }

        if(document.getElementById("tva").value == "") {
            e.preventDefault();
            document.getElementById('errorTva').innerHTML = "Veuillez entrer un numéro de TVA valide";
            document.getElementById('errorTva').style.color = "red";
        }

        if(document.getElementById("number").value == "" || !regexNumber.test(document.getElementById("number").value)) {
            e.preventDefault();
            document.getElementById('errorNumber').innerHTML = "Veuillez entrer un numéro de rue valide";
            document.getElementById('errorNumber').style.color = "red";
        }

        if(document.getElementById("street").value == "") {
            e.preventDefault();
            document.getElementById('errorStreet').innerHTML = "Veuillez entrer la rue";
            document.getElementById('errorStreet').style.color = "red";
        }

        if(document.getElementById("city").value == "") {
            e.preventDefault();
            document.getElementById('errorCity').innerHTML = "Veuillez entrer la ville";
            document.getElementById('errorCity').style.color = "red";
        }

        if(document.getElementById("state").value == "") {
            e.preventDefault();
            document.getElementById('errorState').innerHTML = "Veuillez entrer le pays";
            document.getElementById('errorState').style.color = "red";
        }

        if(document.getElementById("zip").value == "" || !regexZip.test(document.getElementById("zip").value)) {
            e.preventDefault();
            document.getElementById('errorZip').innerHTML = "Veuillez entrer un code postal valide";
            document.getElementById('errorZip').style.color = "red";
        }

    })
}


if (document.getElementById("formDomaine") != null) {
    document.getElementById("formDomaine").addEventListener("submit", function (e) {
        var number = 0;
        var markedCheckboxGros = document.getElementsByName('checkGros[]');
        var markedCheckboxPetits = document.getElementsByName('checkPetits[]');  
        var markedCheckboxDepannage = document.getElementsByName('checkDepannage[]');  
        for (var checkbox of markedCheckboxGros) {  
            if (checkbox.checked)  
                number++;
        }
        for (var checkbox of markedCheckboxPetits) {  
            if (checkbox.checked)  
                number++;
        }
        for (var checkbox of markedCheckboxDepannage) {  
            if (checkbox.checked)  
                number++;
        }
        console.log(number);
        if(number == 0){
            e.preventDefault();
            document.getElementById('errorDomaine').innerHTML = "Veuillez cocher au moins 1 domaine";
            document.getElementById('errorDomaine').style.color = "red";
        }
    })
}