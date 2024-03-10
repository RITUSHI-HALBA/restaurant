<?php include("../config/constant.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">

        <form action="" method="POST">
            <h1 class="text-center">login</h1>
            <table>
                <tr>
                    <?php
                    if (isset($_SESSION['login'])) {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                    if (isset($_SESSION['not_login'])) {
                        echo $_SESSION['not_login'];
                        unset($_SESSION['not_login']);
                    }

                    ?>
                </tr>
                <tr>
                    <td>Username</td>

                </tr>
                <tr>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Password</td>

                </tr>
                <tr>
                    <td> <input type="password" name="password" id=""></td>
                </tr>
                <tr>
                    <td colspan="2"><input class="primary" type="submit" value="Submit" name="submit"></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>

<?php
if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM table_admin WHERE username='$username' AND password='$password' ";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $_SESSION['login'] = "<div class='success'>login successfull</div>";
        $_SESSION['user'] = $username;
        header('location:' . SITEURL . 'admin/index.php');
    } else {
        $_SESSION['login'] = "<div class='error'>login failed</div>";
        header('location:' . SITEURL . 'admin/login.php');
    }
}
?>