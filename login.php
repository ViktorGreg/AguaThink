<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./try.css">
    <title>Log In</title>
</head>
<body>
    <?php
    if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];


        if (empty($email) || empty($password)) {
            echo "<p style='color: red; text-align: center;'>All fields are required.</p>";
        } else {
            require_once "database.php";

            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user_id"] = $user["id"];
                    header("Location: homePage.php");
                    die();
                }
            }else {
                echo "<p style='color: red; text-align: center;'>Email does not exist or is not registered.</p>";
            }
        }
    }
    ?>
    <div class="div1">
        <p class="title">AguaThink</p>
        <hr style="padding-right: 100px;"> 
        <p style="font-size: 20px;">Your safety is our priority...</p>
        <div>
            <img class="img1" src="./img/kudos-productions-star-guardian-key-visual-1.jpg" alt="">
        </div>
        <p class="cred">&copy;!Hydrophobic</p>
    </div>
    <div class="div2">
        <form class="input" action="login.php" method="post">
            <p style="text-align: center; font-size: 35px; font-weight: bold; margin-top: 5px; margin-bottom: 15px;">
                Log In
            </p>
            <label for="">Email:</label><p></p>
            <input class="email_inp" type="email" name="email" id="email" required><p></p>
    
            <label for="">Password:</label><p></p>
            <input class="pass_inp" type="password" name="password" id="password" required><p></p>

            <input class="submit_inp" type="submit" value="Login" name="login" id="sub"><p></p>
        </form>
        <p style="text-align: center; font-size: 16px; font-weight: bold; padding-right: 32px;">
            Don't have an account?
        </p>
        <div class="register_con">
            <a href="register.php">
                <button class="reg" type="button">Register</button>
            </a>
            <p class="e_input" style="font-size: 13px; text-align: center;">
                By registering, you're agreeing to our <a href="">Terms of Service</a> and 
                <a href="">Community Rules.</a>
            </p>
        </div>
    </div>
</body>
</html>
