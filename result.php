<!DOCTYPE html>
<html>

<head>

    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sigmar+One">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"> </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.2/underscore-min.js"> </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"> </script>


    <style>
        body {
            background: #3da1d1;
            color: #fff;
            overflow: hidden;
        }

        .congrats {
            position: absolute;
            top: 140px;
            width: 550px;
            height: 100px;
            padding: 20px 10px;
            text-align: center;
            margin: 0 auto;
            left: 0;
            right: 0;
        }

        h1 {
            transform-origin: 50% 50%;
            font-size: 50px;
            font-family: 'Sigmar One', cursive;
            cursor: pointer;
            z-index: 2;
            position: absolute;
            top: 0;
            text-align: center;
            width: 100%;
        }

        .blob {
            height: 50px;
            width: 50px;
            color: #ffcc00;
            position: absolute;
            top: 45%;
            left: 45%;
            z-index: 1;
            font-size: 30px;
            display: none;
        }
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


    <div class="congrats">
        <h1><?php
            $query = "SELECT * FROM category WHERE name='" . $_SESSION["category"] . "'";
            $result_category = mysqli_query($con, $query) or die(mysqli_error($con));
            if (mysqli_num_rows($result_category) > 0) {
                $category = mysqli_fetch_assoc($result_category);
                $query = 'SELECT * FROM bestscore WHERE user_id=' . $info["id"] . ' AND category_id=' . $category["id"];
                $result = mysqli_query($con, $query) or die(mysqli_error($con));
                if (mysqli_num_rows($result) > 0) {
                    $bestscore = mysqli_fetch_assoc($result);
                    if ($bestscore["score"] < $_SESSION["score"]) {
                        $query = 'UPDATE bestscore SET score='.$_SESSION["score"].' WHERE user_id =' . $info["id"] . ' AND category_id=' . $category["id"];
                        $result = mysqli_query($con, $query) or die(mysqli_error($con));
                        echo 'NEW BEST SCORE!! <br> ' . $_SESSION["score"];
                    } else {
                        echo 'BEST SCORE: ' . $bestscore["score"];
                        echo '<br>YOUR SCORE: ' . $_SESSION["score"];
                    }
                } else {
                    $query = 'INSERT INTO bestscore VALUES (' . $info["id"] . ',' . $category["id"] . ',' . $_SESSION["score"] . ')';
                    $result = mysqli_query($con, $query) or die(mysqli_error($con));
                    echo 'BEST SCORE: ' . $_SESSION["score"];
                }
            }

            ?></h1><br>
    </div>

    <script>
        $(document).ready(function() {
            var numberOfStars = 300;

            for (var i = 0; i < numberOfStars; i++) {
                $('.congrats').append('<div class="blob fa fa-star ' + i + '"></div>');
            }

            animateText();

            animateBlobs();
        });

        $('.congrats').click(function() {
            reset();

            animateText();

            animateBlobs();
        });

        function reset() {
            $.each($('.blob'), function(i) {
                TweenMax.set($(this), {
                    x: 0,
                    y: 0,
                    opacity: 1
                });
            });

            TweenMax.set($('h1'), {
                scale: 1,
                opacity: 1,
                rotation: 0
            });
        }

        function animateText() {
            TweenMax.from($('h1'), 0.8, {
                scale: 0.4,
                opacity: 0,
                rotation: 15,
                ease: Back.easeOut.config(4),
            });
        }

        function animateBlobs() {

            var xSeed = _.random(350, 380);
            var ySeed = _.random(120, 170);

            $.each($('.blob'), function(i) {
                var $blob = $(this);
                var speed = _.random(1, 5);
                var rotation = _.random(5, 100);
                var scale = _.random(0.8, 1.5);
                var x = _.random(-xSeed, xSeed);
                var y = _.random(-ySeed, ySeed);

                TweenMax.to($blob, speed, {
                    x: x,
                    y: y,
                    ease: Power1.easeOut,
                    opacity: 0,
                    rotation: rotation,
                    scale: scale,
                    onStartParams: [$blob],
                    onStart: function($element) {
                        $element.css('display', 'block');
                    },
                    onCompleteParams: [$blob],
                    onComplete: function($element) {
                        $element.css('display', 'none');
                    }
                });
            });
        }
    </script>
</body>

</html>