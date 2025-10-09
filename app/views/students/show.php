<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  
  <style>
    :root {
      --bg-gradient: linear-gradient(to bottom right, #f6f1eb, #e7d8c9);
      --panel-color: #fffaf5;
      --accent-color: #8b5e3c;
      --accent-hover: #6b4423;
      --text-color: #3e2c21;
      --border-color: #d6c3b4;
      --shadow-color: rgba(139, 94, 60, 0.25);
      --danger: #b23c17;
    }

    body {
      background: var(--bg-gradient);
      font-family: "Poppins", "Segoe UI", sans-serif;
      color: var(--text-color);
      margin: 0;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 3rem 1rem;
    }

    .container {
      background: var(--panel-color);
      border: 1px solid var(--border-color);
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(107, 68, 35, 0.1);
      padding: 2.5rem 3rem;
      width: 100%;
      max-width: 1100px;
      transition: all 0.3s ease;
    }

    .container:hover {
      box-shadow: 0 12px 40px rgba(107, 68, 35, 0.15);
    }

    h1 {
      text-align: center;
      color: var(--accent-color);
      font-size: 1.8rem;
      letter-spacing: 1px;
      text-shadow: 0 0 8px rgba(139, 94, 60, 0.2);
      margin-bottom: 2rem;
    }

    /* Header Controls */
    .header-controls {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      align-items: center;
      margin-bottom: 1.8rem;
      gap: 1rem;
    }

    #searchBox {
      flex: 1;
      padding: 0.8rem 1rem;
      border: 1px solid var(--border-color);
      border-radius: 10px;
      background: #fdf7f2;
      font-size: 1rem;
      transition: all 0.3s ease;
      color: var(--text-color);
    }

    #searchBox:focus {
      border-color: var(--accent-color);
      box-shadow: 0 0 10px var(--shadow-color);
      outline: none;
      background: #fffaf5;
    }

    .search-btn,
    .create-btn {
      background: var(--accent-color);
      color: #fff;
      border: none;
      border-radius: 10px;
      font-weight: 600;
      padding: 0.8rem 1.3rem;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(139, 94, 60, 0.3);
    }

    .search-btn:hover,
    .create-btn:hover {
      background: var(--accent-hover);
      box-shadow: 0 6px 20px rgba(107, 68, 35, 0.35);
      transform: translateY(-1px);
    }

    .create-btn {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      text-decoration: none;
    }

    /* Table */
    .table-container {
      border: 1px solid var(--border-color);
      border-radius: 12px;
      overflow-x: auto;
      background: #fffaf5;
      box-shadow: 0 8px 25px rgba(107, 68, 35, 0.08);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.95rem;
    }

    th, td {
      padding: 1rem;
      border-bottom: 1px solid var(--border-color);
      text-align: center;
    }

    th {
      text-transform: uppercase;
      font-size: 0.85rem;
      color: #5a4634;
      background: #fdf7f2;
    }

    tr:hover {
      background: rgba(243, 233, 221, 0.6);
      transition: 0.2s ease;
    }

    .action-links a {
      color: var(--accent-color);
      text-decoration: none;
      font-weight: 600;
      transition: 0.2s ease;
    }

    .action-links a:hover {
      color: var(--accent-hover);
      text-shadow: 0 0 6px rgba(139, 94, 60, 0.3);
    }

    .delete-link {
      color: var(--danger);
    }

    .delete-link:hover {
      color: #7a1c0f;
    }

    /* Pagination */
    .pagination {
      margin-top: 2rem;
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 0.6rem;
    }

    .pagination a,
    .pagination strong {
      padding: 0.6rem 1.2rem;
      border: 1px solid var(--accent-color);
      border-radius: 8px;
      font-weight: 600;
      color: var(--accent-color);
      text-decoration: none;
      transition: 0.3s ease;
    }

    .pagination a:hover {
      background: var(--accent-color);
      color: #fff;
    }

    .pagination strong {
      background: var(--accent-color);
      color: #fff;
    }

    /* Logout Button */
    .logout-container {
      text-align: center;
      margin-top: 2rem;
    }

    .logout-btn {
      background: var(--danger);
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 0.8rem 1.5rem;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .logout-btn:hover {
      background: #7a1c0f;
      box-shadow: 0 6px 15px rgba(178, 60, 23, 0.4);
      transform: translateY(-1px);
    }

    @media (max-width: 768px) {
      .container {
        padding: 2rem;
      }

      .header-controls {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Users</h1>

    <div class="header-controls">
      <form action="<?= site_url('users/show'); ?>" method="get" style="display: flex; gap: 0.6rem; flex: 1;">
        <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
        <input type="text" name="q" id="searchBox" placeholder="Search records..." value="<?= html_escape($q); ?>">
        <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>

      <?php $current_role = isset($_SESSION['role']) ? $_SESSION['role'] : ''; ?>
      <?php if ($current_role === 'admin'): ?>
      <a href="<?= site_url('users/create'); ?>" class="create-btn"><i class="fa-solid fa-plus"></i> Create User</a>
      <?php endif; ?>
    </div>

    <div class="table-container">
      <table>
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

    <div class="pagination">
      <?php if (isset($page)) echo $page; ?>
    </div>

    <div class="logout-container">
      <?php if (isset($_SESSION['user_id'])): ?>
      <form action="<?= site_url('logout'); ?>" method="post">
        <button type="submit" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
      </form>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
