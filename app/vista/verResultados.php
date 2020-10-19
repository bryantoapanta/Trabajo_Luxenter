<?php

include_once "app/databaseConnect.php";
include_once "principal.php";

$paginas = ceil(ModeloUserDB::obtenerFilasResultados($palabra) / 10); //ceil para redondear un numero. Obtener paginas totales
echo "pagina ".$pagina;


$icon_alert = '<svg class="bi bi-alert-triangle text-success" width="32" height="32" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
...
</svg>';


?>
<div id='aviso'><b><?= (isset($msg)) ? $icon_alert . $msg : "" ?></b></div>

<center>
    <table>
        <tr>

            <th>Código del Productos</th>
            <th>Url</th>
            <th>Orden</th>
            <th>Activado</th>

        </tr>
        <?php

        // Foreach para imprimir todos los datos de la tabla

        foreach ($productos as $clave => $datoProducto) {
        ?>
            <tr>
                <?php
                echo "<td>$datoProducto[0]</td>";
                for ($j = 1; $j < count($datoProducto); $j++) {
                    echo "<td>$datoProducto[$j]</td>";
                }
                ?>

                <td class="modificacion"><a href="#" onclick="confirmarRenombrarProducto('<?= $datoProducto[1] ?>','<?= $datoProducto[0] ?>');">&#9998;</a></td>
                <td class="borrador"><a href="#" onclick="confirmarBorrarProducto('<?= $datoProducto[1] ?>','<?= $datoProducto[0] ?>');">&#9760;</a></td>

            </tr>
        <?php } ?>
    </table>

    <div class="paginacion">
        <a href='index.php?orden=Buscar&palabra=<?php echo $palabra ?>&id=0&pagina=<?php if ($pagina > 1) {
                                                                            echo $pagina - 1;
                                                                        } else echo $pagina  ?>'> &#10094;
        </a>

        <?php for ($x = 0; $x < $paginas; $x++) : ?>
            <a href='index.php?orden=Buscar&palabra=<?php echo $palabra ?>&id=0&pagina=<?php echo $x + 1 ?>'> <?php echo $x + 1 ?></a>
        <?php endfor ?>

        <a href='index.php?orden=Buscar&palabra=<?php echo $palabra ?>&id=0&pagina=<?php if ($pagina < $paginas) {
                                                                            echo $pagina + 1;
                                                                        } else echo $pagina  ?>'>&#10095;
        </a>
    </div>

    <div class="añadir">
        <button><a href="index.php?orden=Añadir&id=0">Añadir</a></button>
    </div>

</center>