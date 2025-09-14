<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Data Grid | System Console</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --color-bg-primary: #0a0f14;
      --color-bg-card: rgba(20, 30, 40, 0.85);
      --color-text-primary: #e5e5e5;
      --color-accent-neon: #00ff9f;
      --color-accent-pink: #ff3c7d;
      --color-border: #1f2a35;
      --font-display: 'Orbitron', sans-serif;
      --font-mono: 'Roboto Mono', monospace;
      --shadow-neon: 0 0 12px rgba(0, 255, 159, 0.4);
    }

    body {
      margin: 0;
      padding: 2rem 1rem;
      font-family: var(--font-mono);
      background: radial-gradient(circle at top left, #0f2027, #203a43, #2c5364);
      color: var(--color-text-primary);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: flex-start;
    }

    .container {
      width: 100%;
      max-width: 1100px;
      background: var(--color-bg-card);
      border: 1px solid var(--color-border);
      box-shadow: var(--shadow-neon);
      border-radius: 16px;
      padding: 2rem;
      backdrop-filter: blur(12px);
    }

    h1 {
      font-family: var(--font-display);
      font-size: 2rem;
      text-align: center;
      margin-bottom: 2rem;
      color: var(--color-accent-neon);
      text-shadow: 0 0 10px var(--color-accent-neon);
      text-transform: uppercase;
      letter-spacing: 2px;
    }

    .search-container {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    #searchBox {
      width: 100%;
      max-width: 350px;
      padding: 0.8rem 1rem;
      border-radius: 8px;
      border: 1px solid var(--color-border);
      background: rgba(15, 20, 25, 0.9);
      color: var(--color-text-primary);
      font-family: var(--font-mono);
      font-size: 1rem;
      transition: 0.3s ease;
    }

    #searchBox:focus {
      outline: none;
      border-color: var(--color-accent-neon);
      box-shadow: 0 0 8px var(--color-accent-neon);
    }

    .table-responsive {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-radius: 10px;
      overflow: hidden;
    }

    thead {
      background: rgba(0, 255, 159, 0.08);
    }

    th, td {
      padding: 1rem;
      text-align: left;
      border-bottom: 1px solid var(--color-border);
    }

    th {
      font-family: var(--font-display);
      color: var(--color-accent-neon);
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    tbody tr {
      transition: background 0.3s ease;
    }

    tbody tr:hover {
      background: rgba(0, 255, 159, 0.05);
    }

    .action-links a {
      text-decoration: none;
      font-weight: 600;
      padding: 0.3rem 0.7rem;
      border-radius: 6px;
      transition: 0.3s;
      margin-right: 0.4rem;
    }

    .action-links a:first-child {
      color: var(--color-accent-neon);
      border: 1px solid var(--color-accent-neon);
    }

    .action-links a:first-child:hover {
      background: var(--color-accent-neon);
      color: #0a0f14;
      box-shadow: 0 0 10px var(--color-accent-neon);
    }

    .action-links .delete-link {
      color: var(--color-accent-pink);
      border: 1px solid var(--color-accent-pink);
    }

    .action-links .delete-link:hover {
      background: var(--color-accent-pink);
      color: #0a0f14;
      box-shadow: 0 0 10px var(--color-accent-pink);
    }

    .pagination-container {
      display: flex;
      justify-content: center;
      margin-top: 1.5rem;
      flex-wrap: wrap;
      gap: 0.4rem;
    }

    .pagination-container button {
      padding: 0.5rem 0.9rem;
      border: 1px solid var(--color-accent-neon);
      background: transparent;
      color: var(--color-accent-neon);
      font-family: var(--font-mono);
      border-radius: 6px;
      cursor: pointer;
      transition: 0.3s;
    }

    .pagination-container button:hover:not(:disabled),
    .pagination-container button.active {
      background: var(--color-accent-neon);
      color: #0a0f14;
      box-shadow: 0 0 10px var(--color-accent-neon);
    }

    .pagination-container button:disabled {
      opacity: 0.4;
      cursor: not-allowed;
    }

    .create-record-btn {
      display: block;
      margin: 2rem auto 0;
      padding: 0.9rem 1.6rem;
      font-family: var(--font-display);
      font-weight: bold;
      color: var(--color-accent-neon);
      border: 2px solid var(--color-accent-neon);
      border-radius: 10px;
      text-decoration: none;
      transition: 0.3s ease;
      text-transform: uppercase;
      text-align: center;
      letter-spacing: 1px;
      text-shadow: 0 0 8px var(--color-accent-neon);
    }

    .create-record-btn:hover {
      background: var(--color-accent-neon);
      color: #0a0f14;
      box-shadow: 0 0 15px var(--color-accent-neon);
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>User Data Grid // Access Terminal</h1>

    <div class="search-container">
      <input type="text" id="searchBox" placeholder="Search records...">
    </div>

    <div class="table-responsive">
      <table id="studentsTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Email</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach (html_escape($users) as $user): ?>
            <tr>
              <td><?=$user['id'];?></td>
              <td><?=$user['last_name'];?></td>
              <td><?=$user['first_name'];?></td>
              <td><?=$user['email'];?></td>
              <td class="action-links">
                <a href="<?=site_url('users/update/'.$user['id']);?>">Update</a>
                <a href="<?=site_url('users/delete/'.$user['id']);?>" class="delete-link" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div id="pagination" class="pagination-container"></div>

    <a href="<?=site_url('users/create');?>" class="create-record-btn">Create New Record</a>
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
      let html = '';
      const maxButtons = 5;
      let startPage = Math.max(1, currentPage - Math.floor(maxButtons / 2));
      let endPage = Math.min(totalPages, startPage + maxButtons - 1);

      if (endPage - startPage + 1 < maxButtons) {
        startPage = Math.max(1, endPage - maxButtons + 1);
      }

      html += `<button onclick="gotoPage(1)" ${currentPage===1?'disabled':''}>&laquo;</button>`;
      html += `<button onclick="gotoPage(${currentPage-1})" ${currentPage===1?'disabled':''}>&lt;</button>`;

      for (let i = startPage; i <= endPage; i++) {
        html += `<button onclick="gotoPage(${i})" class="${i===currentPage?'active':''}">${i}</button>`;
      }

      html += `<button onclick="gotoPage(${currentPage+1})" ${currentPage===totalPages?'disabled':''}>&gt;</button>`;
      html += `<button onclick="gotoPage(${totalPages})" ${currentPage===totalPages?'disabled':''}>&raquo;</button>`;

      pagination.innerHTML = html;
    }

    function gotoPage(page) {
      renderTable(page);
    }

    searchBox.addEventListener('input', () => renderTable(1));
    renderTable(1);
  </script>
</body>
</html>
