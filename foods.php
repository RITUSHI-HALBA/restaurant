<?php include("partials_front/menu.php") ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="food-search.html" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        $sql2 = "SELECT * FROM table_food WHERE active='yes'";

        $res2 = mysqli_query($conn, $sql2);

        $count2 = mysqli_num_rows($res2);

        if ($count2 > 0) {
            while ($row = mysqli_fetch_assoc($res2)) {
                $id = $row['id'];
                $image_name = $row['image_name'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($image_name != "") {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name ?>" alt="Pizza"
                                class="img-responsive img-curve">
                            <?php
                        } else {
                            echo "<div>There is no image available</div>";
                        }
                        ?>
                    </div>
                    <div class="food-menu-desc">
                        <h4>
                            <?php echo $title ?>
                        </h4>
                        <p class="food-price">
                            <?php echo $price ?>
                        </p>
                        <p class="food-detail">
                            <?php echo $description ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL; ?>order.php" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
                </a>

                <?php
            }
        } else {
            echo "<div class='error'>No food found</div>";
        }
        ?>

        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include("partials_front/footer.php") ?>