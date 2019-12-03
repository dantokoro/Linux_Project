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
                        require 'func.php';
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
                        $query = "SELECT * FROM category";
                        $result = mysqli_query($con, $query) or die(mysqli_error($con));
                        $category = mysqli_fetch_assoc($result);
                        ?>
                    </li>

                </ul>
            </div>
        </nav>
        <?php
        $query = "SELECT * FROM question WHERE id IN (SELECT question_id FROM quiz WHERE category=" . $_GET["category"] . ")";
        $result_quiz = mysqli_query($con, $query) or die(mysqli_error($con));
        $query = "SELECT * FROM category WHERE id=" . $_GET["category"];
        $result_category = mysqli_query($con, $query) or die(mysqli_error($con));
        $category = mysqli_fetch_assoc($result_category);
        if (mysqli_num_rows($result_quiz) > 0) {
            while ($quiz = mysqli_fetch_assoc($result_quiz)) {
                $quiz_list[] = $quiz;
            }
        }
        shuffle($quiz_list);
        $_SESSION["quiz"] = array_slice($quiz_list, 0, 10);
        $_SESSION["category"]=$category["name"];
        //print_r($_SESSION);
        //foreach ($GLOBALS as $ques_num => $question) {
        ?>
        <div class="starter-template">
            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading"><?= $category["name"]; ?> Quiz</h1>
                    <img width="100%" height="300" style="margin-top: 10px" src="<?= $category["picture"]; ?>" />
                    <a href="quiz.php?q=1" class="btn btn-primary my-2">Start the Quiz</a>
                </div>
            </section>
        </div>
</body>

</html>