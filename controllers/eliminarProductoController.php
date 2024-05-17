<?php
    include("../models/ProductoDAO.php");
    $productoDAO = new claseDAO();
    $mensage = $productoDAO->eliminarClase($_GET['codigo']);
?>