<?php
foreach (glob("classes/*.php") as $filename) {
    require_once $filename; //Call all files in Classes Dir
}
ob_start();
$page_title = "Edit Product";
include "init.php";
?>

<?php
$product = new productClass;
//Fetch Data in DataBase by getItem Method
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$cat_id = isset($_GET['cat_id'])? $_GET['cat_id'] : 0;
$row = $product->getItem($id);
?>
<?php
//When Send Form
if($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['edit_btn'])) {
        $product->name = $_POST['name'];
        $product->price = $_POST['price'];
        $product->description = $_POST['description'];
        $product->id = $_POST['id'];
        $product->cat_id = $_POST['cat_id'];
        $product->update($product->$id);
        echo "<div class='alert alert-success'>Product is Updated.</div>";
    }
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">

    <table class='table table-hover table-responsive table-bordered'>
        <input name="id" type="hidden" value="<?php echo $id?>">
        <input name="cat_id" type="hidden" value="<?php echo $cat_id?>">
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' value="<?php echo $row['name']?>" required/></td>
        </tr>

        <tr>
            <td>Price</td>
            <td><input type='text' name='price' class='form-control' value="<?php echo $row['price']?>" required/></td>
        </tr>

        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control' required><?php echo $row['description']?></textarea></td>
        </tr>

        <tr>
            <td>Category</td>
            <td>
                <?php
                $cats = new categoryClass;
                $rows = $cats->read();
                echo "<select name='cat_id' class='form-control'>";
                foreach ($rows as $row) {
                ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                <?php
                }
                echo "</select>";
                ?>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <input type="submit" class="btn btn-primary" name="edit_btn" value="Edit">
            </td>
        </tr>
    </table>
</form>
<h4><a href="products.php">Back to manageSysytem</a></h4>


<?php
include "Include/Templetes/footer.php";
ob_end_flush();
?>