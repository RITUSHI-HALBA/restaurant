<?php include("partials_front/menu.php") ?>

<?php
if (isset($_GET['category_id'])) {

    $category_id = $_GET['category_id'];

    $sql = "SELECT title FROM table_category WHERE id=$category_id";

    $res = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($res);

    $category_title = $row['title'];

} else {
    header('location:' . SITEURL);
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white">
                <?php echo $category_title; ?>
            </a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php

        $sql2 = "SELECT * FROM table_food where id=$category_id";

        $res2 = mysqli_query($conn, $sql2);

        $count2 = mysqli_num_rows($res2);

        if ($count2 > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];

                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?></p>
                        <p class="food-detail">
                        <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="<?php SITEURL; ?>order.php" class="btn btn-primary">Order Now</a>
                    </div>
                </div>


                <?php

            }
        }

        ?>


        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include("partials_front/footer.php") ?>