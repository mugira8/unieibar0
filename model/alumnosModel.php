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

        $this->CloseConnect();
    }

    public function updateAlumno(){

        $this->OpenConnect();

        $this->CloseConnect();
    }

}//fin