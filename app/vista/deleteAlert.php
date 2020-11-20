<div id="formulario" class="col-12">

    <div class="titulo_modificar text-center ">
        <h4>¿Estas seguro de que quiere eliminar <?= strtoupper($user) ?>?</h4>
    </div>

    <form name='añadir' method="POST" action="index.php?orden=Delete">

        <input type="hidden" value="<?= $user ?>" name="id">

        <div class="text-center">
            <input type='submit' class="crear btn btn-danger" value='Borrar'>
            <button class="volver btn btn-primary">Cancelar</button>
        </div>

    </form>
</div>