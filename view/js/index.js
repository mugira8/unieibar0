$(window).on("load", function() {
    let url = "controller/cGetAlumnos.php"
    fetch(url, {
        method: 'GET',
        headers: {'Content-Type': 'application/json'}
    }).then(res => res.json()).then(result => {
        console.log(result);
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
                    "<td> <button value="+ result.list[i].id +" type='button' class='btn btn-primary'>Editar</button>" +
                    "<button value="+ result.list[i].id +" type='button' class='btn btn-danger'>Borrar</button> </td>" +
                    "</tr>"
            i++;
        }
        $("#tbody").html(table);
    })
});