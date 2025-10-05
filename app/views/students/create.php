<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create User</title>

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" referrerpolicy="no-referrer" />

  <style>
    :root {
      --bg-color: #f5f6fa;
      --panel-color: #ffffff;
      --border-color: #e0e0e0;
      --text-color: #222;
      --accent-color: #2563eb; /* Modern blue */
      --accent-hover: #1e4ed8;
      --font-body: "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }

    body {
      background-color: var(--bg-color);
      color: var(--text-color);
      font-family: var(--font-body);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      padding: 1rem;
    }

    .form-container {
      background-color: var(--panel-color);
      border: 1px solid var(--border-color);
      border-radius: 12px;
      padding: 2.5rem 2.8rem;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      transition: all 0.3s ease;
    }

    .form-container:hover {
      box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }

    h1 {
      color: var(--accent-color);
      font-size: 1.6rem;
      font-weight: 700;
      margin-bottom: 2rem;
      letter-spacing: 0.5px;
      text-align: center;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 1.4rem;
      width: 95%;
    }

    label {
      display: block;
      text-align: left;
      margin-bottom: 0.4rem;
      font-size: 0.9rem;
      font-weight: 600;
      color: #444;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    input[type="text"],
    input[type="email"] {
      width: 100%;
      padding: 0.85rem 1rem;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      background-color: #f9fafb;
      color: var(--text-color);
      font-size: 1rem;
      transition: all 0.2s ease;
    }

    input:focus {
      outline: none;
      border-color: var(--accent-color);
      background-color: #fff;
      box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
    }

    button[type="submit"] {
      width: 100%;
      padding: 0.9rem;
      font-size: 1rem;
      font-weight: 600;
      color: #fff;
      background-color: var(--accent-color);
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.2s ease, transform 0.1s ease;
    }

    button[type="submit"]:hover {
      background-color: var(--accent-hover);
      transform: translateY(-1px);
    }

    button[type="submit"]:active {
      transform: translateY(1px);
    }

    .back-link {
      display: block;
      margin-top: 1.8rem;
      color: var(--accent-color);
      text-decoration: none;
      font-size: 0.95rem;
      text-align: center;
      transition: color 0.2s ease;
    }

    .back-link:hover {
      color: var(--accent-hover);
    }

    @media (max-width: 480px) {
      .form-container {
        padding: 2rem 1.5rem;
      }

      h1 {
        font-size: 1.4rem;
      }
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h1>CREATE USER</h1>

    <form action="<?=site_url('users/create');?>" method="post">
      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" required>
      </div>

      <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>

      <button type="submit">Submit</button>
    </form>

    <a href="<?=site_url('users/show');?>" class="back-link">Back to Dashboard</a>
  </div>
</body>
</html>
