<?php
include_once("../model/cursosModel.php");
$data = json_decode(file_get_contents("php://input"), true);

$nombre = $data['nombre'];

$curso = new cursosModel();
$curso->setNombre($nombre);

if(isset($curso))
{
    $list = array();
    $list = $curso->findCurso();

    $response = array();
    $response['list'] = $list;
    $response['error'] = "Not error";

    echo json_encode($response);
}

unset($curso);
unset($list);