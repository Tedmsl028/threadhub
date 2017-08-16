<?php
include('live-search/livedb.php');

$s1=$_REQUEST["n"];
$select_query="SELECT * FROM products WHERE title LIKE '%".$s1."%'";
$sql=mysql_query($select_query);
$s="";
while($row=mysql_fetch_assoc($sql))
{
	$s=$s."
	<a class='link-p-colr' href='view.php?products=".$row['product_id']."'>
		<div class='live-outer'>
            	<div class='live-im'>
                	<img src='images/".$row['image']."'/>
                </div>
                <div class='live-product-det'>
                	<div class='live-product-name'>
                    	<p>".$row['title']."</p>
                    </div>

                </div>
            </div>
	</a>
	"	;
}
echo $s;
?>
