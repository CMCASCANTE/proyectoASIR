<?php
include "Library/maquetacion.php";

print "<html><head>";
$cssArray=array("Asset/bootstrap/css/bootstrap.css");
head("ProyectoASIR",$cssArray);
print "</head><body>";

    cabecera();

    ?>


<?php
// Sistema de login
// iniciar sesion
session_start();

// incluir archivo de conexion
require_once "Library/loginDB.php";
 
// definir variables
$username = $password = "";
$username_err = $password_err = "";
 
// logeo al introducir los datos
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // comprobacion de campo vacio
    if(empty(trim($_POST["username"]))){
        $username_err = "Introduce un usuario.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // comprobacion de campo vacio
    if(empty(trim($_POST["password"]))){
        $password_err = "Introduce la contraseña.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // validar credenciales
    if(empty($username_err) && empty($password_err)){
        $log=loginDb($username,$password);

        if(!empty($log)){
            // si el password es correcto iniciar sesion
            session_start();
            
            // guardar datos de sesion
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $username;                            
            
            // direccionar a la pagina siguiente
            header("location: database.php");

        } else{
            // error si la password no coincide
            $password_err = "Usario o contraseña incorrectos";
        }
    }
        
}
?>

    <div class="wrapper">
        <h2>Login</h2>
        <p>Introduce tus credenciales.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>            
        </form>
    </div>    

  
    <?php
    
    pie();

print "</body></html>";
?>