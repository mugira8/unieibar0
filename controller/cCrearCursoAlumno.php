<?php

include_once("../model/cursosAlumnosModel.php");
include_once("../model/alumnosModel.php");

$data = json_decode(file_get_contents("php://input"), true);

$cursoId = $data['cursoId'];
$alumnoId = $_SESSION['usuario']->findAlumnoIdByUsuarioId();

$cursoAlumno = new cursosAlumnosModel();

$cursoAlumno->setCursoId($cursoId);
$cursoAlumno->setAlumnoId($alumnoId);

$response = array();
$response['error'] = $cursoAlumno->createCursoAlumno();

echo json_encode($response);

unset($usuario);