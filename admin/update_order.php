<?php include("partials/header.php") ?>

<div class="main-content mx">
    <div class="wrapper px">
        <h1>UPDATE ORDER</h1>
        <br> <br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM table_order WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
            } else {
                header('location:' . SITEURL . 'admin/manage_order.php');
            }
        } else {
            header('location:' . SITEURL . 'admin/manage_order.php');
        }



        ?>
        <form action="" method="post">
            <table class="table_full">
                <tr>
                    <td>Food</td>
                    <td>
                        <?php echo $food; ?>
                    </td>
                </tr>
                <tr>
                    <td>price</td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                </tr>
                <tr>
                    <td>qty</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On delivery"){echo "selected";} ?> value="On delivery">On delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?>value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>customer_name</td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
                </tr>
                <tr>
                    <td>customer_contact</td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>"></td>
                </tr>
                <tr>
                    <td>customer_email</td>
                    <td><input type="text" name="customer_email" value="<?php echo $customer_email; ?>"></td>
                </tr>
                <tr>
                    <td>customer_address</td>
                    <td><textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="update order" class="btn_primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $price * $qty;
    $status = $_POST['status'];
    $customer_name = $_POST['customer_name'];
    $customer_contact = $_POST['customer_contact'];
    $customer_email = $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];

    $sql2 = "UPDATE table_order SET
    qty = '$qty',
    total = '$total',
    status = '$status',
    customer_name = '$customer_name',
    customer_contact = '$customer_contact',
    customer_email = '$customer_email',
    customer_address = '$customer_address'
    WHERE id=$id";

    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == true) {
        $_SESSION['update'] = "<div class='success'>order updated</div>";
        header('location:' . SITEURL . 'admin/manage_order.php');
    } else {
        $_SESSION['update'] = "<div class='error'>order not updated</div>";
        header('location:' . SITEURL . 'admin/manage_order.php');
    }

}
?>
<?php include("partials/footer.php") ?>