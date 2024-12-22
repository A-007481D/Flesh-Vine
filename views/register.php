<?php require_once '../auth/register.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>F&V | Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Merienda:wght@300..900&family=Poppins:wght@500&family=Sansita+Swashed:wght@300..900&display=swap"
    rel="stylesheet">
  <style>
    @layer utilities {
      .font-merienda {
        font-family: 'Merienda', cursive;
      }
    }

    html {
      scroll-behavior: smooth;
    }
  </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center bg-[url('../img/loginback.jpg')] backdrop-blur bg-cover bg-fixed bg-opacity-20">
  <div class="bg-white rounded-lg shadow-lg max-w-5xl w-full flex overflow-hidden">
    <div class="w-1/2 relative">
      <img src="../img/loginback.jpg" alt="login image" class="h-full w-full object-cover">
      <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center text-center text-white px-6">
        <div>
          <a href="home.php">
            <h1 class="text-4xl font-bold mb-2 font-merienda">Flesh & Vine</h1>
          </a>
          <p class="text-lg">Food is the only purchase that enriches you in ways beyond material wealth</p>
        </div>
      </div>
    </div>

    <div class="w-1/2 p-8 flex flex-col justify-center">
      <h2 class="text-3xl font-bold text-[#cca45e] text-center">Join Us</h2>
      <p class="text-gray-500 text-center mb-6">Create your account</p>

      <form action="register.php" method="POST">
        <div class="flex mb-4 gap-4">
          <div class="w-1/2">
            <label for="firstname" class="block text-gray-700 mb-2">First Name</label>
            <div class="flex items-center border rounded-lg px-3 py-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 5.25v13.5c0 .966-.784 1.75-1.75 1.75H4c-.966 0-1.75-.784-1.75-1.75V5.25M21.75 5.25A2.25 2.25 0 0019.5 3H4.5a2.25 2.25 0 00-2.25 2.25m19.5 0H2.25" />
              </svg>
              <input type="text" id="firstname" name="firstname" class="ml-2 w-full border-none outline-none focus:ring-0" placeholder="Madds" required>
            </div>
          </div>
          <div class="w-1/2">
            <label for="lastname" class="block text-gray-700 mb-2">Last Name</label>
            <div class="flex items-center border rounded-lg px-3 py-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 5.25v13.5c0 .966-.784 1.75-1.75 1.75H4c-.966 0-1.75-.784-1.75-1.75V5.25M21.75 5.25A2.25 2.25 0 0019.5 3H4.5a2.25 2.25 0 00-2.25 2.25m19.5 0H2.25" />
              </svg>
              <input type="text" id="lastname" name="lastname" class="ml-2 w-full border-none outline-none focus:ring-0" placeholder="Mikkelsen" required>
            </div>
          </div>
        </div>

        <div class="mb-4">
          <label for="email" class="block text-gray-700 mb-2">Email Address</label>
          <div class="flex items-center border rounded-lg px-3 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 5.25v13.5c0 .966-.784 1.75-1.75 1.75H4c-.966 0-1.75-.784-1.75-1.75V5.25M21.75 5.25A2.25 2.25 0 0019.5 3H4.5a2.25 2.25 0 00-2.25 2.25m19.5 0H2.25" />
            </svg>
            <input type="email" id="email" name="email" class="ml-2 w-full border-none outline-none focus:ring-0" placeholder="example@mail.com" required>
          </div>
        </div>

        <div class="mb-4">
          <label for="password" class="block text-gray-700 mb-2">Password</label>
          <div class="flex items-center border rounded-lg px-3 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V8.25a3.75 3.75 0 10-7.5 0V10.5M3 21h18" />
            </svg>
            <input type="password" id="password" name="password" class="ml-2 w-full border-none outline-none focus:ring-0" placeholder="********" required>
          </div>
        </div>

        <div class="mb-6">
          <label for="confirm-password" class="block text-gray-700 mb-2">Confirm Password</label>
          <div class="flex items-center border rounded-lg px-3 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V8.25a3.75 3.75 0 10-7.5 0V10.5M3 21h18" />
            </svg>
            <input type="password" id="confirm-password" name="confirm_password" class="ml-2 w-full border-none outline-none focus:ring-0" placeholder="********" required>
          </div>
        </div>

        <button type="submit" class="w-full bg-[#cca45e] text-white py-3 rounded-lg font-semibold hover:bg-[#cca45e]">REGISTER</button>
      </form>

      <p class="text-center text-gray-500 mt-6">Already have an account? <a href="login.php" class="text-[#cca45e] font-semibold hover:underline">Login Here</a></p>
    </div>
  </div>


</body>

</html>