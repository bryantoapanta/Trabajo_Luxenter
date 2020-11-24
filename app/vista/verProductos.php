<?php

include_once "app/databaseConnect.php";
include_once "principal.php";

$paginas = ceil(ModeloUserDB::obtenerFilas() / 10); //ceil para redondear un numero. Obtener paginas totales
$maxPages = 10;
$inicio = 0;
$max = 0;


$icon_alert = '<svg class="bi bi-alert-triangle text-success" width="32" height="32" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
...
</svg>';
?>


<center>




    <div class="container contenedor_verVideos">
        <div class="row justify-content-center">

            <?php
            if (isset($msg) && $msg != "") {
                echo "<div class='mt-2'><b>" . $msg . "</b></div>";
            } else echo "<div id='avisoa' class='alert alert-primary mt-2'><b> Videos Totales: " . ModeloUserDB::obtenerTotalVideos() . "</b></div>";
            ?>

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

        <!--PAGINACION -->
        <div class="row justify-content-center">
            <div class="paginacion">
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



                    <?php

                    if (($pagina % $maxPages) != 0) { //cuando la pagina / maxPages de como resultado un distinto de resto 0.
                        $inicio = $maxPages * floor($pagina / $maxPages);
                        $max = $maxPages * ceil($pagina / $maxPages);
                    } else {
                        $inicio = $maxPages * ceil($pagina / $maxPages) - 10; // cuando da 0, se resta 10 al inicio ya que si no le restamos 10, el inicio seria -> 10*(10/10) = 10. 
                        $max = $maxPages * ceil($pagina / $maxPages); //inicio ->10     max->10. Sin esto , no imprimiria la paginacion cuando pulses en 10.
                    }

                    for ($x = $inicio; $x < $max; $x++) {

                        if ($paginas > $x) { ?>
                            <li class="page-item <?php if ($pagina == $x + 1) {
                                                        echo "active";
                                                    } ?>">
                                <a class="page-link" href='index.php?pagina=<?php echo $x + 1 ?>
            <?php
                            if (isset($_GET["ordenar"])) {
                                echo "&ordenar=" . $_GET["ordenar"];
                            } ?>'> <?php echo $x + 1 ?></a></li>
                        <?php }
                    }

                    if ($paginas > $max) { //si el total de paginas es mayor al $maximo, se imprime....sino deja de imprimirse ya que en las ultimas paginas, el max es mayor que las paginas, ejemplo paginas->43    max->50
                        ?>
                        <li class="page-item">
                            <a class="page-link" href='index.php?pagina=<?php echo $max + 1 ?>
                    '> <?php echo "..." ?></a></li>
                    <?php
                    }
                    ?>


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