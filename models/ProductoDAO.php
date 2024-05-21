<?php
include ('../conexiones/conexion.php');

class claseDAO {
  public $codigo;
  public $nombre;
  public $precio;
  public $categoria;

  function __construct($cod = null, $nombreC = null, $precio = null, $categ = null) {
    $this->codigo = $cod;
    $this->nombre = $nombreC;
    $this->precio = $precio;
    $this->categoria = $categ;
  }

  function TraerClases() {
    $conexion = new Conexion('localhost', 'root', '', 'tiendax');

    try {
      $conn = $conexion->Conectar();
      $stmt = $conn->query('SELECT * FROM productos'); 
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $rows; 
      $conexion->cerrarConexion();
    } catch (PDOException $e) {
      echo "Error al conectar a la base de datos ======>" . $e->getMessage();
    }
  }

  

  function eliminarClase($codigo) {
    $conexion = new Conexion('localhost', 'root', '', 'tiendax');

    try {
      $conn = $conexion->Conectar();
      $stmt = $conn->prepare("DELETE FROM productos WHERE codigo= $codigo"); // Using prepared statement for security
      $stmt->bindParam('codigo', $codigo);
      $stmt->execute();
      $conexion->cerrarConexion(); 
      return "Exito";
    } catch (PDOException $e) {
      echo "Error al conectar a la base de datos ======>" . $e->getMessage();
    }
  }
}

// function guardarClase($codigo,$nombre,$precio,$categoria) {
//   $conexion = new Conexion('localhost', 'root', '', 'tiendax');

//   try {
//     $conn = $conexion->Conectar();
//     $agregar = $conn->prepare ("INSERT INTO productos (`codigo`,`nombre`,`precio`,`categoria`) VALUES (?, ?, ?)");
//     $agregar->bindParam(1, $nombre);
//     $agregar->bindParam(2, $precio);
//     $agregar->bindParam(3, $categoria);
//     $stmt->execute();
//     return "exito, se agrego un nuevo registro" ;

//   } catch (PDOException $e) {
//     echo "Error al conectar a la base de datos ======>" . $e->getMessage();
//   }
// }


function TraerClase ($codigo){
  $conexion = new Conexion ('localhost', 'root', '', 'tiendax');
  try {
      $conn = $conexion->Conectar();
      $stmt = $conn->query("SELECT * FROM productos WHERE codigo={$codigo}");
      $rows = $stmt->fetch(PDO::FETCH_ASSOC);
      return $rows;
      $conexion->cerrarConexion();
  } catch(PDOException $e) {
      echo "error al conectar a la base de datos ======>".$e->getMessage();
  }
}

function agregarClases($codigo,$nombre, $precio, $categoria) {
  $conexion = new Conexion('localhost', 'root', '', 'tiendax');
  try {
      $conn = $conexion->Conectar(); 
      $agregar = $conn->prepare("INSERT INTO productos (`codigo`, `nombre`, `precio`, `categoria`) VALUES (?, ?, ?)");
      $agregar->bindParam(1, $codigo);
      $agregar->bindParam(2, $nombre);
      $agregar->bindParam(3, $precio);
      $agregar->bindParam(4, $categoria);
      $agregar->execute();
      return "Agregado Exitosamente";
  } catch(PDOException $e) {
      return "Error al conectar a la base de datos: " . $e->getMessage();
  }
} 


function actualizarClase($codigo,$nombre,$precio,$categoria) {
  $conexion = new Conexion('localhost', 'root', '', 'tiendax');

  try {
    $conn = $conexion->Conectar();
  $query="UPDATE productos SET nombre='$nombre',precio='$precio',categoria='$categoria' WHERE codigo=$codigo";
    $stmt = $conn->prepare($query); 
    $stmt->execute();
    return "Se actulizo Correctamente";
    $conexion->cerrarConexion(); 
  } catch (PDOException $e) {
    echo "Error al conectar a la base de datos ======>" . $e->getMessage();
  }
}

