<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>

  <!-- Tailwind & Font Awesome -->
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" referrerpolicy="no-referrer" />

  <style>
    :root {
      --bg-gradient: linear-gradient(135deg, #f9fafb 0%, #eef2ff 100%);
      --panel-bg: rgba(255, 255, 255, 0.75);
      --border-color: rgba(203, 213, 225, 0.4);
      --text-primary: #1e293b;
      --text-secondary: #64748b;
      --accent: #2563eb;
      --accent-glow: 0 0 10px rgba(37, 99, 235, 0.4);
      --danger: #dc2626;
      --font-heading: 'Poppins', sans-serif;
      --font-body: 'Inter', sans-serif;
    }

    body {
      background: var(--bg-gradient);
      font-family: var(--font-body);
      color: var(--text-primary);
      min-height: 100vh;
      margin: 0;
      padding: 2rem 1rem;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      backdrop-filter: blur(6px);
      animation: gradientMove 10s ease infinite alternate;
    }

    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      100% { background-position: 100% 50%; }
    }

    .container {
      background: var(--panel-bg);
      border: 1px solid var(--border-color);
      border-radius: 16px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
      backdrop-filter: blur(12px);
      padding: 2.5rem 3rem;
      max-width: 1200px;
      width: 100%;
      transition: 0.3s ease;
    }

    .container:hover {
      box-shadow: 0 0 25px rgba(37, 99, 235, 0.15);
    }

    h1 {
      font-family: var(--font-heading);
      text-align: center;
      text-transform: uppercase;
      color: var(--accent);
      font-size: 1.9rem;
      letter-spacing: 1px;
      margin-bottom: 2rem;
      text-shadow: 0 0 10px rgba(37, 99, 235, 0.4);
    }

    /* Search + Create */
    .header-controls-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.8rem;
      gap: 1rem;
    }

    #searchBox {
      flex: 1;
      padding: 0.8rem 1rem;
      border-radius: 10px;
      border: 1px solid var(--border-color);
      background: rgba(255, 255, 255, 0.9);
      font-size: 1rem;
      transition: 0.3s ease;
    }

    #searchBox:focus {
      border-color: var(--accent);
      box-shadow: var(--accent-glow);
      outline: none;
    }

    .search-btn,
    .create-record-btn {
      background: var(--accent);
      color: #fff;
      border: none;
      border-radius: 10px;
      font-weight: 600;
      cursor: pointer;
      padding: 0.8rem 1.4rem;
      transition: 0.3s ease;
      box-shadow: 0 0 0 rgba(37, 99, 235, 0);
    }

    .search-btn:hover,
    .create-record-btn:hover {
      background-color: #1d4ed8;
      box-shadow: 0 0 15px rgba(37, 99, 235, 0.4);
      transform: translateY(-1px);
    }

    .create-record-btn {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      text-decoration: none;
    }

    /* Table */
    .table-responsive {
      overflow-x: auto;
      border-radius: 12px;
      border: 1px solid var(--border-color);
      background: rgba(255, 255, 255, 0.75);
      box-shadow: 0 0 15px rgba(37, 99, 235, 0.1);
      transition: 0.3s ease;
    }

    .table-responsive:hover {
      box-shadow: 0 0 20px rgba(37, 99, 235, 0.25);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.95rem;
    }

    thead {
      background: rgba(240, 245, 255, 0.8);
    }

    th, td {
      padding: 1rem;
      border-bottom: 1px solid var(--border-color);
      text-align: center;
      color: var(--text-primary);
    }

    th {
      text-transform: uppercase;
      font-weight: 600;
      font-size: 0.85rem;
      color: var(--text-secondary);
    }

    tr:hover {
      background: rgba(237, 242, 255, 0.6);
      transition: background 0.2s ease;
    }

    /* Action Links */
    .action-links a {
      color: var(--accent);
      font-weight: 500;
      text-decoration: none;
      transition: 0.2s ease;
    }

    .action-links a:hover {
      text-shadow: 0 0 8px rgba(37, 99, 235, 0.6);
    }

    .action-links .delete-link {
      color: var(--danger);
    }

    /* Pagination */
    .pagination-container {
      margin-top: 2rem;
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 0.5rem;
    }

    .pagination-container a,
    .pagination-container strong {
      padding: 0.6rem 1.2rem;
      border: 1px solid var(--accent);
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      transition: 0.3s ease;
      color: var(--accent);
    }

    .pagination-container a:hover {
      background: var(--accent);
      color: #fff;
      box-shadow: var(--accent-glow);
    }

    .pagination-container strong {
      background: var(--accent);
      color: #fff;
      box-shadow: var(--accent-glow);
    }

    /* Logout */
    .logout-container {
      margin-top: 2rem;
      display: flex;
      justify-content: center;
    }

    .logout-btn {
      background: var(--danger);
      color: #fff;
      border: none;
      border-radius: 10px;
      font-weight: 600;
      padding: 0.8rem 1.5rem;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .logout-btn:hover {
      background-color: #b91c1c;
      box-shadow: 0 0 12px rgba(220, 38, 38, 0.4);
      transform: translateY(-1px);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .container {
        padding: 2rem;
      }

      .header-controls-container {
        flex-direction: column;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Users</h1>

    <div class="header-controls-container">
      <div class="search-container">
        <form action="<?= site_url('users/show'); ?>" method="get" class="search-form">
          <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
          <input type="text" name="q" placeholder="Search records..." value="<?= html_escape($q); ?>" id="searchBox">
          <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
        </form>
      </div>

      <?php $current_role = isset($_SESSION['role']) ? $_SESSION['role'] : ''; ?>
      <?php if ($current_role === 'admin'): ?>
      <a href="<?= site_url('users/create'); ?>" class="create-record-btn"><i class="fa-solid fa-plus"></i> Create New Record</a>
      <?php endif; ?>
    </div>

    <div class="table-responsive">
      <table id="studentsTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Email</th>
            <?php if ($current_role === 'admin'): ?>
            <th>Action</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach (html_escape($users) as $user): ?>
          <tr>
            <td><?= $user['id']; ?></td>
            <td><?= $user['last_name']; ?></td>
            <td><?= $user['first_name']; ?></td>
            <td><?= $user['email']; ?></td>
            <?php if ($current_role === 'admin'): ?>
            <td class="action-links">
              <a href="<?= site_url('users/update/'.$user['id']); ?>">Update</a> |
              <a href="<?= site_url('users/delete/'.$user['id']); ?>" class="delete-link" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
            </td>
            <?php endif; ?>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="pagination-container">
      <?php if (isset($page)) echo $page; ?>
    </div>

    <div class="logout-container">
      <?php if (isset($_SESSION['user_id'])): ?>
      <form action="<?= site_url('logout'); ?>" method="post" style="display: inline;">
        <button type="submit" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
      </form>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
