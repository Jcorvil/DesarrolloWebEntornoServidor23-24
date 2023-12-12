<?php

    class Alumnos Extends Controller {

        function __construct() {

            parent ::__construct();
            
            
        }

        function render() {

            $this->view->render('main/index');
        }
    }

?>