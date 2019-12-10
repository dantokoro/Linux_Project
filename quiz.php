<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Play quizzes with good quiz questions and educational answers. Test your knowledge and learn. The quiz is good for kids and adults who love trivia.">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
</head>

<body <?php if (!isset($_POST["answer"])) echo 'onload="move()"'; ?>>
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
    if (!isset($_POST["answer"]))
        echo '<div class="progress" style="margin-top: 10px; height: 30px;">
        <div id="timeBar" style="width: 100%;background-color: #00ff00;" class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
    </div>';
    if (!isset($_GET["q"])) echo '<h1>Go from homepage!! (index.php)</h1>';
    else {
        $question = $_SESSION["quiz"][$_GET["q"]];
        ?>
        <main role="main" class="container" style="height: auto !important;">
            <div class="d-flex " style="height: auto !important;">
                <div class="col-11 col-sm-11 col-md-11 col-lg-11 col-xl-11" align="center" style="padding-left: 100px;">
                    <div class="card" style="height: auto !important;">
                        <div class="card-body" style="height: auto !important;">
                            <h3>
                                <span class="categoryName" style="color: #00AEEF"><?= strtoupper($_SESSION["category"]); ?></span>
                                </h4>
                                <h4>
                                    <center class="question"><?= $question["question"]; ?></center>
                                </h4>

                                <svg class="bd-placeholder-img card-img-top" style="margin-bottom: 10px" width="100%" height="160" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                                    <title><?= $question["question"]; ?></title>
                                    <rect rx="0" ry="0" width="100%" height="100%" fill="#00AEEF"></rect>
                                    <image x="50%" y="50%" width="200" height="200" transform="translate(-100,-100)" xlink:href="<?= $question["picture"]; ?>"></image>
                                    <text x="50%" y="95%" fill="#ffffff" dominant-baseline="middle" text-anchor="middle" dy=".1em"></text>
                                </svg>

                                <form class="form" action="" <?= $_SERVER['PHP_SELF']; ?>"" method="post" style="height: auto !important;">
                                    <button id="answer1" name="answer" value="a" type="submit" class="btn btn-dark btn-lg  btn-block question" <?php if (isset($_POST["answer"])) answer_color($_POST["answer"], $question["answer"], "a"); ?>><?= $question["a"]; ?></button>
                                    <button id="answer2" name="answer" value="b" type="submit" class="btn btn-dark btn-lg  btn-block question" <?php if (isset($_POST["answer"])) answer_color($_POST["answer"], $question["answer"], "b"); ?>><?= $question["b"]; ?></button>
                                    <button id="answer3" name="answer" value="c" type="submit" class="btn btn-dark btn-lg  btn-block question" <?php if (isset($_POST["answer"])) answer_color($_POST["answer"], $question["answer"], "c"); ?>><?= $question["c"]; ?></button>
                                    <button id="answer4" name="answer" value="d" type="submit" class="btn btn-dark btn-lg  btn-block question" <?php if (isset($_POST["answer"])) answer_color($_POST["answer"], $question["answer"], "d"); ?>><?= $question["d"]; ?></button>
                                </form>
                                <?php
                                    if (isset($_POST["answer"])) {
                                        if (strcmp($_POST["answer"], $question["answer"]) == 0) {
                                            $_SESSION["score"]++;
                                            echo "Congratulation!! Score: " . $_SESSION["score"];
                                        } else {
                                            echo "WRONG :(";
                                        }
                                        echo '<script>
                            document.getElementById("answer1").style.pointerEvents = "none";
                            document.getElementById("answer2").style.pointerEvents = "none";
                            document.getElementById("answer3").style.pointerEvents = "none";
                            document.getElementById("answer4").style.pointerEvents = "none";
                            </script>';
                                    }
                                    ?>
                        </div>
                    </div>
                </div>
            </div>
        </main><!-- /.container -->

        <?php

            if (isset($_SESSION["quiz"][strval(intval($_GET["q"]) + 1)])) { ?>
            <div id="next" class="col-sm-11">
                <div class="button" id="button-7">
                    <div id="dub-arrow"><a href="quiz.php?q=<?= intval($_GET["q"]) + 1; ?>"><img src="./img/right-arrow.png" alt="" /></a></div>
                    <a class="next_result_text">NEXT!</a>
                </div>
            </div>
        <?php
            } else { ?>
            <div id="next" class="col-sm-11">
                <div class="button" id="button-7">
                    <div id="dub-arrow"><a href="result.php"><img src="./img/research.png" alt="" /></a></div>
                    <a class="next_result_text">RESULT</a>
                </div>
            </div>
    <?php

        }
    }
    ?>
    <script>
        function move() {
            var elem = document.getElementById("timeBar");
            var width = 100;
            var color = "#00ff00";
            var id = setInterval(frame, 200); // 0.2s -> width--

            function frame() {
                if (width <= 0) {
                    clearInterval(id);
                    document.getElementById("answer1").style.pointerEvents = "none";
                    document.getElementById("answer2").style.pointerEvents = "none";
                    document.getElementById("answer3").style.pointerEvents = "none";
                    document.getElementById("answer4").style.pointerEvents = "none";
                } else {
                    if (width <= 20) {
                        color = "#ff0000";
                    } else if (width <= 50) {
                        color = "#ffff00";
                    }
                    width--;
                    elem.style.width = width + '%';
                    elem.style.backgroundColor = color;
                }
            }
        }
    </script>
</body>

</html>