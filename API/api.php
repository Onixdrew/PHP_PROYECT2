<?php
    include("../models/ProductoDAO.php");
    //  Especifica que el tipo de contenido devuelto es JSON.
    header("Content-Type: application/json");
    // Permite que cualquier origen (dominio) tenga acceso a la API. Si necesitas restringir el acceso a dominios específicos, deberías cambiar el asterisco * por un dominio específico.
    header("Access-control-Allow-Origin: *");
    // Especifica los métodos HTTP que están permitidos en la API.
    header("Access-control-Allow-Methods: GET, POST, PUT, DELETE");
    // Especifica los encabezados que se permiten en la solicitud.
    header("Access-control-Allow-Headers: Content-Type, Authorization");
    


    $method = $_SERVER['REQUEST_METHOD'];
    $claseDAO= new claseDAO();
    
#! ESTO ES CON IF
/*     // if ($method == 'GET'){
    //     $class= new ProductosDAO();
    //     $clases = $class->traerProducto();
    //     echo(json_encode($clases))
    // }

    // if ($method == 'POST'){

    //     $class= new ProductosDAO();
    //     $data = json_decode(file_get_contents('php://input'),true);
    //     $clases = $class->guardarProducto($_data['nombre'],$_data['descripcion']);
    //     echo(json_encode($clases))

    // } 
*/

    switch ($method) {
        case 'GET':
            $data = $claseDAO->TraerClases();
            echo(json_encode($data));
            break;

        case 'POST':

            $data = json_decode(file_get_contents('php://input'), true);
            
            $codigo = $data['nombre'];
            $nombre = $data['precio'];
            $categoria = $data['categoria'];

            $respuesta = $claseDAO->agregarClases($codigo, $nombre, $categoria);
            echo(json_encode($respuesta));
            break;
        
        case 'DELETE':
            $data = json_decode(file_get_contents('php://input'),true);
            $resultado = $claseDAO->eliminarClase($data['codigo']);
            echo(json_encode($resultado));
            break;
        
        case 'PUT':
            $data = json_decode(file_get_contents('php://input'),true);
            $resultado = $claseDAO->actualizarClase($data['codigo'],$data['nombre'],$data['precio'],$data['categoria']);
            echo(json_encode($resultado));
            break;
        
        default:
            http_response_code(405);
            echo json_encode(array("message"=>"Metodo no permitido"));
            break;
    }


?>