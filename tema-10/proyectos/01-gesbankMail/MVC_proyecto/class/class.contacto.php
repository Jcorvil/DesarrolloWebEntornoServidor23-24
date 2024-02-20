<?php

class classContacto
{

    public $nombre;
    public $email;
    public $asunto;
    public $mensaje;


    public function __construct(
        $nombre = null,
        $email = null,
        $asunto = null,
        $mensaje = null
    ) {

        $this->nombre = $nombre;
        $this->email = $email;
        $this->asunto = $asunto;
        $this->mensaje = $mensaje;

    }


}

?>