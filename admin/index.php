<?php include("partials/header.php") ?>

<!-- main section starts -->
<div class="main-content mx">
    <div class="wrapper px">
        <h1>DASHBOARD</h1>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <div class="row flex ">
            <div class="col-4 py  mx text-center">
                <div class="category_inr px">
                    <h2>5</h2>
                    <p>Category</p>
                </div>
            </div>
            <div class="col-4  mx py text-center">
                <div class="category_inr px">
                    <h2>5</h2>
                    <p>Category</p>
                </div>
            </div>
            <div class="col-4  mx py text-center">
                <div class="category_inr px">
                    <h2>5</h2>
                    <p>Category</p>
                </div>
            </div>
            <div class="col-4  mx py text-center">
                <div class="category_inr px">
                    <h2>5</h2>
                    <p>Category</p>
                </div>
            </div>
            <div class="col-4  mx py text-center">
                <div class="category_inr px">
                    <h2>5</h2>
                    <p>Category</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- main section ends -->
<?php include("partials/footer.php") ?>