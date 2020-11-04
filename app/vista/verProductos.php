<?php

include_once "app/databaseConnect.php";
include_once "principal.php";

$paginas = ceil(ModeloUserDB::obtenerFilas() / 10); //ceil para redondear un numero. Obtener paginas totales
//echo $pagina;


$icon_alert = '<svg class="bi bi-alert-triangle text-success" width="32" height="32" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
...
</svg>';



?>


<center>



    <?php
    if (isset($msg) && $msg != "") {

        echo "<div id='aviso'><b>" . $icon_alert . $msg . "</b></div>";
    } else echo "<div id='aviso'><b> Videos Totales: " . ModeloUserDB::obtenerTotalVideos() . "</b></div>";
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>

                            <th><a class="enlaces" href="?ordenar=prod_codigo">Código</a></th>
                            <th><a class="enlaces" href="?ordenar=url_video">Url</a></th>
                            <th a class="enlaces">Orden</th>
                            <th a class="enlaces">Estado</th>
                            <th a class="enlaces">Modificar</th>
                            <th a class="enlaces">Eliminar</th>

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
                                        echo "<td>Desactivado</td>";
                                    } else  echo "<td>Activado</td>";
                                }

                                if ($j == 2) {

                                    echo "<td>$datoProducto[2]</td>";
                                }
                            }
                            ?>

                            <td class="modificacion puntero" value="<?= $datoProducto[1] ?>">&#9998;</a></td>
                            <td class="borrador puntero" value="<?= $datoProducto[1] ?>">&#9760;</a></td>

                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>


        <div class="row">
            <div class="paginacion col-4 offset-lg-4 offset-sm-3 offset-1">
                <ul class="pagination ">
                    <li class="page-item ">
                        <a class="page-link" href='index.php?pagina=<?php if ($pagina > 1) {
                                                                        echo $pagina - 1;
                                                                    } else echo $pagina  ?>
                                    <?php
                                    if (isset($_GET["ordenar"])) {
                                        echo "&ordenar=" . $_GET["ordenar"];
                                    } ?>'> &#10094;
                        </a>
                    </li>



                    <?php for ($x = 0; $x < $paginas; $x++) : ?>
                        <li class="page-item <?php if ($pagina == $x + 1) {
                                                    echo "active";
                                                } ?>">
                            <a class="page-link" href='index.php?pagina=<?php echo $x + 1 ?>
            <?php
                        if (isset($_GET["ordenar"])) {
                            echo "&ordenar=" . $_GET["ordenar"];
                        } ?>'> <?php echo $x + 1 ?></a></li>
                    <?php endfor ?>


                    <li class="page-item ">
                        <a class="page-link" disabled href='index.php?pagina=<?php if ($pagina < $paginas) {
                                                                                    echo $pagina + 1;
                                                                                } else echo $pagina  ?>
                                            <?php
                                            if (isset($_GET["ordenar"])) {
                                                echo "&ordenar=" . $_GET["ordenar"];
                                            } ?>'>&#10095;

                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <div>
            <button class=" añadir btn btn-success añadirElemento ">Añadir</button>
            <button class=" exportar btn btn-info">Exportar a Exel</button>
        </div>

    </div>