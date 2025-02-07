<?php
session_start();
include('config/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: auth/login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM books WHERE id = '$id'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $date_added = $_POST['date_added'];

    $update_query = "UPDATE books SET title='$title', author='$author', date_added='$date_added' WHERE id='$id'";
    $conn->query($update_query);

    header("Location: book.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-4">Edit Book</h2>

        <form method="POST" class="space-y-4">
            <input type="text" name="title" value="<?php echo $row['title']; ?>" class="w-full p-2 border rounded" required>
            <input type="text" name="author" value="<?php echo $row['author']; ?>" class="w-full p-2 border rounded" required>
            <input type="date" name="date_added" value="<?php echo $row['date_added']; ?>" class="w-full p-2 border rounded" required>
            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded">Update Book</button>
        </form>
    </div>
</body>
</html>
