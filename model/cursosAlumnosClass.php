<?php

class cursosAlumnosClass
{
    protected $id;
    protected $alumno_Id;
    protected $curso_Id;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of alumnoId
     */ 
    public function getAlumnoId()
    {
        return $this->alumno_Id;
    }

    /**
     * Set the value of alumnoId
     *
     * @return  self
     */ 
    public function setAlumnoId($alumno_Id)
    {
        $this->alumno_Id = $alumno_Id;

        return $this;
    }

    /**
     * Get the value of cursoId
     */ 
    public function getCursoId()
    {
        return $this->alumno_Id;
    }

    /**
     * Set the value of cursoId
     *
     * @return  self
     */ 
    public function setCursoId($curso_Id)
    {
        $this->curso_Id = $curso_Id;

        return $this;
    }
}