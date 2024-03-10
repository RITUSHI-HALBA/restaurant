<?php include("partials/header.php") ?>

<!-- main section starts -->
<div class="main-content mx">
    <div class="wrapper px">
        <h1>ADD ADMIN</h1>
        <br> <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <form action="" method="post">
            <table class="table_full">
                <tr>
                    <td>Full name</td>
                    <td><input type="text" name="full_name" id=""></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" id=""></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" id=""></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="add admin" class="btn_primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<!-- main section ends -->

<?php include("partials/footer.php") ?>

<?php
// process the value from form and save it in database

// check whether button is clicked or not

if (isset($_POST['submit'])) {
    // echo "button clicked";
    // get the data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // sql query to save data in database
    $sql = "INSERT INTO table_admin SET
    full_name = '$full_name',
    username = '$username',
    password = '$password'
    ";

    //    execute the query
    $res = mysqli_query($conn, $sql);

    // to check data is executed properly or not
    if ($res) {
        $_SESSION['add'] = "admin added successfully";
        header("location:" . SITEURL . 'admin/manage_admin.php'); //redirect page to manage admin
    } else {
        $_SESSION['add'] = "Failed to add admin added successfully";
        header("location:" . SITEURL . 'admin/add_admin.php'); //redirect page to add admin
    }
}
?>