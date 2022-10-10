<?php

include_once("../model/alumnosModel.php");

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];
$nombre = $data['nombre'];
$apellido = $data['apellido'];
$email = $data['email'];
$edad = $data['edad'];

$alumno = new alumnosModel();

if(isset($alumno))
{
    $alumno->setId($id);
    $alumno->setNombre($nombre);
    $alumno->setApellido($apellido);
    $alumno->setEmail($email);
    $alumno->setEdad($edad);
}


$response = array();
$response['error'] = $alumno->updateAlumno();

echo json_encode($response);

unset($alumno);