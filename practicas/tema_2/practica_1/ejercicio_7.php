<?php include_once(__DIR__ . "/../../../templates/header.php") ?><div class="block">

  <?php
  $numArr = [1, 2, 3, 4, 5];
  ?>
  <div class="content is-medium">
    <p>Result: </p>
    <?php
    echo '<div class="box">';
    echo '<table class="table is-hoverable">';
    echo '<thead><tr>';
    for ($i = 0; $i < count($numArr); $i++) {
      echo '<th>' . $numArr[$i] . '</th>';
    }
    echo '</tr></thead><tbody>';
    for ($i = 2; $i <= 10; $i++) {
      echo "<tr>";
      for ($j = 0; $j < count($numArr); $j++) {
        echo "<td>" . $numArr[$j] * $i . "</td>";
      }
      echo "</tr>";
    }
    echo '</tbody></table>';
    echo '</div>';
    ?>
  </div>
</div><?php include_once(__DIR__ . "/../../../templates/footer.php") ?>