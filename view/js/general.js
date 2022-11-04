$(document).ready(sessionVarsView);
function sessionVarsView() {
	var url = "controller/cSessionVarsView.php";
	fetch(url, {
		method: 'GET',
		headers: { 'Content-Type': 'application/json' }
	}).then(res => res.json()).then(result => {
		if (result.error == "no error") {
			$('#loginModalButton').css("display", "none");
			$("#logoutButton").css("display", "block");
			$("#registroModalButton").css("display", "none");
			$("#cursosButton").css("display", "block");
			if(result.admin == 1)
			{
				$("#adminButton").css("display", "block");
			}
		}
		if (result.error == "No estas loggeado" && 
		!window.location.href.includes("index")) {
			window.location.href = "index.html";
		}
		console.log('session result', result);
		if (result.admin == 0 && 
			result.error == "no error" && 
		window.location.href.includes("administracion")
		) {
			console.log("Usuario en administracion")
			window.location.href = "index.html";
		}
	});
}

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
			$("#cursosButton").css("display", "none");
			window.location.href = "index.html";
		}
	})
})

