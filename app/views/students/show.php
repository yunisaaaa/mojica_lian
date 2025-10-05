<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  
  <!-- Keep Tailwind + Font Awesome -->
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" referrerpolicy="no-referrer" />

  <style>
  :root {
    --color-bg: #f9fafb;
    --color-panel: #ffffff;
    --color-border: #e5e7eb;
    --color-text-primary: #111827;
    --color-primary: #2563eb;
    --color-danger: #dc2626;
    --font-title: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    --font-body: 'Inter', sans-serif;
  }

  body {
    background-color: var(--color-bg);
    font-family: var(--font-body);
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
    margin: 0;
    padding: 3rem 1rem;
  }

  .container {
    background-color: var(--color-panel);
    border: 1px solid var(--color-border);
    border-radius: 12px;
    width: 100%;
    max-width: 1200px;
    padding: 2.5rem 3rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
  }

  h1 {
    font-family: var(--font-title);
    color: var(--color-primary);
    text-align: center;
    text-transform: uppercase;
    font-size: 1.8rem;
    letter-spacing: 1px;
    margin-bottom: 2rem;
  }

  /* Header Controls */
  .header-controls-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.8rem;
    gap: 1rem;
  }

  .search-container {
    flex: 1;
    max-width: 700px;
  }

  .search-form {
    display: flex;
    align-items: center;
    gap: 0.6rem;
  }

  #searchBox {
    flex: 1;
    padding: 0.8rem 1rem;
    border-radius: 8px;
    background-color: #f3f4f6;
    border: 1px solid var(--color-border);
    color: var(--color-text-primary);
    font-size: 1rem;
    transition: 0.3s ease;
  }

  #searchBox:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(37,99,235,0.2);
  }

  .search-btn {
    padding: 0.8rem 1.2rem;
    border-radius: 8px;
    font-weight: 600;
    border: none;
    background-color: var(--color-primary);
    color: #fff;
    cursor: pointer;
    transition: 0.3s ease;
  }

  .search-btn:hover {
    background-color: #1d4ed8;
  }

  .create-record-btn {
    display: inline-block;
    padding: 0.8rem 1.5rem;
    border-radius: 8px;
    background-color: var(--color-primary);
    color: #fff;
    text-decoration: none;
    text-transform: uppercase;
    font-weight: 600;
    transition: 0.3s ease;
  }

  .create-record-btn:hover {
    background-color: #1d4ed8;
  }

  /* Table */
  .table-responsive {
    width: 100%;
    overflow-x: auto;
    border-radius: 8px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
    font-size: 0.95rem;
  }

  thead {
    background-color: #f3f4f6;
  }

  th, td {
    padding: 1rem;
    border-bottom: 1px solid var(--color-border);
    text-align: center;
    white-space: nowrap;
  }

  th {
    color: var(--color-text-primary);
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.9rem;
  }

  tr:hover {
    background-color: #f9fafb;
  }

  .action-links a {
    color: var(--color-primary);
    text-decoration: none;
    font-weight: 500;
    margin: 0 0.3rem;
  }

  .action-links a:hover {
    text-decoration: underline;
  }

  .action-links .delete-link {
    color: var(--color-danger);
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
    border: 1px solid var(--color-primary);
    border-radius: 8px;
    text-decoration: none;
    color: var(--color-primary);
    font-weight: 600;
    transition: 0.3s ease;
  }

  .pagination-container a:hover {
    background-color: var(--color-primary);
    color: #fff;
  }

  .pagination-container strong {
    background-color: var(--color-primary);
    color: #fff;
  }

  /* Logout under pagination */
  .logout-container {
    margin-top: 1.8rem;
    display: flex;
    justify-content: center;
  }

  .logout-btn {
    background-color: var(--color-danger);
    border: none;
    color: #fff;
    font-weight: 600;
    border-radius: 8px;
    padding: 0.8rem 1.5rem;
    cursor: pointer;
    transition: background-color 0.2s ease, transform 0.1s ease;
  }

  .logout-btn:hover {
    background-color: #b91c1c;
    transform: translateY(-1px);
  }

  /* Responsive */
  @media (max-width: 768px) {
    .header-controls-container {
      flex-direction: column;
      align-items: stretch;
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

    <!-- ✅ Logout button now below pagination -->
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
