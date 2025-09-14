<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | System Console</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /*
        -- CSS Variables for a centralized theme --
        */
        :root {
            --color-bg-primary: #0a0a0a;
            --color-bg-secondary: rgba(18, 18, 18, 0.7);
            --color-text-primary: #f0f0f0;
            --color-accent-neon: #00ff80;
            --color-border: #333;
            --font-display: 'Orbitron', sans-serif;
            --font-mono: 'Roboto Mono', monospace;
            --shadow-neon: 0 0 10px rgba(0, 255, 128, 0.5);
        }

        /*
        -- Base & Body Styles --
        */
        body {
            background-color: var(--color-bg-primary);
            color: var(--color-text-primary);
            font-family: var(--font-mono);
            margin: 0;
            padding: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image:
                linear-gradient(to right, rgba(0, 255, 128, 0.07) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 255, 128, 0.07) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /*
        -- Main Container --
        */
        .container {
            width: 90%;
            max-width: 500px;
            background: var(--color-bg-secondary);
            backdrop-filter: blur(8px);
            border: 1px solid var(--color-border);
            box-shadow: var(--shadow-neon);
            padding: 3rem;
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        /*
        -- Heading --
        */
        h1 {
            font-family: var(--font-display);
            font-size: clamp(1.5rem, 5vw, 2.5rem);
            font-weight: 700;
            margin-bottom: 3rem;
            color: var(--color-accent-neon);
            text-shadow: var(--shadow-neon);
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /*
        -- Button Group --
        */
        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            width: 100%;
            align-items: center;
        }

        /*
        -- Button Style --
        */
        .main-btn {
            display: block;
            width: 100%;
            max-width: 320px;
            padding: 1rem 0;
            background-color: transparent;
            color: var(--color-accent-neon);
            text-decoration: none;
            border: 2px solid var(--color-accent-neon);
            border-radius: 8px;
            font-weight: 700;
            font-size: clamp(1rem, 3vw, 1.2rem);
            font-family: var(--font-display);
            transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
            text-shadow: 0 0 5px var(--color-accent-neon);
            box-shadow: 0 0 10px rgba(0, 255, 128, 0.4);
            cursor: pointer;
        }

        .main-btn:hover {
            background-color: var(--color-accent-neon);
            color: var(--color-bg-primary);
            box-shadow: 0 0 25px var(--color-accent-neon);
        }

        /*
        -- Responsive Adjustments --
        */
        @media (max-width: 480px) {
            body {
                padding: 1rem;
            }

            .container {
                padding: 2rem 1.5rem;
            }

            h1 {
                margin-bottom: 2rem;
            }

            .btn-group {
                gap: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Management</h1>
        <div class="btn-group">
            <a href="<?=site_url('users/show');?>" class="main-btn">View Students List</a>
            <a href="<?=site_url('users/create');?>" class="main-btn">Add Students</a>
        </div>
    </div>
</body>
</html>

