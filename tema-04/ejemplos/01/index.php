<?php
    /*
        Programación Orientada a Objetos
        Ejemplo 01. Creación de una clase con encapsulamiento
    */

    class Vehiculo {
        
        private $modelo;
        private $nombre;
        private $velocidad;
        private $matricula;
        
        public function __construct() {
        
        
            $this->modelo = null;
            $this->nombre = null;
            $this->matricula = null;
            $this->velocidad = 0;


        }

        
        #Setters
        //Modificar los valores de los atributos de un objeto
        public function setModelo($modelo){
            $this->modelo = $modelo;
        }
        
        public function setNombre($nombre){
            $this->modelo = $nombre;
        }
        
        public function setMatricula($matricula){
            $this->modelo = $matricula;
        }
        
        public function setVelocidad($velocidad){
            $this->modelo = $velocidad;
        }
        
        
        #Getters
        //Recibir los valores de los atributos de un objeto
        public function getModelo($modelo){
            return $this->modelo;
        }
        
        public function getNombre($nombre){
            return $this->nombre;
        }
        
        public function getMatricula($matricula){
            return $this->matricula;
        }
        
        public function getVelocidad($velocidad){
            return $this->velocidad;
        }
        
        
        
    }
        
?>