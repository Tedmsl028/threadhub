<?php
require_once 'core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
include 'includes/headerfull.php';
include 'includes/leftbar.php';


      $id = $_GET['id'];
      $brandSql = "SELECT * FROM brand where id = '$id'";
      $db->query($brandSql);

      echo "<table>";
      while($row = mysqli_fetch_array($brandSql))
      {
      echo "<tr>";
      echo "<td>" . $row['brand_name'] . "</td>" ."<br>";
      echo "<td>" . $row['review_title'] . "</td>";
      echo "<td>" . $row['review'] . "</td>";
      echo "</tr>";
      }
      echo "</table>";
  ?>

  </div>
</div>

<?php
	include 'includes/footer.php';
 ?>
