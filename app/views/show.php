<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
</head>
<body>
    <h2>Student List</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

        <?php if (!empty($users)): ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id']; ?></td>
                    <td><?= $user['last_name']; ?></td>
                    <td><?= $user['first_name']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td>
                        <a href="<?= site_url('users/update/'.$user['id']); ?>">Edit</a> | 
                        <a href="<?= site_url('users/delete/'.$user['id']); ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No students found</td>
            </tr>
        <?php endif; ?>
    </table>

    <!-- Pagination -->
    <div>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="<?= site_url('users/show?page='.$i); ?>" 
                style="<?= ($i == $current_page) ? 'font-weight:bold;' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
</body>
</html>
