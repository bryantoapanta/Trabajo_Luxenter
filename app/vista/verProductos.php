<?php

include_once "principal.php";


?>
<div id='aviso'><b><?= (isset($msg)) ? $msg : "" ?></b></div>

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
                echo "<td>$clave</td>";
                for ($j = 1; $j < count($datoProducto); $j++) {
                    echo "<td>$datoProducto[$j]</td>";
                }
                ?>
                <td class="borrador"><a href="#" onclick="confirmarBorrarProducto('<?= $clave  ?>');">&#9760;</a></td>
                <td class="modificacion"><a href="#" onclick="confirmarRenombrarProducto('<?= $clave  ?>');">&#9998;</a></td>

            </tr>
        <?php } ?>
    </table>

</center>