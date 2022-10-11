$("#loginButton").on("click", function() {
    console.log("aqui")
    let email = $("#loginEmail").val();
    let contrasena = $("#loginContrasena").val();
    let url = "controller/cLogin.php";
    let data = {'email': email, 'contrasena': contrasena};
    console.log("date", data)
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

$("#adminButton").on("click", function() {
    window.location.href = "administracion.html";
})