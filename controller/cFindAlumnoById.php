<?php
include_once("../model/alumnosModel.php");
$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];

$alumno = new alumnosModel();
$alumno->setId($id);

if(isset($alumno))
{
    echo json_encode($alumno->findAlumnoById());
}

