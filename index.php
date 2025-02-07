<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md text-center w-96">
        <h2 class="text-2xl font-bold">Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <div class="mt-4 space-y-2">
            <a href="books.php" class="block bg-blue-500 text-white px-4 py-2 rounded">Manage Books</a>
            <!-- <a href="export.php" class="block bg-green-500 text-white px-4 py-2 rounded">Export Books</a> -->
            <a href="logout.php" class="block bg-red-500 text-white px-4 py-2 rounded">Logout</a>
        </div>
    </div>
</body>
</html>
