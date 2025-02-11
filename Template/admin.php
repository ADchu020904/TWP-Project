<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Login</title>
   <?php include 'partials/user/userstyle.html'; ?>
   <style>
      body {
         background-color: #efe4d1; /* Updated to match index.php */
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
      .login-left::after {
         content: '';
         position: absolute;
         right: 0;
         top: 0;
         bottom: 0;
         width: 1px;
         background-color: #fff;
      }
      .login-left img {
         max-width: 100px;
         margin-bottom: 20px;
      }
      .login-left h2 {
         font-size: 24px;
         margin-bottom: 10px;
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
      .login-right h2 {
         font-size: 22px;
         font-weight: bold;
         margin-bottom: 20px;
      }
      .form-group label {
         color: #333;
      }
      .form-control {
         border-radius: 5px;
         background-color: #fff;
         border: 1px solid #ccc;
      }
      .btn-primary {
         background-color: #FF6600;
         border: none;
         transition: background-color 0.3s;
         border-radius: 5px;
      }
      .btn-primary:hover {
         background-color: #FF4500;
      }
      .forgot-password {
         display: block;
         margin-top: 10px;
         color: #FF6600;
         text-decoration: none;
         font-size: 0.9rem;
      }
      .forgot-password:hover {
         text-decoration: underline;
      }
      @media (max-width: 768px) {
         .login-container {
            flex-direction: column;
         }
         .login-left, .login-right {
            width: 100%;
         }
         .login-left::after {
            display: none;
         }
      }
   .form-control::placeholder {
      color: #ccc;
      opacity: 1; /* Override default opacity */
   }
   </style>
</head>
<body>
   <div class="login-container"> 
   <div class="login-left">
       <img src="images/logo.png" alt="Company Logo" style="max-width: 200px;">
      <h2>A Moder Furtinure Shop</h2>
   </div>
   <div class="login-right">
      <h2>Welcome</h2>
      <p>PLEASE LOGIN TO ADMIN DASHBOARD</p>
      <form id="loginForm" onsubmit="handleLogin(event)">
      <div class="form-group">
         <label for="username">Username</label>
         <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
      </div>
      <div class="form-group">
         <label for="password">Password</label>
         <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
      </div>
      <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
      <a href="#" class="forgot-password">FORGOTTEN YOUR PASSWORD?</a>
      </form>
   </div>
   </div>
</body>
</html>