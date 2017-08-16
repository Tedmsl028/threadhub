<?php
	require_once 'core/init.php';
	include 'includes/head.php';
	include 'includes/navigation.php';
	include 'includes/headerfull.php';
	include 'includes/leftbar.php';

  if(isset($_POST["query"]))
  {
  $output = '';
  $sqlSearch = "SELECT * FROM products WHERE brand_name LIKE '%".$search."%'";
  $result = $db->query($sqlSearch);
  }

  else {
    $sql = "SELECT * FROM products ORDER BY title";
    $result = $db->query($sqlSearch);
  }

  if(mysqli_num_rows($result) > 0)
  {
    $output .= '<h4 align="center">Search Result</h4>';
    $output .= '<div class="table-responsive">
                  <table class="table table bordered">
                    <tr>
                      <th>Brand Name</th>
                    </tr>';
      while ($row = mysqli_fetch_array($result)) {
        $output .= '
            <tr>
                <td>'.$row["brand_name"].'</td>
            </tr>';
      }
      echo $output;
  }
  else {
    echo 'Brand not Found';
  }
  ?>


  <?php
  	include 'includes/rightbar.php';
  	include 'includes/footer.php';
   ?>
