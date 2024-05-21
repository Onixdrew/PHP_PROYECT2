<?php
    include('../models/ProductoDAO.php');
    $productoDAO = new claseDAO();
    $productos = $productoDAO->TraerClase($_GET['codigo']);
    print_r(json_encode($productos));
?>