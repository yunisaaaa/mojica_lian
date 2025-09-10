<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update User</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-black">

  <!-- Update Form Card -->
  <div class="w-full max-w-md bg-white shadow-2xl rounded-2xl p-8 border border-gray-200">
    <h1 class="text-3xl font-extrabold text-indigo-700 text-center mb-6">Update User</h1>

    <form action="<?=site_url('users/update/'.$user['id']);?>" method="post" class="space-y-5">
      <!-- Last Name -->
      <div>
        <label for="last_name" class="block text-sm font-semibold text-gray-700">Last Name</label>
        <input type="text" id="last_name" name="last_name"
          value="<?=html_escape($user['last_name']);?>"
          class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-300"
          placeholder="Enter last name">
      </div>

      <!-- First Name -->
      <div>
        <label for="first_name" class="block text-sm font-semibold text-gray-700">First Name</label>
        <input type="text" id="first_name" name="first_name"
          value="<?=html_escape($user['first_name']);?>"
          class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-300"
          placeholder="Enter first name">
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
        <input type="email" id="email" name="email"
          value="<?=html_escape($user['email']);?>"
          class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-300"
          placeholder="Enter email address">
      </div>

      <!-- Buttons -->
      <div class="flex items-center justify-between pt-4">
        <a href="<?=site_url('users/show');?>"
          class="text-sm text-gray-500 hover:text-indigo-600">← Back to Show</a>
        <button type="submit"
          class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 active:scale-95 transition">
          Submit
        </button>
      </div>
    </form>
  </div>

</body>
</html>
