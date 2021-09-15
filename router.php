<?php

require_once('funciones.php');
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

if (!empty($_GET['action'])){
    $action = $_GET['action'];
} else{
    $action = 'listar';
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'listar':
        //mostrarmaterias();
        showmaterias();
    break;
    case 'form':
        agregardato();
    break;
    case 'borrar':
        borrardatos($params[1]);
    break;
    case 'modificar':
        modificardatos($params[1]);
    break;
    case 'formulario':
        confirmform();
    break;
    case 'filtrar':
        filtrar();
    break;
    default:
        echo "error";
    break;
}