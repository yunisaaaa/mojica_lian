<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create User</title>

  <style>
    :root {
      --bg-gradient: linear-gradient(to bottom right, #f6f1eb, #e7d8c9);
      --panel-color: #fffaf5;
      --accent-color: #8b5e3c; /* Coffee brown */
      --accent-hover: #6b4423;
      --text-color: #3e2c21;
      --border-color: #d6c3b4;
      --input-bg: #fdf7f2;
      --shadow-color: rgba(139, 94, 60, 0.25);
    }

    body {
      background: var(--bg-gradient);
      font-family: "Poppins", "Segoe UI", sans-serif;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
    }

    .form-container {
      background: var(--panel-color);
      border-radius: 16px;
      padding: 2.5rem 3rem;
      box-shadow: 0 10px 30px rgba(107, 68, 35, 0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
      border: 1px solid var(--border-color);
      transition: all 0.3s ease;
    }

    .form-container:hover {
      box-shadow: 0 12px 40px rgba(107, 68, 35, 0.15);
    }

    h1 {
      color: var(--accent-color);
      font-size: 1.8rem;
      margin-bottom: 2rem;
      letter-spacing: 1px;
      text-shadow: 0 0 8px rgba(139, 94, 60, 0.2);
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 1.2rem;
    }

    label {
      text-align: left;
      font-size: 0.9rem;
      color: #5a4634;
      font-weight: 600;
      margin-bottom: 0.2rem;
    }

    input[type="text"],
    input[type="email"] {
      width: 100%;
      padding: 0.8rem 1rem;
      border-radius: 10px;
      border: 1px solid var(--border-color);
      background: var(--input-bg);
      font-size: 1rem;
      color: var(--text-color);
      transition: all 0.3s ease;
    }

    input:focus {
      border-color: var(--accent-color);
      outline: none;
      box-shadow: 0 0 10px var(--shadow-color);
      background: #fffaf5;
    }

    button[type="submit"] {
      background: var(--accent-color);
      color: white;
      border: none;
      border-radius: 10px;
      padding: 0.9rem;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
      box-shadow: 0 4px 15px rgba(139, 94, 60, 0.3);
    }

    button[type="submit"]:hover {
      background: var(--accent-hover);
      box-shadow: 0 6px 20px rgba(107, 68, 35, 0.35);
      transform: translateY(-1px);
    }

    .back-link {
      display: inline-block;
      margin-top: 1.5rem;
      text-decoration: none;
      color: var(--accent-color);
      font-weight: 600;
      font-size: 0.95rem;
      transition: all 0.2s ease;
    }

    .back-link:hover {
      color: var(--accent-hover);
      text-shadow: 0 0 6px rgba(139, 94, 60, 0.3);
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
