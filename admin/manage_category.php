<?php include("partials/header.php") ?>

<!-- main section starts -->
<div class="main-content mx">
    <div class="wrapper px">
        <h1>MANAGE CATEGORY</h1>

        <?php
        if (isset($_SESSION['add_cat'])) {
            echo $_SESSION['add_cat'];
            unset($_SESSION['add_cat']);
        }
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['no_category_found'])) {
            echo $_SESSION['no_category_found'];
            unset($_SESSION['no_category_found']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }


        ?>
        <br>

        <a href="<?php echo SITEURL; ?>/admin/add_category.php" class="btn_primary  admin">Add category</a>
        <div class="row flex ">
            <table class="table_full">
                <tr>
                    <th>S.no</th>
                    <th>Title</th>
                    <th>image</th>
                    <th>Featured</th>
                    <th>active</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT * FROM table_category";
                $res = mysqli_query($conn, $sql);
                $numm = 1;
                $count = mysqli_num_rows($res);

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>

                        <tr>
                            <td>
                                <?php echo $numm++ ?>
                            </td>
                            <td>
                                <?php echo $title; ?>
                            </td>
                            <td>
                                <?php if ($image_name != "") {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px"
                                        alt="cat">
                                    <?php
                                } else {
                                    echo "<div class='error'>image not added</div>";
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo $featured; ?>
                            </td>
                            <td>
                                <?php echo $active; ?>
                            </td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update_category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                                    class="btn_primary">Update admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete_category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                                    class="btn_danger">Delete admin</a>
                            </td>
                        </tr>

                        <?php
                    }
                } else { ?>

                    <tr>
                        <td colspan="6">No category added</td>
                    </tr>

                <?php } ?>
            </table>
        </div>
    </div>
</div>
<!-- main section ends -->
<?php include("partials/footer.php") ?>