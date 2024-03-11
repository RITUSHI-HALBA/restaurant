<?php include("partials/header.php") ?>

<!-- main section starts -->
<div class="main-content mx">
    <div class="wrapper px">
        <h1>DASHBOARD</h1>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <div class="row flex ">
            <div class="col-4 py  mx text-center">
                <div class="category_inr px">
                    <?php $sql = "SELECT * FROM table_category";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    ?>
                    <h2>
                        <?php echo $count; ?>
                    </h2>
                    <p>Category</p>
                </div>
            </div>
            <div class="col-4  mx py text-center">
                <div class="category_inr px">
                    <?php $sql2 = "SELECT * FROM table_food";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);
                    ?>
                    <h2>
                        <?php echo $count2; ?>
                    </h2>
                    <p>Foods</p>
                </div>
            </div>
            <div class="col-4  mx py text-center">
                <div class="category_inr px">
                    <?php $sql3 = "SELECT * FROM table_order";
                    $res3 = mysqli_query($conn, $sql3);
                    $count3 = mysqli_num_rows($res3);
                    ?>
                    <h2>
                        <?php echo $count3; ?>
                    </h2>
                    <p>Total Orders</p>
                </div>
            </div>
            <div class="col-4  mx py text-center">
                <div class="category_inr px">
                    <?php $sql4 = "SELECT SUM(total) AS Total FROM table_order WHERE status='Delivered'";
                    $res4 = mysqli_query($conn, $sql4);

                    $row4 = mysqli_fetch_assoc($res4);

                    $total_revenue = $row4['Total'];
                    ?>
                    <h2>
                        <?php echo $total_revenue; ?>
                    </h2>
                    <p>Revenue Generated</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- main section ends -->
<?php include("partials/footer.php") ?>