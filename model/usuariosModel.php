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

    public function findEmail()
    {
        $this->OpenConnect();

        $email=$this->email;
        $contrasena=$this->contrasena;
        $correoExists = false;

        $sql = "SELECT * FROM usuarios WHERE email='$email'";

        $result = $this->link->query($sql);

        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            $correoExists = true;
        mysqli_free_result($result);
        $this->CloseConnect();
        return $correoExists;
    }

    public function createUsuario()
    {
        $this->OpenConnect();

		$email = $this->email;
        $contrasena = $this->contrasena;

		$sql= "INSERT INTO usuarios (email, contrasena) VALUES ('$email', '$contrasena')";

		$this -> link -> query($sql);
		
		if ($this -> link -> affected_rows == 1){
			return "Success";
		}
		else {
			return "Error updating ". $sql ."   ". $this->link->error;
		}
		$this->CloseConnect();
    }
}