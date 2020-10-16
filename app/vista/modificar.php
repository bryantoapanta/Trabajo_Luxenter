  <?php
    include_once "principal.php";
    ?>

  <center>
      <h3>MODIFICAR DATOS DE <?= $datos[0] ?> </h3>
      <form name='modificar' method="POST" action="index.php?orden=Actualizar&id=" + $datos[0]>

          <table id="fmodificar">
              <tr>
                  <td>Codigo</td>
                  <td><input type="text" name="prod_codigo" value="<?= $datos[0] ?>" readonly length></td>
              </tr>
              <tr>
                  <td>Url</td>
                  <td> <input type="text" name="url_video" value="<?= $datos[1] ?>" readonly></td>
              </tr>
              <tr>
                  <td>Orden</td>
                  <td><input type="number" name="orden_video" value="<?= $datos[2] ?>" required></td>
              </tr>
              <tr>
                  <td>Activado</td>
                  <td><select name="activado_video" required>
                          <option value="0" <?= ($datos[3]==0)?"selected=\"selected\"":""; ?>>Desactivado</option>
                          <option value="1" <?= ($datos[3]==1)?"selected=\"selected\"":""; ?>>Activado</option>
                      </select> </td>
              </tr>

          </table>

          <p><input type='button' name="orden" value='Volver' onclick="volver()">
              <input type='submit' value='Modificar'>
          </p>
      </form>
  </center>