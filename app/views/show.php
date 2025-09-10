<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Show Users</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-8 bg-black">

  <!-- User Table -->
  <div class="w-full max-w-6xl bg-white shadow-2xl rounded-2xl p-8 border border-gray-200">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-extrabold text-indigo-700">👤 User Records</h1>
      <a href="<?=site_url('users/create');?>"
        class="px-5 py-2 bg-indigo-600 text-white font-semibold rounded-xl shadow hover:bg-indigo-700 active:scale-95 transition">
        Create New User
      </a>
    </div>

    <div class="overflow-x-auto rounded-xl border border-gray-200 shadow">
      <table class="w-full border-collapse">
        <thead class="bg-indigo-600 text-white">
          <tr>
            <th class="px-4 py-3 text-left text-sm font-semibold">ID</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">Last Name</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">First Name</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">Email</th>
            <th class="px-4 py-3 text-center text-sm font-semibold">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-gray-50">
          <?php foreach ($users as $user): ?>
          <tr class="hover:bg-indigo-50 transition">
            <td class="px-4 py-3"><?=html_escape($user['id']);?></td>
            <td class="px-4 py-3"><?=html_escape($user['last_name']);?></td>
            <td class="px-4 py-3"><?=html_escape($user['first_name']);?></td>
            <td class="px-4 py-3"><?=html_escape($user['email']);?></td>
            <td class="px-4 py-3 text-center space-x-2">
              <a href="<?=site_url('users/update/'.$user['id']);?>"
                class="px-4 py-1 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-600 active:scale-95 transition">Update</a>
              <a href="<?=site_url('users/delete/'.$user['id']);?>"
                class="px-4 py-1 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 active:scale-95 transition"
                onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
