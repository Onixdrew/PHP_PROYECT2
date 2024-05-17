<?php
class Conexion{
		private $host="localhost";
		private $user="root";
		private $pwd="";
		private $bd="tiendax";

		function __constructor($hostCon,$userCon,$pwdCon,$bdCon){
			$this->host= $hostCon;
			$this->user= $userCon;
			$this->pwd= $pwdCon;
			$this->bd= $bdCon;
		}
		public function Conectar(){
			try{
				$this->conn=new PDO("mysql:host={$this->host}; dbname={$this->bd}",$this->user,$this->pwd);
                return $this->conn;
				

			}catch(Exception $e){
                echo "error al conectar a la base de datos =====>".$e;
				
			}
		}
        public function cerrarConexion(){
            try{
                $this->conn=null;
                echo "conexion cerrada";
            }catch(Exception $e){
                echo "error al cerrar la conexion =====>".$e;   
            };
            

        }

}


	$db=new Conexion("localhost","root","","tiendax");
$conn=$db->Conectar();
?>
                        