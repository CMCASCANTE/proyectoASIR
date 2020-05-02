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

    <div>   

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="database.php">Buscar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="insertarDatos.php">Insertar</a>
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
    // Insertar los datos en la base de datos cuando se pulsa el boton
    if($_POST['insertar']!=null){
        $nTable=$_POST['tName'];
        $nCampos=$_POST['nCampos'];
        $datos=array();
        for ($i=0;$i<$nCampos;$i++){
            $datos[$i]=$_POST[$i];
        }                
        insertTable($nTable,$datos);
        print "<p>Nuevos datos introducidos correctamente</p>";        
    }    

    // lee los campos y prepara los datos para enviarlos a la base de datos
    $tName="asignaturas";
    if ($tName!=""){
        $column=obtenerColumnas($tName);
        if ($column[0]!=""){
            ?>
            <form id="insertar" action="#" method="post">
            <?php                
                
                $i=0;                
                print "<h4>Datos a introducir:</h4>
                <table style=\"margin-left:20px\">
                <caption id=\"insertar\"><input class=\"btn btn-outline-secondary\" type=\"submit\" name=\"insertar\" value=\"Añadir Datos\">                                
                </caption>";
                
                foreach ($column as $campo ){                    
                    print "<tr>
                    <td><label for=\"$i\" class=\"input-group-text\">$campo</label>
                    </td>
                    <td><input id=\"$i\" class=\"form-control\" name=\"$i\" type=\"text\">
                    </td></tr>";                               
                    $i++;
                }                
                print "<input type=\"hidden\" name=\"tName\" value=\"$tName\">
                <input type=\"hidden\" name=\"nCampos\" value=\"$i\">                
                </table></form>";                
            } else {
                print "<h3>La tabla introducida no existe</h3>";
            }
    }

    
    ?>
   </div>

    <?php

    pie();

print "</body></html>";
?>