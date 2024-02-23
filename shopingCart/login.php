<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'config.php';

// Check if the registration form is submitted
if (isset($_POST["submit2"])) {
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    if ($password !== $confirmPassword) {
        echo "Error: Passwords do not match.";
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO customers (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $fullName, $email, $hashedPassword);
        $stmt->execute();

        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}

if (isset($_POST["submit"])) {
    $useremail = $_POST['email'];
    $userpassword = $_POST['password'];

    // Validate email and password
    if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Invalid email format.";
        exit();
    }

    if (empty($userpassword)) {
        echo "Error: Password cannot be empty.";
        exit();
    }

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT cus_id, role, password FROM customers WHERE email = ?");
    $stmt->bind_param("s", $useremail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($cus_id, $role, $hashedPassword);
        $stmt->fetch();

        // Verify the password using password_verify
        if (password_verify($userpassword, $hashedPassword)) {
            $_SESSION['cus_id'] = $cus_id;
            $_SESSION['role'] = $role;

            if ($role == 'admin') {
                header("location: admin.php");
            } else {
                header("location: bookhome.php");
            }

            // Insert login record into user_session
            $insertQuery = "INSERT INTO user_session (cus_id, login_time) VALUES (?, NOW())";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->bind_param("i", $cus_id);
            $insertStmt->execute();
            $insertStmt->close();
        } else {
            echo "Error: Incorrect password.";
        }
    } else {
        echo "Error: Email not found.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore - Registration and Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="container">
        <div class="LoginRegister_logo">
            <img  src=".png" width="340" height="75">
        </div>
        <div class="form-container">
            <!-- Login Form -->
            <form id="loginForm" class="form" method="POST" >
                <h2>Login</h2>

                <label for="loginEmail">Email:<span>*</span></label>
                <input type="email" id="loginEmail" name="email" placeholder="Your Email" required>

                <label for="loginPassword">Password:<span>*</span></label>
                <input type="password" id="loginPassword" name="password" placeholder="Your Password" required>

                <button type="submit" name="submit">Login</button>

                <p>Forgot password? <a href="forgotpassword.php">Reset password</a></p>

            </form>
        </div>

        <div class="Registration-container">
            <!-- Registration Form -->
            <form id="registrationForm" class="form" method="POST">
                <h2>Register</h2>

                <label for="fullName">Full Name:<span>*</span></label>
                <input type="text" id="fullName" name="fullName" placeholder="Your Full Name" required>

                <label for="email">Email:<span>*</span></label>
                <input type="email" id="email" name="email" placeholder="Your Email" required>

                <label for="password">Password:<span>*</span></label>
                <input type="password" id="password" name="password" placeholder="Your Password" required>

                <label for="confirmPassword">Confirm Password:<span>*</span></label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                <button type="submit" name="submit2">Register</button>
            </form>
        </div>
    </div>
</body>

</html>
