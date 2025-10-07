<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UPDATE USER</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    :root {
      --bg-gradient: linear-gradient(to bottom right, #f7fbff, #e6f0ff);
      --panel-color: #ffffff;
      --accent-color: #0073ff; /* Neon Blue */
      --accent-hover: #005ae0;
      --text-color: #1e293b;
      --border-color: #e2e8f0;
      --input-bg: #f9fafb;
      --shadow-color: rgba(0, 115, 255, 0.25);
      --font-body: 'Inter', 'Segoe UI', sans-serif;
    }

    body {
      background: var(--bg-gradient);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      font-family: var(--font-body);
      color: var(--text-color);
      padding: 1rem;
    }

    .form-container {
      background-color: var(--panel-color);
      border-radius: 16px;
      padding: 2.5rem 3rem;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 10px 30px rgba(0, 115, 255, 0.1);
      border: 1px solid rgba(0, 115, 255, 0.15);
      transition: all 0.3s ease;
      animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h1 {
      color: var(--accent-color);
      text-shadow: 0 0 8px rgba(0, 115, 255, 0.5);
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
      color: #475569;
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
      background: #fff;
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
      box-shadow: 0 4px 15px rgba(0, 115, 255, 0.3);
      letter-spacing: 0.5px;
    }

    button[type="submit"]:hover {
      background: var(--accent-hover);
      box-shadow: 0 6px 20px rgba(0, 115, 255, 0.35);
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
      text-shadow: 0 0 6px rgba(0, 115, 255, 0.5);
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
