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

    public function createUser() {
        $this->OpenConnect();

		$email = $this->email;
        $contrasena=$this->contrasena;

		$sql= "INSERT INTO usuarios (email, contrasena, admin) 
		VALUES ('$email', '$contrasena', 0)";

		$this -> link -> query($sql);
		
		if ($this -> link -> affected_rows == 1){
			$sql = "SELECT id FROM usuarios ORDER BY id DESC LIMIT 1;";
            $result = $this->link->query($sql);
            
            if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                $ultimoUserId = $row['id'];
            }
            mysqli_free_result($result);
            $this->CloseConnect();
            return $ultimoUserId;
		}
		else {
			return "Error updating ". $sql ."   ". $this->link->error;
		}
		$this->CloseConnect();
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

    public function cambiarContrasena(){
		$this->OpenConnect();

		$id = $this->id;
		$nuevaContrasena = $this->contrasena;

		$sql = "UPDATE usuarios 
		SET contrasena='$nuevaContrasena'
		WHERE id = '$id'";

		if($this -> link -> query($sql)) {
			return "no error";
		}
		else {
			return "Error updating ". $sql ."   ". $this->link->error;
		}

		$this->CloseConnect();
	}
    public function getLastId()
    {
        $this->OpenConnect();

        $lastId = 0;

        $sql = "SELECT MAX(id) FROM usuarios";

        $result = $this->link->query($sql);

        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            $lastId = $row['MAX(id)'];
        return $lastId;
        $this->CloseConnect();
    }
}