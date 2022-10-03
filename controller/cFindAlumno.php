<?php
include_once("../model/alumnosModel.php");
$data = json_decode(file_get_contents("php://input"), true);

$apellido = $data['apellido'];

$alumno = new alumnosModel();
$alumno->setApellido($apellido);

if(isset($alumno))
{
    $list = array();
    $list = $alumno->findAlumno();

    $response = array();
    $response['list'] = $list;
    $response['error'] = "Not error";

    echo json_encode($response);
}

unset($alumno);
unset($list);