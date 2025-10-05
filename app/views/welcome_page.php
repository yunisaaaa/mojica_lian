<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to LavaLust</title>
    <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">

    <style>
        /* ======== RESET ======== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", sans-serif;
            background: #fafafa;
            color: #222;
            line-height: 1.6;
        }

        /* ======== LAYOUT ======== */
        .container {
            max-width: 860px;
            margin: 4rem auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .header {
            text-align: center;
            background: #fff;
            border-bottom: 1px solid #eee;
            padding: 2.5rem 1rem;
        }

        .header h1 {
            font-size: 2.2rem;
            font-weight: 600;
            color: #111;
        }

        .header p {
            margin-top: 0.5rem;
            color: #666;
            font-size: 1rem;
        }

        .main {
            padding: 2rem 2.5rem;
        }

        h2 {
            font-size: 1.3rem;
            font-weight: 600;
            color: #111;
            margin: 2.5rem 0 1rem;
        }

        p {
            margin-bottom: 1.2rem;
            color: #444;
        }

        /* ======== CODE BLOCKS ======== */
        pre, code {
            background: #f6f6f6;
            padding: 1rem;
            border-radius: 8px;
            font-family: "Fira Code", monospace;
            font-size: 0.9rem;
            overflow-x: auto;
            color: #111;
            border: 1px solid #eee;
        }

        /* ======== GRID ======== */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 1.2rem;
            transition: all 0.25s ease;
        }

        .card:hover {
            border-color: #ddd;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        }

        .card h3 {
            font-size: 1rem;
            color: #111;
            margin-bottom: 0.5rem;
        }

        .card p {
            font-size: 0.95rem;
            color: #555;
        }

        /* ======== LINKS ======== */
        a {
            color: #0071e3;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        ul {
            margin-top: 0.5rem;
            padding-left: 1.2rem;
        }

        li {
            margin-bottom: 0.5rem;
        }

        /* ======== FOOTER ======== */
        .footer {
            text-align: center;
            background: #fafafa;
            padding: 1.5rem;
            font-size: 0.9rem;
            color: #666;
            border-top: 1px solid #eee;
        }

        /* ======== RESPONSIVE ======== */
        @media (max-width: 600px) {
            .container {
                margin: 1.5rem;
            }

            .main {
                padding: 1.5rem;
            }

            .header h1 {
                font-size: 1.7rem;
            }

            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🔥 LavaLust Framework</h1>
            <p>Lightweight • Fast • MVC for PHP Developers</p>
        </div>

        <div class="main">
            <h2>What is LavaLust?</h2>
            <p><strong>LavaLust</strong> is a lightweight PHP framework that follows the MVC (Model–View–Controller) pattern. It's designed for developers who want a structured yet minimalistic PHP development experience.</p>

            <h2>🚀 Key Features</h2>
            <div class="grid">
                <div class="card">
                    <h3>🧠 MVC Architecture</h3>
                    <p>Clear separation of concerns with Models, Views, and Controllers.</p>
                </div>
                <div class="card">
                    <h3>⚙️ Built-in Routing</h3>
                    <p>Clean and flexible routing system similar to Laravel or CodeIgniter.</p>
                </div>
                <div class="card">
                    <h3>📦 Libraries & Helpers</h3>
                    <p>Includes utilities for sessions, forms, database, validation, and more.</p>
                </div>
                <div class="card">
                    <h3>📁 Organized Structure</h3>
                    <p>Modular folder structure for scalable app development.</p>
                </div>
                <div class="card">
                    <h3>🔗 REST API Support</h3>
                    <p>Build RESTful APIs easily using built-in tools and conventions.</p>
                </div>
                <div class="card">
                    <h3>📘 ORM-like Models</h3>
                    <p>Use LavaLust's model layer for structured database operations with ease.</p>
                </div>
            </div>

            <h2>📂 Project Structure</h2>
            <pre><code>
/app
  /config
  /controllers
  /helpers
  /language
  /libraries
  /models
  /views
/console
/public
/runtime
/scheme
            </code></pre>

            <h2>🧪 Quick Example</h2>
            <p>Route in <code>app/config/routes.php</code></p>
<pre><code>
$router->get('/', 'Welcome::index');
</code></pre>
            <p>Controller method in <code>app/controllers/Welcome.php</code>:</p>
            <pre><code>
class Welcome extends Controller {
    public function index() {
        $this->call->view('welcome_page');
    }
}
            </code></pre>

            <p>View file at: <code>app/Views/welcome_page.php</code></p>

            <h2>📚 Learn More</h2>
            <ul>
                <li><a href="https://github.com/ronmarasigan/LavaLust">GitHub Repository</a></li>
                <li><a href="https://lavalust.netlify.app/">Official Documentation</a></li>
            </ul>
        </div>

        <div class="footer">
            Page rendered in <strong><?php echo lava_instance()->performance->elapsed_time('lavalust'); ?></strong> seconds.
            Memory usage: <?php echo lava_instance()->performance->memory_usage(); ?>.
            <?php if(config_item('ENVIRONMENT') === 'development'): ?>
                <br>LavaLust Version <strong><?php echo config_item('VERSION'); ?></strong>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
