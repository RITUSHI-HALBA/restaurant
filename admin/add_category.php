<?php include("partials/header.php") ?>
<div class="main-content mx">
    <div class="wrapper px">
        <h1>ADD CATEGORY</h1>
        <br>
        <?php
        if (isset($_SESSION['add_cat'])) {
            echo $_SESSION['add_cat'];
            unset($_SESSION['add_cat']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="table_full  radio_width">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title"></td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td class="featured">
                        <input type="radio" name="featured" value="yes"><span>yes</span>
                        <input type="radio" name="featured" value="no"><span>no</span>
                    </td>
                </tr>
                <tr>
                    <td>Select image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>active</td>
                    <td class="active">
                        <input type="radio" name="active" value="yes"><span>yes</span>
                        <input type="radio" name="active" value="no"><span>no</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="add category" class="btn_primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include("partials/footer.php") ?>

<?php
if (isset($_POST['submit'])) {

    $title = $_POST['title'];



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

    // print_r($_FILES['image']);
    // die();

    if (isset($_FILES['image']['name'])) {

        // to upload the image we need the image name , source path and the detination;
        $image_name = $_FILES['image']['name'];

        // upload the image when selected
        if ($image_name != "") {

            // get the extension of the image
            $ext = pathinfo($image_name, PATHINFO_EXTENSION);

            // rename the image
            $image_name = "food_cat" . rand(000, 999) . '.' . $ext;


            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/" . $image_name;

            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error'>fail to upload image</div>";
                header('location:' . SITEURL . '/admin/add_category.php');
                die();
            }
        }
    } else {
        $_image_name = "";
    }

    $sql = "INSERT INTO table_category SET
    title = '$title',
    featured = '$featured',
    image_name = '$image_name',
    active = '$active'";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['add_cat'] = "<div class='success'>category added</div>";
        header('location:' . SITEURL . '/admin/manage_category.php');
    } else {
        $_SESSION['add_cat'] = "<div class='error'>category not added</div>";
        header('location:' . SITEURL . '/admin/add_category.php');
    }


}
?>