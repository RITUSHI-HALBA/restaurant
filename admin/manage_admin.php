<?php include("partials/header.php") ?>
<!-- main section starts -->
<div class="main-content mx">
    <div class="wrapper px">
        <h1>MANAGE ADMIN</h1>
        <a href="add_admin.php" class="btn_primary  admin">Add Admin</a>
        <br>
        <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['user_not_found'])) {
            echo $_SESSION['user_not_found'];
            unset($_SESSION['user_not_found']);
        }

        if (isset($_SESSION['password_not_match'])) {
            echo $_SESSION['password_not_match'];
            unset($_SESSION['password_not_match']);
        }

        if (isset($_SESSION['password_changed'])) {
            echo $_SESSION['password_changed'];
            unset($_SESSION['password_changed']);
        }

        if (isset($_SESSION['password_not_changed'])) {
            echo $_SESSION['password_not_changed'];
            unset($_SESSION['password_not_changed']);
        }

        ?>
        <div class="row flex ">
            <table class="table_full">
                <tr>
                    <th>S.no</th>
                    <th>full_name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php

                $sql = "SELECT * FROM table_admin";
                $res = mysqli_query($conn, $sql);
                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    $numm = 1;
                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];

                            ?>

                            <tr>
                                <td>
                                    <?php echo $numm++; ?>
                                </td>
                                <td>
                                    <?php echo $full_name; ?>
                                </td>
                                <td>
                                    <?php echo $username; ?>
                                </td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>/admin/update_password.php?id=<?php echo $id; ?>"
                                        class="btn_primary">Change password</a>
                                    <a href="<?php echo SITEURL; ?>/admin/update_admin.php?id=<?php echo $id; ?>"
                                        class="btn_primary">Update admin</a>
                                    <a href="<?php echo SITEURL; ?>/admin/delete_admin.php?id=<?php echo $id; ?>"
                                        class="btn_danger">Delete admin</a>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>
<!-- main section ends -->

<?php include("partials/footer.php") ?>