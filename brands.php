<?php
require_once 'core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
include 'includes/headerfull.php';
include 'includes/leftbar.php';

$sql = "SELECT * FROM manufacture ORDER BY manu_title";
$brands = $db->query($sql);
?>

<div class="col-md-8">
  <div class="row">
		<h2 class="text-center">Brands</h2>
<?php
  $last = '';
  while ($row = mysqli_fetch_array($brands)) {
      $current = strtolower($row['manu_title'][0]);
      if ($last != $current) {
          echo strtoupper($current) . "<br />";
          $last = $current;
          $id = $row['manufacture_id']; 
      }
      echo "<a href='brand_details.php?id=" . $row['manufacture_id'] . "'>".$row{'manu_title'}."</a><br />";
      }
  ?>

  </div>
</div>

<?php
	include 'includes/rightbar.php';
	include 'includes/footer.php';
 ?>
