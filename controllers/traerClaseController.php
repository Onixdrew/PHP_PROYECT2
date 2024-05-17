<?php
    include('../models/ProductoDAO.php');
    $productoDAO = new claseDAO();
    $productos = $productoDAO->TraerClases($_GET['codigo']);
    print_r(json_encode($productos));
?>