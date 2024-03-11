<?php include("partials/header.php") ?>

<!-- main section starts -->
<div class="main-content mx">
    <div class="wrapper px">
        <h1>MANAGE ORDER</h1>
        <br>
        <br>
        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <div class="row flex ">
            <table class="table_full">
                <tr>
                    <th>Id</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>total</th>
                    <th>Status</th>
                    <th>Customer_name</th>
                    <th>Customer_contact</th>
                    <th>Customer_email</th>
                    <th>Customer_address</th>
                    <th>Action</th>
                </tr>
                <?php
                $sql = "SELECT * FROM table_order ORDER BY id DESC";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                $numm = 1;
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];

                        ?>

                        <tr>
                            <td>
                                <?php echo $numm++; ?>
                            </td>
                            <td>
                                <?php echo $food; ?>
                            </td>
                            <td>
                                <?php echo $price; ?>
                            </td>
                            <td>
                                <?php echo $qty; ?>
                            </td>
                            <td>
                                <?php echo $total; ?>
                            </td>
                            <td>
                                <?php
                                if ($status == "Ordered") {
                                    echo "<div>$status</div>";
                                } elseif ($status == "On delivery") {
                                    echo "<div style='color:orange;'>$status</div>";
                                } elseif ($status == "Delivered") {
                                    echo "<div style='color:green;'>$status</div>";
                                } elseif ($status == "Cancelled") {
                                    echo "<div style='color:red;'>$status</div>";
                                } ?>
                            </td>
                            <td>
                                <?php echo $customer_name; ?>
                            </td>
                            <td>
                                <?php echo $customer_contact; ?>
                            </td>
                            <td>
                                <?php echo $customer_email; ?>
                            </td>
                            <td>
                                <?php echo $customer_address; ?>
                            </td>
                            <td><a href="<?php echo SITEURL; ?>admin/update_order.php?id=<?php echo $id; ?>"
                                    class="btn_primary">Update order</a></td>
                        </tr>


                        <?php

                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>
<!-- main section ends -->
<?php include("partials/footer.php") ?>