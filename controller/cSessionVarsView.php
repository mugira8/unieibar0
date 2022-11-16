<?php
require_once '../model/usuariosModel.php';

$response=array();
$usuario= new usuariosModel();

session_start();

if (isset($_SESSION['usuario'])){
    $usuario=$_SESSION['usuario'];
    $response['error']="no error";
} else if (!isset($_SESSION['usuario'])){  
    $response['error']="No estas loggeado";
}

if(isset($_SESSION['admin']))
    $admin=$_SESSION['admin'];
else
    $admin = 0;

$response['usuario']= $usuario;
$response['admin'] = $admin;
if(isset($_SESSION['newUser']))
    $response['newUser'] = $_SESSION['newUser'];
if(isset($_SESSION['email']))
    $response['email'] = $_SESSION['email'];

echo json_encode($response);


unset($response);