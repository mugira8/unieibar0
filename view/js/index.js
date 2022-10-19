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

$(window).on("load", getCursos());

function getCursos(){
    let url = "controller/cGetCursos.php";
    fetch(url, {
        method: 'GET',
        headers: {'Content-Type': 'application/json'}
    }).then(res => res.json()).then(result => {
        let i = 0;
        let table = "";
        while (result.list[i] != null)
        {
            table += "<tr>" +
                    "<th scope='row'>" + (parseInt(i)+1) + "</th>" + 
                    "<td>" + result.list[i].nombre + "</td>" +
                    "<td>" + result.list[i].horas + "</td>" +
                    "<td>" + result.list[i].fecha_inicio + "</td>" +
                    "<td>" + result.list[i].fecha_fin + "</td>" +
                    "<td><button type='button' class='btn btn-primary'>Matricular</button></td>" +
                    "</tr>"
            i++;
        }
        $("#tbody").html(table);
    })
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