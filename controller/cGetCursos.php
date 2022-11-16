<?php
	include_once ("../model/cursosModel.php");
	include_once ("../model/cursosAlumnosModel.php");
	include_once ("../model/alumnosModel.php");
	session_start();

	$response = array();
	$cursos = new cursosModel();
	$cursoAlumno = new cursosAlumnosModel();
	$alumno = new alumnosModel();

	$alumno->setUsuario_id($_SESSION['usuario']);

	$alumnoId = $alumno->getAlumnoIdWithUsuarioId();
	if(isset($alumnoId)){
	$cursoAlumno->setAlumnoId($alumnoId);
	$listCursoAlumnos = $cursoAlumno->listCursoAlumnos();
	$listCursos = $cursos->listCursos();
	foreach($listCursoAlumnos as $item){
		for ($i = 0; $i < count($listCursos); $i++)
		{
			if($listCursos[$i]['id'] == $item['curso_Id']){
				array_splice($listCursos, $i, 1);
			}
		}
	}
	} else{
		$listCursos = $cursos->listCursos();
	}
	
	$response['list'] = $listCursos;

	echo json_encode($response);
	unset($response);