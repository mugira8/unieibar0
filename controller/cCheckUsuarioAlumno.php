<?php
include_once("../model/alumnosModel.php");

session_start();

$alumno = new alumnosModel();
echo $_SESSION['usuario'];
$alumno->setCurso_ID($_SESSION['usuario']);

if(isset($alumno))
{
    $response = array();
    $response['error'] = $alumno->checkUsuarioAlumno();

    echo json_encode($response);
}

unset($alumno);
