<?php
    include('../models/ProductoDAO.php');
    $productoDAO = new claseDAO();
    $productos = $productoDAO->TraerClases();
    print_r(json_encode($productos));
?>