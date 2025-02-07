<?php
include('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'user')";
    if ($conn->query($query) === TRUE) {
        echo "<p class='text-green-500 text-center'>Registration successful! <a href='login.php'>Login</a></p>";
    } else {
        echo "<p class='text-red-500 text-center'>Error: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md w-96 text-center">
        <h2 class="text-2xl font-bold mb-4">Register</h2>
        <form method="POST" class="space-y-4">
            <input type="text" name="username" placeholder="Username" class="w-full p-2 border rounded" required>
            <input type="password" name="password" placeholder="Password" class="w-full p-2 border rounded" required>
            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded">Register</button>
        </form>
        <p class="mt-4">Already have an account? <a href="login.php" class="text-blue-500">Login</a></p>
    </div>
</body>
</html>
