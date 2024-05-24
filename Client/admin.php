<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Manager Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <header>
    <a href="export_to_csv.php" class="button1">Export Clients to CSV</a>
    </header>
    <h1>Admin Panel</h1>
    <h2>Add New Client</h2>
    <form action="admin_process.php" method="post">
        <input type="hidden" name="action" value="add">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <button type="submit">Add Client</button>
    </form>

    <h2>Existing Clients</h2>
    <!-- Clients table -->
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php include 'list_clients.php'; ?>
        </tbody>
    </table>

    <!-- Modal Structure -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form action="admin_process.php" method="POST">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" id="clientId" name="id"> <!-- Ensure this is correct -->
                Name: <input type="text" id="editName" name="name" required>
                Email: <input type="email" id="editEmail" name="email" required>
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>
    <script src="admin.js"></script>
</body>
</html>

