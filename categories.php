

    <?php include("partials_front/menu.php") ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php
        $sql = "SELECT * FROM table_category WHERE active='yes'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
                ?>
                <a href="category-foods.php">
                    <div class="box-3 float-container">
                        <?php
                        if ($image_name != "") {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ?>" alt="<?php echo $image_name ?>"
                                class="img-responsive img-curve">
                            <?php
                        } else {
                            echo "<div>There is no image available</div>";
                        }
                        ?>
                        <h3 class="float-text text-white">
                            <?php echo $title; ?>
                        </h3>
                    </div>
                </a>

                <?php
            }
        } else {
            echo "<div class='error'>No category found</div>";
        }
        ?>
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include("partials_front/footer.php") ?>

 