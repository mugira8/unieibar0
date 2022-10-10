<?php
require_once '../model/usuariosModel.php';
require_once '../model/pacientesModel.php';

$response=array();
$usuario= new usuariosModel();
$paciente = new pacientesModel();

session_start();

if (isset($_SESSION['usuario'])){
    $usuario=$_SESSION['usuario'];
    $response['error']="no error";
} else if (!isset($_SESSION['usuario'])){  
    $response['error']="No estas loggeado";
}

$response['usuario']= $usuario;

echo json_encode($response);

unset($response);