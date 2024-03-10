<?php include("partials/header.php") ?>
<div class="main-content mx">
    <div class="wrapper px">
        <h1>CHANGE PASSWORD</h1>
        <br> <br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>
        <form action="" method="post">
            <table class="table_full">
                <tr>
                    <td>Current password</td>
                    <td><input type="password" name="current_password" placeholder="current_password" id=""></td>
                </tr>
                <tr>
                    <td>New password</td>
                    <td><input type="password" name="new_password" placeholder="new_password" id=""></td>
                </tr>
                <tr>
                    <td>Confirm password</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm_password" id=""></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change password" class="btn_primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    $sql = "SELECT * FROM table_admin WHERE id=$id AND password='$current_password'";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $count = mysqli_num_rows($res);

        if ($count == 1) {

            if ($new_password == $confirm_password) {
                $sql2 = "UPDATE table_admin SET 
                password = '$new_password' WHERE id=$id";
                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == true) {
                    $_SESSION['password_changed'] = "<div class='error'>password changed</div>";
                    header('location:' . SITEURL . 'admin/manage_admin.php');
                } else {
                    $_SESSION['password_not_changed'] = "<div class='error'>password not changed</div>";
                    header('location:' . SITEURL . 'admin/manage_admin.php');
                }

            } else {
                $_SESSION['password_not_match'] = "<div class='error'>password not match</div>";
                header('location:' . SITEURL . 'admin/manage_admin.php');
            }
        } else {
            $_SESSION['user_not_found'] = "<div class='error'>user not found</div>";
            header('location:' . SITEURL . 'admin/manage_admin.php');
        }
    }
}
?>
<?php include("partials/footer.php") ?>