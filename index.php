<?php
ob_start();
$page_title = "Index Page";
include "init.php";
?>
<?php
echo "<p class='Para'>"."Hello in OOP PHP CRUD SYSTEM"."<p>";
?>
<?php
include "Include/Templetes/footer.php";
ob_end_flush();
?>
