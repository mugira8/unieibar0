 <?php

include_once("../model/alumnosModel.php");
include_once("../model/usuariosModel.php");

$data = json_decode(file_get_contents("php://input"), true);

session_start();

$nombre = $data['nombre'];
$apellido = $data['apellido'];
$edad = $data['edad'];

$usuario = new usuariosModel();

$ultimoId = $usuario->getLastId();

if($_SESSION['admin'] == 1)
{
    if($ultimoId > 0)
    {
        $email = str_replace(' ','', strtolower($apellido . '.' . ($ultimoId + 1))) . "@uni.eus";
        $usuario->setEmail($email);
        $usuario->setContrasena('Ikasle123');

        $response = array();
        $ultimoUserId = $usuario->createUser();

        if(isset($ultimoUserId)){
            $alumno = new alumnosModel();

            $alumno->setNombre($nombre);
            $alumno->setApellido($apellido);
            $alumno->setEmail($email);
            $alumno->setEdad($edad);
            $alumno->setUsuario_id($ultimoUserId);
    
            $response = array();
            $response['error'] = $alumno->createAlumno();
        }

        echo json_encode($response);
        unset($alumno);
    }
} else {
    $alumno = new alumnosModel();

    $alumno->setNombre($nombre);
    $alumno->setApellido($apellido);
    $alumno->setEmail($_SESSION['email']);
    $alumno->setEdad($edad);
    $alumno->setUsuario_id($_SESSION['usuario']);

    $response = array();
    $response['error'] = $alumno->createAlumno();
}
