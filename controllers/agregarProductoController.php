<?php
include ("../models/ProductoDAO.php");
$clase =new claseDAO();
$msg=$clase->agregarClases($_GET['codigo'], $_GET['nombre'], $_GET['precio'], $_GET['categoria']);

?>