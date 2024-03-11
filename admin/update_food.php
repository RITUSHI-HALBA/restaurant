<?php include("partials/header.php") ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql2 = "SELECT * FROM table_food WHERE id=$id";

    $res2 = mysqli_query($conn, $sql2);

    $row2 = mysqli_fetch_assoc($res2);
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category_id = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];

} else {
    header('location:' . SITEURL . 'admin/manage_food.php');
}
?>
<div class="main-content mx">
    <div class="wrapper px">
        <h1>UPDATE FOOD</h1>
        <br>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="table_full  add_cat">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>description</td>
                    <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>price</td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                </tr>
                <tr>
                    <td>Current image</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px">
                            <?php
                        } else {
                            echo "<div class='error'>image not added</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>category</td>
                    <td>
                        <select name="category">
                            <?php $sql = "SELECT * FROM table_category WHERE active='yes'";

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_id = $row["id"];
                                    $title = $row["title"];

                                    ?>
                                    <option <?php if ($current_category_id == $category_id) {
                                        echo "selected";
                                    } ?>
                                        value="<?php echo $category_id ?>">
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
                        <input <?php if ($featured == "yes") {
                            echo "checked";
                        } ?> type="radio" name="featured"
                            value="yes"><span>yes</span>
                        <input <?php if ($featured == "no") {
                            echo "checked";
                        } ?> type="radio" name="featured"
                            value="no"><span>no</span>
                    </td>
                </tr>
                <tr>
                    <td>active</td>
                    <td class="active">
                        <input <?php if ($active == "yes") {
                            echo "checked";
                        } ?> type="radio" name="active"
                            value="yes"><span>yes</span>
                        <input <?php if ($active == "no") {
                            echo "checked";
                        } ?> type="radio" name="active"
                            value="no"><span>no</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>"
                            class="btn_primary">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" class="btn_primary">
                        <input type="submit" name="submit" value="update food" class="btn_primary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

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
                        header('location:' . SITEURL . '/admin/manage_food.php');
                        die();
                    }

                    // remove image
        
                    if ($current_image != "") {
                        $remove_path = "../images/food/" . $current_image;

                        $remove = unlink($remove_path);

                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "<div class='error'>fail to remove image</div>";
                            header('location:' . SITEURL . '/admin/manage_food.php');
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            }

            $sql3 = "UPDATE table_food SET
            title = '$title',
            description = '$description',
            price = '$price',
            image_name = '$image_name',
            category_id = '$category',
            featured = '$featured',
            active = '$active'
            WHERE id=$id";

            $res3 = mysqli_query($conn, $sql3);

            if ($res3 == true) {
                $_SESSION['update'] = "<div class='success'>Food updated successfully</div>";
                header('location:' . SITEURL . 'admin/manage_food.php');
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to updated</div>";
                header_remove();
                header('location:' . SITEURL . 'admin/manage_food.php');
            }
        }

        ?>
      

    </div>
</div>
<?php include("partials/footer.php") ?>