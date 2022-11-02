<?php

include_once("../model/usuariosModel.php");

$data = json_decode(file_get_contents("php://input"), true);

$email = $data;

$usuario = new usuariosModel();
$usuario->setEmail($email);

$response = $usuario->findEmail();

echo json_encode($response);

unset($alumno);
