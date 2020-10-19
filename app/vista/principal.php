<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magento</title>
    <script type="text/javascript" src="app/vista/js/funciones.js"></script>
    
    <style type="text/css">

        #header {
            font-size: 2em;
            text-align: center;
            
        }

        #header h1 a{

            text-decoration: none;
            color: black;
        }

        #aviso {

            text-align: center;
            color: red;
            margin-top: 2em;
            margin-bottom: 2em;
        }

        table,
        th,
        td,
        tr {
            font-family: 'sanssolid', sans-serif;
            color: #9C9C9C;
            border: 2px solid #757E82;
            border-collapse: collapse;
            padding: 10px;
        }

        #buscador {
            text-align: center;
            margin-bottom: 0em;
        }

        div {
            margin-top: 2em;
            margin-bottom: 2em;
        }
    </style>

</head>

<body>

    <div id="header">
        <h1><a href="?orden=Inicio">Videos Web Magento</a></h1>
    </div>

    <div id="buscador">
        
        <input type="text" id="palabra" placeholder="Introduzca codigo a buscar" > <input type="button" id="search" value="&#128270;">
        
    </div>


</body>

</html>