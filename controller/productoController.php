<?php 
require_once '../model/producto.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
    $precio = filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT);
    $idCategoria = filter_input(INPUT_POST, 'id_categoria', FILTER_VALIDATE_INT);

    if (!$idCategoria){
        echo "Debe seleccionar una categoria";
        exit;
    }

    var_dump($nombre);
    var_dump($precio);
    var_dump($idCategoria);

    if ($nombre && $precio && $idCategoria){

        $producto = new producto();
        $producto->insertar($nombre, $precio, $idCategoria);

        echo "Producto Guardado";
        header("Location: ../view/listar-productos.php");
        exit;   
         
    } else {
        echo "Error: datos invalidos";
    }
}

if(isset($_GET['eliminar'])){
    $id = (int) $_GET['eliminar'];

    $producto = new producto();
    $producto->eliminar($id);

    header("Location: ../view/listar-productos.php");
    exit;
}

?>