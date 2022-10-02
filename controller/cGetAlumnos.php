<?php
	include_once ("../model/alumnosModel.php");

	$response = array();
	$alumnos = new alumnosModel();
	$response['list'] = $alumnos->listAlumnos();
	$response['error'] ='no error';

	echo json_encode($response);
	unset($response);