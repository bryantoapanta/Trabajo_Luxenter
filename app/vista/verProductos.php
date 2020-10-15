<?php

include_once "app/databaseConnect.php";
include_once "principal.php";

$paginas = ceil(ModeloUserDB::obtenerFilas() / 10); //ceil para redondear un numero. Obtener paginas totales
echo $pagina;


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

                <td class="modificacion"><a href="#" onclick="confirmarRenombrarProducto('<?= $datoProducto[1]?>','<?=$datoProducto[0]?>');">&#9998;</a></td>
                <td class="borrador"><a href="#" onclick="confirmarBorrarProducto('<?= $datoProducto[1]?>','<?=$datoProducto[0]?>');">&#9760;</a></td>

            </tr>
        <?php } ?>
    </table>

    <div class="paginacion">
        <a href='index.php?pagina=<?php if ($pagina > 1) {
                                        echo $pagina - 1;
                                    } else echo $pagina  ?>'> <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-bar-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z" />
            </svg> </a>

        <?php for ($x = 0; $x < $paginas; $x++) : ?>
            <a href='index.php?pagina=<?php echo $x + 1 ?>'> <?php echo $x + 1 ?></a>
        <?php endfor ?>

        <a disabled href='index.php?pagina=<?php if ($pagina < $paginas) {
                                                echo $pagina + 1;
                                            } else echo $pagina  ?>'> <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-bar-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z" />
            </svg> </a>
    </div>

    <div class="añadir">
        <button><a href="index.php?orden=Añadir&id=0">Añadir</a></button>
    </div>

</center>