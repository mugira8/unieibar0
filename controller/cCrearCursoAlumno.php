<?php

include_once("../model/cursosAlumnosModel.php");

$data = json_decode(file_get_contents("php://input"), true);

$cursoId = $data['curso_id'];
$alumnoId = $data['alumno_id'];

$cursoAlumno = new cursosAlumnosModel();

$cursoAlumno->setCursoId($cursoId);
$cursoAlumno->setAlumnoId($alumnoId);

$response = array();
$response['error'] = $cursoAlumno->createCursoAlumno();

echo json_encode($response);

unset($usuario);