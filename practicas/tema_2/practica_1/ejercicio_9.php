<?php include_once(__DIR__ . "/../../../templates/header.php") ?><div class="block">

  <div class="content is-medium">
    <p>Result: </p>
    <?php
    echo '<div class="box">';
    for ($i = 0; $i < 5; $i++) {
      $red = rand(0, 255);
      $green = rand(0, 255);
      $blue = rand(0, 255);
      $circleSVG = '<svg height="100" width="100"><circle cx="50" cy="50" r="40" stroke="black" stroke-width="3" fill="rgb(' . $red . ',' . $green . ', ' . $blue . ')" /></svg>';

      echo $circleSVG;
    }
    echo '</div>';
    ?>
  </div>
</div><?php include_once(__DIR__ . "/../../../templates/footer.php") ?>