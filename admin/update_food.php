<?php include("partials/header.php") ?>

<div class="main-content mx">
    <div class="wrapper px">
        <h1>UPDATE food</h1>
        <br> <br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM table_food WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $current_category_id = $row['category_id'];
                $active = $row['active'];
            } else {
                header('location:' . SITEURL . 'admin/manage_food.php');
            }
        } else {
            header('location:' . SITEURL . 'admin/manage_food.php');
        }

        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="table_full radio_width">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
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
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
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
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    $current_image = $_POST['current_image'];


    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        if ($image_name != "") {
            // get the extension of the image
            $ext = pathinfo($image_name, PATHINFO_EXTENSION);

            // rename the image
            $image_name = "food_cat" . rand(000, 999) . '.' . $ext;


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
    } else {
        $image_name = $current_image;
    }


    $sql2 = "UPDATE table_food SET
    title = '$title',
    description = '$description',
    price = '$price',
    category_id = '$category',
    image_name = '$image_name',
    featured = '$featured',
    active = '$active'

    WHERE id=$id";

    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == true) {
        $_SESSION['update'] = "<div class='success'>order updated</div>";
        header('location:' . SITEURL . 'admin/manage_food.php');
    } else {
        $_SESSION['update'] = "<div class='error'>order not updated</div>";
        header('location:' . SITEURL . 'admin/manage_food.php');
    }

}
?>
<?php include("partials/footer.php") ?>