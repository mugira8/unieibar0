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