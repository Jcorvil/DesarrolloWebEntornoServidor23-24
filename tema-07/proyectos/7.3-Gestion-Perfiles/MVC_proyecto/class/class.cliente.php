<?php

/*
    Creamos una clase para cada tabla
    las propiedades públicas y una propiedad para cada columna

    No respetará la propiedad de encapsulamiento.
*/

class classCliente
{

    public $id;
    public $nombre;
    public $apellidos;
    public $email;
    public $telefono;
    public $ciudad;
    public $dni;

    public function __construct(
        $id = null,
        $nombre = null,
        $apellidos = null,
        $email = null,
        $telefono = null,
        $ciudad = null,
        $dni = null,
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->ciudad = $ciudad;
        $this->dni = $dni;
    }


}

?>