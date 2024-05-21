<?php
include ("../models/ProductoDAO.php");
$clase=new claseDAO();
$clases = $clase->TraerClases();
print_r(json_encode($clases));
?>