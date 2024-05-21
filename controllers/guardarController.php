<?php
include ('../models/ProductoDAO.php');
$clase = new claseDAO();
if($_REQUEST['codigo']==''){
    $clase->agregarClases( $_GET['nombre'], $_GET['precio'], $_GET['categoria']);
}else {
    $clase->actualizarClase($_REQUEST['codigo'],$_REQUEST['nombre'],$_REQUEST['precio'],$_REQUEST['categoria']);
}
?>