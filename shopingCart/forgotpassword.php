
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BookStore - Registration and Login</title>
  <link rel="stylesheet" href="forgotpassword.css">
</head>

<body>
  <div class="container">
    <div class="LoginRegister_logo">
      <img alt="Sarasavi Logo" src=".png" width="340" height="75" >
    </div>
    <div class="form-container">
      <!-- Login Form -->
      <form id="loginForm" class="form" action="home.html" method="post">
        <h2>Login</h2>

        <label for="loginEmail">Email:<span>*</span></label>
        <input type="email" id="loginEmail" name="loginEmail" placeholder="Your Email" required>

        <label for="loginPassword">Password:<span>*</span></label>
        <input type="password" id="loginPassword" name="loginPassword" placeholder="Your Password" required>

        <button type="submit" href="home.html">Login</button>
      </form>
    </div>

    <div class="Forgot_Password">
      <!-- Forgot Password -->
      <form id="ForgotPasswordForm" class="form" action="home.html" method="post">
        <h2>Forgot Password</h2>

        <label for="email">Email:<span>*</span></label>
        <input type="email" id="email" name="email" placeholder="Your Email" required>

        <button type="button" onclick="SendResetLink()">Send Reset Link</button>
        

        <script src="forgotpassword.js">
                function SendResetLink() {
            var email= document.getElementById('email').value;
            
            arert('Reset link sent to'+ email);
                }

        </script>
      </form>
    </div>


  </div>
</body>

</html>