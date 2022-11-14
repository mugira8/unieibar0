<?php
//CONTROLADOR DE ALUMNOS
include_once ("connect_data.php");
include_once ("cursosAlumnosClass.php");

class cursosAlumnosModel extends cursosAlumnosClass {

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

	public function listCursoAlumnos(){
		$this->OpenConnect();

		$alumnoId = $this->alumno_Id;
		$sql = "SELECT * FROM curso_alumno WHERE alumno_id = $alumnoId";
		$list = array();
	
		$result=$this->link->query($sql);
	
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		{
			$cursosAlumnos = new cursosAlumnosModel();
	
			$cursosAlumnos->setId($row['id']);
			$cursosAlumnos->setAlumnoId($row['alumno_id']);
			$cursosAlumnos->setCursoId($row['curso_id']);
	
			array_push($list, get_object_vars($cursosAlumnos));
		}
	
		mysqli_free_result($result);
		$this->CloseConnect();
		return $list;
	}

    public function createCursoAlumno() {
        $this->OpenConnect();

		$cursoId = $this->curso_Id;
        $alumnoId=$this->alumno_Id;

		$sql= "INSERT INTO curso_alumno (curso_id, alumno_id) 
		VALUES ('$cursoId', '$alumnoId')";

		$this -> link -> query($sql);	
		
		if ($this -> link -> affected_rows == 1){
			return "no error";
		}
		else {
			return "Error updating ". $sql ."   ". $this->link->error;
		}
		$this->CloseConnect();
    }

    public function findCursosByAlumno(){
        $this->OpenConnect();

        $list=array();
        $alumnoId=$this->alumno_Id;

		$sql= "SELECT curso_id 
		FROM curso_alumno
        WHERE alumno_id='$alumnoId'";

        $result=$this -> link -> query($sql);	
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            array_push($list, $row['curso_id']);
        }
    
        mysqli_free_result($result);
        $this->CloseConnect();
        return $list;
    }
}