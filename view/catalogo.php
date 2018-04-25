<?php
class catalogo{
    //Propiedades de la clase
    public $pagina;
    public $productos;

    // Metodo constructor
    public function __construct($pag,$prod){
        $this->pagina = $pag;
        $this->productos = $prod;        
    }

    public function html(){
        echo '<!DOCTYPE html>';
            echo '<html lang="en">';
            echo '<head>';
                echo '<meta charset="UTF-8">';
                echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
                echo '<meta http-equiv="X-UA-Compatible" content="ie=edge">';
                echo '<title>Catalogo | Página '.$_SESSION["pagina"].'</title>';
                echo '<link href="tienda.css" rel="stylesheet" type="text/css">';
            echo '</head>';
            echo '<body>';
                echo '<div id="contenedor">';
                    echo '<div id="encabezado">';
                    if(isset($_SESSION["cesta"]))
                        echo '<h1>Catalogo de productos</h1>';
                        echo '<h2>Bienvendio de nuevo '.$_SESSION["usuario"].'</h2>';
                        echo '<form action="'.$_SERVER["PHP_SELF"].'" method="post">';
                            echo '<input type="submit" name="desconectar" value="Desconectar usuario '. $_SESSION["usuario"] .'"/>';
                            echo '<input type="submit" name="comprar" value="Ir a la cesta"/>';
                            
                        echo '</form>';
                    echo '</div>';
                    echo '<div id="cuerpo">';
                        $this->productos();
                    echo '</div>';
                    echo '<div id="pie">';
                    echo    '<form action="'.$_SERVER["PHP_SELF"].'" method="post">';
                    if($_SESSION["pagina"]==1)
                        echo    '<input type="submit" name="anterior" value="pagina anterior" disabled="true" />';
                    else
                        echo    '<input type="submit" name="anterior" value="pagina anterior" />';  
                    echo     '</form>';
                    echo    '<form action="'. $_SERVER["PHP_SELF"].'" method="post">';
                    if($_SESSION["pagina"]==3)
                        echo        '<input type="submit" name="siguiente" value="pagina siguiente" disabled="true"/>';
                    else
                        echo        '<input type="submit" name="siguiente" value="pagina siguiente" />';
                echo '</div>';
            echo '</body>';
            echo '</html>';

    }

    public function productos(){
        // numero de pagina
        $numero_pagina = intval($_SESSION["pagina"]); 
        // productos por pagina
        $prod_pagina = intval($_SESSION["numero"]); 
                
        echo '<div id="productos">';
            for($i = (($numero_pagina * $prod_pagina)-$prod_pagina); $i < ($numero_pagina * $prod_pagina); $i++){
                echo '<div class="producto"><form id='.$i.' action='.$_SERVER["PHP_SELF"].' method=post>';
            // Metemos ocultos los datos de los productos
                    echo '<input type=hidden name=producto value='.$this->productos[$i][0].' />';
                    echo '<input type=hidden name=nombre value='.$this->productos[$i][1].' />';
                    echo '<input type=hidden name=precio value='.$this->productos[$i][2].' />';
                    echo '<input type=hidden name=imagen value='.$this->productos[$i][3].' />';
                    echo ' '.$this->productos[$i][1];
                    echo ' '.$this->productos[$i][2].' euros. ';
                    echo '<img src=img/'.$this->productos[$i][3].' /> ';
                    echo '<input type=submit name=addcarro value=Añadir />';
                    echo ' Cantidad <select name=cantidad>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select><br>';
            
                echo '</form>';
                echo '</div>';
            }

    }

    public function display(){
        $this->html();
    }
}