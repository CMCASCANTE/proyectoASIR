<?php
// FUNCIÓN DE CONEXIÓN CON LA BASE DE DATOS MYSQL
function conectaDb()
    {
        try {
            $tmp = new PDO("mysql:host=db;dbname=ASIR", "karlos", "secret");
            $tmp->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $tmp->exec("set names utf8mb4");
            return $tmp;
        } catch (PDOException $e) {
            //cabecera("Error grave", MENU_PRINCIPAL);
            print "    <p>Error: No puede conectarse con la base de datos.</p>\n";
            print "\n";
            print "    <p>Error: " . $e->getMessage() . "</p>\n";
            //pie();
            exit();
        }
    }


// funcion de insert
function insertTable($nombreTabla,$datos){
    $db=conectaDb();
    $num=count($datos);

    $query="insert into $nombreTabla     
    values(";
    for ($i=0; $i < $num; $i++) { 
        if ($i==0){
            $query = $query . "\"$datos[$i]\"";    
        } else {
            $query = $query . ",\"$datos[$i]\"";
        }
    }    
    $query = $query . ");";
    $db -> query($query);
    $db = null; 
    // return (print "$query");
}


// obtener los nombres de las columnas 
function obtenerColumnas($titulo){
    $dbh=conectaDb();
    $q = $dbh -> prepare("DESCRIBE $titulo");
    $q -> execute();
    $table_fields=$q-> fetchALL(PDO::FETCH_COLUMN);
    $dbh=null;
    return $table_fields;
}


// obtener un select segun la tabla
function SelectColumna($tabla){
    $dbh=conectaDb();
    $q = $dbh -> prepare("select * from $tabla");
    $q -> execute();
    $table_fields=$q-> fetchALL(PDO::FETCH_ASSOC);
    $dbh=null;
    return $table_fields;   
}

// seleccionar la pk
function SelectPK($tabla){
    $dbh=conectaDb();
    $q = $dbh -> prepare("select column_name from information_schema.key_column_usage where table_name = \"$tabla\"");
    $q -> execute();
    $table_fields=$q-> fetchALL(PDO::FETCH_ASSOC);
    $dbh=null;
    return $table_fields;   
}

// borrar datos
function delete($tabla,$pk,$id){
    $db = conectaDb();
    $query = "delete from $tabla where $pk = \"$id\"";
    $results = $db -> query($query);
    $db=null;
    return $results;
}

// select
function Select($tabla,$cadena){
    $db = conectaDb();
    $query = "select * from $tabla ";
    $cont=0;
    foreach ($cadena as $name => $text) {
        if ($cont==0){
            $query= $query . "where $name like '%$text%'";
            $cont++;
        }
        $query= $query . " and $name like '%$text%'";
    }
    $query= $query . " order by $name";
    $results = $db -> query($query);
    $db=null;
    return $results;
}

// total de filas
function totalfilas($subquery){
    $db = conectaDb();
    $query = "select count(*) from ($subquery) as temp";
    $results = $db -> query($query);
    $db=null;
    return $results;
}


?>


