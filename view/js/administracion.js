//Lo hago en una funcion aparte porque se usa varias veces
function getAlumnos(){
    let url = "controller/cGetAlumnos.php";
    fetch(url, {
        method: 'GET',
        headers: {'Content-Type': 'application/json'}
    }).then(res => res.json()).then(result => {
        let i = 0;
        let table = "";
        while (result.list[i] != null)
        {
            table += "<tr>" +
                    "<th scope='row'>" + result.list[i].id + "</th>" + 
                    "<td>" + result.list[i].nombre + "</td>" +
                    "<td>" + result.list[i].apellido + "</td>" +
                    "<td>" + result.list[i].email + "</td>" +
                    "<td>" + result.list[i].edad + "</td>" +
                    "<td> <button onclick=updateAlumno("+ result.list[i].id +") type='button' class='btn btn-primary'>Editar</button>" +
                    "<button onclick=deleteAlumno("+ result.list[i].id +") type='button' class='btn btn-danger'>Borrar</button> </td>" +
                    "</tr>"
            i++;
        }
        $("#tbody").html(table);
    })
}

function deleteAlumno(id){
    console.log(id);

    //Hacer la funcion delete, la ID ya la manda
}

function updateAlumno(id){
    let url = "controller/cFindAlumnoById.php";
    let data = {'id': id};
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'Content-Type': 'application/json' }
    }).then(res => res.json()).then(result => {
        $("#editarAlumnoModal").modal("show");
        $("#editId").val(result.id);
        $("#editNombre").val(result.nombre);
        $("#editApellido").val(result.apellido);
        $("#editEmail").val(result.email);
        $("#editEdad").val(result.edad);
    })
}

$("#botonEditarAlumno").on("click", function() {
    let id = $("#editId").val();
    let nombre = $("#editNombre").val();
    let apellido = $("#editApellido").val();
    let email = $("#editEmail").val();
    let edad = $("#editEdad").val();
    let url = "controller/cUpdateAlumno.php";
    let data = {'id':id, 'nombre': nombre, 'apellido': apellido, 'email': email, 'edad': edad};
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'Content-Type': 'application/json' }
    }).then (res => res.json()).then(result => {
        if (result.error == "Success")
            getAlumnos();
    })
    //Guardar los cambios en el formulario de editar alumno
})

$(window).on("load", getAlumnos());

$("#buscar").on("click", function() {
    let apellido = $("#buscarValue").val();
    let url = "controller/cFindAlumno.php";
    let data = {'apellido': apellido};
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'Content-Type': 'application/json' }
    }).then (res => res.json()).then(result => {
        let i = 0;
        let table = "";
        while (result.list[i] != null)
        {
            table += "<tr>" +
                    "<th scope='row'>" + result.list[i].id + "</th>" + 
                    "<td>" + result.list[i].nombre + "</td>" +
                    "<td>" + result.list[i].apellido + "</td>" +
                    "<td>" + result.list[i].email + "</td>" +
                    "<td>" + result.list[i].edad + "</td>" +
                    "<td> <button onclick=updateAlumno("+ result.list[i].id +") type='button' class='btn btn-primary'>Editar</button>" +
                    "<button onclick=deleteAlumno("+ result.list[i].id +") type='button' class='btn btn-danger'>Borrar</button> </td>" +
                    "</tr>"
            i++;
        }
        $("#tbody").html(table);
    })
})

$("#crearModal").on("click", function() {
    $("#crearAlumnoModal").modal("show");
})

$("#botonCrearAlumno").on("click", function() {
    let nombre = $("#insertNombre").val();
    let apellido = $("#insertApellido").val();
    let email = $("#insertEmail").val();
    let edad = $("#insertEdad").val();
    let url = "controller/cCrearAlumno.php";
    let data = {'nombre': nombre, 'apellido': apellido, 'email': email, 'edad': edad};
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'Content-Type': 'application/json' }
    }).then (res => res.json()).then(result => {
        if (result.error == "Success")
            getAlumnos();
    })
})