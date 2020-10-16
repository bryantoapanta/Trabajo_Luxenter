<?php

include_once "DB.php";

class ModeloUserDB
{

    private static $dbh = null;

    private static $añadir_producto = "INSERT INTO videos_web_magento2_pruebas (prod_codigo, url_video, orden, activado)
    VALUES (?, ?, ?, ?)";

    private static $consulta_url_modificar = "SELECT * from videos_web_magento2_pruebas where url_video = ?";
    private static $consulta_orden = "SELECT * from videos_web_magento2_pruebas where orden = ?";
    private static $borrar_producto = "DELETE from videos_web_magento2_pruebas where url_video = ?";
    private static $modificar_producto = "UPDATE videos_web_magento2_pruebas set  prod_codigo = ?,url_video= ?, orden = ? ,
    activado = ? where url_video = ?";


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
        $stmt = self::$dbh->prepare("Select * from videos_web_magento2_pruebas LIMIT :min , :max"); //creamos la consulta
        $stmt->bindValue(':min', $min, PDO::PARAM_INT);
        $stmt->bindValue(':max', $max, PDO::PARAM_INT);

        $tablaProductos = [];
        $stmt->execute();

        $resultado = $stmt->fetchAll();

        $contador = 0;

        foreach ($resultado as $fila) {
            //echo $fila["prod_codigo"]."<br> ".$contador;
            //almaceno en una tabla todos los valores para posteriormente imprimirlos por pantalla
            $datosProducto = [
                $fila['prod_codigo'],
                $fila['url_video'],
                $fila['orden'],
                $fila['activado']
            ];

            $tablaProductos[$contador++] = $datosProducto;
        }
        return $tablaProductos; //devolvemos una tabla con todos lo valores de la base de datos
    }



    // Actualizar datos producto (boolean)
    /* public static function productoUpdate($newDatos): bool
    {
        var_dump($newDatos);
        $stmt = self::$dbh->prepare(self::$modificar_producto);
        $stmt->bindValue(1, $newDatos[0]);
        $stmt->bindValue(2, $newDatos[2]);
        $stmt->bindValue(3, $newDatos[3]);
        $stmt->bindValue(4, $newDatos[1]);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }*/


    // Actualizar datos producto (boolean)
    public static function productoUpdate($newDatos): bool
    {
        var_dump($newDatos);
        echo $newDatos[1];
        $stmt = self::$dbh->prepare("UPDATE videos_web_magento2_pruebas set  orden = ? ,
        activado = ? where url_video = ?");
        $stmt->bindValue(1, $newDatos[2]); // codigo
        $stmt->bindParam(2, $newDatos[3]); // url 
        $stmt->bindValue(3, $newDatos[1], PDO::PARAM_STR); //url primary key




        try {
            $stmt->execute();
            return true; //
        } catch (Exception $e) {
            echo '<script type="text/javascript">
                alert("Error: No se puede duplicar ORDEN");
                </script>';
            //echo $e->getMessage();
            return false;
        }
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
        echo "modificar";
        $stmt = self::$dbh->prepare(self::$consulta_url_modificar); //creamos la consulta
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
    public static function añadirProducto($datos): bool
    {

        $stmt = self::$dbh->prepare(self::$añadir_producto);
        $stmt->bindValue(1, $datos[0]);
        $stmt->bindValue(2, $datos[1]);
        $stmt->bindValue(3, $datos[2]);
        $stmt->bindValue(4, $datos[3]);

        $confirmar = 1;

        if (self::consultarUrl($datos[1]) == false) { // si al consultar la url te devuelve false...
            echo "es false consultar datos";
            if (self::consultar_codigo($datos[0])) {
                //echo "codigo encontrado";
                //return true;


                if (self::consultar_orden($datos[0], $datos[2])) { //consultamos si existe el numero de orden, si es false se ejecuta, 
                    /* $msg = "El numero de orden ya existe";
                    CtlVerProductos($msg, 1);*/
                    echo '<script type="text/javascript">
                        alert("La Orden ya existe");
                         </script>';
                    $confirmar = 0;
                }
            }
        } else {
            echo '<script type="text/javascript">
            alert("La Url ya existe");
            </script>';
            $confirmar = 0;
        }
        //return false;
        // consulto si existe el codigo, si es true...

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


    //// Consulto si existe la url del producto a modificar
    public static function consultarUrl($codigo): bool
    {
        var_dump($codigo);
        $stmt = self::$dbh->prepare("Select * from videos_web_magento2_pruebas where url_video = ?"); //creamos la consulta
        $stmt->bindValue(1, $codigo, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        //Recorremos todos los elementos en busca de un elemento ya existente
        //echo $codigo;
        echo "resultado= " . $stmt->rowCount();
        if ($stmt->rowCount() > 0) {
            echo "  existe resultado url";
            return true;
        } else "no existe url";
        return false; //obtenemos el numero de filas totales.

    }

    //// Consulto si existe la url del producto
    /* public static function consultarUrlModificar($codigo, $url): bool
    {
        var_dump($codigo);
        $stmt = self::$dbh->prepare("Select * from videos_web_magento2_pruebas where prod_codigo = ? and url_video = ?"); //creamos la consulta
        $stmt->bindValue(1, $codigo, PDO::PARAM_STR);
        $stmt->bindValue(2, $url, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        //Recorremos todos los elementos en busca de un elemento ya existente
        //echo $codigo;
        echo "resultado= " . $stmt->rowCount();
        if ($stmt->rowCount() == 1) {
            echo "  existe una url, puede modificar <br>";
            return true;
        } else "no existe resultados de url <br>";
        return false; //obtenemos el numero de filas totales.

    }*/


    //// Consulto si existe la orden del producto indicado
    public static function consultar_orden_modificar($codigo, $orden): bool
    {

        $stmt = self::$dbh->prepare("Select * from videos_web_magento2_pruebas where prod_codigo =? and orden = ?"); //creamos la consulta
        $stmt->bindValue(1, $codigo, PDO::PARAM_STR);
        $stmt->bindValue(2, $orden, PDO::PARAM_INT);
        echo " soncultar orden <br>";
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            echo "procesando..";
            return true;
        } else return false;
        /*
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

        return false; //devolvemos una tabla con todos lo valores de la base de datos*/
    }

    //--------------------------------BUSCADOR-------------------------

    // Tabla de todos los productos para visualizar
    public static function GetResultados($palabra, $pagina): array
    {
        $max = 10;
        $min = ($pagina - 1) * $max;
        echo $min."   ".$max."   "."  pagina -> ".$pagina;
        // Genero los datos para la vista
        $palabra = "%".$palabra."%";
        $stmt = self::$dbh->prepare("SELECT * FROM videos_web_magento2_pruebas WHERE prod_codigo LIKE  ? or url_video LIKE ? LIMIT ?, ?"); //creamos la consulta
       // echo "palabra -> " . $palabra;
        $stmt->bindValue(1, $palabra,PDO::PARAM_STR);
        $stmt->bindValue(2, $palabra, PDO::PARAM_STR);
        $stmt->bindValue(3, $min,PDO::PARAM_INT);
        $stmt->bindValue(4, $max,PDO::PARAM_INT);
        

        $tablaProductos = [];
        try {
            $stmt->execute();
            
        } catch (Exception $e) {
            
            echo $e->getMessage();
            
        }
        echo "post";
        $resultado = $stmt->fetchAll();

        $contador = 0;

        foreach ($resultado as $fila) {
            //echo $fila["prod_codigo"]."<br> ".$contador;
            //almaceno en una tabla todos los valores para posteriormente imprimirlos por pantalla
            $datosProducto = [
                $fila['prod_codigo'],
                $fila['url_video'],
                $fila['orden'],
                $fila['activado']
            ];

            $tablaProductos[$contador++] = $datosProducto;
        }
        return $tablaProductos; //devolvemos una tabla con todos lo valores de la base de datos
    }
}
