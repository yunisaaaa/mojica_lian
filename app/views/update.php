<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update User</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-950 text-white">

  <!-- Update Form Card -->
  <div class="w-full max-w-md bg-gradient-to-br from-gray-800 to-gray-900 shadow-2xl rounded-2xl p-8 border border-gray-700 relative overflow-hidden">
    
    <!-- Glow border -->
    <div class="absolute inset-0 rounded-2xl border border-purple-500/40 pointer-events-none"></div>

    <!-- Futuristic background shapes -->
    <div class="absolute -top-10 -left-10 w-32 h-32 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full opacity-20 blur-2xl"></div>
    <div class="absolute -bottom-12 -right-12 w-40 h-40 bg-gradient-to-tr from-pink-500 to-purple-700 rounded-full opacity-20 blur-2xl"></div>
    <div class="absolute top-1/3 -right-8 w-16 h-16 bg-blue-500 rounded-lg opacity-30 rotate-12 blur-lg"></div>
    <div class="absolute bottom-1/4 -left-6 w-12 h-12 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full opacity-40 blur-md"></div>

    <!-- Title -->
    <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-500 text-center mb-6 drop-shadow-lg">
      Update User
    </h1>

    <!-- Form -->
    <form action="<?=site_url('users/update/'.$user['id']);?>" method="post" class="space-y-5 relative z-10">
      <!-- Last Name -->
      <div>
        <label for="last_name" class="block text-sm font-semibold text-gray-300">Last Name</label>
        <input type="text" id="last_name" name="last_name"
          value="<?=html_escape($user['last_name']);?>"
          class="mt-2 w-full rounded-xl border border-gray-700 bg-gray-800/60 px-4 py-2 text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/70 placeholder-gray-400"
          placeholder="Enter last name">
      </div>

      <!-- First Name -->
      <div>
        <label for="first_name" class="block text-sm font-semibold text-gray-300">First Name</label>
        <input type="text" id="first_name" name="first_name"
          value="<?=html_escape($user['first_name']);?>"
          class="mt-2 w-full rounded-xl border border-gray-700 bg-gray-800/60 px-4 py-2 text-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-500/70 placeholder-gray-400"
          placeholder="Enter first name">
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-semibold text-gray-300">Email</label>
        <input type="email" id="email" name="email"
          value="<?=html_escape($user['email']);?>"
          class="mt-2 w-full rounded-xl border border-gray-700 bg-gray-800/60 px-4 py-2 text-white focus:border-pink-400 focus:ring-2 focus:ring-pink-500/70 placeholder-gray-400"
          placeholder="Enter email address">
      </div>

      <!-- Buttons -->
      <div class="flex items-center justify-between pt-4">
        <a href="<?=site_url('users/show');?>"
          class="text-sm text-gray-400 hover:text-purple-400 transition">← Back to Show</a>
        <button type="submit"
          class="px-6 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:from-indigo-400 hover:to-purple-500 active:scale-95 transition">
          Submit
        </button>
      </div>
    </form>
  </div>

</body>
</html>
