<?php
session_start();
include 'configs/DbConn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["export_pdf"])) {
        // Implement PDF export logic
        // You can use a library like FPDF or TCPDF
        // Example: https://www.fpdf.org/

    } elseif (isset($_POST["export_text"])) {
        // Implement Text file export logic
        $filename = "authors_list.txt";
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = "";
        $result = $DbConn->query("SELECT * FROM users ORDER BY Full_Name");

        if ($result->rowCount() > 0) {
            foreach ($result as $row) {
                $output .= implode("\t", $row) . "\n";
            }
        }

        echo $output;

    } elseif (isset($_POST["export_excel"])) {
        // Implement Excel (CSV) export logic
        $filename = "authors_list.csv";
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        fputcsv($output, array('ID', 'Full name', 'Email', 'Phone number', 'User name', 'Password', 'User type', 'Access time', 'Address'));

        $result = $DbConn->query("SELECT * FROM users ORDER BY Full_Name");

        if ($result->rowCount() > 0) {
            foreach ($result as $row) {
                fputcsv($output, $row);
            }
        }

        fclose($output);
    }
}
?>
