document.getElementById('checkGrosTravaux').addEventListener('change', function () {
    if(this.checked) {
        document.getElementById('listGrosTravaux').style.display = "block";
    } else {
        document.getElementById('listGrosTravaux').style.display = "none";
    }
})

document.getElementById('checkPetitstravaux').addEventListener('change', function () {
    if(this.checked) {
        document.getElementById('listPetitsTravaux').style.display = "block";
    } else {
        document.getElementById('listPetitsTravaux').style.display = "none";
    }
})