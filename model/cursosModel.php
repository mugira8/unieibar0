<?php
//CONTROLADOR DE cursos
include_once ("connect_data.php");
include_once ("cursosClass.php");

class cursosModel extends cursosClass {

	private $link;
		
	public function OpenConnect() {
		$konDat = new connect_data();
		try {
			$this->link=new mysqli($konDat->host, $konDat->userbbdd, $konDat->passbbdd, $konDat->ddbbname);
		}
		catch(Exception $e) {
			echo $e->getMessage();
		}
		
		$this->link->set_charset("utf8");
	}
		 
	public function CloseConnect() {
		mysqli_close($this->link);
	}


//LISTAR DATOS DE PACIENTES
public function listCursos(){
	$this->OpenConnect();

	$sql = "SELECT * FROM cursos";
	$list = array();

	$result=$this->link->query($sql);

	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$cursos = new cursosModel();

		$cursos->setId($row['id']);
		$cursos->setNombre($row['nombre']);
		$cursos->setHoras($row['horas']);
		$cursos->setFecha_inicio($row['fecha_inicio']);
		$cursos->setFecha_fin($row["fecha_fin"]);

		array_push($list, get_object_vars($cursos));
	}

	mysqli_free_result($result);
	$this->CloseConnect();
	return $list;
}

public function findCurso(){
	$this->OpenConnect();
	$apellido=$this->apellido;
	$sql = "SELECT * FROM cursos WHERE apellido LIKE '$apellido%'";
	$list = array();

	$result=$this->link->query($sql);
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$cursos = new cursosModel();

		$cursos->setId($row['id']);
		$cursos->setNombre($row['nombre']);
		$cursos->setHoras($row['horas']);
		$cursos->setFecha_inicio($row['fecha_inicio']);
		$cursos->setFecha_fin($row["fecha_fin"]);

		array_push($list, get_object_vars($cursos));
	}
	mysqli_free_result($result);
	$this->CloseConnect();
	return $list;
}
}//fin