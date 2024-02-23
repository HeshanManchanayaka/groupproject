<?php
session_start();

include 'config.php';

if (isset($_POST["register"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $query = "SELECT * FROM customers WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result) {

        if (mysqli_num_rows($result) > 0) {

            echo '<script language="javascript">';
            echo 'alert("Username already exists")';
            echo '</script>';
        } else {
            $pass = md5($pass);
            $sql = "INSERT INTO customers (name,email,password,role) 
                    VALUES ('$name', '$email','$pass','admin')";

            mysqli_query($conn, $sql);
            $_SESSION['message'] = "You are now Registered";
            $_SESSION['email'] = $email;
            header("location:login.html");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .register_form {
            color: black;
            margin-top: 150px;
            width: 500px;
            height: 200;
            background-color: lightskyblue;
            font-size: 17px;
        }
        .backbtn{
        padding-top: 50px;
        }
    </style>
</head>

<body>
    <center>
        <h1>Admin page</h1>
    </center>
    <center>
        <form class="register_form" method="POST">

            <fieldset>
                <h2>Admin Registration</h2>
                <label>
                    <pre>    Admin Name</pre>
                </label>
                <pre>    <input type="text" class="input_size" name="name" placeholder="name" ></pre>
                <label>
                    <pre>    Admin Email</label></pre>
                    <pre>    <input type="email" class="input_size" name="email" placeholder="email"></pre>
                    <label>
                        <pre>    Password</label></pre>
                        <pre>    <input type="password" class="input_size" name="pass" placeholder="Password"></pre>
                            <button class="submitbtn" name="register">Submit</button>

            </fieldset>

        </form>
    </center>
    <center>
        <form action="admin.php" class="backbtn">
            <button >Back</button>
        </form>
    </center>
</body>

</html>