<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data Grid | System Console</title>
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
            --color-accent-pink: #ff3366;
            --color-border: #333;
            --color-input-bg: #181818;
            --color-table-header-bg: #1e1e1e;
            --color-table-row-hover: #1e1e1e;
            --font-display: 'Orbitron', sans-serif;
            --font-mono: 'Roboto Mono', monospace;
            --shadow-neon: 0 0 10px rgba(0, 255, 128, 0.5);
            --shadow-neon-pink: 0 0 10px rgba(255, 51, 102, 0.5);
        }

        /*
        -- Base & Body Styles --
        */
        body {
            background-color: var(--color-bg-primary);
            color: var(--color-text-primary);
            font-family: var(--font-mono);
            margin: 0;
            padding: 2rem 1rem;
            display: flex;
            flex-direction: column;
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
            width: 100%;
            max-width: 1200px;
            margin-top: 2rem;
            background: var(--color-bg-secondary);
            backdrop-filter: blur(8px);
            border: 1px solid var(--color-border);
            box-shadow: var(--shadow-neon);
            padding: 2.5rem;
            border-radius: 12px;
            position: relative;
        }

        /*
        -- Heading --
        */
        h1 {
            font-family: var(--font-display);
            font-size: clamp(1.5rem, 5vw, 2.5rem);
            font-weight: 700;
            text-align: center;
            margin-bottom: 2rem;
            color: var(--color-accent-neon);
            text-shadow: var(--shadow-neon);
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /*
        -- Search Box --
        */
        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        #searchBox {
            width: 100%;
            max-width: 350px;
            padding: 0.7rem 1rem;
            border-radius: 6px;
            border: 1px solid var(--color-border);
            background: var(--color-input-bg);
            color: var(--color-text-primary);
            font-family: var(--font-mono);
            font-size: 1rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        #searchBox:focus {
            outline: none;
            border-color: var(--color-accent-neon);
            box-shadow: 0 0 5px var(--color-accent-neon);
        }

        /*
        -- Responsive Table Wrapper --
        */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /*
        -- Table Styles --
        */
        table {
            width: 100%;
            min-width: 600px; /* Ensures columns are not too narrow */
            border-collapse: collapse;
            text-align: left;
            font-size: 0.95rem;
            border-radius: 8px;
        }

        th, td {
            padding: 1rem;
            border-bottom: 1px solid var(--color-border);
        }

        thead {
            background-color: var(--color-table-header-bg);
        }
        
        th {
            font-weight: 700;
            color: var(--color-accent-neon);
            text-transform: uppercase;
        }

        tr {
            transition: background-color 0.3s ease;
        }
        
        tbody tr:hover {
            background-color: var(--color-table-row-hover);
            box-shadow: inset 2px 0 0 0 var(--color-accent-neon);
        }

        /* -- Action Links --
        */
        .action-links {
            white-space: nowrap;
        }

        .action-links a {
            text-decoration: none;
            color: var(--color-accent-neon);
            font-weight: 700;
            padding: 0.25rem 0.5rem;
            border: 1px solid transparent;
            transition: all 0.2s ease-in-out;
        }
        
        .action-links a:hover {
            border-color: var(--color-accent-neon);
            box-shadow: 0 0 5px var(--color-accent-neon);
        }

        .action-links a.delete-link {
            color: var(--color-accent-pink);
        }
        
        .action-links a.delete-link:hover {
            border-color: var(--color-accent-pink);
            box-shadow: 0 0 5px var(--color-accent-pink);
        }

        /*
        -- Pagination --
        */
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin: 2rem 0 1rem 0;
        }

        .pagination-container button {
            margin: 0 0.25rem;
            padding: 0.5rem 0.8rem;
            border: 1px solid var(--color-accent-neon);
            background-color: transparent;
            color: var(--color-accent-neon);
            border-radius: 5px;
            cursor: pointer;
            font-family: var(--font-mono);
            font-size: 1rem;
            transition: background-color 0.2s, color 0.2s, box-shadow 0.2s;
        }

        .pagination-container button:hover:not(:disabled) {
            background-color: var(--color-accent-neon);
            color: var(--color-bg-primary);
            box-shadow: 0 0 10px var(--color-accent-neon);
        }

        .pagination-container button:disabled {
            border-color: #555;
            color: #555;
            cursor: not-allowed;
            opacity: 0.5;
        }

        .pagination-container button.active {
            background-color: var(--color-accent-neon);
            color: var(--color-bg-primary);
            font-weight: bold;
        }

        /* -- Create Record Button --
        */
        .create-record-btn {
            display: inline-block;
            margin-top: 2rem;
            padding: 0.75rem 1.5rem;
            background-color: transparent;
            color: var(--color-accent-neon);
            text-decoration: none;
            border: 2px solid var(--color-accent-neon);
            border-radius: 8px;
            font-weight: 700;
            font-family: var(--font-display);
            transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
            text-shadow: 0 0 5px var(--color-accent-neon);
            box-shadow: 0 0 10px rgba(0, 255, 128, 0.4);
            text-transform: uppercase;
        }

        .create-record-btn:hover {
            background-color: var(--color-accent-neon);
            color: var(--color-bg-primary);
            box-shadow: 0 0 20px var(--color-accent-neon);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Data Grid // Access Terminal</h1>
        
        <div class="search-container">
            <input type="text" id="searchBox" placeholder="Search records...">
        </div>
        
        <div class="table-responsive">
            <table id="studentsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (html_escape($users) as $user):?>
                        <tr>
                            <td><?=$user['id'];?></td>
                            <td><?=$user['last_name'];?></td>
                            <td><?=$user['first_name'];?></td>
                            <td><?=$user['email'];?></td>
                            <td class="action-links">
                                <a href="<?=site_url('users/update/'.$user['id']);?>">Update</a> |
                                <a href="<?=site_url('users/delete/'.$user['id']);?>" class="delete-link" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        
        <div id="pagination" class="pagination-container"></div>
        
        <div style="text-align: center;">
            <a href="<?=site_url('users/create');?>" class="create-record-btn">Create New Record</a>
        </div>
    </div>

    <script>
    // Live search and pagination (client-side)
    const searchBox = document.getElementById('searchBox');
    const table = document.getElementById('studentsTable');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const pagination = document.getElementById('pagination');
    const pageSize = 5;
    let currentPage = 1;

    function filterRows() {
        const query = searchBox.value.trim().toLowerCase();
        return rows.filter(row => {
            return Array.from(row.children).some(cell =>
                cell.textContent.toLowerCase().includes(query)
            );
        });
    }

    function renderTable(page = 1) {
        const filtered = filterRows();
        const total = filtered.length;
        const totalPages = Math.ceil(total / pageSize) || 1;
        if (page > totalPages) page = totalPages;
        currentPage = page;
        tbody.innerHTML = '';
        const start = (page - 1) * pageSize;
        const end = start + pageSize;
        filtered.slice(start, end).forEach(row => tbody.appendChild(row));
        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        let html = '';
        const maxButtons = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxButtons / 2));
        let endPage = Math.min(totalPages, startPage + maxButtons - 1);

        if (endPage - startPage + 1 < maxButtons) {
            startPage = Math.max(1, endPage - maxButtons + 1);
        }

        // Always render pagination
        html += <button onclick="gotoPage(1)" ${currentPage===1?'disabled':''}>&laquo;</button>;
        html += <button onclick="gotoPage(${currentPage-1})" ${currentPage===1?'disabled':''}>&lt;</button>;
        
        for (let i = startPage; i <= endPage; i++) {
            html += <button onclick="gotoPage(${i})" class="${i===currentPage?'active':''}">${i}</button>;
        }

        html += <button onclick="gotoPage(${currentPage+1})" ${currentPage===totalPages?'disabled':''}>&gt;</button>;
        html += <button onclick="gotoPage(${totalPages})" ${currentPage===totalPages?'disabled':''}>&raquo;</button>;
        
        pagination.innerHTML = html;
    }

    function gotoPage(page) {
        renderTable(page);
    }

    searchBox.addEventListener('input', () => renderTable(1));
    // Initial render
    renderTable(1);
    </script>
</body>
</html>