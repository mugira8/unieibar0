<?php

include_once("../model/alumnosModel.php");
include_once("../model/usuariosModel.php");

$data = json_decode(file_get_contents("php://input"), true);

$nombre = $data['nombre'];
$apellido = $data['apellido'];
$email = $data['email'];
$edad = $data['edad'];

$usuario = new usuariosModel();

$usuario->setEmail($email);
$usuario->setContrasena('Ikasle123');

$response = array();
$response['ultimoUserId'] = $usuario->createUser();
var_dump($response);

if(isset($response['ultimoUserId'])){
    $alumno = new alumnosModel();

    $alumno->setNombre($nombre);
    $alumno->setApellido($apellido);
    $alumno->setEmail($email);
    $alumno->setEdad($edad);
    $alumno->setUsuarioId($response['ultimoUserId']);
    
    $response = array();
    $response['error'] = $alumno->createAlumno();
}

echo json_encode($response);
unset($alumno);