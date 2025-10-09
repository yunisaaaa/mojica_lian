<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Login Page</title>

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Consolas&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  :root {
    --bg-color: #f5f7fa;
    --panel-bg: rgba(255, 255, 255, 0.9);
    --border-color: rgba(0, 0, 0, 0.08);
    --primary-color: #007bff;
    --primary-hover: #007bff;
    --text-color: #111827;
    --text-muted: #4b5563;
    --input-bg: rgba(255, 255, 255, 0.7);
    --input-border: rgba(0, 0, 0, 0.1);
    --error-color: #dc2626;
    --radius: 10px;
    --font-main: "Consolas", "Courier New", monospace;
  }

  body {
    background: linear-gradient(135deg, #f8fafc, #e3f2fd);
    font-family: var(--font-main);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    overflow: hidden;
    color: var(--text-color);
  }

  /* animated background grid */
  body::before {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 200%; height: 200%;
    background:
      linear-gradient(90deg, rgba(0,0,0,0.03) 1px, transparent 1px),
      linear-gradient(180deg, rgba(0,0,0,0.03) 1px, transparent 1px);
    background-size: 40px 40px;
    animation: moveGrid 10s linear infinite;
    z-index: 0;
  }

  @keyframes moveGrid {
    from { transform: translate(0,0); }
    to { transform: translate(-40px,-40px); }
  }

  .form-container {
    position: relative;
    z-index: 1;
    background: var(--panel-bg);
    border: 1px solid var(--border-color);
    backdrop-filter: blur(15px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
    border-radius: var(--radius);
    padding: 2.5rem;
    width: 380px;
    text-align: center;
    transition: all 0.3s ease;
  }

  .form-container:hover {
    box-shadow: 0 8px 35px rgba(0, 200, 83, 0.15);
  }

  h1 {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--primary-color);
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 1.8rem;
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
  input[type="password"] {
    width: 80%;
    padding: 0.75rem 2.5rem 0.75rem 1rem;
    background-color: var(--input-bg);
    border: 1px solid var(--input-border);
    border-radius: var(--radius);
    font-size: 1rem;
    color: var(--text-color);
    transition: all 0.25s ease;
  }

  input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 8px rgba(0, 200, 83, 0.2);
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
    transition: background 0.25s ease, transform 0.15s ease;
  }

  button[type="submit"]:hover {
    background-color: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0, 200, 83, 0.25);
  }

  .back-link {
    display: block;
    margin-top: 1.5rem;
    color: var(--primary-color);
    text-decoration: none;
    font-size: 0.95rem;
    font-weight: 600;
  }

  .back-link:hover {
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
    <h1>Login</h1>

    <?php if(isset($error)): ?>
      <div class="error"><?=$error;?></div>
    <?php endif; ?>

    <form action="<?=site_url('login');?>" method="post" autocomplete="on">
      <div class="form-group">
        <label for="username">Username</label>
        <div class="input-wrapper">
          <input type="text" id="username" name="username" required autocomplete="username">
        </div>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <div class="input-wrapper">
          <input type="password" id="password" name="password" required autocomplete="current-password">
          <button type="button" id="togglePassword" class="toggle-password" aria-label="Show password" aria-pressed="false">
            <i class="fa-solid fa-eye-slash"></i>
          </button>
        </div>
      </div>

      <button type="submit">Login</button>
    </form>

    <a href="<?=site_url('register');?>" class="back-link">Register</a>
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
