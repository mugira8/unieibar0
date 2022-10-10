$(document).ready(sessionVarsView);
function sessionVarsView() {
    var url = "controller/cSessionVarsView.php";
    fetch(url, {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' }
    }).then(res => res.json()).then(result => {
        console.log('session result', result);
        console.log(window.location.href);
    });
}

$("#botonLogin").on("click", function(){
    let email = $("#loginEmail").val();
    let contrasena = $("#loginContrasena").val();
    let url = "controller/cLogin.php";
    let data = {'email': email, 'contrasena': contrasena};
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'Content-Type': 'application/json' }
    }).then(res => res.json()).then(result => {
        console.log(result);
    })
})

$("#loginModalButton").on("click", function() {
    $("#loginModal").modal("show");
})