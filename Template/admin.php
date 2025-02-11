<?php include("partials/staffinfo.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <?php include 'partials/style.html'; ?>
  </head>
  <body x-data="{ darkMode: true }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'))" :class="{'dark': darkMode}">
    <div class="min-h-screen bg-gray-100 dark:bg-boxdark-2 flex items-center justify-center">
      <div class="bg-white dark:bg-boxdark rounded-lg shadow-default max-w-md w-full p-8">
        <h2 class="text-2xl font-bold text-center mb-6 dark:text-white">Admin</h2>
        <?php if ($error): ?>
          <div class="mb-4">
            <p class="text-red-600 text-center"><?php echo htmlspecialchars($error); ?></p>
          </div>
        <?php endif; ?>
        <form id="loginForm" method="POST" action="admin.php">
          <div class="mb-4">
            <label for="email" class="block text-gray-700 dark:text-gray-300">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" 
              class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-primary dark:bg-boxdark dark:text-white" required>
          </div>
          <div class="mb-4">
            <label for="password" class="block text-gray-700 dark:text-gray-300">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" 
              class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-primary dark:bg-boxdark dark:text-white" required>
          </div>
          <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg hover:bg-primary-dark">
            LOGIN
          </button>
        </form>
        <p class="mt-4 text-center">
          <a href="#" class="text-primary hover:underline">Forgot Password?</a>
        </p>
      </div>
    </div>
    <?php include 'partials/js.html'; ?>
  </body>
</html>