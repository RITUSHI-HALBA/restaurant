<?php
include("../config/constant.php");
if (isset($_GET['id']) AND isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if ($image_name != "") {
        $path = "../images/food/" . $image_name;
        $remove = unlink($path);

        if ($remove == false) {
            $_SESSION['remove'] = "<div class='error'>failed to remove image</div>";
            header('location:' . SITEURL . 'admin/manage_food.php');
            die();
        }
    } 

    $sql = "DELETE FROM table_food WHERE id= $id";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>food deleted</div>";
        header('location:' . SITEURL . 'admin/manage_food.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>failed to delete food</div>";
        header('location:' . SITEURL . 'admin/manage_food.php');
    }

} else {
    header('location:' . SITEURL . 'admin/manage_food.php');
}

?>