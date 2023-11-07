<?php

/*
Class calculadora
*/

class Calculadora
{

	private $valor1;
	private $valor2;
	private $operacion;
	private $resultado;


	public function __construct(
		$valor1 = 0,
		$valor2 = 0,
		$operacion = null,
		$resultado = 0,
	) {
		$this->valor1 = $valor1;
		$this->valor2 = $valor2;
		$this->operacion = $operacion;
		$this->resultado = $resultado;

	}


	public function suma()
	{
		$this->resultado = $this->valor1 + $this->valor2;
	}
	public function resta()
	{
		$this->resultado = $this->valor1 - $this->valor2;

	}
	public function multiplicacion()
	{
		$this->resultado = $this->valor1 * $this->valor2;
	}
	public function division()
	{
		$this->resultado = $this->valor1 / $this->valor2;

	}

	public function potencia()
	{
		$this->resultado = pow($this->valor1, $this->valor2);

	}


	/* **********GETTERS Y SETTERS********** */

	/**
	 * @return mixed
	 */
	public function getValor1()
	{
		return $this->valor1;
	}

	/**
	 * @param mixed $valor1 
	 * @return self
	 */
	public function setValor1($valor1): self
	{
		$this->valor1 = $valor1;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getValor2()
	{
		return $this->valor2;
	}

	/**
	 * @param mixed $valor2 
	 * @return self
	 */
	public function setValor2($valor2): self
	{
		$this->valor2 = $valor2;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getOperacion()
	{
		return $this->operacion;
	}

	/**
	 * @param mixed $operacion 
	 * @return self
	 */
	public function setOperacion($operacion): self
	{
		$this->operacion = $operacion;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getResultado()
	{
		return $this->resultado;
	}

	/**
	 * @param mixed $resultado 
	 * @return self
	 */
	public function setResultado($resultado): self
	{
		$this->resultado = $resultado;
		return $this;
	}





}


?>