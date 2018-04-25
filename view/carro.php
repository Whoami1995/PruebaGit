<?php
class carro{

    public function html(){
        echo'<html>';
        echo'<head>';
          echo'<meta http-equiv="content-type" content="text/html; charset=UTF-8">';
          echo'<title>Cesta de la Compra</title>';
          echo'<link href="tienda.css" rel="stylesheet" type="text/css">';
        echo'</head>';
         
        echo'<body>';
        echo'<div id="contenedor">';
            echo'<div id="encabezado">';
                echo'<h1>Cesta de la compra</h1>';
                echo '<form action="'.$_SERVER["PHP_SELF"].'" method="post">';
                    echo '<input type="submit" name="desconectar" value="Desconectar usuario '. $_SESSION["usuario"] .'"/>';
                    echo '<input type="submit" name="volver" value="Volver al catalogo "/>';
                echo '</form>';
            echo'</div>';
            $total = 0;
            echo'<div id="cuerpo">';
            if(isset($_SESSION["cesta"])){
                for($i = 0; $i<(count($_SESSION["cesta"]));$i++ ){
                    echo '<div class="producto">';
                        echo '<img src=img/'.$_SESSION["cesta"][$i]["imagen"].' />';
                        echo '<span> Nombre: '.$_SESSION["cesta"][$i]["nombre"].'</span>';
                        echo '<span> Cantidad: '.$_SESSION["cesta"][$i]["cantidad"].'</span>';
                        echo '<span> Precio: '.$_SESSION["cesta"][$i]["precio"].'€</span>';
                        echo '<form action="'.$_SERVER["PHP_SELF"].'" method="post">';
                            echo '<input type="submit" name="eliminar" value="Borrar del carro "/>';
                            echo '<input type=hidden name=producto value='.$i.' />';
                        echo '</form>';
                        $total+= (intval($_SESSION["cesta"][$i]["cantidad"]) * doubleval($_SESSION["cesta"][$i]["precio"]));
                    echo '</div>';
                }
            }
            else{
                echo '<div id="total"><span> No hay nada en el carrito</span></div>';
            }
                echo '<div id="total"><span> Subtotal: '.$total.'€</span></div>';
            echo '</div>';
        echo '</div>';
        echo '</body>';
        echo '</html>';
    }

    public function display(){
        $this->html();
    }
}