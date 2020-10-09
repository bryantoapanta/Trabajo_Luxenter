<?php

include_once "DB.php";

class ModeloUserDB
{

    private static $dbh = null;

    private static $añadir_producto = "INSERT INTO videos_web_magento2_pruebas (prod_codigo, url_video, orden, activado)
    VALUES (?, ?, ?, ?)";

    private static $consulta_orden = "SELECT * from videos_web_magento2_pruebas where orden = ?";
    private static $borrar_producto = "DELETE from videos_web_magento2_pruebas where prod_codigo = ?";
    private static $modificar_producto = "UPDATE videos_web_magento2_pruebas set url_video = ? , orden = ? ,
    activado = ? where prod_codigo = ?";


    public static function init()
    {

        if (self::$dbh == null) {
            try {
                // Cambiar  los valores de las constantes en config.php
                $dsn = "mysql:host=" . host . ";dbname=" . dbname . ";charset=utf8";
                self::$dbh = new PDO($dsn, username, password);
                // Si se produce un error se genera una excepción;
                self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Error de conexión " . $e->getMessage();
                exit();
            }
        }
    }

    // Tabla de todos los productos para visualizar
    public static function GetAll($pagina): array
    {
        $max = 10;
        $min = ($pagina - 1) * $max;

        // Genero los datos para la vista
        $stmt = self::$dbh->prepare("Select * from videos_web_magento2_pruebas Limit :min, :max"); //creamos la consulta
        $stmt->bindValue(':min', $min, PDO::PARAM_INT);
        $stmt->bindValue(':max', $max, PDO::PARAM_INT);

        $tablaProductos = [];
        $stmt->execute();

        $resultado = $stmt->fetchAll();


        foreach ($resultado as $fila) {

            //almaceno en una tabla todos los valores para posteriormente imprimirlos por pantalla
            $datosProducto = [
                $fila['prod_codigo'],
                $fila['url_video'],
                $fila['orden'],
                $fila['activado']
            ];
            $tablaProductos[$fila['prod_codigo']] = $datosProducto;
        }
        return $tablaProductos; //devolvemos una tabla con todos lo valores de la base de datos
    }



    // Actualizar datos producto (boolean)
    public static function productoUpdate($newDatos): bool
    {
        var_dump($newDatos);
        $stmt = self::$dbh->prepare(self::$modificar_producto);
        $stmt->bindValue(1, $newDatos[1]);
        $stmt->bindValue(2, $newDatos[2]);
        $stmt->bindValue(3, $newDatos[3]);
        $stmt->bindValue(4, $newDatos[0]);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }




    // Borrar un producto (boolean)
    public static function productoDel($codigo): bool
    {
        // echo "Estas en productoDel";
        $stmt = self::$dbh->prepare(self::$borrar_producto);
        $stmt->bindValue(1, $codigo);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //// Modificar un producto (boolean)
    public static function modificarProducto($codigo): array
    {

        $stmt = self::$dbh->prepare(self::$consulta_orden); //creamos la consulta
        $stmt->bindValue(1, $codigo);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while ($fila = $stmt->fetch()) {
            //almaceno en una tabla todos los valores para posteriormente imprimirlos por pantalla
            $datosProducto = [
                $fila['prod_codigo'],
                $fila['url_video'],
                $fila['orden'],
                $fila['activado']
            ];
        }
        return $datosProducto; //devolvemos una tabla con todos lo valores del producto*/
    }

    // Obtener productos totales
    public static function obtenerFilas()
    {

        $stmt = self::$dbh->query("select * from videos_web_magento2_pruebas"); //cargamos la consulta
        $stmt->execute(); //la ejecuto.
        $Total_filas = $stmt->rowCount(); //obtenemos el numero de filas totales.

        return $Total_filas; //devolvemos el valor
    }


    //// Añadir producto
    //// Añadir producto
    public static function añadirProducto($datos): bool
    {

        $stmt = self::$dbh->prepare(self::$añadir_producto);
        $stmt->bindValue(1, $datos[0]);
        $stmt->bindValue(2, $datos[1]);
        $stmt->bindValue(3, $datos[2]);
        $stmt->bindValue(4, $datos[3]);

        $confirmar = 1;
        // consulto si existe el codigo, si es true...
        if (self::consultar_codigo($datos[0])) {
            //echo "codigo encontrado";
            //return true;


            if (self::consultar_orden($datos[0], $datos[2])) { //consultamos si existe el numero de orden, si es false se ejecuta, 
                /* $msg = "El numero de orden ya existe";
                CtlVerProductos($msg, 1);*/
                echo "orden existe";
                $confirmar = 0;
            }
        }
        echo $confirmar;
        if ($confirmar == 1) {
            if ($stmt->execute()) { // si se ejecuta le devolvemos true
                //echo "aqui";
                return true;;
            }
        } else return false;

        return false;
    }

    //// Consulto si existe el codigo del producto
    public static function consultar_codigo($codigo): bool
    {

        $stmt = self::$dbh->prepare("Select * from videos_web_magento2_pruebas"); //creamos la consulta
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        //Recorremos todos los elementos en busca de un elemento ya existente
        //echo $codigo;
        foreach ($resultado as $fila) {

            /* var_dump($fila["prod_codigo"]);echo "<br>";
            var_dump($codigo);echo "<br>";*/
            if ($fila['prod_codigo'] == $codigo) { //utilizamos strcmp para comparar ambos strings
                echo "codigo bd = " . $fila["prod_codigo"] . " - " . $codigo . "<br>";
                echo " CODIGO ENCONTRADO <br>";
                return true;
            }
        }

        return false; //devolvemos una tabla con todos lo valores de la base de datos
    }




    //// Consulto si existe la orden del producto indicado
    public static function consultar_orden($codigo, $orden): bool
    {

        $stmt = self::$dbh->prepare("Select * from videos_web_magento2_pruebas"); //creamos la consulta
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        //Recorremos todos los elementos en busca de un elemento ya existente
        //echo $codigo;
        foreach ($resultado as $fila) {

            // le pregunto si el codigo coincide con algun codigo de la tabla de BD
            if (strcmp($fila['prod_codigo'], $codigo) == 0) { //utilizamos strcmp para comparar ambos strings
                echo "prod_codigo = " . $fila['prod_codigo'] . "orden = " . $fila["orden"] . " - " . $orden . "<br>";
                if ($fila["orden"] == $orden) { //si la orden ya existe le devuelvo true
                    echo "encontrado";
                    return true;
                }
            } //else echo "no";
        }

        return false; //devolvemos una tabla con todos lo valores de la base de datos
    }
}
