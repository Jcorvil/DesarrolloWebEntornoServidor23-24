<?php

/*
	Clase deportivo
*/


class Deportivo extends Vehiculo
{

	private $cilindrada;
	private $km;


	public function __construct(
		$modelo = null,
		$nombre = null,
		$matricula = null,
		$velocidad = null,
		$cilindrada = null,
		$km = null,
	) {
		parent::__construct($modelo, $nombre, $matricula, $velocidad);
		$this->cilindrada = $cilindrada;
		$this->km = $km;
	}


	


	/**
	 * @return mixed
	 */
	public function getCilindrada() {
		return $this->cilindrada;
	}
	
	/**
	 * @param mixed $cilindrada 
	 * @return self
	 */
	public function setCilindrada($cilindrada): self {
		$this->cilindrada = $cilindrada;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getKm() {
		return $this->km;
	}
	
	/**
	 * @param mixed $km 
	 * @return self
	 */
	public function setKm($km): self {
		$this->km = $km;
		return $this;
	}


	public function velocidadMax(){
		$this->velocidad = 500;
	}


}

?>