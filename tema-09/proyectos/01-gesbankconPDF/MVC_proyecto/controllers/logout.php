<?php
session_start();
session_destroy();
header("location:" . URL . "main");
exit;
?>
