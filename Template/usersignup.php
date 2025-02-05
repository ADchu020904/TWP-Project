<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login & Sign Up</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
      body {
         background-color: #efe4d1; /* Updated to match index.html */
         font-family: 'Poppins', sans-serif;
         color: #fff;
         display: flex;
         justify-content: center;
         align-items: center;
         height: 100vh;
         margin: 0;
      }
        .login-container {
         display: flex;
         background-color: #fff;
         border-radius: 8px;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
         overflow: hidden;
         max-width: 900px;
         width: 100%;
         position: relative;
      }
        .login-left, .login-right {
            width: 50%;
            padding: 20px;
        }
        .login-left {
         background-color: #c3baab;
         padding: 40px;
         display: flex;
         flex-direction: column;
         justify-content: center;
         align-items: center;
         color: #fff;
         width: 50%;
         text-align: center;
         position: relative;
      }
      
        .login-left img {
            max-width: 200px;
        }
        .login-right {
         padding: 40px;
         flex: 1;
         background-color: #fff;
         color: #333;
         display: flex;
         flex-direction: column;
         justify-content: center;
         align-items: center;
         width: 50%;
      }
        .form-control::placeholder {
            color: #ccc;
            opacity: 1; /* Override default opacity */
        }
        .btn-primary {
         background-color: #7c2c0c;
         border: none;
         transition: background-color 0.3s;
         border-radius: 5px;
      }
      .btn-primary:hover {
         background-color: #975a41;
      }
        .forgot-password, .sign-up, .go-back {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #7c2c0c;
            text-decoration: none;
        }
        .forgot-password:hover, .sign-up:hover, .go-back:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .login-left, .login-right {
                width: 100%;
            }
            .login-left::after {
                display: none;
            }
        }
    </style>
    <script>
        function handleLogin(event) {
            event.preventDefault(); // Prevent the default form submission
            window.location.href = 'user-dashboard.html'; // Redirect to user dashboard
        }
        function switchToSignUp(event) {
            event.preventDefault(); // Prevent the default link action
            document.getElementById('loginForm').style.display = 'none';
            document.getElementById('signUpForm').style.display = 'block';
            document.getElementById('loginHeader').style.display = 'none';
        }
        function switchToLogin(event) {
            event.preventDefault(); // Prevent the default link action
            document.getElementById('signUpForm').style.display = 'none';
            document.getElementById('loginForm').style.display = 'block';
            document.getElementById('loginHeader').style.display = 'block';
        }
    </script>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <img src="images/logo.png" alt="Company Logo">
            <h2>A Modern Furniture Shop</h2>
        </div>
        <div class="login-right">
            <div id="loginHeader">
                <h2>Welcome</h2>
                <p>PLEASE LOGIN TO YOUR ACCOUNT</p>
            </div>
            <form id="loginForm" onsubmit="handleLogin(event)" method="POST" action="register.php">
                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="text" class="form-control" id="useremail" name="useremail" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <input type="submit" class="btn btn-primary btn-block" name="login">LOGIN</input>
                <a href="#" class="sign-up" onclick="switchToSignUp(event)">SIGN UP</a>
                <a href="#" class="forgot-password">FORGOTTEN YOUR PASSWORD?</a>
                <a href="index.html" class="go-back">GO BACK TO HOME</a>
            </form>
            <form id="signUpForm" style="display: none;" method="POST" action="register.php">
                <h2>Sign Up</h2>
                <div class="form-group">
                    <label for="Fname">First Name</label>
                    <input type="text" class="form-control" id="FNname" name="FName" placeholder="Enter you first name" required>
                </div>
                <div class="form-group">
                    <label for="LName">Last Name</label>
                    <input type="text" class="form-control" id="LNname" name="LName" placeholder="Enter you last name" required>
                </div>
                <div class="form-group">
                    <label for="useremail">Email</label>
                    <input type="text" class="form-control" id="useremail" name="useremail" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                
                <input type="submit" class="btn btn-primary btn-block" name="signUp">SIGN UP</input>
                <a href="#" class="sign-up" onclick="switchToLogin(event)">ALREADY HAVE AN ACCOUNT? LOGIN</a>
                <a href="forgot-password.html" class="forgot-password">FORGOTTEN YOUR PASSWORD?</a>
                <a href="index.html" class="go-back">GO BACK TO HOME</a>
            </form>
        </div>
    </div>
</body>
</html>