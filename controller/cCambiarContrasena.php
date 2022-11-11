<?php
include_once("../model/usuariosModel.php");
session_start();
$data = json_decode(file_get_contents("php://input"), true);
$nuevaContrasena = $data['contrasena'];


$usuario = new usuariosModel();
$usuario->setId($_SESSION['usuario']); 
$usuario->setContrasena($nuevaContrasena);

if(isset($usuario))
{
    $response = array();
    $response['error'] = $usuario->cambiarContrasena();

    if($response['error']=='no error'){
        $_SESSION['newUser'] = false;
    }
    echo json_encode($response);
}

unset($usuario);