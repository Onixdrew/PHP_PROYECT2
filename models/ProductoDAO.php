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
    } catch (PDOException $e) {
      echo "Error al conectar a la base de datos ======>" . $e->getMessage();
    }
  }

  

  function eliminarClase($id) {
    $conexion = new Conexion('localhost', 'root', '', 'tiendax');

    try {
      $conn = $conexion->Conectar();
      $stmt = $conn->prepare("DELETE FROM productos WHERE codigo=:id"); // Using prepared statement for security
      $stmt->bindParam(':codigo', $id);
      $stmt->execute();
      $conexion->cerrarConexion(); // Ensure connection is closed
    } catch (PDOException $e) {
      echo "Error al conectar a la base de datos ======>" . $e->getMessage();
    }
  }
}