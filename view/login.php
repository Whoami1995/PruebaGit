<?php
require_once('control/control.php');

class login{
    // Primera parte del HTML
    public function html(){
        echo "<html>";
        echo "<head>";
          echo "<meta http-equiv='content-type' content='text/html; charset=UTF-8'>";
          echo "<title>Login Tienda Web</title>";
          echo "<link href='tienda.css' rel='stylesheet' type='text/css'>";
        echo "</head>";
        
        echo "<body>";
            echo "<div id='login'>";
            echo "<form action='".$_SERVER["PHP_SELF"]."' method='post'>";
            echo "<fieldset>";
            echo "<h1> Esta linea ha sido añadida en la version 1.2 </h1>";
			echo "<h2> ESTA LINEA ES AÑADIDA EN LA VERSION 1.3</h2>";

                echo "<legend>Login</legend>";
                if($_SESSION['error']!="")
                    echo "<script> alert('".$_SESSION['error']."')</script>";
                echo "<div class='campo'>";
                    echo "<label for='usuario' >Usuario:</label><br/>";
                    echo "<input type='text' name='usuario' id='usuario' maxlength='50' /><br/>";
                echo "</div>";
                echo "<div class='campo'>";
                    echo "<label for='password' >Contraseña:</label><br/>";
                    echo "<input type='password' name='password' id='password' maxlength='50' /><br/>";
                echo "</div>";
        
                echo "<div class='campo'>";
                    echo "<input type='submit' name='login' value='Login' />";
                echo "</div>";
            echo "</fieldset>";
            echo "</form>";
            echo "</div>";
        echo "</body>";
        echo "</html>";
    }

    // Metodo para imprimir por pantalla
    public function display(){
        $this->html();
    }

}

?>