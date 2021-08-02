document.getElementById("commentForm").addEventListener("submit", function (e) {
    if(document.getElementById("newComment").value == "") {
        e.preventDefault();
        document.getElementById('newCommentError').innerHTML = "La zone de commentaire ne peut être vide.";
        document.getElementById('newCommentError').style.color = "red";
    }

    var stars = document.getElementsByName('rating');
    var flag = false;
    for(i = 0; i < stars.length; i++) {
        if(stars[i].checked)
            flag = true;
    }
    if(!flag){
        e.preventDefault();
        document.getElementById('ratingError').innerHTML = "Vous devez obligatoirement mettre une note.";
        document.getElementById('ratingError').style.color = "red";
    }
})
