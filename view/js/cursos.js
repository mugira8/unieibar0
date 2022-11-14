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
                    "<td><button type='button' onclick=desMatricularAlumno("+ result.list[i].id +") id='quitarMatricularButton' class='dnone btn btn-primary'>Matricular</button></td>" +
                    "</tr>"
            i++;
        }
        $("#tbody").html(table);
    })
}

function matricularAlumno(cursoId){
    let alumno = checkUsuarioAlumno().then(result.error);
    console.log("Result dentro de matricular", alumno);
    if(alumno){
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
    } else{
        $("#");
    }
}

function desMatricularAlumno(cursoId){

}

function checkUsuarioAlumno()
{
    let url = "controller/cCheckUsuarioAlumno.php";
    fetch(url, {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' }
    }).then(res => res.json()).then(result => {
        console.log("result dentro de check", result);
        return result;
    })
}