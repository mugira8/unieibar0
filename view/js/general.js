$(document).ready(sessionVarsView);
function sessionVarsView() {
	var url = "controller/cSessionVarsView.php";
	fetch(url, {
		method: 'GET',
		headers: { 'Content-Type': 'application/json' }
	}).then(res => res.json()).then(result => {
		console.log('session result', result);
		if (result.error == "no error" && result.admin == 1) {
			$('#loginModalButton').css("display", "none");
			$("#logoutButton").css("display", "block");
			$("#adminButton").css("display", "block");
		}
		if (result.admin != 1 && !window.location.href.includes("index")) {
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
			window.location.href = "index.html";
		}
	})
})

