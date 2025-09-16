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
      <input id="searchBox" type="text" placeholder="Search users..."
        class="w-full max-w-sm rounded-xl border border-gray-700 bg-gray-800/60 px-4 py-2 text-white placeholder-gray-400 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/70">
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
          <?php if (!empty($users) && is_array($users)): ?>
            <?php foreach ($users as $user): ?>
              <tr class="hover:bg-gray-800/40 transition">
                <td class="px-4 py-3"><?= htmlspecialchars($user['id']); ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($user['last_name']); ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($user['first_name']); ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($user['email']); ?></td>
                <td class="px-4 py-3 text-center space-x-2">
                  <a href="<?= site_url('users/update/'.$user['id']); ?>" 
                     class="px-3 py-1 rounded-lg text-sm font-medium bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-400 hover:to-purple-500 transition">
                    Update
                  </a>
                  <a href="<?= site_url('users/delete/'.$user['id']); ?>" 
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
    <div id="pagination" class="flex justify-center mt-6 gap-2 flex-wrap relative z-10"></div>

    <!-- Create button -->
    <div class="text-center mt-8 relative z-10">
      <a href="<?= site_url('users/create'); ?>" 
         class="px-6 py-2 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl font-semibold hover:from-green-400 hover:to-emerald-500 transition">
         Create New User
      </a>
    </div>
  </div>

  <script>
    const searchBox = document.getElementById('searchBox');
    const table = document.getElementById('studentsTable');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const pagination = document.getElementById('pagination');
    const pageSize = 5;
    let currentPage = 1;

    function filterRows() {
      const query = searchBox.value.trim().toLowerCase();
      return rows.filter(row => {
        return Array.from(row.children).some(cell =>
          cell.textContent.toLowerCase().includes(query)
        );
      });
    }

    function renderTable(page = 1) {
      const filtered = filterRows();
      const total = filtered.length;
      const totalPages = Math.ceil(total / pageSize) || 1;
      if (page > totalPages) page = totalPages;
      currentPage = page;
      tbody.innerHTML = '';
      const start = (page - 1) * pageSize;
      const end = start + pageSize;
      filtered.slice(start, end).forEach(row => tbody.appendChild(row));
      renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
      pagination.innerHTML = '';
      const maxButtons = 5;
      let startPage = Math.max(1, currentPage - Math.floor(maxButtons / 2));
      let endPage = Math.min(totalPages, startPage + maxButtons - 1);
      if (endPage - startPage + 1 < maxButtons) startPage = Math.max(1, endPage - maxButtons + 1);

      const createButton = (label, page, disabled=false, active=false) => {
        const btn = document.createElement('button');
        btn.textContent = label;
        btn.disabled = disabled;
        btn.className = `px-3 py-1 rounded-lg text-xs font-semibold transition
          ${active ? 'bg-indigo-500 text-white shadow-md border-indigo-500' :
                     'bg-gray-800/60 border border-indigo-500 text-indigo-400 hover:bg-indigo-500 hover:text-white'}
          ${disabled ? 'opacity-40 cursor-not-allowed' : ''}`;
        if (!disabled) btn.onclick = () => gotoPage(page);
        return btn;
      };

      pagination.appendChild(createButton('«', 1, currentPage===1));
      pagination.appendChild(createButton('‹', currentPage-1, currentPage===1));
      for (let i = startPage; i <= endPage; i++) {
        pagination.appendChild(createButton(i, i, false, i===currentPage));
      }
      pagination.appendChild(createButton('›', currentPage+1, currentPage===totalPages));
      pagination.appendChild(createButton('»', totalPages, currentPage===totalPages));
    }

    function gotoPage(page) { renderTable(page); }

    searchBox.addEventListener('input', () => renderTable(1));
    renderTable(1);
  </script>
</body>
</html>
