<?php include_once(__DIR__ . "/../../../templates/header.php") ?>

<div class="block">

  <?php
  $cadena1 = "Lo que estoy escribiendo es un string";
  $cadena2 = " muuuuuy largo";
  $cadena3 = $cadena1 . $cadena2;
  ?>
  <div class="content is-medium">
    <p><?= $cadena3 ?></p>
    <p>Result: </p>
    <p>La posición de la primera ‘e’.</p>
    <div class="box">
      <?= strpos($cadena3, "e"); ?>
    </div>
    <p>La posición de la última ‘u’.</p>
    <div class="box">
      <?= strrpos($cadena3, "u"); ?>
    </div>
    <p>La posición de la palabra “texto”</p>
    <div class="box">
      <?= strpos($cadena3, "texto"); ?>
    </div>
  </div>
</div>
<?php include_once(__DIR__ . "/../../../templates/footer.php") ?>