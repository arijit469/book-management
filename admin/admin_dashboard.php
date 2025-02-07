<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}
?>
<h2>Admin Dashboard</h2>
<a href="../logout.php">Logout</a>
