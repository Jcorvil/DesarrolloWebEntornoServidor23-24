<?php

class classContacto
{

    public $nombre;
    public $remitente;
    public $asunto;
    public $mensaje;


    public function __construct(
        $nombre = null,
        $remitente = null,
        $asunto = null,
        $mensaje = null
    ) {

        $this->nombre = $nombre;
        $this->remitente = $remitente;
        $this->asunto = $asunto;
        $this->mensaje = $mensaje;

    }


}

?>