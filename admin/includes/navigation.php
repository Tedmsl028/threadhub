<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<a href="/threadhub/admin/index.php" class="navbar-brand">ThreadHub Online Clothing Store - Administrator</a>
			<ul class="nav navbar-nav">
		<!-- Menu Items -->
    <li><a href="brands.php">Brands</a></l>
			<li><a href="categories.php">Categories</a></l>
				<li><a href="products.php">Products</a></l>
					<li><a href="archived.php">Archived</a></l>
						<?php if(has_permission('admin')) :?>
						<li><a href="users.php">Users</a></l>
						<?php endif; ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello <?=$user_data['first'];?>!
							<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="change_password.php">Change Password</a></li>
								<li><a href="logout.php">Log Out</a></li>
							</ul>
						</li>
			<!-- <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $parent['category']; ?><span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="#"></a></li>
				</ul>
			</li>
		</div> -->
</nav>
