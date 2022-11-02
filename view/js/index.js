function sessionVarsView() {
	var url = "controller/cSessionVarsView.php";
	fetch(url, {
		method: 'GET',
		headers: { 'Content-Type': 'application/json' }
	}).then(res => res.json()).then(result => {
		console.log('session result', result);
		if (result.error == "no error") {
			$('#loginModalButton').css("display", "none");
			$("#logoutButton").css("display", "block");
			$("#registroModalButton").css("display", "none");
			$("#cursosButton").css("display", "block");
			if (result.admin == 1) {
				$("#adminButton").css("display", "block");
			}
		}
		if (result.admin != 1 && !window.location.href.includes("index")) {
			window.location.href = "index.html";
		}
	});
}

$("#loginButton").on("click", function () {
	let email = $("#loginEmail").val();
	let contrasena = $("#loginContrasena").val();
	let url = "controller/cLogin.php";
	let data = { 'email': email, 'contrasena': contrasena };
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

$("#loginModalButton").on("click", function () {
	$("#loginModal").modal("show");
})
$("#registroModalButton").on("click", function () {
	$("#registroModal").modal("show");
})

$("#registroButton").on("click", function () {
	let email = $("#registroEmail").val();
	let contrasena = $("#registroContrasena").val();
	let contrasena2 = $("#registroContrasena2").val();
	let urlEmail = "controller/cBuscarEmail.php";
	let urlRegistro = "controller/cCrearUsuario.php";
	let emailValido = false;
	let contrasenaValida = false;
	let data = { 'email': email, 'contrasena': contrasena };
	$("#errorContrasena").css('display', 'none');
	$('#errorEmail').css('display', 'none');
	if (email) {
		fetch(urlEmail, {
			method: 'POST',
			body: JSON.stringify(email),
			headers: { 'Content-Type': 'application/json' }
		}).then(res => res.json()).then(result => {
			if (result == false)
				emailValido = true;
			else
				$('#errorEmail').css('display', 'block');
			if (contrasena == contrasena2 && contrasena != "" && contrasena.length >= 6) {
				contrasenaValida = true;
				console.log("Contrasena valida")
			}
			else {
				$("#errorContrasena").css('display', 'block');
				console.log("Contrasena no valida")
			}
			if (emailValido && contrasenaValida) {
				fetch(urlRegistro, {
					method: 'POST',
					body: JSON.stringify(data),
					headers: { 'Content-Type': 'application/json' }
				}).then(res => res.json()).then(result => {
					console.log(result);
				})
			}
		})
	}
	else
		$('#errorEmail').css('display', 'block');
})


$("#adminButton").on("click", function () {
	window.location.href = "administracion.html";
})