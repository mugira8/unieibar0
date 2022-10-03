<?php
include_once("../model/alumnosModel.php");
$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];

$alumnos = new alumnosModel();
$alumnos->setId($id);

$response = array();
$response['error'] = $alumnos->deleteAlumno();

echo json_encode($response);

unset($centro);