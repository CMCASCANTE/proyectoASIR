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
            <a class="nav-link" href="insertarDatos.php">Insertar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="borrarDatos.php">Borrar</a>
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
        // borrar datos si se pulsa el input de borrar
        // obtencion de la pk
        $test=SelectPK($tName);
        // guardamos el nombre del campo pk 
        $intermed=$test[0];        
        $pk=$intermed['column_name'];        
        // borrado de datos
        if (isset($_POST['borrar'])){
            $value=$_POST["value"];            
            delete($tName,$pk,$value);
            print "<p>Fila con id=$value eliminada</p><br>";                                            
        }   
        
        # introducir datos para borrar
        if ($pk!=null){
            ?>
                <form action="#" method="POST">
                    <h4><?php print "$pk";?> de la fila a eliminar</h4>
                    <table style="margin-left:20px">
                    <tr><td>
                        <label style="padding-right: 40px" class="input-group-text" for="value"><?php print "$pk"; ?></label>
                    </td><td>
                        <input class="form-control" type="text" name="value" id="value">
                    </td><td>   
                        <input class="btn btn-outline-secondary" type="submit" value="Borrar" name="borrar">
                    </td></tr></table>
                </form>

            <?php
        } else {
            print "<p>No hay datos de ninguna tabla</p>";
        }
      
    pie();

print "</body></html>";
?>