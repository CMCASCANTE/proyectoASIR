<?php

function connDb()
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

function loginDb($user,$pass)
    {
        $db = connDb();
        $stmt = $db -> prepare("SELECT user, password FROM users WHERE user = ? and password = ?");
        $stmt->execute([$user,$pass]);
        $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $db=null;
        return $fetch;
    }


