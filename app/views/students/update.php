<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UPDATE USER</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      font-family: "Poppins", "Segoe UI", sans-serif;
      color: var(--text-color);
      padding: 1rem;
    }

    .form-container {
      background: var(--panel-color);
      border-radius: 16px;
      padding: 2.5rem 3rem;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 10px 30px rgba(107, 68, 35, 0.1);
      border: 1px solid var(--border-color);
      transition: all 0.3s ease;
      animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h1 {
      color: var(--accent-color);
      text-shadow: 0 0 8px rgba(139, 94, 60, 0.2);
      text-align: center;
      font-size: 1.8rem;
      margin-bottom: 2rem;
      font-weight: 700;
      letter-spacing: 1px;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 1.2rem;
    }

    .form-group {
      text-align: left;
    }

    label {
      display: block;
      color: #5a4634;
      font-size: 0.9rem;
      font-weight: 600;
      margin-bottom: 0.4rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    input[type="text"],
    input[type="email"] {
      width: 100%;
      padding: 0.9rem 1rem;
      background-color: var(--input-bg);
      border: 1px solid var(--border-color);
      border-radius: 10px;
      font-size: 1rem;
      color: var(--text-color);
      transition: all 0.3s ease;
    }

    input:focus {
      outline: none;
      border-color: var(--accent-color);
      box-shadow: 0 0 10px var(--shadow-color);
      background: #fffaf5;
    }

    button[type="submit"] {
      background: var(--accent-color);
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 0.9rem;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: uppercase;
      box-shadow: 0 4px 15px rgba(139, 94, 60, 0.3);
      letter-spacing: 0.5px;
    }

    button[type="submit"]:hover {
      background: var(--accent-hover);
      box-shadow: 0 6px 20px rgba(107, 68, 35, 0.35);
      transform: translateY(-1px);
    }

    .back-link {
      display: inline-block;
      margin-top: 1.5rem;
      color: var(--accent-color);
      text-decoration: none;
      font-size: 0.95rem;
      font-weight: 600;
      text-align: center;
      width: 100%;
      transition: all 0.2s ease;
    }

    .back-link:hover {
      color: var(--accent-hover);
      text-shadow: 0 0 6px rgba(139, 94, 60, 0.3);
    }

    @media (max-width: 480px) {
      .form-container {
        padding: 2rem 1.5rem;
        border-radius: 12px;
      }

      h1 {
        font-size: 1.5rem;
      }
    }
  </style>
</head>

<body>
  <div class="form-container">
    <h1>UPDATE USER</h1>

    <form action="<?=site_url('users/update/'.$user['id']);?>" method="post">
      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" value="<?=html_escape($user['last_name']);?>" required>
      </div>

      <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" value="<?=html_escape($user['first_name']);?>" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?=html_escape($user['email']);?>" required>
      </div>

      <button type="submit">Update Record</button>
    </form>

    <a href="<?=site_url('users/show');?>" class="back-link">
      <i class="fa-solid fa-arrow-left"></i> Back to Dashboard
    </a>
  </div>
</body>
</html>
