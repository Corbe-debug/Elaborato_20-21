<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" href="css/style.css" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OneClick Sharing</title>
    <link rel="shortcut icon" type="image/jpg" href="img/logo.ico" />
</head>

<body>
    <!----------Header con link per login e signup------>
    <header>
        <nav class="nav"> <a class="logo" href="#"> <img src="img/logo.png" alt="logo"> </a>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Portfolio</a></li>
                <li><a href="#">About me</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <div class="login">
                <form action="includes/login.inc.php" method="post">
                    <input type="text" name="mailuid" placeholder="Username or Email...">
                    <input type="password" name="pwd" placeholder="Password...">
                    <button type="submit" name="login-submit">Login</button>
                </form>
                <a href="signup.php">Signup</a>
                <form action="includes/logout.inc.php" method="post">
                    <button type="submit" name="logout-submit">Logout</button>
                </form>
            </div>
        </nav>
    </header>


    <!----------Schermata di benevenuto con foto vestiti presenti------>
    <center>
        <h2 class="welcomeText">Benvenuto su OneClick Sharing</h2>
        <h3 class="welcomeText">Accedi o visualizza alcuni degli indumenti disponibili</h3>

        <!-- Gallery -->
        <div class="row">
            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                ciao
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(73).jpg" class="w-100 shadow-1-strong rounded mb-4" alt="CIAAAAAAAAAAA" />

                <img src="https://mdbootstrap.com/img/Photos/Vertical/mountain1.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="" />
            </div>

            <div class="col-lg-4 mb-4 mb-lg-0">
                <img src="https://mdbootstrap.com/img/Photos/Vertical/mountain2.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="" />

                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(73).jpg" class="w-100 shadow-1-strong rounded mb-4" alt="" />
            </div>

            <div class="col-lg-4 mb-4 mb-lg-0">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" class="w-100 shadow-1-strong rounded mb-4" alt="" />

                <img src="https://mdbootstrap.com/img/Photos/Vertical/mountain3.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="" />
            </div>
        </div>
    </center>
</body>

</html>