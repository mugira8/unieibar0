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
                    "<td><button type='button' id='matricularButton' ("+ result.list[i].id +") class='btn btn-primary'>Matricular</button></td>" +
                    "</tr>"
            i++;
        }
        $("#tbody").html(table);
    })
}

$("#matricularButton").on("click", function() {
	$("#loginModal").modal("show");
})

function matricularAlumno(cursoId){
    let url = "controller/cMatricularAlumno.php";
	let data = {'cursoId': cursoId, 'loggedUser' : userId};
    fetch(url, {
		method: 'POST',
		body: JSON.stringify(data),
		headers: { 'Content-Type': 'application/json' }
    }).then(res => res.json()).then(result => {
        if (result.error == "Success")
        getCursos();
    })
}