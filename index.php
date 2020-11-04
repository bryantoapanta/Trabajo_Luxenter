<?php

include_once 'app/DB';
include_once 'app/controlador.php';
include_once 'app/databaseConnect.php';

// Inicializo el modelo
ModeloUserDB::init();
$msg = "";



// al iniciar por defecto tendra la pagina 1
if (isset($_GET["pagina"])) { // si existe un get pagina
    $pagina = $_GET["pagina"];
} else $pagina = 1; //parametro para saber la pagina e imprimir los productos por cada pagina.

/*
echo "accion -" .$_GET['orden'];
echo "<br> id - ".$_POST['id'];
var_dump(isset($_GET['orden']) && isset($_POST['id']));*/



if (  (isset($_GET['orden']) && isset($_POST['id']))  or (isset($_GET['orden']) && isset($_GET['id']))              ) {



  //echo $_GET["orden"];
  $orden=$_GET['orden'];


    switch ($_GET['orden']) {

        case "Exportar":
            CtlExportar(); // llamamos a la funcion borrar y le pasamos el codigo del producto.
            break;

        case "Borrar":
            CtlBorrar($_POST["id"]); // llamamos a la funcion borrar y le pasamos el codigo del producto.
            break;

        case "Modificar":
            //echo "aqui";
            CtlModificar($_POST["id"]); // llamamos a la funcion modificar y le pasamos el codigo del producto.
            break;

        case "Inicio":
            CtlVerProductos($msg, 1); // llamamos a la funcion verProductos.
            break;

        case "Añadir":
            CtlAñadir(); // llamamos a la funcion verProductos.
            break;

        case "Buscar":
            //echo "buscar";
            CtlBuscar($_GET["palabra"], $_GET["pagina"]); // llamamos a la funcion verProductos. Le pasamos la pagina y la palabra 
            break;

        case "Actualizar":

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

                    CtlActualizar($datos); // llamamos a la funcion verProductos y le pasamos el array.
                }
            } else  CtlVerProductos($msg, 1);
            break;
    }
} else CtlVerProductos($msg, $pagina); //cargo la funcion del controlador para imprimir los productos.