<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registerPage.css">
    <title>Registration</title>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $email = $_POST["email"];
            $passwordConfirmation = $_POST["confirm_password"];

            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $error = ""; // Initialize a single error message variable.

            // Check if all fields are empty first.
            if (empty($username) && empty($password) && empty($email) && empty($passwordConfirmation)) {
                $error = "All fields are required";
            } elseif (empty($username) || empty($password) || empty($email) || empty($passwordConfirmation)) {
                $error = "Please fill in all the fields.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Email is not valid";
            } elseif (strlen($password) < 8) {
                $error = "Password must be at least 8 characters long";
            } elseif ($password !== $passwordConfirmation) {
                $error = "Password does not match";
            } else {
                require_once "database.php";
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                if ($rowCount > 0) {
                    $error = "Email already exists!";
                }
            }

            if (!empty($error)) {
                // Display the error message in a styled floating box.
                echo '<div class="error-box">';
                echo '<button onclick="this.parentElement.style.display=\'none\';">&times;</button>';
                echo "<p>$error</p>";
                echo '</div>';
            } else {
                // If no errors, insert the data into the database.
                $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password_hash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='error-box' style='background-color: #d4edda; color: #155724; border-color: #c3e6cb;'>
                            <button onclick=\"this.parentElement.style.display='none';\">&times;</button>
                            <p>You have been registered successfully!</p>
                          </div>";
                } else {
                    echo "<div class='error-box'>
                            <button onclick=\"this.parentElement.style.display='none';\">&times;</button>
                            <p>Something went wrong. Please try again.</p>
                          </div>";
                }
            }
        }
        ?>

        <form action="register.php" method="post">
        <p class="reg_name">
            Register
        </p>  
            <div class="form-group">
                <input class="input" type="text" name="username" placeholder="username">
            </div>
            <br>
            <div class="form-group">
                <input class="input" type="text" name="email" placeholder="email">
            </div>
            <br>
            <div class="form-group">
                <input class="input" type="password" name="password" placeholder="password">
            </div>
            <br>
            <div class="form-group">
                <input class="input" type="password" name="confirm_password" placeholder="confirm password">
            </div>
            <br>
            <div class="form-group">
                <input class="sbmt" type="submit" value="register" name="submit">
            </div>
            <br>
        </form>
        <p>
            Already have an account? <a href="login.php">Click Here!</a>
        </p>
    </div>
</body>
</html>