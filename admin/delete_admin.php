<?php
include('../config/constant.php');
$id = $_GET['id'];
$sql = "DELETE FROM table_admin WHERE id=$id";
$res = mysqli_query($conn, $sql);
if ($res == true) {
    $_SESSION['delete'] = '<div class="success">Admin deleted successfully</div>';
    header('location:' . SITEURL . 'admin/manage_admin.php');
} else {
    $_SESSION['delete'] = '<div class="error">Failed to Delete Admin. Try again later.</div>';
    header('location:' . SITEURL . 'admin/manage_admin.php');
}
?>