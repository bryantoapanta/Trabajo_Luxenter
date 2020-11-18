
<div class="row justify-content-center">
    <div class="col-12">
        <table class="table table-hover">
            <thead class="thead-dark text-center">
                <tr>

                    <th class="col1"><a class="enlaces" href="?ordenar=prod_codigo">Código</a></th>
                    <th class="col2"><a class="enlaces" href="?ordenar=url_video">Url</a></th>
                    <th a class="enlaces col3">Orden</th>
                    <th a class="enlaces col4">Estado</th>
                    <th a class="enlaces colf">Modificar</th>
                    <th a class="enlaces colf">Eliminar</th>

                </tr>
            </thead>
            <?php

            // Foreach para imprimir todos los datos de la tabla

            foreach ($productos as $clave => $datoProducto) {
            ?>
                <tr>
                    <?php
                    echo "<td>$datoProducto[0]</td>";
                    for ($j = 1; $j < count($datoProducto); $j++) {

                        if ($j == 1) {
                            echo "<td><a target='_blank' href='$datoProducto[1]'>$datoProducto[$j]</a></td>";
                        }
                        if ($j == 3) {
                            if ($datoProducto[3] == 0) {
                                echo "<td class='text-center'>Desactivado</td>";
                            } else  echo "<td class='text-center'>Activado</td>";
                        }

                        if ($j == 2) {

                            echo "<td>$datoProducto[2]</td>";
                        }
                    }
                    ?>

                    <td class="modificacion puntero text-center" value="<?= $datoProducto[1] ?>">&#9998;</a></td>
                    <td class="borrador puntero text-center" value="<?= $datoProducto[1] ?>">&#9760;</a></td>

                </tr>
            <?php } ?>
        </table>
    </div>
</div>


<div>
    <button class=" añadir btn btn-success añadirElemento ">Añadir</button>
    <button class=" exportar btn btn-info">Exportar a Exel</button>
</div>