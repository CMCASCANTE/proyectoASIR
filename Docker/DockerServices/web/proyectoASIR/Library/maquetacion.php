<?php 
# funcion de head de la web, titulo y estilos de CSS
function head($title,$array){
    $num=count($array);
    print "
        <meta charset=\"UTF-8\">
        <meta name=\"author\" content=\"karlos\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">

        <title>$title</title>
    ";
    
    for ($i=0; $i < $num; $i++) { 
        print "<link rel=\"stylesheet\" href=\"$array[$i]\">";                       
    }
}

function cabecera(){
    $tName="asignaturas";
    print "<header style=\"background-color:#e9ecef\">
        <div id=\"top\">
        <h1 class=\"display-4\">Bienvenido al ProyectoASIR<h1>
        <h3 class=\"text-muted\">Base de datos de prueba, tabla: $tName</h3>
        </div>
        <hr>
    </header>";
}

function pie(){
    print "<footer>
        
    </footer>";
}



?>