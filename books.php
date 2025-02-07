<?php
session_start();
include('config/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: auth/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $date_added = $_POST['date_added'];

    $query = "INSERT INTO books (title, author, date_added) VALUES ('$title', '$author', '$date_added')";
    $conn->query($query);
}

$books = $conn->query("SELECT * FROM books");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-4">Book List</h2>
        
        <table class="w-full border-collapse border border-gray-200 mb-4">
            <tr class="bg-gray-300">
                <th class="border p-2">Title</th>
                <th class="border p-2">Author</th>
                <th class="border p-2">Date Added</th>
                <th class="border p-2">Actions</th>
            </tr>
            <?php while ($row = $books->fetch_assoc()) { ?>
                <tr>
                    <td class="border p-2"><?php echo $row['title']; ?></td>
                    <td class="border p-2"><?php echo $row['author']; ?></td>
                    <td class="border p-2"><?php echo $row['date_added']; ?></td>
                    <td class="border p-2">
                        <a href="edit_book.php?id=<?php echo $row['id']; ?>" class="bg-blue-500 text-white px-3 py-1 rounded">Edit</a>
                        <a href="delete_book.php?id=<?php echo $row['id']; ?>" class="bg-red-500 text-white px-3 py-1 rounded" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <form method="POST" class="space-y-4">
            <input type="text" name="title" placeholder="Book Title" class="w-full p-2 border rounded" required>
            <input type="text" name="author" placeholder="Author" class="w-full p-2 border rounded" required>
            <input type="date" name="date_added" class="w-full p-2 border rounded" required>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Add Book</button>

        </form>
        <div class="mt-4 flex justify-between">
    <!-- <a href="export.php?type=pdf" class="bg-red-500 text-white px-4 py-2 rounded">Download PDF</a> -->
    <a href="export.php?type=excel" class="bg-green-500 text-white px-4 py-2 rounded">Download Excel</a>
</div>

    </div>
</body>
</html>
