<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Register | System Console</title>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" referrerpolicy="no-referrer" />

<style>
  :root {
    --bg-color: #f4f6f8;
    --panel-bg: #ffffff;
    --border-color: #d1d5db;
    --primary-color: #2563eb;
    --primary-hover: #1e40af;
    --text-color: #111827;
    --text-muted: #6b7280;
    --input-bg: #f9fafb;
    --input-border: #d1d5db;
    --error-color: #dc2626;
    --radius: 8px;
    --font-main: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  }

  body {
    background-color: var(--bg-color);
    font-family: var(--font-main);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: var(--text-color);
    margin: 0;
  }

  .form-container {
    background: var(--panel-bg);
    border: 1px solid var(--border-color);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    border-radius: var(--radius);
    padding: 2.5rem 2.5rem 2rem;
    width: 380px;
    text-align: center;
  }

  h1 {
    font-size: 1.8rem;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 1.8rem;
    letter-spacing: 0.5px;
  }

  form {
    display: flex;
    flex-direction: column;
    gap: 1.2rem;
  }

  label {
    text-align: left;
    display: block;
    margin-bottom: 0.4rem;
    font-weight: 500;
    color: var(--text-muted);
    font-size: 0.9rem;
  }

  input[type="text"],
  input[type="email"],
  input[type="password"],
  select {
    width: 85%;
    padding: 0.75rem 2.5rem 0.75rem 0.9rem;
    background-color: var(--input-bg);
    border: 1px solid var(--input-border);
    border-radius: var(--radius);
    color: var(--text-color);
    font-size: 1rem;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  input:focus,
  select:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
  }

  .input-wrapper {
    position: relative;
  }

  .toggle-password {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: var(--text-muted);
    background: transparent;
    border: none;
    font-size: 1rem;
  }

  .toggle-password:hover {
    color: var(--primary-color);
  }

  button[type="submit"] {
    width: 100%;
    padding: 0.9rem;
    font-weight: 600;
    font-size: 1rem;
    color: #fff;
    background-color: var(--primary-color);
    border: none;
    border-radius: var(--radius);
    cursor: pointer;
    transition: background-color 0.25s ease, box-shadow 0.25s ease;
  }

  button[type="submit"]:hover {
    background-color: var(--primary-hover);
    box-shadow: 0 3px 8px rgba(37, 99, 235, 0.25);
  }

  .back-link {
    display: block;
    margin-top: 1.5rem;
    color: var(--primary-color);
    text-decoration: none;
    font-size: 0.95rem;
    font-weight: 500;
  }

  .back-link:hover {
    text-decoration: underline;
  }

  .error {
    color: var(--error-color);
    font-size: 0.9rem;
    margin-bottom: 1rem;
    text-align: left;
  }

  @media (max-width: 420px) {
    .form-container {
      width: 90%;
      padding: 2rem;
    }
  }
</style>
</head>
<body>
  <div class="form-container">
    <h1>Register</h1>

    <?php if(isset($error)): ?>
      <div class="error"><?=$error;?></div>
    <?php endif; ?>

    <form action="<?=site_url('register');?>" method="post" autocomplete="on">
      <div class="form-group">
        <label for="username">Username</label>
        <div class="input-wrapper">
          <input type="text" id="username" name="username" required autocomplete="username">
        </div>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <div class="input-wrapper">
          <input type="email" id="email" name="email" required autocomplete="email">
        </div>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <div class="input-wrapper">
          <input type="password" id="password" name="password" required autocomplete="new-password">
          <button type="button" id="togglePassword" class="toggle-password" aria-label="Show password" aria-pressed="false">
            <i class="fa-solid fa-eye-slash"></i>
          </button>
        </div>
      </div>

      <div class="form-group">
        <label for="role">Role</label>
        <select id="role" name="role" required>
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
      </div>

      <button type="submit">Register</button>
    </form>

    <a href="<?=site_url('login');?>" class="back-link">Back to Login</a>
  </div>

  <script>
    (function(){
      const toggleBtn = document.getElementById('togglePassword');
      const pwd = document.getElementById('password');
      const icon = toggleBtn.querySelector('i');

      toggleBtn.addEventListener('click', function(){
        const isHidden = pwd.type === 'password';
        pwd.type = isHidden ? 'text' : 'password';
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
        this.setAttribute('aria-pressed', String(isHidden));
        this.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
      });
    })();
  </script>
</body>
</html>
