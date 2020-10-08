<?php

include_once "DB.php";

class ModeloUserDB
{

    private static $dbh = null;

    private static $consulta_codigo = "Select * from videos_web_magento2_pruebas where prod_codigo = ?";
    private static $borrar_producto = "Delete from videos_web_magento2_pruebas where prod_codigo = ?";
    private static $modificar_producto = "Update videos_web_magento2_pruebas set url_video = ? , orden = ? ,
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

    // Tabla de todos los usuarios para visualizar
    public static function GetAll(): array
    {
        // Genero los datos para la vista
        $stmt = self::$dbh->query("select * from videos_web_magento2_pruebas");

        $tablaProductos = [];
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
            $tablaProductos[$fila['prod_codigo']] = $datosProducto; //creo una fila de valores para cada producto.
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

        $stmt = self::$dbh->prepare(self::$consulta_codigo); //creamos la consulta
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
}
