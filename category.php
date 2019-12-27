<!DOCTYPE html>
<!-- saved from url=(0031)http://localhost/Linux/quiz.php -->
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Quiz Categories QuizStone - Quiz and put your knowledge to the test</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
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
        $query = "SELECT id FROM category WHERE parent_category_id=" . $_GET["category"];
        $result_category = mysqli_query($con, $query) or die(mysqli_error($con));
        if (mysqli_num_rows($result_category) > 0) {  //parent_category
            $query = "SELECT * FROM question WHERE category_id = {$_GET["category"]} OR category_id IN (SELECT id FROM category WHERE parent_category_id = " . $_GET["category"] . ")";
            $result_quiz = mysqli_query($con, $query) or die(mysqli_error($con));
        } else {    //sub category
            $query = "SELECT * FROM question WHERE category_id = " . $_GET["category"];
            $result_quiz = mysqli_query($con, $query) or die(mysqli_error($con));
        }

        $query = "SELECT * FROM category WHERE id=" . $_GET["category"];
        $result_category = mysqli_query($con, $query) or die(mysqli_error($con));
        $category = mysqli_fetch_assoc($result_category);
        if (mysqli_num_rows($result_quiz) > 0) {
            while ($quiz = mysqli_fetch_assoc($result_quiz)) {
                $quiz_list[] = $quiz;
            }
        }
        if (isset($quiz_list)) {
            shuffle($quiz_list);
            unset($_SESSION["quiz"]);
            $_SESSION["quiz"] = array_slice($quiz_list, 0, 6);
        }
        $_SESSION["category"] = $category["name"];
        $_SESSION["score"] = 0;
        //print_r($_SESSION);
        //foreach ($GLOBALS as $ques_num => $question) {
        ?>
        <div class="starter-template">
            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading categoryName"><?= $category["name"]; ?> Quiz</h1>
                    <img width="100%" height="400" style="margin-top: 20px" src="<?= $category["picture"]; ?>" />
                    <?php
                    if (!isset($quiz_list)) echo 'No question in this category :(';
                    else echo '<a href="quiz.php?q=0" >
                    <div id="next" class="col-sm-11">
                        <div class="button" id="button-7">
                            <div id="dub-arrow"><img src="./img/right-arrow.png" alt="" /></div>
                            <a class="next_result_text" > START</a>
                        </div>
                    </div></a>';
                    ?>
                </div>
            </section>
        </div>
        <div class="container">
            <div class="row">
                <?php
                $query = "SELECT * FROM category WHERE parent_category_id=" . $_GET["category"]; //sub category
                $result = mysqli_query($con, $query) or die(mysqli_error($con));
                if (mysqli_num_rows($result) > 0) {
                    while ($category = mysqli_fetch_assoc($result)) {
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
                        echo '</div>
                                </div>
                            </div>';
                    }
                }
                ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm category-card">
                        <a href="form_create.php?parent_category=<?= $_GET["category"]; ?>">
                            <img width="100%" height="200" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQBP90Z864SiH1E0e3nkIC6S87kBfFWE6MP-tCdolvhlSQTnI-H&s">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><strong>Add more category</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm category-card">
                        <a href="form_create.php?quiz_to_category=<?= $_GET["category"]; ?>">
                            <img width="100%" height="200" src="https://cdn.pixabay.com/photo/2018/08/31/11/17/quiz-3644414_960_720.png">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><strong>Add more question</strong></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>