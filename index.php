<?php
	require_once 'core/init.php';
	include 'includes/head.php';
	include 'includes/navigation.php';
	include 'includes/headerfull.php';
	include 'includes/leftbar.php';

	$sql = "SELECT * FROM products WHERE featured = 1";
	$featured = $db->query($sql);
 ?>
	<!-- Main Content-->
<div class="col-md-8">
	<div class="row">
 <!-- Search-->
		<div class="container">
	    <br />
	      <div class="form-group">
	          <div class="input-group">
	            <span class="input-group-addon">Search</span>
	            <input type="text" name="search_text" id="search_text" placeholder="Search by Brand or Product" class="form-control" />
	          </div>
	      </div>
	      <br />
	      <div id="result">
	      </div>
	  </div>
		 <!-- Search-->

		<h2 class="text-center">Featured Products</h2>
		<?php while($product = mysqli_fetch_assoc($featured)) : ?>
			<div class="col-md-3 text-center">
			<h4><?= $product['title']; ?></h4>
			<?php $photos = explode(',',$product['image']);?>
			<img src="<?= $photos[0]; ?>" alt="<?=$product['title']; ?>" class="img-thumbnail"/>
			<p class="list-price text-danger">List Price: R<s><?= $product['list_price']; ?>.00</s></p>
			<p class="price">Our Price: R<?= $product['price']; ?>.00</p>
			<button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $product['product_id']; ?>)">Details</button>
			</div>
		<?php endwhile; ?>
	</div>
</div>

<?php
	include 'includes/rightbar.php';
	include 'includes/footer.php';
 ?>

 <script>
 $(document).ready(function(){
	 load_data();

	 function load_data(sqlSearch){
		 $.ajax({
			 url : '/threadhub/fetch.php',
			 method : "post",
			 data : {search:text},
			 dataType : "text",
			 success : function(data){
				 $('#result').html(data);
			 }
		 });
	 }
   $('search_text').keyup(function(){
     var search = $(this).val();
     if(search != '')
     {
			 load_data(search);
     }
     else {
       load_data();
		 }
   });
 });
 </script>
