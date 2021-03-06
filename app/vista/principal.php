<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-15">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos Magento</title>
    <script type="text/javascript" src="app/vista/js/funciones.js"></script>
    <!-- SCRIPTS JS-->
    <script src="app/vista/js/jquery.js"></script>
    <script src="app/vista/js/ajax.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <LINK REL=StyleSheet HREF="app/vista/css/css.css" TYPE="text/css" MEDIA=screen>


</head>

<body>
    <div class="container">

        <div class="row">
            <div id="header" class="col text-center">
                <h1><a href="?orden=Inicio">VIDEOS WEB MAGENTO</a></h1>
            </div>
        </div>

        <div class="row text-center">
            <div id="buscador" class="col-4 offset-4">
                <input type="text" class="form-control" id="busqueda" name="busqueda" placeholder="&#128270;  Buscar... ">
            </div>
        </div>

        <div class="row mt-0 ">
            <div id="resultado" class="col-4 offset-4 ">
            </div>

        </div>


    </div>

    <div class="row">
        <div id="div_modificar" class="align-self-center col-6 offset-3 rounded">
        </div>
        <div id="div_borrar" class="align-self-center col-6 offset-3 rounded"></div>

    </div>
</body>


</html>