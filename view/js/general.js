$(document).ready(sessionVarsView);
function sessionVarsView() {
	var url = "controller/cSessionVarsView.php";
	fetch(url, {
		method: 'GET',
		headers: { 'Content-Type': 'application/json' }
	}).then(res => res.json()).then(result => {
		console.log(result);
		if (result.error == "no error") {
			$('#loginModalButton').css("display", "none");
			$("#logoutButton").css("display", "block");
			$("#cambiarContrasenaModal").css("hide");
			$("#registroModalButton").css("display", "none");
			$("#cursosButton").css("display", "block");
			if (result.admin == 1) {
				$("#adminButton").css("display", "block");
			}
			if(result.newUser==true){
				$("#errorCambioContrasena").css("display", "none");
				$("#cambiarContrasenaModal").css("display", "block");
				$("#cambiarContrasenaModal").attr('class', 'modal fade show');
				$(".body").attr('class', 'modal open');
				$("#cambiarContrasenaModal").modal({backdrop: 'static', keyboard: false}, "show");
			}

		}
		if (result.error == "No estas loggeado" &&
			window.location.href.includes("administracion") || 
			window.location.href.includes("cursos")) {
			window.location.href = "index.html";
		}
		if (result.admin == 0 &&
			result.error == "no error" &&
			window.location.href.includes("administracion")) 
			{
			window.location.href = "index.html";
		}
	});
}

$("#cambioContrasenaButton").on("click", function () {
	var url = "controller/cCambiarContrasena.php";
	
	let contrasena = $("#cambiarPass").val();
	let confirmarContrasena = $("#confirmarPass").val();

	if(contrasena == confirmarContrasena && contrasena != "" && contrasena.length >= 6){
		let nuevaContrasena = $("#cambiarPass").val();
		let data = { 'contrasena': nuevaContrasena };
	
		fetch(url, {
			method: 'POST',
			body: JSON.stringify(data),
			headers: { 'Content-Type': 'application/json' }
		}).then(res => res.json()).then(result => {
			if (result.error == "no error") {
				window.location.href = "index.html";
			}
		})
	}
	else{
		$("#errorCambioContrasena").css("display", "block");
		$("#cambiarPass").val("");
		$("#confirmarPass").val("");
	}
})

$("#logoutButton").on("click", function () {
	var url = "controller/cLogout.php";
	fetch(url, {
		method: 'GET',
		headers: { 'Content-Type': 'application/json' }
	}).then(res => res.json()).then(result => {
		if (result.error == "no error") {
			$('#loginModalButton').css("display", "block");
			$("#logoutButton").css("display", "none");
			$("#adminButton").css("display", "none");
			$("#tabla").css("display", "none");
			$("#registroModalButton").css("display", "block");
			$("#cambiarContrasenaModal").css("display", "none");
			$("#cursosButton").css("display", "none");
			window.location.href = "index.html";
		}
	})
})

$("#loginButton").on("click", function () {
	let email = $("#loginEmail").val();
	let contrasena = $("#loginContrasena").val();
	let url = "controller/cLogin.php";
	let data = { 'email': email, 'contrasena': contrasena };
	fetch(url, {
		method: 'POST',
		body: JSON.stringify(data),
		headers: { 'Content-Type': 'application/json' }
	}).then(res => res.json()).then(result => {
		if(result.error == "no error"){
			$("#loginModal").modal("hide");
			sessionVarsView();
		}
		if(result.error == "incorrect user"){
			$("#errorLogin").html("La contraseña y el correo no coinciden");
		}
		if(result.error == "insert data"){
			$("#errorLogin").html("Introduce todos los datos");
		}
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
			}
			else {
				$("#errorContrasena").css('display', 'block');
			}
			if (emailValido && contrasenaValida) {
				fetch(urlRegistro, {
					method: 'POST',
					body: JSON.stringify(data),
					headers: { 'Content-Type': 'application/json' }
				}).then(res => res.json()).then(result => {
					$("#registroModal").modal("hide");
					alert("Te has registrado");
				})
			}
		})
	}
	else
		$('#errorEmail').css('display', 'block');
})

