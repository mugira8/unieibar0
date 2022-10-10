<?php

class cursosClass
{
    protected $id;
    protected $nombre;
    protected $horas;
    protected $fecha_inicio;
    protected $fecha_fin;

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
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of horas
     */ 
    public function getHoras()
    {
        return $this->horas;
    }

    /**
     * Set the value of horas
     *
     * @return  self
     */ 
    public function setHoras($horas)
    {
        $this->horas = $horas;

        return $this;
    }

    /**
     * Get the value of fecha_inicio
     */ 
    public function getFecha_inicio()
    {
        return $this->fecha_inicio;
    }

    /**
     * Set the value of fecha_inicio
     *
     * @return  self
     */ 
    public function setFecha_inicio($fecha_inicio)
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    /**
     * Get the value of fecha_fin
     */ 
    public function getFecha_fin()
    {
        return $this->fecha_fin;
    }

    /**
     * Set the value of fecha_fin
     *
     * @return  self
     */ 
    public function setFecha_fin($fecha_fin)
    {
        $this->fecha_fin = $fecha_fin;

        return $this;
    }
}