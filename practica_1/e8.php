<?php include_once("../templates/header.php") ?><div class="block">
  <h1 class="title"> Ejercicio 8</h1>
  <div class="content is-medium">
    <p>Result: </p>
    <div class="box">
      <table class="table is-bordered" style="max-width: 600px;">
        <tr>
          <?php
          for ($i = 0; $i < 6; $i++) {
            echo '<td>' . rand(1, 49) . '</td>';
          }
          ?>
        </tr>
      </table>
    </div>
  </div><?php include_once("../templates/footer.php") ?>