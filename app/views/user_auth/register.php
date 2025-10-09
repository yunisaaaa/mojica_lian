<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Register | System Console</title>

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  :root {
    --bg-color: #f5ede3;
    --panel-bg: #fffaf5;
    --border-color: #d6c3b4;
    --primary-color: #8b5e3c; /* Coffee brown */
    --primary-hover: #6b4423;
    --text-color: #3e2c21;
    --text-muted: #5a4634;
    --input-bg: #fdf7f2;
    --input-border: #d6c3b4;
    --error-color: #b23c17;
    --radius: 10px;
    --shadow-color: rgba(139, 94, 60, 0.25);
    --font-main: "Poppins", sans-serif;
  }

  body {
    background: linear-gradient(135deg, #f6f1eb, #e7d8c9);
    font-family: var(--font-main);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    overflow: hidden;
    color: var(--text-color);
  }

  body::before {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background:
      radial-gradient(circle at 20% 20%, rgba(139,94,60,0.05) 0%, transparent 60%),
      radial-gradient(circle at 80% 80%, rgba(139,94,60,0.05) 0%, transparent 60%);
    z-index: 0;
  }

  .form-container {
    position: relative;
    z-index: 1;
    background: var(--panel-bg);
    border: 1px solid var(--border-color);
    box-shadow: 0 8px 25px rgba(107, 68, 35, 0.1);
    border-radius: var(--radius);
    padding: 2.5rem;
    width: 400px;
    text-align: center;
    transition: all 0.3s ease;
  }

  .form-container:hover {
    box-shadow: 0 8px 35px rgba(107, 68, 35, 0.15);
  }

  h1 {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--primary-color);
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 1.8rem;
    text-shadow: 0 0 8px rgba(139, 94, 60, 0.2);
  }

  form {
    display: flex;
    flex-direction: column;
    gap: 1.2rem;
  }

  label {
    text-align: left;
    font-weight: 600;
    color: var(--text-muted);
    font-size: 0.9rem;
    letter-spacing: 0.5px;
  }

  .input-wrapper {
    position: relative;
  }

  input[type="text"],
  input[type="email"],
  input[type="password"],
  select {
    width: 100%;
    padding: 0.75rem 2.5rem 0.75rem 1rem;
    background-color: var(--input-bg);
    border: 1px solid var(--input-border);
    border-radius: var(--radius);
    font-size: 1rem;
    color: var(--text-color);
    transition: all 0.25s ease;
  }

  input:focus,
  select:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 8px var(--shadow-color);
    background-color: #fffaf5;
  }

  select {
    appearance: none;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml;utf8,<svg fill='%235a4634' height='16' viewBox='0 0 24 24' width='16' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 16px;
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
    transition: color 0.2s ease;
  }

  .toggle-password:hover {
    color: var(--primary-color);
  }

  button[type="submit"] {
    width: 100%;
    padding: 0.9rem;
    font-weight: 700;
    font-size: 1rem;
    letter-spacing: 1px;
    color: #fff;
    background: var(--primary-color);
    border: none;
    border-radius: var(--radius);
    cursor: pointer;
    transition: background 0.25s ease, transform 0.15s ease, box-shadow 0.25s ease;
    box-shadow: 0 4px 15px rgba(139, 94, 60, 0.3);
  }

  button[type="submit"]:hover {
    background-color: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(107, 68, 35, 0.35);
  }

  .back-link {
    display: block;
    margin-top: 1.5rem;
    color: var(--primary-color);
    text-decoration: none;
    font-size: 0.95rem;
    font-weight: 600;
    transition: color 0.2s ease;
  }

  .back-link:hover {
    color: var(--primary-hover);
    text-decoration: underline;
  }

  .error {
    color: var(--error-color);
    font-size: 0.9rem;
    margin-bottom: 1rem;
    text-align: center;
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
    <h1>Create Account</h1>

    <?php if(isset($error)): ?>
      <div class="error"><?=$error;?></div>
    <?php endif; ?>

    <form action="<?=site_url('register');?>" method="post" autocomplete="on">
      <div class="form-group">
        <label for="role">Role</label>
        <div class="input-wrapper">
          <select id="role" name="role" required>
            <option value="" disabled selected hidden>Select role</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
          </select>
        </div>
      </div>

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

      <button type="submit">Register</button>
    </form>

    <a href="<?=site_url('login');?>" class="back-link">Already have an account?</a>
  </div>

<script>
  const toggleBtn = document.getElementById('togglePassword');
  const pwd = document.getElementById('password');
  const icon = toggleBtn.querySelector('i');

  toggleBtn.addEventListener('click', () => {
    const isHidden = pwd.type === 'password';
    pwd.type = isHidden ? 'text' : 'password';
    icon.classList.toggle('fa-eye');
    icon.classList.toggle('fa-eye-slash');
    toggleBtn.setAttribute('aria-pressed', String(isHidden));
    toggleBtn.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
  });
</script>
</body>
</html>
