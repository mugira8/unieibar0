<?php

include_once("../model/alumnosModel.php");

$data = json_decode(file_get_contents("php://input"), true);

$cursoId = $data['cursoId'];
$loggedUserId = $data['loggedUser'];


$alumno = new alumnosModel();

if(isset($alumno))
{
    $alumno->setId($loggedUserId);
   // $alumno->setCursoId($cursoId);
}

$response = array();
$response['error'] = $alumno->matricularAlumno();

echo json_encode($response);

unset($cursoID);