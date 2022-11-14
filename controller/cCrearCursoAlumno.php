<?php

include_once("../model/cursosAlumnosModel.php");
include_once("../model/alumnosModel.php");

session_start();
$data = json_decode(file_get_contents("php://input"), true);

$cursoId = $data['cursoId'];

$cursoAlumno = new cursosAlumnosModel();
$alumno = new alumnosModel();

$alumno->setUsuario_id($_SESSION['usuario']);

$alumnoId = $alumno->getAlumnoIdWithUsuarioId();
$cursoAlumno->setCursoId($cursoId);
$cursoAlumno->setAlumnoId($alumnoId);

$response = array();
$response['error'] = $cursoAlumno->createCursoAlumno();

echo json_encode($response);

unset($usuario);