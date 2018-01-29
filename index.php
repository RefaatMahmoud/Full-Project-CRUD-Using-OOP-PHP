<?php
ob_start();
$page_title = "Index Page";
include "init.php";
?>
<?php
echo "<h4 class='Para'>"."Hello in OOP PHP CRUD SYSTEM"."</h4>";
?>
<a href="product.php">Add new Product</a><br>
<a href="products.php">All Products in System</a>
<?php
include "Include/Templetes/footer.php";
ob_end_flush();
?>
