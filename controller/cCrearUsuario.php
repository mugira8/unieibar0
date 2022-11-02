<?php

include_once("../model/usuariosModel.php");

$data = json_decode(file_get_contents("php://input"), true);

$email = $data['email'];
$contrasena = $data['contrasena'];

$usuario = new usuariosModel();

$usuario->setEmail($email);
$usuario->setContrasena($contrasena);

$response = array();
$response['error'] = $usuario->createUsuario();

echo json_encode($response);

unset($usuario);