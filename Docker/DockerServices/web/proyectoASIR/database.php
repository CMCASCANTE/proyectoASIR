<?php
include "Library/maquetacion.php";
include "Library/ConectBaseDatos.php";

// comprobacion de login
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

print "<html><head>";
$cssArray=array("Asset/bootstrap/css/bootstrap.css");
head("ProyectoASIR",$cssArray);
print "</head><body>";

    cabecera();

    ?>       
       <div id="biblioteca">

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="database.php">Buscar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="insertarDatos.php">Insertar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="borrarDatos.php">Borrar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Modificar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Library/logout.php" >Logout</a>
            </li>            
        </ul>

            <?php
            $tName="asignaturas";

            $nombCampos=obtenerColumnas($tName);
            $count=count($nombCampos);

            $test=SelectColumna($tName);
            if ($tName!=""){
                if ($test!=null){                                                            
                    print "<form action=\"#\" method=\"post\">
                    <h4>Criterio de busqueda</h4>
                    <table style=\"margin-left:20px\">
                    <td>
                    <select style=\"background-color:#e9ecef\" class=\"custom-select\" id=\"inputGroupSelect01\" name=\"campo\" id=\"campo\">";
                    for ($i=0; $i < $count; $i++) {                                                   
                        print "<option value=\"$nombCampos[$i]\">$nombCampos[$i]</option>";
                    }
                    print "</select></td><td><input class=\"form-control\" type=\"text\" name=\"texto\"></td>
                    <td><input class=\"btn btn-outline-secondary\" type=\"submit\" value=\"Buscar\" name=\"buscar\"></td>";
                    
                    print "<input type=\"hidden\" name=\"tName\" value=\"$tName\"></table></form>";
                } else {
                    print "<p>La tabla $tName no tiene datos<p>";
                }
            } else {
                print "<p>La tabla que buscas no existe<p>";
            }

            // listar los resultados
            if (isset($_POST['buscar'])){                                
                $cadena=array($_POST['campo'] => $_POST['texto']); 
                $tabla=Select($tName,$cadena);
                if ($tName!=""){   
                    if (isset($_POST['buscar'])){
                        // recupero la query hecha anteriormente             
                        $query=$tabla->queryString;
                        // llamo a la funcion de total pasandole la query anterior que hemos recuperado para que la procese
                        $totLib=totalfilas($query) -> fetch();                                                              
                        // imprimo los datos
                        print "<p>Numero total de Resultados: $totLib[0]</p>";
                        
                        if ($tabla!=null){  
                            print "<form action=\"#\" method=\"POST\"> 
                            <table class=\"table table-bordered\">                            
                            <input type=\"hidden\" name=\"quer\" value=\"$query\">
                            <thead class=\"thead-light\"><tr>";
                            for ($i=0; $i < $count; $i++) { 
                                print "<th>$nombCampos[$i]</th>";
                            }
                            print "</tr></thead><tbody>";
                            while ($fila = $tabla -> fetch()) {
                                print "<tr>";
                                for ($i=0; $i < $count; $i++) { 
                                    print "<td>$fila[$i]</td>";
                                }    
                                print "</tr>";
                            }
                            print "</tbody></table></form>";  
                        } 
                    }                  
                }  
            }
            ?>

       </div>
    <?php

    pie();

print "</body></html>";
?>