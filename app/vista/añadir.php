


  <button class="btn btn-outline-light mt-3 cancelar volver">X</button>

  <div id="formulario" class="col-8 offset-2">

      <div class="titulo_modificar text-center ">
          <h3>AÑADIR NUEVO ELEMENTO</h3>
      </div>

      <form name='añadir' method="POST" action="index.php?orden=Añadir">

          <div class="form-group">
              <label for="Codigo">Codigo</label>
              <input type="text" class="form-control disabled" name="prod_codigo" value="<?php $caracteres = '0123456789QWERTYUIOPASDFGHJKLZXCVBNM';
                                                                                            echo substr(str_shuffle($caracteres), 0, 8); ?>">
          </div>

          <div class="form-group">
              <label for="Url">Url</label>
              <input type="text" class="form-control disabled" name="url_video" value="">
          </div>

          <div class="form-group">
              <label for="Orden">Orden</label>
              <input type="number" class="form-control disabled" name="orden_video" value="<?= $datos[2] ?>">
          </div>

          <div class="form-group">
              <label for="Activado">Activado</label>
              <select name="activado_video" class="form-control" required>
                  <option value="0">Desactivado</option>
                  <option value="1">Activado</option>
              </select> </td>
          </div>

          <div class="text-center">
              <input type='submit' class="btn btn-success" value='Añadir'>
          </div>


          <input type="hidden" value="0" name="id">
          

      </form>
  </div>