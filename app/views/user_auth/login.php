<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Log in</title>

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  :root {
    --color-bg: #f8f9fb;
    --color-panel: #ffffff;
    --color-border: #e0e0e0;
    --color-text: #222;
    --color-primary: #0077ff;
    --color-muted: #666;
    --font-base: 'Poppins', sans-serif;
  }

  body {
    background-color: var(--color-bg);
    font-family: var(--font-base);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    color: var(--color-text);
  }

  .form-container {
    background-color: var(--color-panel);
    border: 1px solid var(--color-border);
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    border-radius: 12px;
    padding: 2.5rem 3rem;
    width: 360px;
    transition: box-shadow 0.3s ease;
  }

  .form-container:hover {
    box-shadow: 0 15px 40px rgba(0,0,0,0.08);
  }

  h1 {
    font-weight: 600;
    font-size: 1.8rem;
    color: var(--color-primary);
    letter-spacing: 1px;
    margin-bottom: 2rem;
    text-align: center;
  }

  form {
    display: flex;
    flex-direction: column;
    gap: 1.4rem;
  }

  label {
    font-size: 0.9rem;
    color: var(--color-muted);
    margin-bottom: 0.4rem;
  }

  .input-wrapper {
    position: relative;
    width: 100%;
  }

  input[type="text"],
  input[type="password"] {
    width: 85%;
    padding: 0.9rem 2.5rem 0.9rem 1rem;
    border: 1px solid var(--color-border);
    border-radius: 8px;
    background-color: #fff;
    color: var(--color-text);
    font-size: 1rem;
    transition: all 0.25s ease;
  }

  input:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(0, 119, 255, 0.15);
  }

  .toggle-password {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: var(--color-muted);
    font-size: 1rem;
    background: transparent;
    border: none;
    transition: color 0.2s ease;
  }

  .toggle-password:hover {
    color: var(--color-primary);
  }

  button[type="submit"] {
    width: 100%;
    padding: 0.9rem;
    font-weight: 600;
    font-size: 1rem;
    color: #fff;
    background-color: var(--color-primary);
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
  }

  button[type="submit"]:hover {
    background-color: #005fd4;
    transform: translateY(-1px);
  }

  .back-link {
    display: block;
    margin-top: 1.8rem;
    color: var(--color-muted);
    text-decoration: none;
    font-size: 0.95rem;
    text-align: center;
    transition: color 0.3s ease;
  }

  .back-link:hover {
    color: var(--color-primary);
  }

  .error {
    color: #d9534f;
    font-size: 0.9rem;
    margin-bottom: 1rem;
    text-align: center;
  }

  @media (max-width: 500px) {
    .form-container {
      padding: 2rem;
      width: 90%;
    }

    h1 {
      font-size: 1.5rem;
    }
  }
</style>
</head>

<body>
  <div class="form-container">
    <h1>LOGIN</h1>

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
