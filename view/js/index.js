$("#loginButton").on("click", function() {
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
		$("#loginModal").modal("hide");
		sessionVarsView();
	})
})

$("#loginModalButton").on("click", function() {
	$("#loginModal").modal("show");
})
$("#registroModalButton").on("click", function() {
	$("#registroModal").modal("show");
})

$("#registroButton").on("click", function() {
	let email = $("#loginEmail").val();
	let contrasena = $("#loginContrasena").val();
	let contrasena2 = $("#loginContrasena2").val();
	let urlEmail = "controller/cBuscarEmail.php";
	let urlRegistro = "crontroller/cCrearUsuario.php";
	if (contrasena == contrasena2)
	{

	}
	if (email)
	{
		fetch(urlEmail,{

		})
	}	
})


$("#adminButton").on("click", function() {
	window.location.href = "administracion.html";
})