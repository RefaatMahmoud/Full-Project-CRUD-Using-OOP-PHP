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
                    <form class="Edit-Form" action="">
                    <button class="X btn btn-primary" name="edit"><i class="fa fa-edit"></i>Edit</button>
                    </form>
                    <form class="Delete-Form" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                        <input name="id" type="hidden" value="<?php echo $row['id']?>">
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
include "Include/Templetes/footer.php";
ob_end_flush();
?>