<?php

    class Vehiculo {
        
        private $modelo;
        private $nombre;
        private $velocidad;
        private $matricula;
        
    
        
        
    
	/**
	 * @return mixed
	 */
	public function getModelo() {
		return $this->modelo;
	}
	
	/**
	 * @param mixed $modelo 
	 * @return self
	 */
	public function setModelo($modelo): self {
		$this->modelo = $modelo;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getNombre() {
		return $this->nombre;
	}
	
	/**
	 * @param mixed $nombre 
	 * @return self
	 */
	public function setNombre($nombre): self {
		$this->nombre = $nombre;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getVelocidad() {
		return $this->velocidad;
	}
	
	/**
	 * @param mixed $velocidad 
	 * @return self
	 */
	public function setVelocidad($velocidad): self {
		$this->velocidad = $velocidad;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getMatricula() {
		return $this->matricula;
	}
	
	/**
	 * @param mixed $matricula 
	 * @return self
	 */
	public function setMatricula($matricula): self {
		$this->matricula = $matricula;
		return $this;
	}
}
        
?>