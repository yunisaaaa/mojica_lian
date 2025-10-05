<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UPDATE USER</title>

  <!-- Keep Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    :root {
      --color-bg: #f8fafc;
      --color-panel: #ffffff;
      --color-border: #e2e8f0;
      --color-text-primary: #1e293b;
      --color-accent: #2563eb;
      --color-input-bg: #f1f5f9;
      --color-shadow: rgba(0, 0, 0, 0.05);
      --font-body: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: var(--color-bg);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      font-family: var(--font-body);
      color: var(--color-text-primary);
      padding: 1rem;
    }

    .form-container {
      background-color: var(--color-panel);
      border: 1px solid var(--color-border);
      border-radius: 16px;
      padding: 2.5rem 3rem;
      width: 400px;
      box-shadow: 0 8px 25px var(--color-shadow);
      animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h1 {
      color: var(--color-accent);
      font-size: 1.6rem;
      text-align: center;
      font-weight: 700;
      letter-spacing: 0.5px;
      margin-bottom: 2rem;
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
      width: 95%;
      padding: 0.9rem 1rem;
      background-color: var(--color-input-bg);
      border: 1px solid var(--color-border);
      border-radius: 8px;
      font-size: 1rem;
      color: var(--color-text-primary);
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    input:focus {
      outline: none;
      border-color: var(--color-accent);
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
    }

    button[type="submit"] {
      width: 100%;
      padding: 0.9rem;
      background-color: var(--color-accent);
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.1s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    button[type="submit"]:hover {
      background-color: #1d4ed8;
      transform: translateY(-1px);
    }

    .back-link {
      display: inline-block;
      margin-top: 1.5rem;
      color: var(--color-accent);
      text-decoration: none;
      font-size: 0.95rem;
      font-weight: 600;
      text-align: center;
      width: 100%;
      transition: color 0.3s ease;
    }

    .back-link:hover {
      color: #1d4ed8;
      text-decoration: underline;
    }

    /* RESPONSIVE */
    @media (max-width: 480px) {
      .form-container {
        width: 100%;
        padding: 2rem 1.5rem;
        border-radius: 12px;
      }

      h1 {
        font-size: 1.4rem;
      }
    }

    @media (max-height: 600px) {
      body {
        align-items: flex-start;
        padding-top: 2rem;
      }
    }
  </style>
</head>

<body>
  <div class="form-container">
    <h1>Update User</h1>

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

    <a href="<?=site_url('users/show');?>" class="back-link"><i class="fa-solid fa-arrow-left"></i> Back to Dashboard</a>
  </div>
</body>
</html>
