<?php include("partials/header.php") ?>
<div class="main-content mx">
    <div class="wrapper px">
        <h1>ADD FOOD</h1>
        <br> <br>
        <?php if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        } ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="table_full radio_width">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" placeholder="Title of the food"></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea type="text" name="description" cols="30" rows="5"
                            placeholder="Description of food"></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Select Image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category">
                            <?php $sql = "SELECT * FROM table_category WHERE active='yes'";

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row["id"];
                                    $title = $row["title"];

                                    ?>
                                    <option value="<?php echo $id ?>">
                                        <?php echo $title; ?>
                                    </option>
                                    <?php
                                }
                            } else {
                                ?>
                                <option value="0">No category found</option>
                                <?php
                            } ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td class="featured">
                        <input type="radio" name="featured" value="yes"><span>yes</span>
                        <input type="radio" name="featured" value="no"><span>no</span>
                    </td>
                </tr>
                <tr>
                    <td>Acive</td>
                    <td class="active">
                        <input type="radio" name="active" value="yes"><span>yes</span>
                        <input type="radio" name="active" value="no"><span>no</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="add food" class="btn_primary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];

            } else {
                $featured = "no";

            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];

            } else {
                $active = "no";

            }



            if (isset($_FILES['image']['name'])) {

                // to upload the image we need the image name , source path and the detination;
                $image_name = $_FILES['image']['name'];

                // upload the image when selected
                if ($image_name != "") {

                    // get the extension of the image
                    $ext = pathinfo($image_name, PATHINFO_EXTENSION);

                    // rename the image
                    $image_name = "food_name" . rand(000, 999) . '.' . $ext;


                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/food/" . $image_name;

                    $upload = move_uploaded_file($source_path, $destination_path);
                   

                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>fail to upload image</div>";
                        header('location:' . SITEURL . '/admin/add_food.php');
                        die();
                    }
                }
            } else {
                $_image_name = "";
            }


            $sql2 = "INSERT INTO table_food SET 
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category,
            featured = '$featured',
            active = '$active'";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) {
                $_SESSION['add'] = "<div class='success'>Food added successfully</div>";
                header('location:' . SITEURL . 'admin/manage_food.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Food not added</div>";
                header('location:' . SITEURL . 'admin/manage_food.php');
            }

        }
        ?>
    </div>
</div>
<?php include("partials/footer.php") ?>