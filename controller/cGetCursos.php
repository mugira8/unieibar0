<?php
	include_once ("../model/cursosModel.php");

	$response = array();
	$cursos = new cursosModel();
	$response['list'] = $cursos->listCursos();
	$response['error'] ='no error';

	echo json_encode($response);
	unset($response);