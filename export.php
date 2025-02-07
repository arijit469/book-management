<?php
include('config/db.php');

if (isset($_GET['type'])) {
    $type = $_GET['type'];

    $query = "SELECT title, author FROM books";
    $result = $conn->query($query);
    
    if ($type == 'pdf') {
        require('fpdf/fpdf.php'); // Ensure this path is correct
        
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);

        // Table Headers
        $pdf->Cell(90, 10, 'Title', 1, 0, 'C');
        $pdf->Cell(90, 10, 'Author', 1, 1, 'C');

        // Table Data
        while ($row = $result->fetch_assoc()) {
            $pdf->Cell(90, 10, $row['title'], 1, 0, 'C');
            $pdf->Cell(90, 10, $row['author'], 1, 1, 'C');
        }

        $pdf->Output('D', 'books.pdf'); // Download PDF
        exit();
    } 

    elseif ($type == 'excel') {
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=books.xls");
        echo "Title\tAuthor\n";
        while ($row = $result->fetch_assoc()) {
            echo $row['title'] . "\t" . $row['author'] . "\n";
        }
        exit();
    }
}
?>
