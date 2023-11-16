<?php

/*
	Clase Alumno
*/

class Alumno
{

	public $id;
	public $nombre;
	public $apellidos;
	public $email;
	public $fecha_nacimiento;
	public $curso;
	public $asignatura;

	public function __construct(
		$id = null,
		$nombre = null,
		$apellidos = null,
		$email = null,
		$fecha_nacimiento = null,
		$curso = null,
		$asignatura = null
	) {

		$this->id = $id;
		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->email = $email;
		$this->fecha_nacimiento = $fecha_nacimiento;
		$this->curso = $curso;
		$this->asignatura = $asignatura;

	}



	function getEdad() {
		$fechaNacimiento = DateTime::createFromFormat('d/m/Y', $this->fecha_nacimiento);
		$hoy = new DateTime();
		$edad = $hoy->diff($fechaNacimiento)->y;
		return $edad;
	}


}

?>