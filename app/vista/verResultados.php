<?php

include_once "app/databaseConnect.php";
include_once "principal.php";

$paginas = ceil(ModeloUserDB::obtenerFilasResultados($palabra) / 10); //ceil para redondear un numero. Obtener paginas totales
//echo "pagina " . $pagina;


$icon_alert = '<svg class="bi bi-alert-triangle text-success" width="32" height="32" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
...
</svg>';


?>
<div id='aviso'><b><?= (isset($msg)) ? $icon_alert . $msg : "" ?></b></div>

<center>
    <table>
        <tr>

            <th><a class="enlaces" href="?orden=Buscar&palabra=<?php echo $palabra ?>&id=0&pagina=<?php echo $pagina ?>&ordenar=prod_codigo">Código del Productos</a></th>
            <th><a class="enlaces" href="?orden=Buscar&palabra=<?php echo $palabra ?>&id=0&pagina=<?php echo $pagina ?>&ordenar=url_video">Url</a></th>
            <th a class="enlaces">Orden</th>
            <th a class="enlaces">Activado</th>

        </tr>
        <?php

        // Foreach para imprimir todos los datos de la tabla

        foreach ($productos as $clave => $datoProducto) {
        ?>
            <tr>
                <?php
                echo "<td>$datoProducto[0]</td>";
                for ($j = 1; $j < count($datoProducto); $j++) {

                    if ($j==1){echo "<td><a href='$datoProducto[1]'>$datoProducto[$j]</a></td>";}
                    else echo "<td>$datoProducto[$j]</td>";
                   
                }
                ?>

                <td class="modificacion"><a href="#" class="enlaces" onclick="confirmarRenombrarProducto('<?= $datoProducto[1] ?>','<?= $datoProducto[0] ?>');">&#9998;</a></td>
                <td class="borrador"><a href="#" class="enlaces" onclick="confirmarBorrarProducto('<?= $datoProducto[1] ?>','<?= $datoProducto[0] ?>');">&#9760;</a></td>

            </tr>
        <?php } ?>
    </table>

    <div class="paginacion">
        <a href='index.php?orden=Buscar&palabra=<?php echo $palabra ?>&id=0&pagina=<?php if ($pagina > 1) {
                                                                                        echo $pagina - 1;
                                                                                    } else echo $pagina  ?>
                                                                                     <?php
                                                                                        if (isset($_GET["ordenar"])) {
                                                                                            echo "&ordenar=" . $_GET["ordenar"];
                                                                                        } ?>'> &#10094;
        </a>

        <?php for ($x = 0; $x < $paginas; $x++) : ?>
            <a href='index.php?orden=Buscar&palabra=<?php echo $palabra ?>&id=0&pagina=<?php echo $x + 1 ?>
            <?php
            if (isset($_GET["ordenar"])) {
                echo "&ordenar=" . $_GET["ordenar"];
            } ?>'> <?php echo $x + 1 ?></a>
        <?php endfor ?>

        <a href='index.php?orden=Buscar&palabra=<?php echo $palabra ?>&id=0&pagina=<?php if ($pagina < $paginas) {
                                                                                        echo $pagina + 1;
                                                                                    } else echo $pagina  ?>
                                                                                     <?php
                                                                                        if (isset($_GET["ordenar"])) {
                                                                                            echo "&ordenar=" . $_GET["ordenar"];
                                                                                        } ?>'>&#10095;
        </a>
    </div>

    <div class="añadir">
        <button><a class="enlaces" href="index.php?orden=Añadir&id=0">Añadir</a></button>
    </div>

</center>