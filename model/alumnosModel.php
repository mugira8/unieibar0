<?php
//CONTROLADOR DE ALUMNOS
include_once ("connect_data.php");
include_once ("alumnosClass.php");

class alumnosModel extends alumnosClass {

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
public function listAlumnos()
{
	$this->OpenConnect();

	$sql = "SELECT * FROM alumnos";
	$list = array();

	$result=$this->link->query($sql);

	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$alumnos = new alumnosModel();

		$alumnos->setId($row['id']);
		$alumnos->setNombre($row['nombre']);
		$alumnos->setApellido($row['apellido']);
		$alumnos->setEmail($row['email']);
		$alumnos->setEdad($row["edad"]);

		array_push($list, get_object_vars($alumnos));
	}

	mysqli_free_result($result);
	$this->CloseConnect();
	return $list;
}

	public function findAlumno(){
		$this->OpenConnect();
		$apellido=$this->apellido;
		$sql = "SELECT * FROM alumnos WHERE apellido LIKE '$apellido%'";
		$list = array();

		$result=$this->link->query($sql);
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		{
			$alumnos = new alumnosModel();

			$alumnos->setId($row['id']);
			$alumnos->setNombre($row['nombre']);
			$alumnos->setApellido($row['apellido']);
			$alumnos->setEmail($row['email']);
			$alumnos->setEdad($row["edad"]);

			array_push($list, get_object_vars($alumnos));
		}
		mysqli_free_result($result);
		$this->CloseConnect();
		return $list;
	}

	public function createAlumno()
	{
		$this->OpenConnect();

		$nombre = $this->nombre;
		$apellido = $this->apellido;
		$email = $this->email;
		$edad = $this->edad;

		$sql= "INSERT INTO alumnos (nombre, apellido, email, edad) 
		VALUES ('$nombre', '$apellido', '$email', '$edad')";

		$this -> link -> query($sql);
		
		if ($this -> link -> affected_rows == 1){
			return "Success";
		}
		else {
			return "Error updating ". $sql ."   ". $this->link->error;
		}
		$this->CloseConnect();
	}

	public function findAlumnoById()
	{
		$this->OpenConnect();
		
		$id = $this->id;

		$sql = "SELECT * FROM alumnos WHERE id = '$id'";
		$result = $this->link->query($sql);
		
		if ($row = $result->fetch_array(MYSQLI_ASSOC))
		{
			$alumno = new alumnosModel();

			$alumno->id = $row['id'];
			$alumno->nombre=$row['nombre'];
			$alumno->apellido=$row['apellido'];
			$alumno->email=$row['email'];
			$alumno->edad=$row["edad"];
		}
		mysqli_free_result($result);
		$this->CloseConnect();
		return get_object_vars($alumno);
	}

	public function updateAlumno(){

		$this->OpenConnect();

		$this->CloseConnect();
	}

	public function deleteAlumno(){
		
		$this->OpenConnect();
		$id = $this->getId();
		$sql = "DELETE FROM alumnos WHERE id = $id";

		if($this -> link -> query($sql)) {
			return " Record deleted successfully";
		}
		else {
			return "Error updating ". $sql ."   ". $this->link->error;
		}

		$this->CloseConnect();
	}

}//fin