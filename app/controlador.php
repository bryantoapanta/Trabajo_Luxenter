<?php

include_once 'app/databaseConnect.php';

// Muestro la tabla con los productos
function CtlVerProductos($msg)
{
    // Obtengo los datos del modelo
    $productos = ModeloUserDB::GetAll();
    // Invoco la vista
    include_once 'vista/verProductos.php';
    //echo "estas en controlador productos";


}

// controlador para poder borrar un producto con sus datos
function CtlBorrar($codigo)
{

    //llamamos a la funcion que borrara un producto
    if (ModeloUserDB::productoDel($codigo)) {
        $msg = "El Producto se borrado correctamente.";
    } else {
        $msg = "No se pudo borrar el producto.";
    }

    CtlVerProductos($msg);
}

//Pasamos el codigo y los nuevos datos para actualizar el producto.
function CtlModificar($codigo)
{
    $datos = ModeloUserDB::modificarProducto($codigo);

    var_dump($datos);
    include_once("vista/modificar.php");
}


//Actualizamos los datos

function CtlActualizar($datos)
{


    //var_dump($datos);
    if (ModeloUserDB::productoUpdate($datos)) {
        $msg = "¡Actualizacion completada con éxito!";
    } else $msg = "¡Actualizacion no realizada!";



    CtlVerProductos($msg);
}
