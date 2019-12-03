<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Play quizzes with good quiz questions and educational answers. Test your knowledge and learn. The quiz is good for kids and adults who love trivia.">
    <link href="./Category_files/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            padding-top: 5rem;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
        }

        .starter-template {
            padding: 2rem 1.5rem;
            text-align: center;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .site-logo {
            display: inline-block;
        }

        #progressBar {
            width: 14%;
            margin-left: 83%;
            height: 22px;
            background-color: #0A5F44;
        }

        #progressBar div {
            height: 100%;
            text-align: right;
            padding: 0 10px;
            line-height: 22px;
            /* same as #progressBar height if we want text middle aligned */
            width: 0;
            background-color: #CBEA00;
            box-sizing: border-box;
        }
    </style>
</head>

<body onload="move()">
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

    <div class="progress" style="margin-top: 10px; height: 30px;">
        <div id="timeBar" style="width: 100%;background-color: #00ff00;" class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <?php
    $question = $_SESSION["quiz"][$_GET["q"]];
    ?>
    <main role="main" class="container" style="height: auto !important;">
        <div class="d-flex " style="height: auto !important;">
            <div class="col-11 col-sm-11 col-md-11 col-lg-11 col-xl-11" style="height: auto !important;">
                <div class="card" style="height: auto !important;">
                    <div class="card-body" style="height: auto !important;">
                        <h2>
                            <font style="color: #00AEEF"><?= strtoupper($_SESSION["category"]); ?></font>
                        </h2>
                        <h3>
                            <center><?= $question["question"]; ?></center>
                        </h3>

                        <svg class="bd-placeholder-img card-img-top" style="margin-bottom: 10px" width="100%" height="240" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                            <title><?= $question["question"]; ?></title>
                            <rect rx="0" ry="0" width="100%" height="100%" fill="#00AEEF"></rect>
                            <image x="50%" y="50%" width="200" height="200" transform="translate(-100,-100)" xlink:href="<?= $question["picture"]; ?>"></image>
                            <text x="50%" y="95%" fill="#ffffff" dominant-baseline="middle" text-anchor="middle" dy=".1em"></text>
                        </svg>

                        <form action="" method="post" style="height: auto !important;">
                            <button type="submit" class="btn btn-dark btn-lg  btn-block" style="background-color:#00ff00"><?= $question["a"]; ?></button>
                            <button type="submit" class="btn btn-dark btn-lg  btn-block" style="background-color:#666666"><?= $question["b"]; ?></button>
                            <button type="submit" class="btn btn-dark btn-lg  btn-block" style="background-color:#ff0000"><?= $question["c"]; ?></button>
                            <button type="submit" class="btn btn-dark btn-lg  btn-block" style="background-color:##FFD700"><?= $question["d"]; ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- /.container -->
    <?php
    //unset($_SESSION["quiz"][$_GET["q"]]);
    //} // End of foreach 
    ?>
    <?php
    if(isset($_SESSION["quiz"][strval(intval($_GET["q"])+1)])){ ?>
        <div class="col-sm-12">
            <a class="btn btn-primary" href ="quiz.php?q=<?= intval($_GET["q"])+1;?>" >Next question </a>
        </div>
    <?php 
    }else{?>
        <div class="col-sm-12">
            <a class="btn btn-primary" href ="result.php" >Result </a>
        </div>
    <?php

    }
    ?>
    <script>
        function move() {
            var elem = document.getElementById("timeBar");
            var width = 100;
            var color = "#00ff00";
            var id = setInterval(frame, 300);

            function frame() {
                if (width <= 0) {
                    clearInterval(id);
                } else {
                    if (width <= 20) {
                        color = "#ff0000";
                    } else if (width <= 40) {
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