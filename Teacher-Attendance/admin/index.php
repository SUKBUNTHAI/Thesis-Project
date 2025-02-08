
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="./admin/assets/img/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./admin/assets/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./admin/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./admin/assets/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./admin/assets/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./admin/assets/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./admin/assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="./admin/assets/css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="./admin/assets/img/img-01.png" alt="IMG">
            </div>

            <form class="login100-form validate-form" action="index.php" method="post">
					<span class="login100-form-title">
						Login
					</span>
                <div class="wrap-input100 validate-input" data-validate = "Valid name is required: exabc_xyz">
                    <input class="input100" type="text" name="username" placeholder="Username">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Valid password is required: ex@abc321">
                    <input class="input100" type="password" name="password" placeholder="Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit" name="login">
                        Login
                    </button>
                </div>

                <!-- <div class="text-center p-t-12">
                    <span class="txt1">
                        Forgot
                    </span>
                    <a class="txt2" href="#">
                        Username / Password?
                    </a>
                </div> -->

                <div class="text-center p-t-10">
                    <p>If you don't have account please!</p> <br>
                    <a class="txt2" href="./admin/register.php">
                        <!-- <span><p>If you don't have account please!</p></span> <br> -->
                        Register
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include ('./admin/database/connection.php');
global $conn;

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT `password`, `id` FROM admin WHERE `username` = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $stored_password = $row['password'];
        // $stored_role = $row['role'];
        $user_id = $row['id'];

        if ($password === $stored_password) {
            session_start();
            $_SESSION['user_id'] = $user_id;


            echo "
                <script>
                    alert('Login Successfully!');
                    window.location.href = './admin/dashboard.php';
                </script>
                ";


        } else {
            echo "
            <script>
                alert('Login Failed, Incorrect Password!');
               window.location.href = 'index.php';
            </script>
            ";
        }

    } else {
        echo "
            <script>
                alert('Login Failed, User Not Found!');
               window.location.href = 'index.php';
            </script>
            ";
    }
}

?>





<!--===============================================================================================-->
<script src="./admin/assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="./admin/assets/vendor/bootstrap/js/popper.js"></script>
<script src="./admin/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="./admin/assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="./admin/assets/vendor/tilt/tilt.jquery.min.js"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="./admin/assets/js/main.js"></script>

</body>
</html>
