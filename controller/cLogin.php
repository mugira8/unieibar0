<?php
require_once "../model/usuariosModel.php";

$data=json_decode(file_get_contents("php://input"),true);

$email=$data['email'];
$contrasena=$data['contrasena'];

$response=array();
$usuario=new usuariosModel();

if ($email!=null){
    $usuario->setEmail($email);
    $usuario->setContrasena($contrasena);

    if ($usuario->findUser()){
        session_start();
        $_SESSION['usuario']=$usuario->getId();
        $_SESSION['email']=$usuario->getEmail();
        $_SESSION['admin']=$usuario->getAdmin();
        $_SESSION['newUser']=false;
        
        if($contrasena=='Ikasle123'){
            $_SESSION['newUser']=true;
        }

        $response['newUser'] = $_SESSION['newUser'];
        $response['error']="no error";
    }else{
        $response['error']="incorrect user";
    }
}else{
    $response['error']="insert data";
}   
$response['error']="No error";

echo json_encode($response);

unset($response);