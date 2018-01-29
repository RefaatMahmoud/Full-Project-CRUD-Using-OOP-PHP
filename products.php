<?php
foreach (glob("classes/*.php") as $filename) {
    require_once $filename; //Call all files in Classes Dir
}
ob_start();
$page_title = "Manage Products";
include "init.php";
?>
<?php
$products = new productClass;
//Read All Data as Method readAll()
$rows = $products->readALl();
//Handle Delete Button
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(isset($_POST['delete']))
    {
        //get id from hidden input ^_^
        //echo $_POST['id'];
        $products->id = $_POST['id'];
        //echo $products->id;
        $products->Delete($products->id);
        echo "<div class='alert alert-success'>Product was Deleted.</div>";
        header('REFRESH:1 ;URL=products.php');
    }
}
?>
<?php
$do = isset($_GET['do']) ? $_GET['do'] : 'manage';
if($do == "manage") {
    ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($rows as $row) {
            ?>
            <tr>
                <th scope="row"><?php echo $row['name'] ?></th>
                <td><?php echo $row['price'] ?></td>
                <td><?php echo $row['description'] ?></td>
                <td>
                    <a href="products.php?do=edit&id=<?php echo $row['id']?>&cat_id=<?php echo $row['cat_id']?>">
                        <button class="btn btn-primary" name="edit"><i class="fa fa-edit"></i>Edit</button>
                    </a>
                    <form class="Delete-Form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <input name="id" type="hidden" value="<?php echo $row['id'] ?>">
                        <button class="btn btn-danger" name="delete"><i class="fa fa-close"></i>Delete</button>
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}
if($do == "edit")
{
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $cat_id = isset($_GET['cat_id'])? $_GET['cat_id'] : 0;
    $row = $products->getItem($id);
    ?>
    <h2>Edit Item</h2>
    <form action="products.php?do=update" method="POST">

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
    <?php
}
else if($do == 'update')
{
    $product = new productClass;
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['edit_btn'])) {
            $product->name = $_POST['name'];
            $product->price = $_POST['price'];
            $product->description = $_POST['description'];
            $product->id = $_POST['id'];
            $product->cat_id = $_POST['cat_id'];
            $product->update();
            echo "<div class='alert alert-success'>Product is Updated Successfully .</div>";
        }
    }
    header('REFRESH:2 ;URL=products.php');
}?>
<?php
include "Include/Templetes/footer.php";
ob_end_flush();
?>