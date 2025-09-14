<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Data Grid</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-950 text-white">

  <!-- Container -->
  <div class="w-full max-w-5xl bg-gradient-to-br from-gray-800 to-gray-900 shadow-2xl rounded-2xl p-8 border border-gray-700 relative overflow-hidden">
    
    <!-- Glow border effect -->
    <div class="absolute inset-0 rounded-2xl border border-purple-500/40 pointer-events-none"></div>

    <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-500 text-center mb-6 drop-shadow-lg">
      User Data Grid
    </h1>

    <!-- Search -->
    <div class="mb-6 flex justify-center">
      <input id="searchBox" type="text" placeholder="Search records..."
        class="w-full max-w-sm rounded-xl border border-gray-700 bg-gray-800/60 px-4 py-2 text-white placeholder-gray-400 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/70">
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-xl border border-gray-700">
      <table id="studentsTable" class="w-full text-left text-sm">
        <thead class="bg-gray-800/80 text-indigo-400 uppercase text-xs tracking-wider">
          <tr>
            <th class="px-6 py-3">ID</th>
            <th class="px-6 py-3">Last Name</th>
            <th class="px-6 py-3">First Name</th>
            <th class="px-6 py-3">Email</th>
            <th class="px-6 py-3">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-700">
          <?php foreach (html_escape($users) as $user): ?>
            <tr class="hover:bg-gray-800/50 transition">
              <td class="px-6 py-3"><?=$user['id'];?></td>
              <td class="px-6 py-3"><?=$user['last_name'];?></td>
              <td class="px-6 py-3"><?=$user['first_name'];?></td>
              <td class="px-6 py-3"><?=$user['email'];?></td>
              <td class="px-6 py-3 flex gap-2">
                <a href="<?=site_url('users/update/'.$user['id']);?>"
                   class="px-3 py-1 rounded-lg border border-indigo-400 text-indigo-400 hover:bg-indigo-500 hover:text-white transition text-xs font-semibold">
                   Update
                </a>
                <a href="<?=site_url('users/delete/'.$user['id']);?>"
                   onclick="return confirm('Are you sure you want to delete this record?');"
                   class="px-3 py-1 rounded-lg border border-pink-400 text-pink-400 hover:bg-pink-500 hover:text-white transition text-xs font-semibold">
                   Delete
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div id="pagination" class="flex justify-center mt-6 gap-2 flex-wrap"></div>

    <!-- Create button -->
    <div class="text-center mt-8">
      <a href="<?=site_url('users/create');?>"
         class="px-6 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:from-indigo-400 hover:to-purple-500 active:scale-95 transition">
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
      if (endPage - startPage + 1 < maxButtons) {
        startPage = Math.max(1, endPage - maxButtons + 1);
      }

      const button = (label, page, disabled=false, active=false) => {
        const btn = document.createElement('button');
        btn.textContent = label;
        btn.disabled = disabled;
        btn.className = `px-3 py-1 rounded-lg border text-xs font-semibold transition
          ${active ? 'bg-indigo-500 text-white border-indigo-500 shadow-md' :
                     'border-indigo-400 text-indigo-400 hover:bg-indigo-500 hover:text-white'}
          ${disabled ? 'opacity-40 cursor-not-allowed' : ''}`;
        if (!disabled) btn.onclick = () => gotoPage(page);
        return btn;
      };

      pagination.appendChild(button('«', 1, currentPage===1));
      pagination.appendChild(button('‹', currentPage-1, currentPage===1));
      for (let i = startPage; i <= endPage; i++) {
        pagination.appendChild(button(i, i, false, i===currentPage));
      }
      pagination.appendChild(button('›', currentPage+1, currentPage===totalPages));
      pagination.appendChild(button('»', totalPages, currentPage===totalPages));
    }

    function gotoPage(page) {
      renderTable(page);
    }

    searchBox.addEventListener('input', () => renderTable(1));
    renderTable(1);
  </script>
</body>
</html>
