<?php
//CONTROLADOR DE ALUMNOS
include_once ("connect_data.php");
include_once ("usuariosClass.php");

class usuariosModel extends usuariosClass {

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

    public function findUser(){
        $this->OpenConnect();

        $email=$this->email;
        $contrasena=$this->contrasena;

        $sql = "SELECT * FROM usuarios WHERE email='$email' AND contrasena='$contrasena'";

        $result = $this->link->query($sql);

        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
			$this->id = $row['id'];
            $this->admin = $row['admin'];
            $usuarioExists = true;
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return $usuarioExists;
    }
}