<?php
require_once "model/modelo.php";
require_once "view/login.php";
require_once "view/catalogo.php";
require_once "view/carro.php";

session_start();
class control{
    private $modelo;
    private $vista;

    public function __construct(){
        $this->recibir();
    }

    public function mostrar_login(){
        $this->vista = new login();
        $this->vista->display();
    }

    public function mostrar_catalogo(){
        $this->vista = new catalogo($_SESSION['pagina'],modelo::get_productos());
        $this->vista->display();
    }
    
    public function mostrar_carrito(){
        $this->vista = new carro();
        $this->vista->display();
    }

    public function recibir(){

        if (isset($_POST['login'])) {
            $this->modelo = new modelo();
            if($this->modelo::login()){
                $_SESSION['pagina']="1";
                $_SESSION['numero']="2";
                $this->mostrar_catalogo();
            }
        }

        // Comprobamos si se ha enviado el formulario de añadir producto a la cesta    
        elseif(isset($_POST['addcarro'])){
            // Creamos un array con los datos del nuevo producto
            $producto['nombre'] = $_POST['nombre'];
            $producto['precio'] = $_POST['precio'];
            $producto['cantidad'] = $_POST['cantidad'];
            $producto['imagen'] = $_POST['imagen'];
            //  y lo añadimos
            
            if(isset($_SESSION['cesta'])){
                array_push($_SESSION['cesta'],$producto);
            }
            else    
                $_SESSION['cesta'][0] = $producto;
                
            $this->mostrar_catalogo();   
        }

        // Comprobamos si se ha enviado el formulario de acceso a la cesta
        elseif(isset($_POST['comprar'])){
            $this->mostrar_carrito();
        }

        // Sirve para borrar un elemento del carrito
        elseif(isset($_POST['eliminar'])){
            unset( $_SESSION['cesta'][$_POST['producto']]);
            sort($_SESSION['cesta']);
            $this->mostrar_carrito();
        }

        // Sirve para volver a el catalogo desde la cesta
        elseif(isset($_POST['volver'])){
            $this->mostrar_catalogo();
        }

        // Sirve para ir a la página anterior
        elseif(isset($_POST['anterior'])){
            $pagina=intval($_SESSION['pagina']);
            if($pagina==2)
                $_SESSION['pagina']="1";
            if($pagina==3)
                $_SESSION['pagina']="2";
            $this->mostrar_catalogo();
        }

        // Sirve para ir a la página siguiente
        elseif(isset($_POST['siguiente'])){
            $pagina=intval($_SESSION['pagina']);
            if($pagina==2)
                $_SESSION['pagina']="3";
            if($pagina==1)
                $_SESSION['pagina']="2";
            $this->mostrar_catalogo();
        }          

        else{
            $_SESSION['error'] = "";
            $this->mostrar_login();
        }
    }
}