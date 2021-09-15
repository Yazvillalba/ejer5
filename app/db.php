<?php

    function obtenerinformacion(){
        // 1. Abrimos  una conexión
         $db = new PDO('mysql:host=localhost;'.'dbname=db_materias;charset=utf8', 'root', '');

         // 2. Enviamos la consulta (2 sub pasos)
        $query = $db->prepare('SELECT * FROM materia');
        $query->execute();

        // 3. obtengo la respuesta de la DB
        $materias = $query->fetchAll(PDO::FETCH_OBJ); // obtengo un arreglo con TODAS las materias

        return $materias;
    }

    function agregar($nombrealumno,$nombreprofesor){
        $db = new PDO('mysql:host=localhost;'.'dbname=db_materias;charset=utf8', 'root', '');

        $query = $db->prepare('INSERT INTO materia(nombre,profesor) VALUES (?,?)');
        $query->execute([$nombrealumno,$nombreprofesor]);

        // 3. Obtengo y devuelo el ID de la tarea nueva
        return $db->lastInsertId();
    }

    
    function borrar($id) {
        $db = new PDO('mysql:host=localhost;'.'dbname=db_materias;charset=utf8', 'root', '');
    
        $query = $db->prepare('DELETE FROM materia WHERE id=?');
        return $query->execute([$id]);
    }

    function modificar($nombre, $profesor, $id) {
        $db = new PDO('mysql:host=localhost;'.'dbname=db_materias;charset=utf8', 'root', '');
    
        $query = $db->prepare('UPDATE `materia` SET `nombre` = ?, `profesor` = ? WHERE `materia`.`id` = ?');
        return $query->execute([$nombre, $profesor, $id]);
    }

    function filtrado($dato) {
        $db = new PDO('mysql:host=localhost;'.'dbname=db_materias;charset=utf8', 'root', '');
    
       $query = $db->prepare('SELECT * FROM `materia` WHERE `materia`.`nombre` LIKE ? OR `materia`.`profesor` LIKE ?');
       // $query = $db->prepare('SELECT * FROM `materia` WHERE * LIKE ?');
       $query->execute([$dato.'%',$dato.'%']);
        $filtro = $query->fetchAll(PDO::FETCH_OBJ);
        return $filtro;
    }