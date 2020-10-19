<?php

include_once 'app/databaseConnect.php';

// Muestro la tabla con los productos
function CtlVerProductos($msg, $pagina)
{
    if (isset($_GET["ordenar"])) {
        if ($_GET["ordenar"] == "prod_codigo") {

            echo "codigo";
            $msg = "Ordenador por Codigo Del Prodcuto";
            $productos = ModeloUserDB::GetAllOrder($pagina);
        } else  if ($_GET["ordenar"] == "url_video") {

            echo "url";
            $msg = "Ordenador por Url";
            $productos = ModeloUserDB::GetAllOrder($pagina);
        }
    } else $productos = ModeloUserDB::GetAll($pagina);

    // Obtengo los datos del modelo
    //$productos = ModeloUserDB::GetAll($pagina);
    // Invoco la vista
    //var_dump($productos);
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

    CtlVerProductos($msg, 1);
}

//Pasamos el codigo y los nuevos datos para actualizar el producto.
function CtlModificar($codigo)
{
    var_dump($codigo);
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



    CtlVerProductos($msg, 1);
}

function CtlAñadir()
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (isset($_POST['prod_codigo']) && isset($_POST['url_video']) && isset($_POST['orden_video']) && isset($_POST['activado_video'])) { //si los campos  tienen valor

            $codigo = $_POST['prod_codigo'];
            $url = $_POST['url_video'];
            $orden = $_POST['orden_video'];
            $activo = $_POST['activado_video'];

            $datos = [ //alamcenamos los valores en un array
                $codigo,
                $url,
                $orden,
                $activo
            ];

            if (ModeloUserDB::añadirProducto($datos)) {
                $msg = "¡Producto añadido con éxito!";
            } else $msg = "Producto no añadido!"; // llamamos a la funcion para añadir productos.

            CtlVerProductos($msg, 1);
        }
    } else  include_once("vista/añadir.php");


    var_dump($datos);
}

// Muestro la tabla con los productos
function CtlBuscar($palabra, $pagina)
{

    if (isset($_GET["ordenar"])) {
        if ($_GET["ordenar"] == "prod_codigo") {

            echo "codigo";
            $msg = "Ordenador por Codigo Del Prodcuto";
            $productos = ModeloUserDB::GetResultados($palabra,$pagina);
        } else  if ($_GET["ordenar"] == "url_video") {

            echo "url";
            $msg = "Ordenador por Url";
            $productos = ModeloUserDB::GetResultados($palabra,$pagina);
        }
    } else {
        $productos = ModeloUserDB::GetResultados($palabra, $pagina);
    }

    // Invoco la vista
    //var_dump($productos);
    $numResultados = ModeloUserDB::obtenerFilasResultados($palabra);
    if ($numResultados > 0) {
        $msg = "Resultados de " . $palabra . ": " . $numResultados;
        include_once 'vista/verResultados.php';
    } else  $msg = $msg . "<br>" . "Resultados de " . $palabra . ": " . $numResultados;

    include_once 'vista/verResultados.php';

    //echo "estas en controlador productos";


}
