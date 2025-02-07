<?php
include('config/db.php'); // Database connection

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convert ID to integer

    // Delete the book
    $query = "DELETE FROM books WHERE id = $id";
    if ($conn->query($query) === TRUE) {
        // Redirect back to book.php with success message
        header("Location: book.php?message=deleted");
        exit();
    } else {
        header("Location: book.php?message=error");
        exit();
    }
} else {
    // If no ID is provided, return to book.php
    header("Location: book.php");
    exit();
}
?>
