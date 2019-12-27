<!DOCTYPE html>
<html>

<head>

    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,300,600,400italic);
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark rounded fixed-top" style="background-color: #333333">
        <div class="site-logo">
            <a href="index.php">
                <img width="25%" src="img/logo.png" alt="">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav mt-2 mt-md-0">
                <li class="nav-item">
                    <?php
                    session_start();
                    require 'login/db.php';
                    require 'func.php';
                    if (isset($_SESSION['email']) && $_SESSION['email']) {
                        echo '<a class="nav-link" href="" >Hello ';
                        $email = $_SESSION['email'];
                        $query = "SELECT * FROM user WHERE email='{$email}'";
                        $result = mysqli_query($con, $query) or die(mysqli_error($con));
                        $info = mysqli_fetch_assoc($result);
                        $mang_ho_ten = explode(" ", $info["name"]);
                        $so_phan_tu = count($mang_ho_ten);
                        $ten = $mang_ho_ten[$so_phan_tu - 1];
                        echo $ten . "</a>";
                        echo '</li>
                            <li class="nav-item">';
                        echo '<a class="nav-link" href="login/logout.php">Logout </a>';
                    } else {
                        echo '<a class="nav-link" href="login/login2.php">Register/Login</a>';
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>

    <?php
    if (isset($_GET["new_category"])) {
        if (isset($_POST["category_name"])) {
            $query = "SELECT * FROM category WHERE name='" . $_POST["category_name"] . "'";
            $result = mysqli_query($con, $query) or die(mysqli_error($con));
            if (mysqli_num_rows($result) > 0) {
                echo '<div class="alert alert-danger" role="alert">
                This category already existed. Click to this category to add more question.
                <p>Auto reloading <a href="form_create.php">page</a></p>
                </div>';
                header("refresh:2;url=form_create.php");
            } else {
                $query = "INSERT INTO category(name, picture) VALUES ('{$_POST["category_name"]}', '{$_POST["category_url"]}')";
                $result = mysqli_query($con, $query) or die(mysqli_error($con));
                if ($result) {
                    echo '<div class="alert alert-success" role="alert">
                            Create new category successfully
                            </div>';
                    header("refresh:2;url=index.php");
                }
            }
        }
    ?>
        <div class="form-container">
            <form id="contact" action="" method="post">
                <h3><strong>Create New Category</strong></h3>
                <input placeholder="Category Name" name="category_name" type="text" tabindex="1" required autofocus>
                <input placeholder="Image Url" name="category_url" type="text" tabindex="2" id="url" required>
                <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
            </form>
        </div>
    <?php
    } elseif (isset($_GET["parent_category"])) {
        $parent_category_id = $_GET["parent_category"];
        if (isset($_POST["sub_category_name"])) {
            $query = "SELECT * FROM category WHERE name='" . $_POST["sub_category_name"] . "'  AND parent_category_id=" . $_GET["parent_category"];
            $result = mysqli_query($con, $query) or die(mysqli_error($con));
            if (mysqli_num_rows($result) > 0) {
                echo '<div class="alert alert-danger" role="alert">
                This sub category already existed. Click to this sub category to add more question.
                <p>Auto reloading page</p>
                </div>';
                header("refresh:2");
            } else {
                $query = "INSERT INTO category(name, picture, parent_category_id) VALUES ('{$_POST["sub_category_name"]}', '{$_POST["sub_category_url"]}', {$_GET["parent_category"]})";
                $result = mysqli_query($con, $query) or die(mysqli_error($con));
                if ($result) {
                    echo '<div class="alert alert-success" role="alert">
                            Create new category successfully
                            </div>';
                    header("Location:category.php?category=$parent_category_id");
                } else {
                    echo '<div class="alert alert-danger" role="alert">
                        Can not add new sub category.
                        <p>Auto reloading page</p>
                        </div>';
                    header("refresh:2");
                }
            }
        }
        $query = "SELECT * FROM category WHERE id=" . $_GET["parent_category"];
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        if (mysqli_num_rows($result) > 0) {
            $parent_category = mysqli_fetch_assoc($result);
        } else {
            echo '<div class="alert alert-danger" role="alert">
                This parent category is not existed. Back to homepage!
                </div>';
        }
    ?>
        <div class="form-container">
            <form id="contact" action="" method="post">
                <h3><strong>Create New Sub Category of
                        <?php
                        if (isset($parent_category)) {
                            echo strtoupper($parent_category["name"]);
                        }
                        ?> </strong></h3>
                <input placeholder="Sub Category Name" name="sub_category_name" type="text" tabindex="1" required autofocus>
                <input placeholder="Image Url" name="sub_category_url" type="text" tabindex="2" id="url" required>
                <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
            </form>
        </div>
    <?php
    } elseif (isset($_GET["quiz_to_category"])) { /////
        $quiz_to_category=$_GET["quiz_to_category"];
        if (isset($_POST["question"])) {
            if(!isset($_POST["c"])) $_POST["c"]=NULL;
            if(!isset($_POST["d"])) $_POST["d"]=NULL;
            $query = "INSERT INTO question( category_id, question , a, b, c, d, answer, picture) VALUES  ({$_GET["quiz_to_category"]}, '{$_POST["question"]}', '{$_POST["a"]}', '{$_POST["b"]}', '{$_POST["c"]}', '{$_POST["d"]}', '{$_POST["answer"]}', '{$_POST["question_image_url"]}')";
            $result = mysqli_query($con, $query) or die(mysqli_error($con));
            if ($result) {
                echo '<div class="alert alert-success" role="alert">
                            Create new question successfully
                            </div>';
                header("Location:category.php?category=$quiz_to_category");
            } else {
                echo '<div class="alert alert-danger" role="alert">
                        Can not add new question.
                        <p>Auto reloading page</p>
                        </div>';
                header("refresh:2");
            }
        }
        $query = "SELECT * FROM category WHERE id=" . $_GET["quiz_to_category"];
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        if (mysqli_num_rows($result) > 0) {
            $category = mysqli_fetch_assoc($result);
        } else {
            echo '<div class="alert alert-danger" role="alert">
                This category is not existed. Back to homepage!
                </div>';
        }
    ?>
        <div class="form-container">
            <form id="contact" action="" method="post">
                <h3><strong>Create New Question for
                        <?php
                        if (isset($category)) {
                            echo strtoupper($category["name"]);
                        }
                        ?> </strong></h3>
                <input placeholder="Question" name="question" type="text" tabindex="1" required autofocus>
                <input placeholder="Image Url" name="question_image_url" type="text" tabindex="2" id="url" >
                <input placeholder="A" name="a" type="text" tabindex="3" required>
                <input placeholder="B" name="b" type="text" tabindex="4" required>
                <input placeholder="C (optional)" name="c" type="text" tabindex="5">
                <input placeholder="D (optional)" name="d" type="text" tabindex="6">
                <input placeholder="Answer" name="answer" type="text" tabindex="7" required>
                <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
            </form>
        </div>
    <?php
    } else {
        echo '<div class="alert alert-danger" role="alert">
                This page need right GET parameter. Back to homepage!
                </div>';
    }
    ?>

    <script>
        $(document).ready(function() {
            $("#url").on('input', function() {
                if ($(this).val().length >= 500) {
                    alert('This url is too long. Choose another picture or upload this picture to any image hosting and get link.');
                    location.reload();
                }
            });
        });
    </script>
</body>

</html>