<?php
 require_once('libreria/header.php');
 require_once('libreria/footer.php');
 require_once('app/db.php');

function home(){
    head();
    echo('
    <form action="form" method="GET">
        <input type="text" id="disabledTextInput" class="form-control mt-2"  name="nombrealumno" placeholder= "nombre">
        <input type="text" id="disabledTextInput" class="form-control mt-2" name="nombreprofesor" placeholder="profesor">
        <button type="submit" class="btn btn-danger mt-2" >Agregar</button>
    </form>');  
    echo (' 
        <form action="filtrar" method="GET">
            <input type="text" id="disabledTextInput" class="form-control mt-2" name="filtrado" placeholder="filtrado">
            <button type="submit" class="btn btn-danger mt-2" >Filtrar</button>
        </form>');
    footer();
}
function showmaterias(){
    head();
    home();
    $materi = obtenerinformacion();
    mostrarmaterias($materi);
    
    footer();
}
 function mostrarmaterias($materi){
   //head();
      //  $materi = obtenerinformacion();
        echo '<table class="table table-dark table-sm mt-4 me-3">
        <thead> 
        <tr>
            <th>nombre</th>
            <th>profesor</th>
        </tr>
        </thead>';
        foreach ($materi as $materias) {
            echo '<tr>';
            echo '<td>'.$materias->nombre.'</td>
                <td>'.$materias->profesor.'</td>
               <td><a class="btn btn-danger" href="borrar/'.$materias->id.'">Borrar</a></td>
               <td><a class="btn btn-primary" href="modificar/'.$materias->id.'">Modificar</a></td>
            </tr>';
        }
        echo"</table>";
 //   footer();
 }

 function agregardato(){
     $nombrealumno = $_GET['nombrealumno'];
     $nombreprofesor = $_GET['nombreprofesor'];

    $id = agregar($nombrealumno, $nombreprofesor);
    header("Location: " . BASE_URL); 
 }

 function borrardatos($id){
     
     $borrar = borrar($id);
     
     if ($borrar){
        echo($borrar);
        header("Location: " . BASE_URL);
     }
     else {
         echo"error";
     }
 }
 
 
 function modificardatos($id){
     head();
      //  $materia = obtenerunamateria();
        echo (' <form action="formulario" method="POST">
                    <input type="text" class="form-control mt-2"  name="alumno" placeholder= "nombre">
                    <input type="text" class="form-control mt-2" name="profesor" placeholder="profesor">
                    <input type="hidden" value="'.$id.'" class="form-control mt-2 " name="id">
                     <a href="listar" class="btn btn-danger mt-2" >cancelar</a>
                     <button type="submit" class="btn btn-danger mt-2" >confirmar</button>
                   
                </form>');
    footer();
 }

 function confirmform(){
    $nombre = $_REQUEST['alumno'];
    $profesor = $_REQUEST['profesor'];
    $id = $_REQUEST['id'];
    //var_dump($nombre, $profesor, $id); 
    $modificar = modificar($nombre, $profesor, $id);
    if ($modificar){
        header("Location: " . BASE_URL);
    } else{
        echo "error";
    }
 }
function filtrar(){
    $dato = $_REQUEST['filtrado'];
    $filtrar = filtrado($dato);
   // var_dump($filtrar);
    if($filtrar){
        head();
        home();
        mostrarmaterias($filtrar);
        footer();
    } else{
        header("Location: " . BASE_URL);
    }
    
}