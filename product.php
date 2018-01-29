<?php
foreach (glob("classes/*.php") as $filename) {
    require_once $filename; //Call all files in Classes Dir
}
ob_start();
$page_title = "Product Page";
include "init.php";
?>
<?php
//Create Product
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(isset($_POST['create_btn']))
    {
        $product = new productClass();
        $product->name = $_POST['name'];
        $product->price = $_POST['price'];
        $product->description = $_POST['description'];
        $product->cat_id = $_POST['cat_id'];
        $product->create();
        echo "<div class='alert alert-success'>Product was created.</div>";
    }
}
?>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">

        <table class='table table-hover table-responsive table-bordered'>

            <tr>
                <td>Name</td>
                <td><input type='text' name='name' class='form-control' required/></td>
            </tr>

            <tr>
                <td>Price</td>
                <td><input type='text' name='price' class='form-control' required/></td>
            </tr>

            <tr>
                <td>Description</td>
                <td><textarea name='description' class='form-control' required></textarea></td>
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
                    <input type="submit" class="btn btn-primary" name="create_btn" value="create">
                </td>
            </tr>
        </table>
    </form>
    <h4><a href="products.php">Go TO ALl Products in Sysytem</a></h4>

<?php
include "Include/Templetes/footer.php";
ob_end_flush();
?>