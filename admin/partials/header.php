<?php include('../config/constant.php');

if (!isset($_SESSION['user'])) {
    $_SESSION['not_login'] = "<div class='error'>Please login</div>";
    header('location:' . SITEURL . 'addmin/login.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home-page</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <!-- menu section starts -->
    <div class="menu text-center">
        <div class="wrapper px">
            <ul>
                <li class="py"><a href="index.php">Home</a></li>
                <li class="py"><a href="manage_admin.php">Admin</a></li>
                <li class="py"><a href="manage_category.php">Category</a></li>
                <li class="py"><a href="manage_food.php">Food</a></li>
                <li class="py"><a href="manage_order.php">Order</a></li>
                <li class="py"><a href="logout.php" class="btn_primary">logout</a></li>
            </ul>
        </div>
    </div>
    <!-- menu section ends -->