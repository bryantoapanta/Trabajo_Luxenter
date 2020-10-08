  <?php
    include_once "databaseConnect.php";
    include_once "principal.php";
    ?>

  <center>
      <h3>AÑADIR UN NUEVO PRODUCTO</h3>
      <form name='añadir' method="POST" action="index.php?orden=Añadir&id=0">

          <table id="fmodificar">
              <tr>
                  <td>Codigo</td>
                  <td><input type="text" name="prod_codigo" value="<?php $caracteres = '0123456789QWERTYUIOPASDFGHJKLZXCVBNM';
                     echo substr(str_shuffle($caracteres), 0, 8); ?>"></td>
              </tr>
              <tr>
                  <td>Url</td>
                  <td><input type="text" name="url_video"></td>
              </tr>
              <tr>
                  <td>Orden</td>
                  <td><input type="number" name="orden_video"></td>
              </tr>
              <tr>
                  <td>Activado</td>
                  <td><input type="number" name="activado_video" value="1"></td>
              </tr>

          </table>

          <p><input type='button' name="orden" value='Volver' onclick="volver()">
              <input type='submit' value='Añadir'>
          </p>
      </form>
  </center>