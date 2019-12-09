<!DOCTYPE html>
<!-- saved from url=(0031)http://localhost/Linux/quiz.php -->
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Quiz Categories QuizStone - Quiz and put your knowledge to the test</title>
    <link href="./Category_files/bootstrap.min.css" rel="stylesheet">
    <link href="./Category_files/style.css" rel="stylesheet">
</head>

<body>
    <main role="main" class="container">
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
                        require 'login/db.php';
                        session_start();
                        if (isset($_SESSION['email']) && $_SESSION['email']) {
                            $login = 1;
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
                            $login = 0;
                            echo '<a class="nav-link" href="login/login2.php">Register/Login</a>';
                        }
                        ?>
                    </li>

                </ul>
            </div>
        </nav>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <?php
                    $query = "SELECT * FROM category";
                    $result = mysqli_query($con, $query) or die(mysqli_error($con));
                    if (mysqli_num_rows($result) > 0) {
                        while ($category = mysqli_fetch_assoc($result)) {
                            if($login){
                                $query = 'SELECT * FROM bestscore WHERE user_id=' . $info["id"] . ' AND category_id=' . $category["id"];
                                $result_score = mysqli_query($con, $query) or die(mysqli_error($con));
                            }
                            echo '<div class="col-md-4">
                                <div class="card mb-4 shadow-sm category-card" >
                                    <a href="';
                            if ($login)
                                echo 'category.php?category=' . $category["id"];
                            else
                                echo 'login/login2.php';
                            echo '">
                                        <img width="100%" height="200" 
                                            src="' . $category["picture"] . '">
                                    </a>
                                    <div class="card-body">
                                        <h3 class="card-title">' . $category["name"] . '</h3>';
                            if ($login==1 && mysqli_num_rows($result_score) > 0) {
                                $bestscore = mysqli_fetch_assoc($result_score);
                                $query = 'SELECT COUNT(*) FROM quiz WHERE category=' . $category["id"];
                                $result_count = mysqli_query($con, $query) or die(mysqli_error($con));
                                $count = mysqli_fetch_assoc($result_count);
                                echo '<h6>Best score: '.$bestscore["score"].'/6</h6>';
                            }else{
                                echo '<h6>Do you dare?</h6>';
                            }
                            echo '</div>
                                </div>
                            </div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>