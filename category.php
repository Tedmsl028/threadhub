<?php
	require_once 'core/init.php';
	include 'includes/head.php';
	include 'includes/navigation.php';
	include 'includes/headerpartial.php';
	include 'includes/leftbar.php';

  if(isset($_GET['cat'])){
    $cat_id = sanitize($_GET['cat']);
  }else{
    $cat_id = '';
  }

	$sql = "SELECT * FROM products WHERE categories = '$cat_id'";
	$productQ = $db->query($sql);
  $category = get_category($cat_id);
 ?>
	<!-- Main Content-->
<div class="col-md-8">
	<div class="row">
		<h2 class="text-center"><?=$category['parent']. ' ' . $category['child'];?></h2>
		<?php while($product = mysqli_fetch_assoc($productQ)) : ?>
			<div class="col-md-3 text-center">
			<h4><?= $product['title']; ?></h4>
			<?php $photos = explode(',',$product['image']);?>
			<img src="<?= $photos[0]; ?>" alt="<?= $product['title']; ?>" class="img-thumbnail"/>
			<p class="list-price text-danger">List Price: R<s><?= $product['list_price']; ?>.00</s></p>
			<p class="price">Our Price: R<?= $product['price']; ?>.00</p>
			<button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $product['product_id']; ?>)">Details</button>
			</div>
		<?php endwhile; ?>
	</div>
</div>

<?php
	include 'includes/rightbar.php';
	//include 'includes/detailsmodal.php';
	include 'includes/footer.php';
 ?>