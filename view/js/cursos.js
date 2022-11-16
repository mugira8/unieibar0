var userId;

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
                    "<td><button type='button' onclick=matricularAlumno("+ result.list[i].id +") id='matricularButton' class='btn btn-primary'>Matricular</button></td>" +
                    "</tr>"
            i++;
        }
        $("#tbody").html(table);
    })
}

function matricularAlumno(cursoId){
        let check = checkUsuarioAlumno();

        check.then(response => {
            if(response == true){
                if(confirm("Estas seguro de que te quieres matricular? Si quieres desmatricularte tendras que ponerte en contacto con el centro")){
                let url = "controller/cCrearCursoAlumno.php";
                let data = {'cursoId': cursoId};
                fetch(url, {
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: { 'Content-Type': 'application/json' }
                }).then(res => res.json()).then(result => {
                    if (result.error == "no error")
                        getCursos();
                })
            }
            } else{
                $("#crearAlumnoModal").modal('show');
            }
        });
}

async function checkUsuarioAlumno()
{
    let url = "controller/cCheckUsuarioAlumno.php";
    return fetch(url, {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' }
    }).then(res => res.json()).then(result => {
        return result.error;
    })
}

$("#botonCrearAlumno").on("click", function() {
	let nombre = $("#insertNombre").val();
	let apellido = $("#insertApellido").val();
	let edad = $("#insertEdad").val();
	let url = "controller/cCrearAlumno.php";
	let data = {'nombre': nombre, 'apellido': apellido, 'edad': edad};
	fetch(url, {
		method: 'POST',
		body: JSON.stringify(data),
		headers: { 'Content-Type': 'application/json' }
	}).then (res => res.json()).then(result => {
		if (result.error == "Success"){
			$("#crearAlumnoModal").modal("hide");
            alert("Ya eres un alumno, elige donde te quieres matricular");
		}
	})
})