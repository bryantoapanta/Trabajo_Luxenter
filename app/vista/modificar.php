<?php
include_once "cabecera.php";
?>


<button class="btn btn-outline-light mt-3 cancelar volver">X</button>

<div id="formulario" class="col-8 offset-2">

    <div class="titulo_modificar text-center ">
        <h3>MODIFICAR DATOS DE <?= $datos[0] ?> </h3>
    </div>

    <form name='añadir' method="POST" action="index.php?orden=Actualizar">

        <div class="form-group">
            <label for="Codigo">Codigo</label>
            <input type="text" class="form-control disabled" name="prod_codigo" value="<?= $datos[0] ?>" readonly>
        </div>

        <div class="form-group">
            <label for="Url">Url</label>
            <input type="text" class="form-control disabled" name="url_video" value="<?= $datos[1] ?>" readonly>
        </div>

        <div class="form-group">
            <label for="Orden">Orden</label>
            <input type="number" class="form-control disabled" name="orden_video" value="<?= $datos[2] ?>">
        </div>

        <div class="form-group">
            <label for="Activado">Activado</label>
            <select name="activado_video" class="form-control" required>
                <option value="0" <?= ($datos[3] == 0) ? "selected=\"selected\"" : ""; ?>>Desactivado</option>
                <option value="1" <?= ($datos[3] == 1) ? "selected=\"selected\"" : ""; ?>>Activado</option>
            </select> </td>
        </div>

        <div class="text-center">
            <input type='submit' class="btn btn-success" value='Modificar'>
        </div>


        <input type="hidden" value="<?= $datos[1] ?>" name="id">

    </form>
</div>