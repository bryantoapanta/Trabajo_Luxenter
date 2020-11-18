<?php

include_once 'app/databaseConnect.php';

// Muestro la tabla con los productos
function CtlVerProductos($msg, $pagina)
{
    if (isset($_GET["ordenar"])) {
        if ($_GET["ordenar"] == "prod_codigo") {

            // echo "codigo";
            $msg = "<div class='alert alert-primary'>Ordenador por Codigo Del Prodcuto</div>";
            $productos = ModeloUserDB::GetAllOrder($pagina);
        } else  if ($_GET["ordenar"] == "url_video") {

            //echo "url";
            $msg = "<div class='alert alert-primary'>Ordenador por Url</div>";
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
        $msg = "<div class='alert alert-success'>El Producto se borrado correctamente</div>";
    } else {
        $msg = "<div class='alert alert-danger'>No se pudo borrar el producto</div>";
    }

    CtlVerProductos($msg, 1);
}

//Pasamos el codigo y los nuevos datos para actualizar el producto.
function CtlModificar($codigo)
{
    //var_dump($codigo);
    $datos = ModeloUserDB::modificarProducto($codigo);

    // var_dump($datos);
    include_once "vista/modificar.php";
}


//Actualizamos los datos

function CtlActualizar($datos)
{


    //var_dump($datos);
    if (ModeloUserDB::productoUpdate($datos)) {
        $msg = "<div class='alert alert-success'>¡Actualizacion completada con éxito!</div>";
    } else $msg = "<div class='alert alert-danger'>¡Actualizacion no realizada!</div>";



    CtlVerProductos($msg, 1);
}

function CtlAñadir()
{
    if (isset($_POST["prod_codigo"])) {
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
                    $msg = "<div class='alert alert-success'>¡Producto añadido con éxito!</div>";
                } else $msg = "<div class='alert alert-danger'>Producto no añadido!</div>"; // llamamos a la funcion para añadir productos.

                CtlVerProductos($msg, 1);
            }
        } else  include_once "vista/añadir.php";
    } else  include_once "vista/añadir.php";
    //var_dump($datos);
}


// Muestro la tabla con los productos que contengan la palabra escrita
function CtlBuscarPalabra($palabra)
{

    $productos = ModeloUserDB::GetResultadosPalabra($palabra);

    $numResultados = ModeloUserDB::obtenerFilasResultados($palabra);
    if ($numResultados > 0) {
        $msg = "<div class='alert alert-success'>Resultados de " . $palabra . ": " . $numResultados."</div>";
        include_once 'vista/verResultados.php';
    } else  $msg =  "<div class='alert alert-danger'>" . "Resultados de " . $palabra . ": " . $numResultados."</div>";

    include_once 'vista/verResultados.php';
}

function CtlExportar()
{

    $datos = ModeloUserDB::cargarDatos();
    ModeloUserDB::exportarExel($datos);
}
