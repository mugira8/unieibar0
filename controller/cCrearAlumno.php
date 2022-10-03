<?php

include_once("../model/alumnosModel.php");

$data = json_decode(file_get_contents("php://input"), true);

$nombre = $data['nombre'];
$apellido = $data['apellido'];
$email = $data['email'];
$edad = $data['edad'];

$alumno = new alumnosModel();

$alumno->setNombre($nombre);
$alumno->setApellido($apellido);
$alumno->setEmail($email);
$alumno->setEdad($edad);

$response = array();
$response['error'] = $alumno->createAlumno();

echo json_encode($response);

unset($alumno);