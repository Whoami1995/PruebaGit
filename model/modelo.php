<?php
class modelo{
    // propiedades clase
    private static $db;
    
    // Función que comprueba los valores del login
    public static function login(){
        $_SESSION['error']="";
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $acceso = false;
        if (empty($usuario) || empty($password)){ 
            $_SESSION['error'] = "Debes introducir un nombre de usuario y una contraseña";
        }
        else {
            // Conectamos a la base de datos                                            
            try {                       
                self::$db = new PDO('mysql:host=localhost; dbname=tienda','root','');
            }
            catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
            // Ejecutamos la consulta para comprobar las credenciales
            $sql = "SELECT nombre FROM usuario WHERE nombre=:usuario AND pass=:password";
            $resultado = self::$db->prepare($sql);
            $resultado->bindValue(":usuario",$usuario);
            $resultado->bindValue(":password",$password);            
            $resultado-> execute();
            $registro = $resultado->rowCount();
            if($registro!=0){
                $acceso=true;
                $_SESSION['usuario']=$_POST['usuario'];
            }
            else
                $_SESSION['error'] = "Usuario o contraseña incorrectos";
        }
        self::$db =null;
        return $acceso;
    }

    public static function get_productos(){
        try {                       
            self::$db = new PDO('mysql:host=localhost; dbname=tienda','root','');
        }
        catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
        $sql = "SELECT * FROM producto";
        $productos = array();
        foreach (self::$db->query($sql) as $valor){
            array_push($productos,array($valor["id"],$valor["nombre"],$valor["precio"],$valor["imagen"]));
        }
        return $productos;
    }
}