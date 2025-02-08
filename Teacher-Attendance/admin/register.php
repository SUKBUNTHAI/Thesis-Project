<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="./assets/img/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./assets/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./assets/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./assets/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./assets/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="./assets/img/img-01.png" alt="IMG">
            </div>

            <form class="login100-form validate-form" action="register.php" method="post">
					<span class="login100-form-title">
						Register
					</span>
                <div class="wrap-input100 validate-input" data-validate = "Valid name is required: exabc_xyz">
                    <input class="input100" type="text" name="name" placeholder="Full Name">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
                </div>
                <div class="wrap-input100 validate-input" data-validate = "Valid username is required: exabc-123">
                    <input class="input100" type="text" name="username" placeholder="Username">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user-secret" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100" type="password" name="password" placeholder="Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>
                <div class="wrap-input100 validate-input" data-validate = "Valid password is required: ex@abc321">
                    <input class="input100" type="password" name="c_password" placeholder="Confirm Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit" name="register">
                        Register
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
                    <p>Already have account please!</p> <br>
                    <a class="txt2" href="../index.php">
                        <!-- <span><p>If you don't have account please!</p></span> <br> -->
                        Login
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include ('./database/connection.php');
global $conn;

if (isset($_POST['name'], $_POST['username'], $_POST['password'])) {
    $name = $_POST['name'];
    // $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT `name` FROM admin WHERE `name` =  :name ");
        $stmt->execute(['name' => $name]);

        $nameExist =  $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($nameExist)) {
            $conn->beginTransaction();

            $insertStmt = $conn->prepare("INSERT INTO admin (`name`, `username`, `password`) VALUES (:name, :username, :password)");
            $insertStmt->bindParam('name', $name, PDO::PARAM_STR);
            // $insertStmt->bindParam('role', $role, PDO::PARAM_STR);
            $insertStmt->bindParam('username', $username, PDO::PARAM_STR);
            $insertStmt->bindParam('password', $password, PDO::PARAM_STR);

            $insertStmt->execute();

            $conn->commit();

            echo "
            <script>
                alert('Registered Successfully!');
                window.location.href = './index.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Account Already Exist!');
           window.location.href = './index.php';
            </script>
            ";
        }

    }  catch (PDOException $e) {
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }

}

?>





<!--===============================================================================================-->
<script src="./assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="./assets/vendor/bootstrap/js/popper.js"></script>
<script src="./assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="./assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="./assets/vendor/tilt/tilt.jquery.min.js"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="./assets/js/main.js"></script>

</body>
</html>
