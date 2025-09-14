<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Show Users</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-8 bg-gradient-to-br from-gray-900 via-black to-gray-950 text-white">

  <!-- User Table -->
  <div class="w-full max-w-6xl bg-gradient-to-br from-gray-800 to-gray-900 shadow-2xl rounded-2xl p-8 border border-gray-700 relative overflow-hidden">

    <!-- Glow border effect -->
    <div class="absolute inset-0 rounded-2xl border border-purple-500/40 pointer-events-none"></div>

    <!-- Futuristic background shapes -->
    <div class="absolute -top-10 -left-10 w-32 h-32 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full opacity-20 blur-2xl"></div>
    <div class="absolute -bottom-12 -right-12 w-40 h-40 bg-gradient-to-tr from-pink-500 to-purple-700 rounded-full opacity-20 blur-2xl"></div>
    <div class="absolute top-1/3 -right-8 w-16 h-16 bg-blue-500 rounded-lg opacity-30 rotate-12 blur-lg"></div>
    <div class="absolute bottom-1/4 -left-6 w-12 h-12 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full opacity-40 blur-md"></div>

    <!-- Header -->
    <div class="flex justify-between items-center mb-6 relative z-10">
      <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-500 drop-shadow-lg">
        👤 User Records
      </h1>
      <a href="<?=site_url('users/create');?>"
        class="px-5 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:from-indigo-400 hover:to-purple-500 active:scale-95 transition">
        Create New User
      </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-xl border border-gray-700 shadow relative z-10">
      <table class="w-full border-collapse">
        <thead class="bg-gradient-to-r from-indigo-600 to-purple-700 text-white">
          <tr>
            <th class="px-4 py-3 text-left text-sm font-semibold">ID</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">Last Name</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">First Name</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">Email</th>
            <th class="px-4 py-3 text-center text-sm font-semibold">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-700 bg-gray-800/60">
          <?php foreach ($users as $user): ?>
          <tr class="hover:bg-gray-700/60 transition">
            <td class="px-4 py-3"><?=html_escape($user['id']);?></td>
            <td class="px-4 py-3"><?=html_escape($user['last_name']);?></td>
            <td class="px-4 py-3"><?=html_escape($user['first_name']);?></td>
            <td class="px-4 py-3"><?=html_escape($user['email']);?></td>
            <td class="px-4 py-3 text-center space-x-2">
              <a href="<?=site_url('users/update/'.$user['id']);?>"
                class="px-4 py-1 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-lg shadow hover:from-yellow-400 hover:to-orange-400 active:scale-95 transition">
                Update
              </a>
              <a href="<?=site_url('users/delete/'.$user['id']);?>"
                class="px-4 py-1 bg-gradient-to-r from-red-600 to-pink-600 text-white rounded-lg shadow hover:from-red-500 hover:to-pink-500 active:scale-95 transition"
                onclick="return confirm('Are you sure you want to delete this record?');">
                Delete
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
