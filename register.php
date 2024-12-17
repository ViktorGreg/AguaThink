<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/registerPage.css">
    <title>Registration</title>
</head>
<style>
    /* Global Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
    }

    /* Body Styling */
    body {
        background-color: #f1f1f1;
        color: #333;
        font-size: 16px;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    /* Container Styling */
    .container {
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
        text-align: center;
    }

    /* Header */
    h2 {
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: bold;
        color: #4CAF50;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 15px;
    }

    .input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        outline: none;
    }

    .input:focus {
        border-color: #4CAF50;
    }

    /* Submit Button */
    .btn-submit {
        width: 100%;
        padding: 12px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #45a049;
    }

    /* Error and Success Messages */
    .error-box, .success-box {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        border-radius: 4px;
        margin-top: 10px;
        border: 1px solid #f5c6cb;
        position: relative;
    }

    .success-box {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .error-box button, .success-box button {
        position: absolute;
        top: 5px;
        right: 10px;
        background: none;
        border: none;
        font-size: 20px;
        color: inherit;
        cursor: pointer;
    }

    /* Link to Login */
    .login-link {
        margin-top: 20px;
        font-size: 14px;
    }

    .login-link a {
        color: #4CAF50;
        text-decoration: none;
    }

    .login-link a:hover {
        text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 600px) {
        .container {
            padding: 20px;
            width: 90%;
        }

        .btn-submit {
            font-size: 14px;
        }
    }

</style>
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
                    echo "<div class='success-box'>
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
            <h2>Register</h2>

            <div class="form-group">
                <input class="input" type="text" name="username" placeholder="Username" required>
            </div>

            <div class="form-group">
                <input class="input" type="email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <input class="input" type="password" name="password" placeholder="Password" required>
            </div>

            <div class="form-group">
                <input class="input" type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>

            <div class="form-group">
                <input class="btn-submit" type="submit" value="Register" name="submit">
            </div>

            <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>
</body>
</html>
