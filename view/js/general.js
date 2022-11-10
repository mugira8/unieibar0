$(document).ready(sessionVarsView);
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
			$("#cambiarContrasenaModal").css("display", "none");
			$("#cursosButton").css("display", "block");
			$("#userId").html(result.Id);

			if(result.admin == 1)
			{
				$("#adminButton").css("display", "block");
			}
			if(result.newUser==true){
				$("#errorCambioContrasena").css("display", "none");
				$("#cambiarContrasenaModal").css("display", "block");
				$("#cambiarContrasenaModal").modal({backdrop: 'static', keyboard: false}, "show");
			}
		}
		if (result.admin != 1 && !window.location.href.includes("index")) {
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
			console.log(result);
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

