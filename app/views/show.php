<?php
// Database connection (adjust credentials to your DB)
$conn = new mysqli("localhost", "root", "", "your_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pagination setup
$page   = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit  = 5;
$offset = ($page - 1) * $limit;

// Search filter
$search = isset($_GET['search']) ? trim($_GET['search']) : "";
$where  = "";
$params = [];
$types  = "";

if ($search) {
    $where = "WHERE first_name LIKE ? OR last_name LIKE ? OR email LIKE ?";
    $like  = "%$search%";
    $params = [$like, $like, $like];
    $types  = "sss";
}

// Count total
$sqlCount = "SELECT COUNT(*) as total FROM users $where";
$stmt = $conn->prepare($sqlCount);
if ($search) $stmt->bind_param($types, ...$params);
$stmt->execute();
$totalRows = $stmt->get_result()->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

// Fetch data
$sql = "SELECT * FROM users $where LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
if ($search) {
    $stmt->bind_param($types . "ii", ...$params, $limit, $offset);
} else {
    $stmt->bind_param("ii", $limit, $offset);
}
$stmt->execute();
$result = $stmt->get_result();
$users  = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Show Users</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-950 text-white">

  <!-- Show Users Card -->
  <div class="w-full max-w-5xl bg-gradient-to-br from-gray-800 to-gray-900 shadow-2xl rounded-2xl p-8 border border-gray-700 relative overflow-hidden">
    
    <!-- Glow Border -->
    <div class="absolute inset-0 rounded-2xl border border-purple-500/40 pointer-events-none"></div>

    <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-500 text-center mb-6 drop-shadow-lg">
      Users List
    </h1>

    <!-- Search -->
    <div class="mb-6 flex justify-center relative z-10">
      <form method="get" class="w-full max-w-sm">
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>"
          placeholder="Search users..."
          class="w-full rounded-xl border border-gray-700 bg-gray-800/60 px-4 py-2 text-white placeholder-gray-400 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/70">
      </form>
    </div>

    <!-- Users Table -->
    <div class="overflow-x-auto relative z-10">
      <table id="studentsTable" class="w-full border-collapse rounded-lg overflow-hidden">
        <thead>
          <tr class="bg-gradient-to-r from-indigo-500/20 to-purple-600/20 text-gray-300">
            <th class="px-4 py-3 text-left">ID</th>
            <th class="px-4 py-3 text-left">Last Name</th>
            <th class="px-4 py-3 text-left">First Name</th>
            <th class="px-4 py-3 text-left">Email</th>
            <th class="px-4 py-3 text-center">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-700">
          <?php if (!empty($users)): ?>
            <?php foreach ($users as $user): ?>
              <tr class="hover:bg-gray-800/40 transition">
                <td class="px-4 py-3"><?= htmlspecialchars($user['id']); ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($user['last_name']); ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($user['first_name']); ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($user['email']); ?></td>
                <td class="px-4 py-3 text-center space-x-2">
                  <a href="update.php?id=<?= $user['id']; ?>"
                     class="px-3 py-1 rounded-lg text-sm font-medium bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-400 hover:to-purple-500 transition">
                    Update
                  </a>
                  <a href="delete.php?id=<?= $user['id']; ?>"
                     onclick="return confirm('Are you sure you want to delete this record?');"
                     class="px-3 py-1 rounded-lg text-sm font-medium bg-gradient-to-r from-pink-500 to-red-600 hover:from-pink-400 hover:to-red-500 transition">
                    Delete
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" class="text-center py-3">No users found</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div id="pagination" class="flex justify-center mt-6 gap-2 flex-wrap relative z-10">
      <?php if ($page > 1): ?>
        <a href="?page=1&search=<?= urlencode($search) ?>" class="px-3 py-1 border rounded bg-gray-800">«</a>
        <a href="?page=<?= $page-1 ?>&search=<?= urlencode($search) ?>" class="px-3 py-1 border rounded bg-gray-800">‹</a>
      <?php endif; ?>

      <?php for ($i = max(1, $page-2); $i <= min($totalPages, $page+2); $i++): ?>
        <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"
           class="px-3 py-1 border rounded <?= $i==$page ? 'bg-indigo-500 text-white' : 'bg-gray-800' ?>">
           <?= $i ?>
        </a>
      <?php endfor; ?>

      <?php if ($page < $totalPages): ?>
        <a href="?page=<?= $page+1 ?>&search=<?= urlencode($search) ?>" class="px-3 py-1 border rounded bg-gray-800">›</a>
        <a href="?page=<?= $totalPages ?>&search=<?= urlencode($search) ?>" class="px-3 py-1 border rounded bg-gray-800">»</a>
      <?php endif; ?>
    </div>

    <!-- Create button -->
    <div class="text-center mt-8 relative z-10">
      <a href="create.php"
         class="px-6 py-2 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl font-semibold hover:from-green-400 hover:to-emerald-500 transition">
        Create New User
      </a>
    </div>
  </div>
</body>
</html>
