<?php 
require_once("../inc/config.php");
require_once(ROOT_PATH . "inc/products.php");


if(empty($_GET['page'])){
	$current_page = 1;
} else {
	$current_page = $_GET['page'];
}

$current_page = intval($current_page);

$total_products = get_products_count();
$products_per_page = 8;
$total_pages = ceil($total_products/$products_per_page);

if($current_page > $total_pages){
	header("Location: ./?page=".$total_pages);
}

if($current_page < 1){
	header("Location: ./");
}

$start = (($current_page - 1) * $products_per_page) + 1 ;
$end = $current_page * $products_per_page;
if($end > $total_products){
	$end = $total_pages;
}

$products = get_products_subset($start, $end);
 
$pageTitle = "Mike's Full Catalog of Shirts";
$section = "shirts";
include(ROOT_PATH . 'inc/header.php');
?>
		<div class="section shirts page">

			<div class="wrapper">

				<h1>Mike&rsquo;s Full Catalog of Shirts</h1>
				
				<?php include(ROOT_PATH . 'inc/pages_list_nav.php'); ?>

				<ul class="products">
					<?php foreach($products as $product) { 
							echo get_list_view_html($product);
						}
					?>
				</ul>

				<?php include(ROOT_PATH . 'inc/pages_list_nav.php'); ?>

			</div>

		</div>

<?php include(ROOT_PATH . 'inc/footer.php') ?>