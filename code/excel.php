<?php

require 'vendor/autoload.php';
require "util/db.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Id');
$sheet->setCellValue('B1', 'Full Name');
$sheet->setCellValue('C1', 'user Name');
$sheet->setCellValue('D1', 'Email');
$sheet->setCellValue('E1', 'Password');

$db = connectDB();
$sql = "SELECT * FROM users";
$stmt = $db->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Set details for the formula that we want to evaluate, together with any data on which it depends
$sheet->fromArray($users, null, 'A2');

$writer = new Xlsx($spreadsheet);
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="usuarios.xlsx"');
$writer->save('php://output');
//$writer->save('usuarios.xlsx');


?>