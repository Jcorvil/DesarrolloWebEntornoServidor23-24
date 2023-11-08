<?php

/*
	Clase articulo
*/

class Articulo
{

	private $id;
	private $descripcion;
	private $modelo;
	private $marca;
	private $categoria;
	private $unidades;
	private $precio;

	public function __construct(
		$id = null,
		$descripcion = null,
		$modelo = null,
		$marca = null,
		$categoria = [],
		$unidades = null,
		$precio = null
	) {

		$this->id = $id;
		$this->descripcion = $descripcion;
		$this->modelo = $modelo;
		$this->marca = $marca;
		$this->categoria = $categoria;
		$this->unidades = $unidades;
		$this->precio = $precio;

	}






	/* ******* GETTERS Y SETTERS ******* */

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id 
	 * @return self
	 */
	public function setId($id): self
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getDescripcion()
	{
		return $this->descripcion;
	}

	/**
	 * @param mixed $descripcion 
	 * @return self
	 */
	public function setDescripcion($descripcion): self
	{
		$this->descripcion = $descripcion;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getModelo()
	{
		return $this->modelo;
	}

	/**
	 * @param mixed $modelo 
	 * @return self
	 */
	public function setModelo($modelo): self
	{
		$this->modelo = $modelo;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getMarca()
	{
		return $this->marca;
	}

	/**
	 * @param mixed $marca 
	 * @return self
	 */
	public function setMarca($marca): self
	{
		$this->marca = $marca;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCategoria()
	{
		return $this->categoria;
	}

	/**
	 * @param mixed $categoria 
	 * @return self
	 */
	public function setCategoria($categoria): self
	{
		$this->categoria = $categoria;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getUnidades()
	{
		return $this->unidades;
	}

	/**
	 * @param mixed $unidades 
	 * @return self
	 */
	public function setUnidades($unidades): self
	{
		$this->unidades = $unidades;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPrecio()
	{
		return $this->precio;
	}

	/**
	 * @param mixed $precio 
	 * @return self
	 */
	public function setPrecio($precio): self
	{
		$this->precio = $precio;
		return $this;
	}
}

?>