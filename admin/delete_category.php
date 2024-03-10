<?php
include("../config/constant.php");
if (isset($_GET['id']) AND isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if ($image_name != "") {
        $path = "../images/category/" . $image_name;
        $remove = unlink($path);

        if ($remove == false) {
            $_SESSION['remove'] = "<div class='error'>failed to remove image</div>";
            header('location:' . SITEURL . 'admin/manage_category.php');
            die();
        }
    } 

    $sql = "DELETE FROM table_category WHERE id= $id";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>category deleted</div>";
        header('location:' . SITEURL . 'admin/manage_category.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>failed to delete category</div>";
        header('location:' . SITEURL . 'admin/manage_category.php');
    }

} else {
    header('location:' . SITEURL . 'admin/manage_category.php');
}

?>